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
        $checks = Check::select('*', 'checks.id as id')
        ->join('banks as ba', 'checks.bank_id', '=', 'ba.id')
        ->join('documents as do', 'checks.type_fund_id', '=', 'do.id')
        // ->join('suppliers as su', 'checks.supplier_id', '=', 'su.id')
        ->get();

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
        $lastModel = Check::latest()->first();
        $formatter = new NumeroALetras();

        $check = new Check;
        $check->check_number = date('Ymd').(($lastModel == null)?1:($lastModel->id+1));
        $check->check_name = $request->check_name;
        $check->concept = $request->concept;
        $check->date = $request->date;
        $check->amount = $request->amount;
        $check->total_letters = $formatter->toInvoice($request->amount, 2, 'DÓLARES', 'CENTAVOS');
        $check->number_project = $request->number_project;
        $check->bank_id = Bank::where('account_number', $request->account_number)->first()->id;
        $check->type_fund_id = Document::where('document_name', $request->document_name)->first()->id;

        $check->save();

        // Check::insert($request->except(['grade_name']));
        return response()->json(['message'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Check  $checks
     * @return \Illuminate\Http\Response
     */
    public function show(Check $check)
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
    public function update(Request $request, Check $check)
    {
        $formatter = new NumeroALetras();

        // $check->check_number = date('Ymd').(($lastModel == null)?1:($lastModel->id+1));
        $check->check_name = $request->check_name;
        $check->concept = $request->concept;
        $check->date = $request->date;
        $check->amount = $request->amount;
        $check->total_letters = $formatter->toMoney($request->amount, 2, 'DÓLARES', 'CENTAVOS');
        $check->number_project = $request->number_project;
        $check->bank_id = Bank::where('account_number', $request->account_number)->first()->id;
        $check->type_fund_id = Document::where('document_name', $request->document_name)->first()->id;

        $check->save();

        return response()->json(["message"=>"success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Check  $checks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Check $check)
    {
        Check::where('id', $check->id)->delete();
        return response()->json(["message"=>"success"]);
    }
}
