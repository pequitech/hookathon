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
                            <th>URL</th>
                            <td>
                                <input type="text" value="{{ route('bins.listen', ['uid' => $bin->uid]) }}" class="form-control" readonly>
                            </td>
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

    @forelse($bin->requests()->orderBy('created_at', 'DESC')->get() as $r)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <span style="float:left">{{ $r->created_at->diffForHumans() }}</span>
                  <a style="float:right" href="{{ route('requests.destroy', ['request' => $r, 'uid' => $bin->uid]) }}" class="text-danger">x</a>
                </div>
                <table class="table table-striped table-bordered" style="border-left:0; border-right: 0">
                    <tr>
                        <th style="border-left: 0px">Method</th>
                        <td style="border-right: 0px">{{ $r->header['method'] }}</td>
                    </tr>
                    @if($r->header['content_type'])
                    <tr>
                        <th style="border-left: 0px">Content-Type</th>
                        <td style="border-right: 0px">{{ $r->header['content_type'] }}</td>
                    </tr>
                    @endif
                </table>
                <div class="card-body">
                    <pre>{{ $r->body }}</pre>
                </div>
                <div class="card-footer">
                    <input type="text" value="{{ route('requests.endpoint', ['uid' => $r->uid]) }}" class="form-control" readonly>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table table-striped table-responsive">
                </table>
                <div class="card-body text-center">
                    Oops, this bins have no requests yet. Send us a request on the following bin link:
                    <code>{{ route('bins.listen', ['uid' => $bin->uid]) }}</code>
                </div>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection
