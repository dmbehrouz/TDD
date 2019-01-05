@extends('layouts.app')

@section('customCSS')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('topMenu')
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <label>تنظیمات پروفایل کاربر</label>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="dir:rtl">
                        <label>عزیز خوش آمدی</label>
                        <label style="font-size: 17px;">{{\Illuminate\Support\Facades\Auth::user()->name}}</label>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                    @endif
                     <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <!-- User Profile -->
                        <div class="row">
                            <!-- User Image -->
                            <div class="col-md-4">
                                <div class="bio-image">
                                    <img src="{{\Illuminate\Support\Facades\Auth::user()->photo}}" alt="profileImage" />
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <!-- User Content -->
                            <div class="col-md-5">
                                <div class="row" style="direction:rtl">
                                    <label for="name">نام</label>
                                    <input type="text" name="name" placeholder="نام" id="name" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                                </div>

                                <div class="row" style="direction:rtl">
                                    <label for="family">نام خانوادگی</label>
                                    <input type="text" name="family" placeholder="نام خانوادگی" id="family" value="{{\Illuminate\Support\Facades\Auth::user()->family}}">
                                </div>

                                <div class="row" style="direction:rtl">
                                    <label for="email">ایمیل</label>
                                    <input type="text" name="email" placeholder="ایمیل" id="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                                </div>

                                <div class="row" style="direction:rtl">
                                    <label for="tel">تلفن</label>
                                    <input type="text" name="phone" placeholder="تلفن" id="tel" value="{{\Illuminate\Support\Facades\Auth::user()->phone}}">
                                </div>

                                <div class="row">
                                    <button type="button" class="btn btn-primary" name="editButton" style="font-family: farsi;">ویرایش</button>
                                </div>
                            </div>
                        </div>
                     </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
