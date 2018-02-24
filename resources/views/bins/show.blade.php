@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="page-header">
                <h1>Bins</h1>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 text-right">
            <a href="{{ route('bins.edit', ['bin' => $bin]) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('bins.destroy', ['bin' => $bin]) }}" class="btn btn-danger">Delete</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bins</div>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $bin->name }}</td>
                        </tr>
                        <tr>
                            <th>UID</th>
                            <td>{{ $bin->uid }}</td>
                        </tr>
                        <tr>
                            <th>User</th>
                            <td>{{ $bin->user->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @forelse($bin->requests as $r)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <span style="float:left">{{ $r->created_at->diffForHumans() }}</span>
                  <a style="float:right" href="{{ route('requests.destroy', ['request' => $r, 'uid' => $bin->uid]) }}" class="text-danger">x</a>
                </div>
                <table class="table table-striped table-responsive">
                </table>
                <div class="card-body">
                    <code>{{ gettype($r->body) }}</code>
                    <pre>{{ $r->body }}</pre>
                </div>
            </div>
        </div>
    </div>
    @empty
    @endforelse
</div>
@endsection
