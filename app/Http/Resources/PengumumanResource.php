<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Resources\Json\JsonResource;

class PengumumanResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>Crypt::encryptString($this->id),
            'title'=>$this->title,
            'image'=>$this->image,
            'description'=>$this->description,
            'url'=>env('PENGUMUMAN_URL').'/storage/pengumuman/'
        ];
    }
}
