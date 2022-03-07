<?php

namespace App\Http\Controllers;

use App\Models\Check;
use App\Models\Bank;
use App\Models\Document;
use Illuminate\Http\Request;
use Luecano\NumeroALetras\NumeroALetras;

class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checks = Check::all();

        return response()->json(['message' => 'success', 'checks'=>$checks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $lastModel = Check::latest()->first();
        $formatter = new NumeroALetras();

        $check = new Check;
        $check->check_number = date('Ymd').(($lastModel == null)?1:($lastModel->id+1));
        $check->check_name = $request->check_name;
        $check->concept = $request->concept;
        $check->date = $request->date;
        $check->amount = $request->amount;
        $check->total_letters = $formatter->toMoney($request->amount, 2, 'DÓLARES', 'CENTAVOS');
        $check->number_project = $request->number_project;
        $check->bank_id = Bank::where('account_number', $request->account_number)->first()->id;
        $check->type_fund_id = Document::where('document_name', $request->document_name)->first()->id;
        // dd($check);
        $check->save();

        Check::insert($request->except(['grade_name']));
        return response()->json(['message'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Check  $checks
     * @return \Illuminate\Http\Response
     */
    public function show(Check $professor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Check  $checks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Check $professor)
    {
        Check::where('id', $professor->id)->update($request->except(['grade_name']));
        return response()->json(["message"=>"success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Check  $checks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Check $professor)
    {
        Check::where('id', $professor->id)->delete();
        return response()->json(["message"=>"success"]);
    }
}
