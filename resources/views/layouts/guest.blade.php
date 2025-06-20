<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Bankwooa') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</head>
<body>
    <style>
        .first-part {
            background-image: url('{{ asset('img/background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>



    <div class="container-fluid">
        <div class="row">
            <!-- Partie gauche : fond animé -->
            <div class="col-md-8 first-part vh-100 text-white position-relative p-0 d-none d-md-block">
                <!-- ici ta vidéo ou autre contenu -->
               
            </div>


            <!-- Partie droite : formulaire centré -->
            <div class="col-md-4 d-flex align-items-center justify-content-center vh-100 bg-light">
                <div class="w-100 px-0" style="max-width: 500px;">
                    <div class="text-center mb-4">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="img-fluid" style="max-height: 200px;">
                    </div>

                    <div class="card shadow-sm p-4">
                        <h3 class="text-center mb-4">Se connecter</h3>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- JS Bootstrap 4 -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>
</html>
