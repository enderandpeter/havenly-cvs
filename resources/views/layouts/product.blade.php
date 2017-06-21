@extends('layouts.master')

@include('css.main')
@include('css.bootstrap4')

@include('scripts.bootstrap4')
@include('scripts.jquery')

@section('body')
<body id="product-home-body">
	@yield('body-content')
	@stack('scripts')
</body>
@endsection