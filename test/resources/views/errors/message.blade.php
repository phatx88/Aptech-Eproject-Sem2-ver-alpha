@php
    $success = request()->session()->pull("success");
    $error = request()->session()->pull("error");
    if (!empty($error)) {
        $alertClass = "alert-danger" ;
        $message = $error;
    }
    else if (!empty($success)) {
        $alertClass = "alert-success" ;
        $message = $success;
    }
@endphp
@if (!empty($message))
    <span class="alert {{$alertClass}}">
        {{$message}}
    </span>    
@endif