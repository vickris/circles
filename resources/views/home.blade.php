@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (empty(Auth::user()->circles->first()))
                        <p>You are not part of any circles.</p>
                        <create-circle><create-circle>
                        <!-- <search-circle><search-circle> -->
                    @else
                        <search-circle :user_id="{{ Auth::user()->id }}"><search-circle>
                        <p>See your circles</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
