<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Support\Env;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Repositories\PengumumanRepo\PengumumanInterface;

class PengumumanController extends Controller
{
    private PengumumanInterface $pengumumanInterface;
    public function __construct(PengumumanInterface $pengumumanInterface)
    {
        $this->pengumumanInterface = $pengumumanInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->pengumumanInterface->all();
        } catch (\Exception $e) {
            return response()->error($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $decrypted = Crypt::decryptString($id);

            $pengumuman = Pengumuman::find($decrypted);
            return $this->pengumumanInterface->detail($pengumuman);
        } catch (\Exception $e) {
            return response()->error($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
