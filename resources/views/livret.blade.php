<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$livret->livret_name}} | Livret d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        .website-icon {
            color: #000000;
            font-size: 1rem;
        }

        .instagram-icon {
            color: #C13584;
            font-size: 1rem;
        }

        .facebook-icon {
            color: #3b5998;
            font-size: 1rem;
        }

        .linkedin-icon {
            color: #0077b5;
            font-size: 1rem;
        }

        .twitter-icon {
            color: #1DA1F2;
            font-size: 1rem;
        }

        .tripadvisor-icon {
            color: #34E0A1;
            font-size: 1rem;
        }

        .socials {
            padding: 0;
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .socials div {
            width: max-content;
        }
    </style>
</head>
<body style="min-height:100vh;background-image: url({{asset($livret->background)}});background-repeat: no-repeat;background-size: cover">
<main>
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <img src="{{ asset($livret->logo) }}" alt="Logo" style="width: 100px;"
                     class="img-fluid rounded-circle mx-auto d-block">
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-6">
                <h1 class="display-4">{{ $livret->livret_name }}</h1>
                <p class="lead">{!! nl2br(e($livret->description)) !!}</p>
            </div>
        </div>
    </div>
</main>
<footer class="container">
    <div class="row socials">
        @if($livret->establishment_website)
            <div class="col-md-2">
                <a href="{{ $livret->establishment_website }}" target="_blank"><i class="bi bi-globe website-icon"></i></a>
            </div>
        @endif
        @if($livret->instagram)
            <div class="col-md-2">
                <a href="{{ $livret->instagram }}" target="_blank"><i class="bi bi-instagram instagram-icon"></i></a>
            </div>
        @endif
        @if($livret->facebook)
            <div class="col-md-2">
                <a href="{{ $livret->facebook }}" target="_blank"><i class="bi bi-facebook facebook-icon"></i></a>
            </div>
        @endif
        @if($livret->linkedin)
            <div class="col-md-2">
                <a href="{{ $livret->linkedin }}" target="_blank"><i class="bi bi-linkedin linkedin-icon"></i></a>
            </div>
        @endif
        @if($livret->twitter)
            <div class="col-md-2">
                <a href="{{ $livret->twitter }}" target="_blank"><i class="bi bi-twitter twitter-icon"></i></a>
            </div>
        @endif
        @if($livret->tripadvisor)
            <div class="col-md-2">
                <a href="{{ $livret->tripadvisor }}" target="_blank"><i class="bi bi-globe tripadvisor-icon"></i></a>
            </div>
        @endif
    </div>
</footer>
</body>
</html>