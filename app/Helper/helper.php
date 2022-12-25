<?php

namespace App\Helper;

class helper
{
    public static function timeToSeconds($time)
    {
        $time =  explode(':', $time);
        return $time[0] * 3600 + $time[1] * 60;
    }

    public static function timeToString($int)
    {
        $h = floor($int / 3600); //Get whole hours
        $int -= $h * 3600;
        $m = floor($int / 60); //Get remaining minutes
        $int -= $m * 60;
        // $int =  explode(':', $int);
        // dump($h,$m);
        return ($h < 10 ? '0' . $h : $h) . ":" . ($m < 10 ? '0' . $m : $m) . ":00";
    }

    public static function setIstirahat($data)
    {
        $collect = collect($data)->map->only('mulai', 'selesai');
        //convert string to seconds
        $time = [];
        foreach ($collect as $val) {
            $time[] = [Helper::timeToSeconds($val['mulai']), Helper::timeToSeconds($val['selesai'])];
        }

        //flatten
        $result = collect($time)->flatten(1);
        //ambil jam yang kosong
        $flat = [];
        for ($i = 0; $i < count($result); $i++) {
            if ($i < count($result) - 2) {
                for ($y = $i += 1; $y < $i + 1; $y++) {

                    if ($result[$i] != $result[$y + 1]) {
                        // dump($result[$i],$result[$y+1]);

                        $flat[] = [$result[$i], $result[$y + 1]];
                    }
                }
                // $i += 1;
            }
        }

        //second to time string
        $timeToString = [];
        for ($i = 0; $i < count($flat); $i++) {
            // dd());
            for ($j = 0; $j < count($flat[$i]); $j++) {
                $d = [
                    'id' => 0,
                    'mulai' => Helper::timeToString($flat[$i][$j]), 'selesai' => Helper::timeToString($flat[$i][$j += 1]), 'mapel' => ['id' => 0, 'mapel' => 'Istirahat'], 'guru' => ['id' => 0, 'nama' => 'Istirahat']
                ];
                $timeToString[] = $d;
            }
        }
        //gabungkan dataawal dan data istirahat
        // $push = $data;
        // if ($timeToString) {
        //     $push = collect($data)->merge(collect($timeToString));
        // }

        return $timeToString;
    }

    public static function DecodeImage($nameDir, $imageName)
    {
        $path = public_path('storage/' . $nameDir . '/' . $imageName);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataimage = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataimage);
        return $base64;
    }
}
