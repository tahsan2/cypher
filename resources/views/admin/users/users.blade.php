@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>User List <span class="float-right"><a href="{{ route('user.excel.download') }}" class="btn btn-success">Export Excel</a></span></h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $sl=>$user)
                        <tr>
                            <td>{{$sl+1}}</td>
                            <td>
                                @if ($user->photo == null)
                                    <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                                @else
                                    <img src="{{asset('uploads/user')}}/{{$user->photo}}" alt="profile">
                                @endif
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input data-id="{{$user->id}}" type="checkbox" class="custom-control-input toggle-class" id="customSwitch{{$user->id}}"  {{ $user->status ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch{{$user->id}}"></label>
                                </div>
                            </td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('user.delete', $user->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
      $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {'status': status, 'user_id': user_id},
                success: function(data){
                console.log(data.success)
                }
            });
        });
    });
</script>
@endsection
