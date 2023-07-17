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
                <a href="{{ route('restaurant.select', $restaurant->id) }}" class="btn btn-sm btn-outline-secondary">Select</a>
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
                @if($menu->menu_status ==true)
                    <a href="{{ route('menu.update', $menu->id) }}" class="btn btn-sm btn-outline-secondary">Update</a>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">#</div>
        <div class="col-md-1">{{$menu->id}}</div>
        <div class="col-md-2">Name</div>
        <div class="col-md-2">{{$menu->menu_name}}</div>
        <div class="col-md-2">Price</div>
        <div class="col-md-2">{{number_format($menu->menu_price, 2, '.', ',')}}</div>
        <div class="col-md-1">Status</div>
        @if($menu->menu_status ==true)
            <div class="col-md-1">Active</div>
        @else
            <div class="col-md-1">Inactive</div>
        @endif
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 bpatient-bottom">
        <h2>Orders</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Order</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItems as $row)
                    <tr>
                        <td>{{$row['id']}}</td>
                        <td>{{$row['menu']['menu_name']}}</td>
                        <td>{{number_format($row['menu']['menu_price'], 2, '.', ',')}}</td>
                        <td>{{$row['order_id']}}</td>
                        @if($row['order']['order_status'] ==true)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
