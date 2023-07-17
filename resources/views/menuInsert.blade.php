@extends('app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 brestaurant-bottom">
        <h1 class="h2">Restaurant</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('restaurant.insert') }}" class="btn btn-sm btn-outline-secondary">Insert</a>
                @if($restaurant->restaurant_status ==true)
                    <a href="{{ route('restaurant.update', $restaurant->id) }}" class="btn btn-sm btn-outline-secondary">Update</a>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">#</div>
        <div class="col-md-2">{{$restaurant->id}}</div>
        <div class="col-md-2">Name</div>
        <div class="col-md-2">{{$restaurant->restaurant_name}}</div>
        <div class="col-md-2">Status</div>
        @if($restaurant->restaurant_status ==true)
            <div class="col-md-2">Active</div>
        @else
            <div class="col-md-2">Inactive</div>
        @endif
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 brestaurant-bottom">
        <h2>Menu</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                @if($restaurant->restaurant_status ==true)
                    <a href="{{ route('menu.insert', $restaurant->id) }}" class="btn btn-sm btn-outline-secondary">Insert</a>
                @endif
            </div>
        </div>
    </div>
    <h2>Create</h2>
    <form method="POST" action="{{ route('menu.insert.confirm') }}" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="menu_name" placeholder="menu_name" value="" required>
            <label for="floatingInput">menu_name</label>
            @if ($errors->has('menu_name'))
                <span class="text-danger">{{$errors->first('menu_name')}}</span>
            @endif
        </div>
        <input type="hidden" name=restaurant_id value='{{$restaurant->id}}'>
        <div class="form-floating mb-3">
            <input type="number" step="10" min="100" class="form-control" id="floatingInput" name="menu_price" placeholder="menu_price" value="" required>
            <label for="floatingInput">menu_price</label>
            @if ($errors->has('menu_price'))
                <span class="text-danger">{{$errors->first('menu_price')}}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" id="menu" name="menu_status" required>
                <option value="1">Active</option>
            </select>
            <label for="floatingInput">menu_status</label>
            @if ($errors->has('menu_status'))
                <span class="text-danger">{{$errors->first('menu_status')}}</span>
            @endif
        </div>
        <hr class="my-4">
        <button class="w-100 btn btn-lg btn-primary" type="submit">Insert</button>
    </form>
@endsection
