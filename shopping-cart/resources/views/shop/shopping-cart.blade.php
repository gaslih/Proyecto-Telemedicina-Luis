@extends('layouts.master')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
    @if(Session::has('cart'))
        <div class="row justify-content-md-center">
            <div class="col-sm-8">
                <ul class="list-group">
                    @foreach($products as $product)
                            <li class="list-group-item">
                                <span class="badge badge-secondary">{{ $product['qty'] }}</span>
                                <strong>{{ $product['item']['title'] }}</strong>
                                <span class="badge badge-success">{{ $product['price'] }}$</span>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs dropdown-toogle" data-toggle="dropdown">Acción <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('product.reduceByOne', ['id' => $product['item']['id']]) }}">Eliminar 1</a>
                                        <a class="dropdown-item" href="{{ route('product.removeItem', ['id' => $product['item']['id']]) }}">Eliminar todo</a>
                                    </ul>
                                </div>
                            </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 offset-2 offset-2">
                <strong>Total: {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 offset-2 offset-2">
            <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Comprar</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 offset-3 offset-3">
                <h2>No tiene ningún articulo!</h2>
            </div>
        </div>
    @endif
@endsection