<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\City;
use App\Http\Resources\City as CityResource;
use App\Http\Resources\Achtervoegsels as AchtervoegselsResource;
use App\Http\Resources\Voorvoegsels as VoorvoegselsResource;
use App\Http\Resources\Koning as KoningResource;
use App\Http\Resources\Persoon as PersoonResource;
use App\Http\Resources\Uniek as UniekResource;
use DB;
class ArticleController extends Controller
{
    public function index()
    {
        $articles = DB::table('cities')
        ->select(DB::raw('count(STRAATNM) as total,
        (CASE WHEN(STRAATNM  REGEXP "rui") then substring(STRAATNM,1,length(STRAATNM)-3)
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
         WHEN(STRAATNM  REGEXP "plein") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) 
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
        ->where('STRAATTYPE',null)
        ->groupBy('extend')
       
        ->get();
    

    return PersoonResource::collection(  $articles );
  
        
     

    }
    public function uniek($gemeente)
    {
        $articles=  DB::table('cities')->select('STRAATNM')->distinct() ->limit(20)->get();
      dd( $articles);
   


     
        

    return UniekResource::collection(  $articles );
  
        
     

    }
    public function persoonGemeente($gemeente)
    {
        $articles = DB::table('cities')
        ->select(DB::raw('count(STRAATNM) as total,(CASE WHEN(STRAATNM  REGEXP "rui") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "weg") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "pad") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "lei") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "dok") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "pad") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "gat") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "hof") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "put") then substring(STRAATNM,1,length(STRAATNM)-3)
        WHEN(STRAATNM  REGEXP "berg") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "laan") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "dijk") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "brug") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "laan") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "veld") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "baan") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "vest") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "hoek") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "kaai") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) 
        WHEN(STRAATNM  REGEXP "markt") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) WHEN(STRAATNM  REGEXP "plein") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) WHEN(STRAATNM  REGEXP "kouter") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-6) WHEN(STRAATNM  REGEXP "heide") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) WHEN(STRAATNM  REGEXP "akker") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) WHEN(STRAATNM  REGEXP "sluis") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) WHEN(STRAATNM  REGEXP "dreef") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) WHEN(STRAATNM  REGEXP "gracht") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-6) WHEN(STRAATNM  REGEXP "plaats") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-6) WHEN(STRAATNM  REGEXP "straat") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-6) END) as extend'))
        ->where('STRAATNM', 'REGEXP',  'lei$|laan$|straat$|baan$|rui$|plaats$|markt$|kaai$|weg$|gracht$|plein$|dreef$|veld$|pad$|dok$|poort$|heide$|vaart$|dijk$|gat$|steeg$|sluis$|vest$|brug$|kouter$|akker$|berg$|hoek$|put$|bos$|hof$')     
        ->where('STRAATNM', 'like', '%'.' '.'%')
                     ->where('GEMNM','like', '%'.$gemeente.'%')
                   
                     ->groupBy('total')
                     ->orderBy('total' , 'DESC')
                     ->paginate(30);

    return PersoonResource::collection(  $articles );
  
        
     

    }
    public function getAllextentions($gemeente){
 
       if(trim($gemeente) == "")  return CityResource::collection( null );
        $articles = DB::table('cities')
        ->select( 'STRAATNM', DB::raw('count(STRAATNM) as total'))
        ->groupBy('STRAATNM')
        ->where('GEMNM','like', '%'.$gemeente.'%')
        ->where(function($query) {
            $query->where('STRAATNM', 'like', '%lei')
                ->orWhere('STRAATNM', 'like', '%laan')
                ->orWhere('STRAATNM', 'like', '%straat');
      })->get();
        return CityResource::collection(  $articles );

    }





    public function getvoorvoegsels(){
 
        $articles = DB::table('cities')
        ->select(DB::raw('count(STRAATNM) as total,(CASE WHEN(STRAATNM  REGEXP "rui") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "weg") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "pad") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "lei") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "dok") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "pad") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "gat") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "hof") then substring(STRAATNM,1,length(STRAATNM)-3) WHEN(STRAATNM  REGEXP "put") then substring(STRAATNM,1,length(STRAATNM)-3)
        WHEN(STRAATNM  REGEXP "berg") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "laan") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "dijk") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "brug") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "laan") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "veld") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "baan") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "vest") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "hoek") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) WHEN(STRAATNM  REGEXP "kaai") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-4) 
        WHEN(STRAATNM  REGEXP "markt") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) WHEN(STRAATNM  REGEXP "plein") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-7) WHEN(STRAATNM  REGEXP "kouter") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-6) WHEN(STRAATNM  REGEXP "heide") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) WHEN(STRAATNM  REGEXP "akker") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) WHEN(STRAATNM  REGEXP "sluis") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) WHEN(STRAATNM  REGEXP "dreef") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-5) WHEN(STRAATNM  REGEXP "gracht") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-6) WHEN(STRAATNM  REGEXP "plaats") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-7) WHEN(STRAATNM  REGEXP "straat") then SUBSTRING(STRAATNM , 1 , length(STRAATNM)-6) END) as extend'))
        ->groupBy('extend')
        ->orderBy('total' , 'DESC')
      
        ->get();

                  return VoorvoegselsResource::collection( $articles );

 }


 public function getachtervoegsels(){

    $articles =  DB::table('cities')
    ->select(DB::raw('count(STRAATNM) as total,(CASE WHEN(STRAATNM  REGEXP "lei") 
    then "lei" WHEN(STRAATNM  REGEXP "laan") 
    then "laan"  WHEN(STRAATNM  REGEXP "straat") 
    then "straat" WHEN(STRAATNM  REGEXP "baan") 
    then "plaats" WHEN(STRAATNM  REGEXP "plaats")
     then "baan"  WHEN(STRAATNM  REGEXP "rui") 
     then "rui"  WHEN(STRAATNM  REGEXP "markt")
      then "markt"  WHEN(STRAATNM  REGEXP "hof") 
      then "hof" WHEN(STRAATNM  REGEXP "kaai")
       then "kaai" WHEN(STRAATNM  REGEXP "weg") 
       then "weg" WHEN(STRAATNM  REGEXP "gracht")
        then "gracht" WHEN(STRAATNM  REGEXP "plein") 
        then "plein" WHEN(STRAATNM  REGEXP "dreef")
         then "dreef" WHEN(STRAATNM  REGEXP "veld")
          then "veld" WHEN(STRAATNM  REGEXP "pad") 
          then "pad" WHEN(STRAATNM  REGEXP "gang")
          then "gang" WHEN(STRAATNM  REGEXP "dok") 
          then "dok"  WHEN(STRAATNM  REGEXP "poort") 
          then "poort" WHEN(STRAATNM  REGEXP "heide") 
          then "heide" WHEN(STRAATNM  REGEXP "vaart") 
          then "vaart" WHEN(STRAATNM  REGEXP "dijk") 
          then "dijk"  WHEN(STRAATNM  REGEXP "gat") 
          then "gat" WHEN(STRAATNM  REGEXP "steeg")
          then "sluis" WHEN(STRAATNM  REGEXP "sluis")
          then "steeg" WHEN(STRAATNM  REGEXP "vest") 
          then "vest"  WHEN(STRAATNM  REGEXP "brug")
          then "brug"  WHEN(STRAATNM  REGEXP "kouter")
          then "kouter" WHEN(STRAATNM  REGEXP "akker")
          then "akker" WHEN(STRAATNM  REGEXP "park") 
          then "park" WHEN(STRAATNM  REGEXP "berg") 
          then "berg" WHEN(STRAATNM  REGEXP "hoek") 
          then "hoek" WHEN(STRAATNM  REGEXP "put") 
          then "put" WHEN(STRAATNM  REGEXP "bos") 
          then "bos" END) as extend')) 
             ->where('STRAATNM', 'REGEXP',  
             'lei$|laan$|straat$|baan$|rui$|plaats$|markt$|kaai$|weg$|gracht$|plein$|
             dreef$|veld$|pad$|dok$|poort$|heide$|vaart$|dijk$|gat$|steeg$|sluis$|vest$|
             brug$|kouter$|akker$|berg$|hoek$|put$|bos$|hof$')
             ->groupBy('extend')
             ->get();
              return  $articles ;


}
public function getachtervoegselsgemeente($gemeente ){
 
 if(trim($gemeente) == "")  return AchtervoegselsResource::collection( null );
 $articles = DB::table('cities')
           ->select(DB::raw('count(STRAATNM) as total,(CASE WHEN(STRAATNM  REGEXP "lei") 
           then "lei" WHEN(STRAATNM  REGEXP "laan") 
           then "laan"  WHEN(STRAATNM  REGEXP "straat") 
           then "straat" WHEN(STRAATNM  REGEXP "baan") 
           then "plaats" WHEN(STRAATNM  REGEXP "plaats")
            then "baan"  WHEN(STRAATNM  REGEXP "rui") 
            then "rui"  WHEN(STRAATNM  REGEXP "markt")
             then "markt"  WHEN(STRAATNM  REGEXP "hof") 
             then "hof" WHEN(STRAATNM  REGEXP "kaai")
              then "kaai" WHEN(STRAATNM  REGEXP "weg") 
              then "weg" WHEN(STRAATNM  REGEXP "gracht")
               then "gracht" WHEN(STRAATNM  REGEXP "plein") 
               then "plein" WHEN(STRAATNM  REGEXP "dreef")
                then "dreef" WHEN(STRAATNM  REGEXP "veld")
                 then "veld" WHEN(STRAATNM  REGEXP "pad") 
                 then "pad" WHEN(STRAATNM  REGEXP "gang")
                 then "gang" WHEN(STRAATNM  REGEXP "dok") 
                 then "dok"  WHEN(STRAATNM  REGEXP "poort") 
                 then "poort" WHEN(STRAATNM  REGEXP "heide") 
                 then "heide" WHEN(STRAATNM  REGEXP "vaart") 
                 then "vaart" WHEN(STRAATNM  REGEXP "dijk") 
                 then "dijk"  WHEN(STRAATNM  REGEXP "gat") 
                 then "gat" WHEN(STRAATNM  REGEXP "steeg")
                 then "sluis" WHEN(STRAATNM  REGEXP "sluis")
                 then "steeg" WHEN(STRAATNM  REGEXP "vest") 
                 then "vest"  WHEN(STRAATNM  REGEXP "brug")
                 then "brug"  WHEN(STRAATNM  REGEXP "kouter")
                 then "kouter" WHEN(STRAATNM  REGEXP "akker")
                 then "akker" WHEN(STRAATNM  REGEXP "park") 
                 then "park" WHEN(STRAATNM  REGEXP "berg") 
                 then "berg" WHEN(STRAATNM  REGEXP "hoek") 
                 then "hoek" WHEN(STRAATNM  REGEXP "put") 
                 then "put" WHEN(STRAATNM  REGEXP "bos") 
                 then "bos" END) as extend'))
            
           ->where('GEMNM','like', '%'.$gemeente.'%') 
           ->where('STRAATNM', 'REGEXP',  
           'lei$|laan$|straat$|baan$|rui$|plaats$|markt$|kaai$|weg$|gracht$|plein$|
           dreef$|veld$|pad$|dok$|poort$|heide$|vaart$|dijk$|gat$|steeg$|sluis$|vest$|
           brug$|kouter$|akker$|berg$|hoek$|put$|bos$|hof$')
           ->groupBy('extend')
           ->get();
            $gemeente = $articles  ;
            $land = $this->getachtervoegsels() ;

           return AchtervoegselsResource::collection(   $land->merge($gemeente )  );

}

 public function getkoningfamilie(){
    $articles = DB::table('cities')
              ->select(DB::raw('count(STRAATNM) as total,(CASE  WHEN(STRAATNM  REGEXP "Prins Boudewijn") then "Prins Boudewijn"  WHEN(STRAATNM  REGEXP "Prins Alexander") then "Prins Alexander" WHEN(STRAATNM  REGEXP "Koninklijke") then "Koninklijke"  WHEN(STRAATNM  REGEXP "Koningsarend") then "Koningsarend" WHEN(STRAATNM  REGEXP "Koninginne") then "Koninginne" WHEN(STRAATNM  REGEXP "Konings") then "Konings" WHEN(STRAATNM  REGEXP "Koningin Fabiola") then "Koningin Fabiola" WHEN(STRAATNM  REGEXP "Kristus-Koning") then "Kristus-Koning" WHEN(STRAATNM  REGEXP "Koning Leopold I-") then "Koning Leopold I-" WHEN(STRAATNM  REGEXP "Koningin Elisabeth") then "Koningin Elisabeth" WHEN(STRAATNM  REGEXP "Koningin Elisabeth") then "Koningin Elisabeth" WHEN(STRAATNM  REGEXP "Koning Leopold III-") then "Koning Leopold III-" WHEN(STRAATNM  REGEXP "Koningspark") then "Koningspark" WHEN(STRAATNM  REGEXP "Koning Ridder") then "Koning Ridder" WHEN(STRAATNM  REGEXP "Koningin Astrid") then "Koningin Astrid" WHEN(STRAATNM  REGEXP "Koning Leopold") then "Koning Leopold" WHEN(STRAATNM  REGEXP "Koning Albert") then "Koning Albert" WHEN(STRAATNM  REGEXP "prinses") then "prinses" WHEN(STRAATNM  REGEXP "Astrid") then "Astrid"  WHEN(STRAATNM  REGEXP "Prins Albert") then "Prins Albert" WHEN(STRAATNM  REGEXP "Astrid") then "Astrid" WHEN(STRAATNM  REGEXP "Albert") then "Albert" END) as extend'))
              
              
              ->groupBy('extend')
              ->orderBy('total')
              ->get();
              return KoningResource::collection( $articles );

}

 
 
}
