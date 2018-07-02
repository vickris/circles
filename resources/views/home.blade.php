@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (empty(Auth::user()->circles))
                        <p>You are not part of any circles</p>
                        <p>Create your own circle below and invite users</p>
                        <create-circle><create-circle>
                    @else
                        <p>You are not part of any circles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
