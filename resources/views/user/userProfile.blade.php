<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesgeet"
        href="https://rawgit.com/creativetimofficial/material-kit/master/assets/css/material-kit.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
        integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
        integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/css/profilestyle.css">

</head>

<body class="profile-page">
    <nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg " color-on-scroll="100"
        id="sectionsNav">
            <div class="container">
            <div class="navbar-translate">
                <h3>Profile</h3>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <div class="dropdown-menu dropdown-with-icons">
                        <a href="{{route('logout')}}" class="dropdown-item">
                            <i class="material-icons">layers</i>Sign Out
                        </a>
                    </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" target="_blank">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" target="_blank">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">
                            <i class="material-icons">apps</i> {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="{{route('logout')}}" class="dropdown-item">
                                <i class="material-icons">layers</i>Sign Out
                            </a>
                        </div>
                    </li>
                </ul>   
            </div>
        </div>
    </nav>

    <div class="page-header header-filter" data-parallax="true">
        </div>
        <div class="main main-raised">
            <div class="profile-content">
                <div class="container">
                    <div class="row">
                    <div class="name"> <br>
                        <img src="{{ asset('storage/images/' .auth()->user()->image) }}" class="rounded" width="12%" alt="..."> &nbsp; &nbsp;
                    <div style="display: inline-block; vertical-align: top;">
                        <h3 class="title">{{ ucfirst(auth()->user()->name ?? '') }}</h3>
                        <h6>{{ auth()->user()->designation ? auth()->user()->designation->designation : '' }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
                
    <div class="card-body p-4 info1">
        <h6>Information</h6>
        <hr class="mt-0 mb-4">
        <div class="row pt-1">
        <div class="col-6 mb-3">
        <h6>Email</h6>
        <p class="text-muted">{{ auth()->user()->email }}</p>
        </div>
        <div class="col-6 mb-3">
        <h6>Phone</h6>
        <p class="text-muted"> {{auth()->user()->phone}} </p>
        </div>
        </div>
        <hr class="mt-0 mb-4">
        <div class="row pt-1">
        <div class="col-6 mb-3">
        <h6>Gender</h6>
        <p class="text-muted"> {{auth()->user()->gender}}</p>
        </div>
        <div class="col-6 mb-3">
        <h6>Date of Birth</h6>
        <p class="text-muted">{{auth()->user()->dob}} </p>
        </div>
        </div>
        </div>
        </div>
    </div>

    <footer class="footer text-center ">
        <p> © Copyright: Employee Management System</p>
    </footer>
</body>
</html>
