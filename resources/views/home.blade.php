@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session("error"))
                        <div class="alert alert-danger">
                            {{ session("error") }}
                        </div>
                    @endif
                    @if(auth()->user()->secret_code)
                        <form method="POST" action="{{ route('2fa.disable') }}">
                            @csrf
                            <button class="btn btn-danger">Disable 2fa</button>
                        </form>
                    @else
                        <form method="GET" action="{{ route('2fa.getQrCode') }}">
                            @csrf
                            <button class="btn btn-primary">Enable 2fa</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
