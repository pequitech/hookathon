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
                    @foreach( $bins as $bin )
                        <tr>
                            <td>{{ $bin->name }}</td>
                            <td>{{ $bin->id }}</td>
                            <td>
                                <a href="{{ route('bins.edit', ['bin' => $bin]) }}">Edit</a>
                            </td>
                            <td>
                                <a href="{{ route('bins.show', ['bin' => $bin]) }}">Show</a>
                            </td>
                            <td>
                                <a href="{{ route('bins.destroy', ['bin' => $bin]) }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="card-footer">
                    {{ $bins->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
