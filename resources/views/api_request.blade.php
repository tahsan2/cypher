@extends('frontend.master')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Request for Api</h3>
                </div>
                <div class="card-body">
                    @if (session('token'))
                        <div class="alert alert-success">{{ session('token') }}</div>
                    @endif
                    <form action="{{ route('api.token.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="">Enter Your Email to Verify Your Access</label>
                            <input type="text" class="form-control" name="email">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Verify Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
