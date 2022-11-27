@extends('layouts.app')

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">2FA Setting</div>
                <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </div>
                @endif
                    <form role="form" method="POST" action="{{ route('2fa.enable') }}">
                        @csrf
                        <h2>Scan QRCode</h2>
                        <p>
                            <img src="{{ $qrCodeUrl }}" />
                        </p>
                        <h5>Enter the six-digit code from the application</h5>
                        <div class="form-group mb-2">
                            <input type="text" name="code" class="form-control" placeholder="123456" autocomplete="off" maxlength="6">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Enable</button>
                            <a href="{{ route('home') }}" class="btn btn-secondary float-right">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
