@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (empty(Auth::user()->circles->first()))
                        <p>You are not part of any circles.</p>
                        <search-circle><search-circle>
                    @else
                        <p>See your circles</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
