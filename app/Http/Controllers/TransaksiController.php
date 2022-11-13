<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDet;
use App\Models\TransaksiDetMenu;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function total($payload)
    {
        // dd($payload);
        $total = 0;
        foreach ($payload as $key => $value) {
            foreach ($value['menu'] as $key => $value1) {
                $total += $value1['harga'] * $value1['jumlah'];
            }
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

        $total = $this->total($payload);
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
