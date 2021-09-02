<!doctype html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/datatables/dataTables.bootstrap4.css') }}">	
    <link rel="stylesheet" href="{{ asset('assets/dist/sweetalert2/sweetalert2.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
        @include('layouts.navbar')

        <main class="col-12 py-4">
            @yield('content')
        </main>
    </div>
    
    
    @include('layouts.script')
    @yield('script')
</body>
</html>

