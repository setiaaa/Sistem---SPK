<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
    <title>Error 404 - Percetakan Bandung</title>
    <meta name="robots" content="noindex, follow">
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="notfound">
        <div class="notfound">
            {!! file_get_contents('img/404_error_with_portals-rafiki.svg') !!}
            
            <p class="title">Waduh, tujuanmu nggak ada!</p>
            <p class="content">Bisa jadi kamu salah alamat atau mungkin kamu engga punya akses</p>
            <button onclick="redirect()" class="btn btn-primary">Kembali</button>
        </div>
    </div>
    <script>
        function redirect() {
          location.replace("{{ route('dashboard') }}")
        }
        </script>
</body>
</html>
