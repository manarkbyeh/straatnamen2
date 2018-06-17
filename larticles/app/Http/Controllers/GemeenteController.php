<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class GemeenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function index($gemeente=null){
       
        $gemeente = trim($gemeente) ;
        if( strlen( $gemeente ) >= 2 ){

            $resultgemeente = $gemeente ;

        }else{
            $resultgemeente =  '' ;
        }
        $aantalstraten = DB::table('cities')
        ->select( DB::raw('count(*) as total'))
        ->groupBy('ID')
        ->where('GEMNM','like', '%'.$gemeente.'%')
       ->get();
        return view('gemeentesug')->withResultgemeente($resultgemeente)->withAantalstraten($aantalstraten) ;
    }
    public function gemeentesuggestions(Request $request){
        
        $query = $request->get('term','');

          $sql = "select GEMNM,COUNT(*) as TotalVisit from cities
               WHERE GEMNM LIKE '$query%' GROUP BY(GEMNM) "; 
       echo $sql ; die ;
        if( strlen( $query  ) >= 2 )
           $gemeente = DB::select($sql) ;
        else $gemeente = [] ;
 

           return response()->json($gemeente);
        
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
