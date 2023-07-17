@extends('app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Restaurant</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('restaurant.insert') }}" class="btn btn-sm btn-outline-secondary">Insert</a>
            </div>
        </div>
    </div>
    <h2>Create</h2>
    <form method="POST" action="{{ route('restaurant.insert.confirm') }}" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="restaurant_name" placeholder="restaurant_name" value="" required>
            <label for="floatingInput">restaurant_name</label>
            @if ($errors->has('restaurant_name'))
                <span class="text-danger">{{$errors->first('restaurant_name')}}</span>
            @endif
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" id="menu" name="restaurant_status" required>
                <option value="1">Active</option>
            </select>
            <label for="floatingInput">restaurant_status</label>
            @if ($errors->has('restaurant_status'))
                <span class="text-danger">{{$errors->first('restaurant_status')}}</span>
            @endif
        </div>
        <hr class="my-4">
        <button class="w-100 btn btn-lg btn-primary" type="submit">Insert</button>
    </form>
@endsection
