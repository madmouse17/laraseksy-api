<?php

namespace App\Http\Resources;

use App\Http\Resources\DayResource;
use App\Http\Resources\JadwalDetailResource;
use Illuminate\Http\Resources\Json\JsonResource;

class JadwalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this);
        return [
            'day'=>$this->whenLoaded('day', fn () => new DayResource($this->day)),
            'jadwaldetail'=>JadwalDetailResource::collection($this->whenLoaded('jadwaldetail')),
        ];
    }
}
