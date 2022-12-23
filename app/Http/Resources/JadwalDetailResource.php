<?php

namespace App\Http\Resources;

use App\Http\Resources\AdminResource;
use App\Http\Resources\MapelResource;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Resources\Json\JsonResource;

class JadwalDetailResource extends JsonResource
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
            'mulai'=> $this->mulai,
            'selesai'=> $this->selesai,
            'guru'=> $this->whenLoaded('admin', fn () => new AdminResource($this->admin)),
            'mapel'=> $this->whenLoaded('mapel', fn () => new MapelResource($this->mapel)),
        ];
    }
}
