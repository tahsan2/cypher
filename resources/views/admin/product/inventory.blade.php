@extends('layouts.dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Inventory</a></li>
    </ol>
</nav>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Inventory List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($inventories as $inventory)                        
                    <tr>
                        <td>{{$inventory->rel_to_color->color_name}}</td>
                        <td>{{$inventory->size_id==null?'NA':$inventory->rel_to_size->size_name}}</td>
                        <td>{{$inventory->quantity}}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-icon">
                                <i data-feather="trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add Inventory</h3>
            </div>
            <div class="card-body">
                <form action="{{route('inventory.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Product Name</label>
                        <input type="hidden" name="product_id" value="{{$product_info->id}}" class="form-control">
                        <input type="text" readonly value="{{$product_info->product_name}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Select Color</label>
                        <select name="color_id" class="form-control">
                            <option value="">Select One</option>
                            @foreach ($colors as $color)                                
                                <option value="{{$color->id}}">{{$color->color_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Select Size</label>
                        <select name="size_id" class="form-control">
                            <option value="">Select One</option>
                            <option value="1">NA</option>
                            @foreach ($sizes as $size)                                
                                <option value="{{$size->id}}">{{$size->size_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Quantity</label>
                        <input name="quantity" type="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection