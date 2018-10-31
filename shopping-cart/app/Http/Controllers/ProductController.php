<?php
namespace App\Http\Controllers;
use App\Product;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Cart;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::all();
        return view('shop.index', ['products' => $products]);
    }
    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id); //se busca el producto
        $product->quantity -= 1; //se disminuye en 1 la cantidad del producto en la base de datos
        $product->save(); 
        $oldCart = Session::has('cart') ? Session::get('cart') : null;//Se verifica la sesión por si hay un carro en existencia
        $cart = new Cart($oldCart);//Se construye el carro de compras a partir de uno existente, de ser el caso
        $cart->add($product, $product->id);//Se añade el nuevo producto

        $request->session()->put('cart', $cart);//se almacenan los datos en la sesión
        return redirect()->route('product.index');
    }

    public function getReduceByOne($id) {
        $product = Product::find($id);
        $product->quantity += 1; //se disminuye en 1 la cantidad del producto en la base de datos
        $product->save();

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
         if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingCart');
    }
     public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $product = Product::find($id);
        $product->quantity += $cart->items[$id]['qty']; //se restauran tantos articulos se tenian de dicho prodcuto
        $product->save();

        $cart->removeItem($id);
         if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
         return redirect()->route('product.shoppingCart');
    }


    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);


        Stripe::setApiKey('sk_test_15yV9h8p8oNNRtcIaM4bFWH6');
        try {
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Test Charge"
            ));
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

            Auth::user()->orders()->save($order);

        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products!');
    }
}