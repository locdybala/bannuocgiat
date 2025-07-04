@php
    $message=Session::get('message');
    $success=Session::get('success');
@endphp
@if($message)
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
@endif
@if($success)
    <div class="alert alert-success" role="alert">
        {{$success}}
    </div>
@endif
@php
    Session::put('message', null);
    Session::put('success', null);
@endphp

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi bi-x-circle-fill me-2"></i>
        <div>{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <div>{{ session('warning') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('info'))
    <div class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i>
        <div>{{ session('info') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
