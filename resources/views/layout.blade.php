<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://kit.fontawesome.com/5f712d1a25.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('particles-js/demo/css/style.css')}}">
</head>
<style>
    body{
        font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
    }

    .btn-primary{
        background-color: #2A4222;
        border-color: #2A4222;
    }

    .btn-primary:hover{
        background-color: #1b2a16;
        border-color: #1b2a16;
    }
</style>
<body>


  <!-- count particles -->
  {{-- <div class="count-particles">
    <span class="js-count-particles">--</span> particles
  </div> --}}


  <!-- particles.js container -->
  <div id="particles-js">

  </div>

  @yield('content')

  <!-- scripts -->
  <script src="{{asset('particles-js/particles.js')}}"></script>
  <script src="{{asset('particles-js/demo/js/app.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        AOS.init();
    </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script>
    $('#tambah-pembeli').on('click', function () {
        var id = $('.form-pembeli').length +1;


        $('#kolom-pembeli').append(`
        <div class="mb-2 pembeli">
                <div class="row mb-2">
                    <label for="" class="col-md-4">Pembeli `+id+`</label>
                    <div class="col-md input-group">
                        <input type="text" class="form-control form-control-sm form-pembeli" id="pembeli-`+id+`">
                        <button class="btn-danger btn btn-sm input-group-append delete-pembeli">
                                <i class="fas fa-trash"></i>
                            </button>
                    </div>
                </div>
                <div class="list-menu-peserta"  id="list-menu-peserta-`+id+`">
                <div class="row mb-2 daftar-menu">
                            <div class="col-md-4  mb-2 d-flex justify-content-end">
                                <button class="btn btn-primary btn-sm tambah-menu"><i class="fas fa-xs fa-plus"></i> &nbsp; Menu</button>
                            </div>
                            <div class="col-md-8">
                                <div class="row d-flex">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control mb-2 form-control-sm menu-peserta-`+id+`" placeholder="Menu">
                                    </div>
                                    <div class="col-md input-group">
                                        <button class=" btn btn-sm btn-primary input-group-prepend my-auto" disabled><i class="fas fa-percent fa-xs"></i></button>
                                        <input type="number" class="form-control mb-2 form-control-sm harga-peserta-`+id+`" placeholder="Harga">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control mb-2 form-control-sm jumlah-peserta-`+id+`" placeholder="Qty">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
            </div>
        `)


        if(id == 1){
            $('.delete-pembeli').hide();
        }else{
            $('body .delete-pembeli').attr('hidden', true);
            $('body .delete-pembeli:last').attr('hidden', false);
        }
    })

    $('#hitung').on('click', function () {
        var payload = [];
        var diskon = $('#diskon').val();
        var diskonMax = $('#diskon-max').val();
        var minimalPembelian = $('#minimal-pembelian').val();
        var ongkir = $('#ongkir').val();
        $('.pembeli').each(function (i, e) {
            var pembeli = $(e).find('.form-pembeli').val();
            var menu = [];
            $(e).find('.daftar-menu').each(function (ind, el) {
                var nama = $(el).find('.menu-peserta-'+(i+1)).val();
                var harga = $(el).find('.harga-peserta-'+(i+1)).val();
                var jumlah = $(el).find('.jumlah-peserta-'+(i+1)).val();
                menu.push({
                    nama: nama,
                    harga: harga,
                    jumlah: jumlah
                })
            })
            payload.push({
                pembeli: pembeli,
                menu: menu
            })
        })
        // payload.push({
        //     pembeli: $('#pembeli-1').val(),
        //     menu: $('.menu-peserta-1').map(function () {
        //         return $(this).val();
        //     }).get(),
        //     harga: $('.harga-peserta-1').map(function () {
        //         return $(this).val();
        //     }).get(),
        //     jumlah: $('.jumlah-peserta-1').map(function () {
        //         return $(this).val();
        //     }).get(),
        // })
        // $('.form-pembeli').each(function (index, element) {
        //     payload['nama'].push($(element).val());
        // })

        // payload['menu'].push([]);
        //     payload['menu']['nama'].push([]);
        //     $('.menu-peserta-'+(index+1)).each(function (index, element) {
        //         payload['menu']['nama'][index].push($(element).val());
        //     })
        //     payload['menu']['harga'].push([]);
        //     $('.harga-peserta-'+(index+1)).each(function (index, element) {
        //         payload['menu']['harga'][index].push($(element).val());
        //     })
        console.log(payload)
        console.log($('.menu-peserta-2').length);
        $.ajax({
            url: 'api/transaksi',
            type: 'GET',
            data: {
                'payload': payload,
                'percent': diskon,
                'ongkir': ongkir,
                'max': diskonMax,
                'minimum': minimalPembelian
            },
            success: function (data) {
                console.log(data)
                $("#id-transaksi").html(data.data.id);
                $("#harga-total-akhir").html(data.data.total_harga);
                $('#ongkir-akhir').html(data.data.ongkir);
                $('#diskon-akhir').html(data.data.diskon);
                $('#minimal-pembelian-akhir').html(data.data.min_pembelian);
                $('#max-diskon').html(data.data.max_diskon);
                var key = 1;
              data.data?.transaksi_det.forEach(element => {
                    $("#table-detail").append(`
                        <tr>
                            <td>`+key+`</td>
                            <td>`+element.nama_pembeli+`</td>
                            <td>`+element.harga_diskon+`</td>
                        </tr>
                    `)
                    key++;
                });
            }

        })
    })

    $('body').on('click', '.tambah-menu', function () {
        var id = $(this).closest('.pembeli').index('.pembeli') + 1;
        console.log(id);
        $(this).closest('.list-menu-peserta').prepend(`
        <div class="row mb-2 daftar-menu">
        <div class="col-md-4 d-flex justify-content-end">
            <button class="btn btn-danger btn-sm delete-menu">
                        <i class="fas fa-trash fa-xs"></i>
                    </button>
                            </div>
                            <div class="col-md-8">
                                <div class="row d-flex">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control mb-2 form-control-sm menu-peserta-`+id+`" placeholder="Menu">
                                    </div>
                                    <div class="col-md input-group">
                                        <button class=" btn btn-sm btn-primary input-group-prepend my-auto" disabled><i class="fas fa-percent fa-xs"></i></button>
                                        <input type="number" class="form-control mb-2 form-control-sm harga-peserta-`+id+`" placeholder="Harga">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control mb-2 form-control-sm jumlah-peserta-`+id+`" placeholder="Qty">
                                    </div>
                                </div>
                            </div>
                            </div>
                            `)
    })

    $('body').on('click', '.delete-menu', function () {
        $(this).closest('.daftar-menu').remove();
    })




    $('body').on('click', '.delete-pembeli', function () {
        $(this).closest('.pembeli').remove();
        var id = $('.form-pembeli').length;

        if(id == 1){
            $('.delete-pembeli').hide();
        }else{
            $('body .delete-pembeli').attr('hidden', true);
            $('body .delete-pembeli').last().attr('hidden', false);
        }

    })
</script>
</body>
</html>
