<?php

namespace App\Helper;

trait Imageable
{
    public function storeMedia($request,$dirpath)
    {
//  dd($request);
        $path = storage_path('app/public/'.$dirpath);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

         if ($request->hasfile('image')) {
            $file = $request->file('image');

            $fileName = uniqid() . '_' . trim($file->getClientOriginalName());

            $this->image = $fileName;
            $this->save();

            $file->move($path, $fileName);

            return $this;
         }
    }
}
