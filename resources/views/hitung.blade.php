@extends('layout')

@section('content')

    <div class="card border-0 shadow" style="width: 80%;margin-top:10%;left:10%;position: absolute;">
        <div class="card-body">
            <button class="btn mb-3 btn-sm btn-primary" style="width: fit-content" id="tambah-peserta">
                <i class="fas fa-plus"></i>
            </button>
            <div class="row d-flex">
                <div class="col-md-6" id="kolom-peserta">
                    <div class=" mb-2">
                        <div class="row mb-2">
                            <label for="" class="col-md-4">Peserta 1</label>
                            <div class="col-md input-group">
                                <input type="text" class="form-control form-control-sm form-peserta"  id="peserta-1">
                                <button class="btn-danger btn btn-sm input-group-append">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-8">
                                <div class="row d-flex">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row mb-2">
                        <label for="" class="col-md-4">Diskon</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm "  id="disc">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="" class="col-md-4">Diskon Max.</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm "  id="max-disc">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="" class="col-md-4">Minimal Pembelian</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm "  id="min-pay">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-primary" id="hitung">
                    <i class="fas fa-save"></i>&nbsp; Submit
                </button>
            </div>
        </div>
    </div>



@endsection

