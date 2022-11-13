@extends('layout')

@section('content')

    <div class="card border-0 shadow mb-3" style="width: 80%;margin-top:10%;left:10%;position: absolute;">
        <div class="card-body">
            <button class="btn mb-3 btn-sm btn-primary" style="width: fit-content" id="tambah-pembeli">
                <i class="fas fa-plus"></i>
            </button>
            <div class="row d-flex">
                <div class="col-md-6" id="kolom-pembeli">
                    <div class="mb-2 pembeli">
                        <div class="row mb-2">
                            <label for="" class="col-md-4">Pembeli 1</label>
                            <div class="col-md input-group">
                                <input type="text" class="form-control form-control-sm form-pembeli"  id="pembeli-1">
                                <button class="btn-danger btn btn-sm input-group-append delete-pembeli" hidden>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="list-menu-peserta"  id="list-menu-peserta-1">
                            <div class="row mb-2 daftar-menu">
                                <div class="col-md-4 mb-2 d-flex justify-content-end">
                                    <button class="btn btn-primary btn-sm tambah-menu"><i class="fas fa-xs fa-plus"></i> &nbsp; Menu</button>
                                </div>
                                <div class="col-md-8">
                                    <div class="row d-flex">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control mb-2 form-control-sm menu-peserta-1" placeholder="Menu">
                                        </div>
                                        <div class="col-md input-group">
                                            <button class=" btn btn-sm btn-primary input-group-prepend my-auto" disabled><i class="fas fa-percent fa-xs"></i></button>
                                            <input type="number" class="form-control mb-2 form-control-sm harga-peserta-1" placeholder="Harga">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control mb-2 form-control-sm jumlah-peserta-1" placeholder="Qty">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row mb-2">
                        <label for="" class="col-md-4">Diskon</label>
                        <div class="col-md input-group input-group-sm">
                            <input type="number" class="form-control form-control-sm "  id="diskon">
                            <button class="btn btn-sm btn-secondary input-group-append" disabled>
                                <i class="fas fa-percent fa-xs"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="" class="col-md-4">Diskon Max.</label>
                        <div class="col-md input-group input-group-sm">
                            <button class="btn btn-sm btn-secondary input-group-prepend" disabled>
                                Rp.
                            </button>
                            <input type="number" class="form-control form-control-sm "  id="diskon-max">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="" class="col-md-4">Minimal Pembelian</label>
                        <div class="col-md input-group input-group-sm input-group-prepend">
                            <button class="btn btn-sm btn-secondary" disabled>
                                Rp.
                            </button>
                            <input type="number" class="form-control form-control-sm "  id="minimal-pembelian">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="" class="col-md-4">Ongkir</label>
                        <div class="col-md input-group input-group-sm">
                            <button class="btn btn-sm btn-secondary input-group-prepend" disabled>
                                Rp.
                            </button>
                            <input type="number" class="form-control form-control-sm"  id="ongkir">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-primary" id="hitung">
                    <i class="fas fa-save"></i>&nbsp; Submit
                </button>
            </div>

            <hr>
            <div class="row d-flex">
                <div class="col-md-6">
                    <h1 class="mb-3" style="font-size: 18px;font-weight: 600">Hasil Perhitungan</h1>
                    <table class="table">
                        <tr class="mb-2">
                            <td>ID Transaksi</td>
                            <td id="id-transaksi"></td>
                        </tr>
                        <tr class="mb-2">
                            <td>Total Harga</td>
                            <td id="harga-total"></td>
                        </tr>
                        <tr class="mb-2">
                            <td>Ongkir</td>
                            <td id="ongkir"></td>
                        </tr>
                        <tr class="mb-2">
                            <td>Diskon</td>
                            <td id="diskon"></td>
                        </tr>
                        <tr class="mb-2">
                            <td>Minimum Pembelian</td>
                            <td id="minimal-pembelian"></td>
                        </tr>
                        <tr class="mb-2">
                            <td>Maksimal Diskon</td>
                            <td id="max-diskon"></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    {{-- <h1>Table Detail</h1> --}}
                    <h1 class="mb-3" style="font-size: 18px;font-weight: 600">Table Detail</h1>
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                        </thead>
                        <tbody id="table-detail">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection

