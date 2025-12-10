@extends('layouts.app')
@section('content')
    <x-website.header />
    <x-website.home.hero />
    <div class="container">
        <x-website.home.packages />
        <x-website.home.articles />
    </div>
    <x-website.home.collage />

    </div>
    <x-website.footer />

@endsection