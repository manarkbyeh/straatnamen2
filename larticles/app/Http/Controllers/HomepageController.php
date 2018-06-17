<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $street = null ;
        
        return view('homepage')->withStreet($street);
    }
    public function gemeente()
    {
        $gemeente = null ;
        
        return view('gemeente')->withGemeente($gemeente);
    }
    public function suggestions($suggest){
        if($suggest != null){
            $streets = \App\City::select('STRAATNM')
            ->where('STRAATNM','like',   $suggest.'%')
            ->groupBy('STRAATNM')
            ->limit(20)->get();
            return response()->json($streets);
        }
        return response()->json($suggest);
        
    }

    
    public function gemeentesuggestions($suggest){
        
        if($suggest != null){
            $streets = \App\City::select('GEMNM')
            ->where('GEMNM','like',   $suggest.'%')
            ->groupBy('GEMNM')
            ->limit(20)->get();
            return response()->json($streets);
        }
        return response()->json($suggest);
        
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