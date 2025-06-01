@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="text-center mt-5 pt-5">
    <div class="error-page">
        <h1 class="display-1 fw-bold text-primary">404</h1>
        <h2 class="mb-4">Oops! Page Not Found.</h2>
        <p class="lead mb-4">
            The page you are looking for might have been removed, had its name changed,
            or is temporarily unavailable.
        </p>
        <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-home me-2"></i>Go to Homepage
        </a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .error-page {
        max-width: 600px;
        margin: auto;
    }
</style>
@endpush