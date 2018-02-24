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

    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('bins.create') }}">New bin</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bins</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <td>{{ $bin->name }}</td>
                        </tr>
                        <tr>
                            <th>User</th>
                            <td>{{ $bin->user->name }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
