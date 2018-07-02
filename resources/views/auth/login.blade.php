@extends('layouts.app')

@section('content')
<div class="login">
    <div class="container">
        <a href="{{ url('/login/facebook') }}" class="btn btn-primary fb-button">
            <i class="fab fa-facebook-f"></i>
             <b>Log in with facebook</b>
        </a>
    </div>
</div>
@endsection
