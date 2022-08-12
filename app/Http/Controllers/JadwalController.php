<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Admin;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Distance;
use App\Models\tahunajaran;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function index(Request $request)
    {

        $date = Carbon::parse($request->tgl)->locale('id_ID');
        $diff = $date->dayName;
        // dd($diff);
        $siswa = Siswa::where('nis', $request->nis)->first();
        $taja = Distance::first();
        $jadwal = Jadwal::where('kelas_id', $siswa->kelas_id)
            ->where('tahunajaran_id', $taja->tahunajaran_id)
            ->where('hari', $diff)
            ->select('jadwal', 'hari')
            ->first();
        // dd($jadwal);
        if ($jadwal == null) {
            $respon = [
                'status' => 'success',
                'msg' => 'Empty Data',
                'errors' => null,
                'content' => $jadwal,
            ];
        } else {
            $respon = [
                'status' => 'success',
                'msg' => 'Data Fetched',
                'errors' => null,
                'content' => $jadwal,
            ];
        }
        return response()->json($respon, 200);
    }

    public function getSnapToken(Request $req){

        $item_list = array();
        $amount = 0;
        Config::$serverKey = 'SB-Mid-server-l6ACUHnLScYbVS2pi9VlIwhD';
        if (!isset(Config::$serverKey)) {
            return "Please set your payment server key";
        }
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;

        // Required

         $item_list[] = [
                'id' => "111",
                'price' => 20000,
                'quantity' => 1,
                'name' => "Majohn"
        ];

        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => 20000, // no decimal allowed for creditcard
        );


        // Optional
        $item_details = $item_list;

        // Optional
        $billing_address = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'address'       => "Mangga 20",
            'city'          => "Jakarta",
            'postal_code'   => "16602",
            'phone'         => "081122334455",
            'country_code'  => 'IDN'
        );

        // Optional
        $shipping_address = array(
            'first_name'    => "Obet",
            'last_name'     => "Supriadi",
            'address'       => "Manggis 90",
            'city'          => "Jakarta",
            'postal_code'   => "16601",
            'phone'         => "08113366345",
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'email'         => "andri@litani.com",
            'phone'         => "081122334455",
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );

        // Optional, remove this to display all available payment methods
        $enable_payments = ['credit_card', 'mandiri_clickpay','cimb_clicks','bca_klikbca', 'bca_klikpay', 'bri_epay', 'echannel', 'permata_va','bca_va', 'bni_va', 'other_va', 'gopay', 'indomaret','danamon_online', 'akulaku'];

        // Fill transaction details
        $transaction = array(
            'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );
        // return $transaction;
        try {
            $snapToken = Snap::getSnapToken($transaction);
            return response()->json($snapToken);
            // return ['code' => 1 , 'message' => 'success' , 'result' => $snapToken];
        } catch (\Exception $e) {
            dd($e);
            return ['code' => 0 , 'message' => 'failed'];
        }

    }
}
