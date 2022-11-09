<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function total($payload)
    {
        // dd($payload);
        $total = 0;
        foreach ($payload as $key => $value) {
            $total += $value['harga'] * $value['jumlah'];
        }
        return $total;
    }

    public function discount($data, $percent, $max)
    {
        $total = $this->total($data);
        $discount = $total * ($percent / 100);
        if ($discount > $max) {
            $discount = $max;
        }
        $pay = $total - $discount;
        return $pay;
    }

    public function ongkir($ongkir, $payload)
    {
        $jumlah = count($payload);

        $person = $ongkir / $jumlah;
        return $person;
    }

    public function personal(Request $request)
    {
        $payload = $request->payload;
        $ongkir = $request->ongkir;
        $percent = $request->percent;
        $max = $request->max;

        $total = $this->total($payload);
        $discount = $this->discount($payload, $percent, $max);
        $totalPerPerson = [];
        $ongkir = $this->ongkir($ongkir, $payload);

        foreach ($payload as $key => $value) {
            $totalPerPerson[$key] = round(($discount * (($value['harga'] * $value['jumlah']) / $total)) + $ongkir);
        }

        return $totalPerPerson;
    }
}
