@extends('layouts.common')
@section('title', config('app.name'))
@include('layouts.head')
@include('layouts.footer')
@include('layouts.script')
@section('content')
    <div id="app">
        <app></app>
    </div>
@endsection
