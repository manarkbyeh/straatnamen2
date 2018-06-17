<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\City;
use Illuminate\Support\Facades\Route ;

class MensController extends Controller
{
   
    public function index()
    {
        $street = City::select('id','STRAATNM')
        ->where('STRAATTYPE',null)
        ->first();
        return view('welcome')->withStreet($street);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update( $id,$mens)
    {
        City::where('id',$id)->where('STRAATTYPE',null)
        ->update(['STRAATTYPE'=>$mens]);
        return redirect()->route('path');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
