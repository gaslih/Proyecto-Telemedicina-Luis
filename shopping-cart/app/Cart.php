<?php
namespace App;
class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public function __construct($oldCart)
    {
        if ($oldCart) {//se crea el carro a partir de uno ya existente
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    public function add($item, $id) {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {//se verifica si ya existe el articulo en el carrito
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++; //se aumenta la cantidad en 1
        $storedItem['price'] = $item->price * $storedItem['qty']; //articulo simple * cantidad de articulos del mismo tipo
        $this->items[$id] = $storedItem; //se actualiza el array items
        $this->totalQty++; //se aumenta la cantidad total de articulos 
        $this->totalPrice += $item->price; //Se actualiza el precio total
    }
}