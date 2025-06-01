@extends('layouts.app')

@section('title', 'Access Denied')

@section('content')
<div class="text-center mt-5 pt-5">
    <div class="error-page">
        <h1 class="display-1 fw-bold text-danger">403</h1>
        <h2 class="mb-4">Access Denied!</h2>
        <p class="lead mb-4">
            You do not have permission to view this page.
            Please contact the administrator if you believe this is an error.
        </p>
        <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" class="btn btn-danger btn-lg">
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