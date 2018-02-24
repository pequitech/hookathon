@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>Bins</h1>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit bin</div>
                <div class="card-body">
                    @include('bins.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
