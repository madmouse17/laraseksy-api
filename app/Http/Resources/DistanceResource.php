<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Crypt;
use App\Http\Resources\SemesterResource;
use App\Http\Resources\TahunAjaranResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DistanceResource extends JsonResource
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
            'id'=> Crypt::encryptString($this->id),
            'tahunajaran_id'=>Crypt::encryptString($this->tahunajaran_id),
            'tahunajaran'=>$this->whenLoaded('taja', fn () => new TahunAjaranResource($this->taja)),
            'semester_id'=>Crypt::encryptString($this->semester_id),
            'semester'=>$this->whenLoaded('semester', fn () => new SemesterResource($this->semester)),

        ];
    }
}
