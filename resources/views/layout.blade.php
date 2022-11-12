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
        <div class="mb-2">
                <div class="row mb-2">
                    <label for="" class="col-md-4">Pembeli `+id+`</label>
                    <div class="col-md input-group">
                        <input type="text" class="form-control form-control-sm form-pembeli" id="pembeli-`+id+`">
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
                                    <div class="col-md-5">
                                        <input type="text" class="form-control form-control-sm" placeholder="Menu">
                                    </div>
                                    <div class="col-md input-group">
                                        <button class=" btn btn-sm btn-primary input-group-prepend my-auto" disabled><i class="fas fa-percent fa-xs"></i></button>
                                        <input type="number" class="form-control form-control-sm" placeholder="Harga">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control form-control-sm" placeholder="Qty">
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        `)
    })

    $('#hitung').on('click', function () {
        var payload = [];
        $('.form-pembeli').each(function (index, element) {
            payload.push({
                'harga': $(element).val(),
                'jumlah' : 1
            })
        })
        console.log(payload)
        $.ajax({
            url: 'api/transaksi',
            type: 'GET',
            data: {
                'payload': payload
            },
            success: function (data) {
                console.log(data)
            }

        })
    })

    $('body').on('click', '.tambah-menu', function () {
        $(this).closest('.row').append(`
        <div class="col-md-4 mb-2 d-flex justify-content-end">

                            </div>
                            <div class="col-md-8">
                                <div class="row d-flex">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control form-control-sm menu-peserta-1" placeholder="Menu">
                                    </div>
                                    <div class="col-md input-group">
                                        <button class=" btn btn-sm btn-primary input-group-prepend my-auto" disabled><i class="fas fa-percent fa-xs"></i></button>
                                        <input type="number" class="form-control form-control-sm harga-peserta-1" placeholder="Harga">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control form-control-sm jumlah-peserta-1" placeholder="Qty">
                                    </div>
                                </div>
                            </div>
                            `)
    })
</script>
</body>
</html>
