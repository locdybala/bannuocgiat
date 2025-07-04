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
