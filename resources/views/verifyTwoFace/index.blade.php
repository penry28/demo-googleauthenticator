@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Two-factor authentication</div>
                <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </div>
                @endif
                    <form role="form" method="post" action="{{ route('two_face.verify') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <label class="control-label" for="otp">
                                <b>Authentication code</b>
                            </label>
                            <input type="text" name="code" class="form-control" placeholder="123456" autocomplete="off" maxlength="6" id="otp">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success col-md-12">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
