<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Achtervoegsels extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
        
           
  
          
                'total' => $this->total,  'extend' => $this->extend,
                
                
                
                
         
           
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0',
            'author_url' => url('http://traversymedia.com')
        ];
    }
}
