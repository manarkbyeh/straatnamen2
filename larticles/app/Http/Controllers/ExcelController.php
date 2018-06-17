<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\City;
use Illuminate\Support\Facades\Route ;

class ExcelController extends Controller
{
   
    public function index()
    {
        $articles = DB::table('cities')
        ->select(DB::raw('count(STRAATNM) as total,
        (CASE WHEN(STRAATNM  REGEXP "rui") then substring(STRAATNM,1,length(STRAATNM)-3)
        WHEN(STRAATNM  REGEXP "plein") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5)
         WHEN(STRAATNM  REGEXP "weg") then substring(STRAATNM,1,length(STRAATNM)-3)
          WHEN(STRAATNM  REGEXP "pad") then substring(STRAATNM,1,length(STRAATNM)-3)
           WHEN(STRAATNM  REGEXP "lei") then substring(STRAATNM,1,length(STRAATNM)-3)
            WHEN(STRAATNM  REGEXP "dok") then substring(STRAATNM,1,length(STRAATNM)-3)
              WHEN(STRAATNM  REGEXP "gat") then substring(STRAATNM,1,length(STRAATNM)-3)
               WHEN(STRAATNM  REGEXP "hof") then substring(STRAATNM,1,length(STRAATNM)-3)
                WHEN(STRAATNM  REGEXP "put") then substring(STRAATNM,1,length(STRAATNM)-3)
        WHEN(STRAATNM  REGEXP "berg") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4)
         WHEN(STRAATNM  REGEXP "laan") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4)
          WHEN(STRAATNM  REGEXP "dijk") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4)
           WHEN(STRAATNM  REGEXP "brug") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4)
             WHEN(STRAATNM  REGEXP "veld") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) 
             WHEN(STRAATNM  REGEXP "baan") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) 
             WHEN(STRAATNM  REGEXP "vest") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4)
              WHEN(STRAATNM  REGEXP "hoek") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4)
               WHEN(STRAATNM  REGEXP "kaai") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) 
        WHEN(STRAATNM  REGEXP "markt") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5)
          
         WHEN(STRAATNM  REGEXP "kouter") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-6)
          WHEN(STRAATNM  REGEXP "heide") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5)
           WHEN(STRAATNM  REGEXP "akker") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5)
            WHEN(STRAATNM  REGEXP "sluis") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5)
             WHEN(STRAATNM  REGEXP "dreef") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) 
             WHEN(STRAATNM  REGEXP "gracht") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-6) 
             WHEN(STRAATNM  REGEXP "plaats") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-6)
              WHEN(STRAATNM  REGEXP "straat") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-6) END) as extend'))
        ->where('STRAATNM', 'like', '%'.' '.'%')
        ->orderBy('total' , 'DESC')
        ->groupBy('extend')
       
        ->get();
       
       
        return view('excel')->withArticles($articles);
    }

  
}
