<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="{{ asset('js/main.js') }}"></script>

    <title>Laravel</title>

</head>
<body id="app">
<div class="col-md-offset-2 col-md-8">
    <div class="well">
        <h2>Get orders from</h2>
        <form class="container-fluid" action="{{ route('orders') }}" method="GET">
            <div class="form-group">
                <p>Today </p>
                <p>This week </p>
                <p>All time </p>
            </div>
            <div class="form-group radio-buttons">
                <p>
                    <input class="btn btn-info btn-circle" type="radio" name="interval" value="today">
                </p>
                <p>
                    <input class="btn btn-info btn-circle" type="radio" name="interval" value="week">
                </p>
                <p>
                    <input class="btn btn-info btn-circle" type="radio" name="interval" value="all">
                </p>
            </div>
        </form>
    </div>

    <div class="well">
        <h2>Add new order</h2>
        <form class="container-fluid" action="{{ route('orders') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group col-md-3">
                <label for="user">User </label>
                <select class="form-control" name="user">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="product">Product </label>
                <select class="form-control" name="product">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="quantity">Quantity </label>
                <input class="form-control" type="number" name="quantity" value="1">
            </div>
            <br>
            <input type="submit" class="btn btn-info" value="Save">
        </form>
    </div>

    <br>

    <div class="well">
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th class="text-center">User</th>
                <th class="text-center">Product</th>
                <th class="text-center">Date</th>
                <th class="text-center">Price</th>
                <th class="text-center">Options</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <input type="search" data-type="users" class="form-control search" placeholder="Search">
                </td>
                <td>
                    <input type="search" data-type="products" class="form-control search" placeholder="Search">
                </td>
            </tr>
            @foreach ($orders as $order)
                <tr>
                    @if($order->user && $order->product)
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->date }}</td>
                        <td>{{ $order->product->price * $order->quantity }}</td>
                        <td>
                            <a class="edit" data-url="{{ route('orders.update', ['id' => $order->id]) }}"
                               data-user="{{ $order->user->name }}"
                               data-product="{{ $order->product->name }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a class="delete" data-url="{{ route('orders.delete', ['id' => $order->id]) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
