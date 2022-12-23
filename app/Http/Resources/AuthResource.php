<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public $preserveKeys = true;
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
            'nama'=>$this->nama,
            'kelas_id'=>Crypt::encryptString($this->kelas_id),
            'kelas'=> $this->whenLoaded('kelas', fn () => new KelasResource($this->kelas))
        ];
    }
}
