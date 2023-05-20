@extends('frontend.master')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Request API data</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.info') }}" method="GET">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="">Enter Your Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="" class="">Enter Your Token</label>
                            <input type="text" class="form-control" name="token">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Get Data</button>
                        </div>
                        <div class="mb-3">
                            <p>If you have no token <b><a href="{{ route('api.request') }}"><u>Request for token</u></a></b></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
