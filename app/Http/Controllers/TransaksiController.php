<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDet;
use App\Models\TransaksiDetMenu;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class TransaksiController extends Controller
{
    public function total($payload)
    {
        $message = [];
        $total = 0;
        foreach ($payload as $key => $value) {

            foreach ($value['menu'] as $key => $value1) {
                if (!isset($value['harga'])) {
                    array_push($message, "Harga menu ada yang kosong, Harap Lengkapi Form\n");
                }

                if (!isset($value['jumlah'])) {
                    array_push($message, "Jumlah menu ada yang kosong, Harap Lengkapi Form\n");
                }

                $total += $value1['harga'] * $value1['jumlah'];
            }
        }
        // dd(count($message));
        if (count($message) > 0) {
            // dd($message);
            return response()->json([
                'message' => $message,
                'status' => false
            ], 400);
        }


        return $total;
    }

    public function discount($data, $percent, $max, $min)
    {
        $total = $this->total($data);
        $discount = $total * ($percent / 100);
        if ($discount > $max) {
            $discount = $max;
        }

        if ($total < $min) {
            $discount = 0;
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
        $minimum = $request->minimum;
        $message = [];


        if ($ongkir == null) {
            array_push($message, 'Ongkir tidak boleh kosong');
        }

        if ($percent == null) {
            array_push($message, 'Diskon tidak boleh kosong');
        }

        if ($max == null) {
            array_push($message, 'Maksimal diskon tidak boleh kosong');
        }

        if ($minimum == null) {
            array_push($message, 'Minimal pembelian tidak boleh kosong');
        }

        if (count($message) > 0) {
            return response()->json([
                'message' => $message,
                'status' => 400
            ], 400);
        }

        $total = $this->total($payload);
        // dd();
        if (!is_numeric($total)) {
            $message = $total->getData()->message;
            return response()->json([
                'message' => $message,
                'status' => 400
            ], 400);
        }

        $discount = $this->discount($payload, $percent, $max, $minimum);
        $transaksi = Transaksi::create([
            'total_harga' => $total + $ongkir,
            'harga_diskon' => $discount + $ongkir,
            'diskon' => $percent,
            'max_diskon' => $max,
            'min_pembelian' => $minimum,
            'ongkir' => $ongkir,
        ]);
        $totalPerPerson = [];
        $ongkir_diskon = $this->ongkir($ongkir, $payload);
        foreach ($payload as $key => $value) {

            $totalPerPerson[$key]['nama'] = $value['pembeli'];
            $totalPerPerson[$key]['total'] = 0;


            $transaksi_det = TransaksiDet::create([
                'transaksi_id' => $transaksi->id,
                'nama_pembeli' => $value['pembeli'],
            ]);
            $paid = 0;
            foreach ($value['menu'] as $keys => $values) {
                $paid += $values['harga'] * $values['jumlah'];
                $totalPerPerson[$key]['total'] = round(($discount * ($paid / $total)) + $ongkir_diskon);
                TransaksiDetMenu::create([
                    'transaksi_det_id' => $transaksi_det->id,
                    'nama_menu' => $values['nama'],
                    'harga' => $values['harga'],
                    'jumlah' => $values['jumlah'],
                ]);

                TransaksiDet::find($transaksi_det->id)->update([
                    'total_harga' => $paid + $ongkir,
                    'harga_diskon' => $totalPerPerson[$key]['total'],
                ]);
            }
        }



        return [
            'total' => $total,
            'discount' => $discount,
            'ongkir' => $ongkir,
            'totalPerPerson' => $totalPerPerson,
            'data' => Transaksi::with('transaksi_det.transaksi_det_menu')->find($transaksi->id),
        ];
    }
}
