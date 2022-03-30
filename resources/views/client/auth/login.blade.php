<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel </title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/images/favicon.png') }}">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
</head>

<body  style="height: 100vh;">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="https://www.kocaeli.edu.tr/"><img
                                                src="{{ asset('frontend/images/logo-kocaeli.png') }}"
                                                class="img-circle" style="border-radius: 50%;" alt=""></a>
                                    </div>
                                    <h4 class="text-center mb-4 text-white">Giriş Paneli</h4>
                                    <form action="{{ url('/login') }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                {{ $errors->first() }}
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="ornek@ornek.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Şifre</strong></label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Şifre">
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn text-primary btn-block bg-success">Giriş
                                                Yap</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required vendors -->
    <script src="{{ asset('frontend/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.min.js') }}"></script>
    <script src="{{ asset('frontend/js/deznav-init.js') }}"></script>
</body>

</html>
