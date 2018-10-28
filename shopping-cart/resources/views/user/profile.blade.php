@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2"><!--Se ocupan 8 de las 12 columnas y se desplaza 2 columnas a la derecha-->
            <h1>Perfil</h1>
            <hr>
            <h2>Ordenes</h2>
            @foreach($orders as $order) <!--se pasan cada una de las ordenes-->
                 <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($order->cart->items as $item)<!--se pasan cada uno de los articulos--> 
                                <li class="list-group-item">
                                     <span class = "bagde bagde-dark"> {{$item['price']}}$</span>
                                         {{$item['item']['title'] }}  | {{ $item['qty'] }} Unidades
                                </li>
                             @endforeach
                        </ul>
                     </div>
                     <div class="panel-footer">
                     <strong>Precio Total: {{  $order->cart->totalPrice}}</strong>
                    </div>
                 </div>
            @endforeach
        </div>
    </div>
@endsection