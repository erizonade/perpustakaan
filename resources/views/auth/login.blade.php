<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Silakan Login</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/sweetalert2/sweetalert2.min.css') }}">
</head>
<body style="background-color: ">

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-5">
                <div class="card card-outline">
                    <div class="card-header">
                        <h3>Silakan Login</h3>
                    </div>
                    <div class="card-body shadow rounded">
                        <form id="form-login-user">
        
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" id="username" name="username" class="form-control" value="">
                            </div>
        
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" id="password" name="password" class="form-control" value="">
                            </div>
        
                        </form>

                        <div class="form-group">
                               <button type="submit" form="form-login-user" class="btn btn-info">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>           
    
<script src="{{ asset('assets/dist/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dist/jquery-form/jquery.form.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/dist/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/commons.js') }}"></script>
<script src="{{ asset('assets/auth.js') }}"></script>

</body>
</html>