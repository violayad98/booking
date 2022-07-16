<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->property_id,
            'name' => $this->name,
            'address' => $this->city_name->name.','.$this->street.' '.$this->building.' '.$this->apt,
            'description'=>$this->description,
            'photo'=>$this->photo,
            'price'=>$this->price_per_night,
            'stars'=>$this->stars,
        'grade'=>$this->grade,

        ];
    }
}
