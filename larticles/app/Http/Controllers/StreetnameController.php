<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
class StreetnameController extends Controller
{
   

    public function index($strGet= null)
    {
        $straten = null ;
        if($strGet !=null){
            $straten =  \App\City::select('STRAATNM','GEMNM')
            ->where('STRAATNM',$strGet)
            ->orderby('GEMNM')->get();
        }
 
        return view('streetnamepage')->withStraten($straten);
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
   
    public function detail($gemeente,$straat)
    { 
        $data = ['gemeente'=>$gemeente,'straat' => $straat ];
        $validator = Validator::make($data, [
            'gemeente' => 'required|exists:cities,GEMNM',
            'straat' => 'required|exists:cities,STRAATNM',
        ]);

        if ($validator->fails()) {
            $straten = null;
        }else{
            $straten =  \App\City::select('STRAATNM','GEMNM')
            ->where('STRAATNM', $straat)
            ->orderby('GEMNM')->get();
        }
        return view('detailpage')->withStraten($straten)->withGemeente($gemeente);
        
    }

    public  function suggestions($suggest){
        if($suggest != null){
            $streets = \App\City::select('STRAATNM')
            ->where('STRAATNM','like', $suggest.'%')
            ->groupBy('STRAATNM')
            ->limit(20)->get();
            return response()->json($streets);
        }
        return response()->json($suggest);
    } 
    
}