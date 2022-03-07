<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::all();

        return response()->json(['message' => 'success', 'documents'=>$documents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Document::insert($request->all());
        return response()->json(['message'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $documents
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $documents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        Document::where('id', $document->id)->update($request->all());
        return response()->json(["message"=>"success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $documents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        Document::where('id', $document->id)->delete();
        return response()->json(["message"=>"success"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function documentByDUI(Request $request)
    {
        $document = Document::where(['dui'=>$request->dui])->first();

        return response()->json(['message' => 'success', 'document'=>$document]);
    }
}
