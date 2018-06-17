<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City ;

class DetailpageController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index(Request $request)
    {
        $straat = $request->input('straat');
        $gemeente = $request->input('gemeente');
      
        if(  $straat !=null &&  $gemeente !=null ){
            $straten =  \App\City::select('STRAATNM','GEMNM')
            ->where('STRAATNM', $straat)
            ->orderby('GEMNM')->get();
        }

        return view('detailpage')->withStraten($straten);
    }
    function Search(Request $request,$street){
        if($request->ajax()){
            if($street !=null){
                $straten =  \App\City::select('STRAATNM','GEMNM')
                ->where('STRAATNM',$street)
                ->orderby('GEMNM')->get()->toJson();
                return $straten;
            }
        }
       return  null;
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function detail()
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
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
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