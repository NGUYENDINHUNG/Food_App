@extends('layouts.client')
@section('title', 'Trang chủ')

@section('content')
    @include('client.partials.header')
    <!-- Stats Section -->
    @include('client.home.start')
    <!-- Features Section -->
    @include('client.home.features')
    <!-- Categories Preview -->
    @include('client.home.categories')
    <!-- CTA Section -->
    @include('client.home.section')
@endsection
