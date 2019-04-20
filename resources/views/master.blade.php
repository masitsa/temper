<!doctype html>

<html lang="en">

<head>

    <title>@yield('title')</title>
    
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <style>
    
        #onboarding {
            width: 100%;
            height: 400px;
            margin: 0 auto
        }
    
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <a class="navbar-brand" href="#">Temper</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03"
            aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
            
            <ul class="navbar-nav mr-auto">
            
                <li class="nav-item">
            
                    <a class="nav-link" href="/">Onboarding</a>
            
                </li>
            
            </ul>
        
        </div>
    
    </nav>

    <div class="container">

        @yield('content')

    </div>

    <script src="/js/axios.min.js"></script>

    <script src="/js/vue.min.js"></script>

    <script src="/js/highcharts.js"></script>

    @yield('scripts')

</body>

</html>
