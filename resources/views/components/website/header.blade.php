@push("styles")
    <style>
        .navbar_modified {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            list-style: none;
            padding-left: 0;
        }

        /* Style HR */
        .navbar_modified hr {
            display: none;
            /* hide on desktop */
            border: 0;
            border-top: 1px solid gray;
            width: 100%;
            margin: 5px 0;
        }

        @media(max-width:980px) {
            .navbar_modified {
                flex-direction: column !important;
                align-items: flex-start !important;
                justify-content: flex-start !important;
                padding: 0 3%;
                gap: 10px;
            }

            .navbar_modified hr {
                display: block;
                /* show HR on mobile */
                align-self: stretch;
                /* make full width */
            }

            .navbar_modified button,
            .navbar_modified div {
                margin-top: 10px;
            }



        }

        @media(max-width:576px) {
            .noveltechlogo {
                width: 35%;
            }
        }

        .navbar-toggler:focus {
            box-shadow: none !important;

        }


        /* for the toggling */
    </style>
@endpush

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <img class="noveltechlogo" width="15%" src="{{ asset('images/Dark Logo.png') }}" alt="Logo">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navbar_modified w-100 mb-2 mb-lg-0 py-3">
                <li class="nav-item">
                   <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link inactive {{ request()->routeIs('services') ? 'active':'' }}" href="{{ route('services') }}">Our Services</a>
                </li>
                <hr>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ?'active':"" }}" href="{{ route("about") }}">About</a>
                </li>
                <hr>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog') }}" href="{{ route('blog') }}" >Blogs</a>
                </li> --}}
                <hr>
                <li>
                    <a href="{{ route('loginview') }}" class="btn loginsignup_header me-2">Login/Signup</a>
                </li>
                <hr>
                <li>
                    {{-- <div>
                        <img width="30px" src="{{ asset('images/languages (1).png') }}" alt="Languages">
                        <span>English</span>
                    </div> --}}
                </li>
            </ul>
        </div>
    </div>
</nav>