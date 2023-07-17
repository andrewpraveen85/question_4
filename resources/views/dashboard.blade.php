@extends('app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Orders</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('order.insert') }}" class="btn btn-sm btn-outline-secondary">Insert</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $row)
                    <tr>
                        <td>{{$row['id']}}</td>
                        <td>{{number_format($row['order_cost'], 2, '.', ',')}}</td>
                        @if($row['order_status'] ==true)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif
                        <td><a href="{{ route('order.select', $row['id']) }}" class="btn btn-sm btn-outline-secondary">Select</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Restaurants</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('restaurant.insert') }}" class="btn btn-sm btn-outline-secondary">Insert</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($restaurants as $row)
                    <tr>
                        <td>{{$row['id']}}</td>
                        <td>{{$row['restaurant_name']}}</td>
                        @if($row['restaurant_status'] ==true)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif
                        <td><a href="{{ route('restaurant.select', $row['id']) }}" class="btn btn-sm btn-outline-secondary">Select</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
