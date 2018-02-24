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
            <a href="{{ route('bins.create') }}" class="btn btn-primary">New bin</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Bins</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Requests</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $bins as $bin )
                            <tr>
                                <td>{{ $bin->name }}</td>
                                <td>{{ $bin->uid }}</td>
                                <td>{{ $bin->requests()->count() }}</td>
                                <td>
                                    <a href="{{ route('bins.show', ['bin' => $bin]) }}" class="btn btn-primary">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer">
                    {{ $bins->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
