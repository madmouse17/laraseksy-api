<?php

namespace App\Http\Resources;

use App\Helper\helper;
use App\Http\Resources\DayResource;
use App\Http\Resources\JadwalDetailResource;
use App\Models\WaliKelas;
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
        $wali =WaliKelas::getWaliKelas($this->tahunajaran_id,$this->kelas_id);
        return [
            'day'=>$this->whenLoaded('day', fn () => new DayResource($this->day)),
            'jadwaldetail'=>JadwalDetailResource::collection($this->whenLoaded('jadwaldetail')),

            'istirahat'=>helper::setIstirahat($this->jadwaldetail),
            'wali_kelas'=>new AdminResource($wali->admin)
        ];
    }
}
