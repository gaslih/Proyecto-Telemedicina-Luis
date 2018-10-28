<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            'imagePath' => 'https://images.farmatodo.com/bduc/img/ve/item/medium/ve_items_111007226_medium_standart_1383877466813.jpg',
            'title' => 'Clorace x 10 Cápsulas',
            'quantity' => 29,
            'price' => 1.5
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://images.farmatodo.com/bduc/img/ve/item/medium/ve_items_111026723_medium_standart_1384012197736.jpg',
            'title' => 'Atamel Forte 650 mg x 10 Tabletas',
            'quantity' => 45,
            'price' => 2
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://images.farmatodo.com/bduc/img/ve/item/medium/ve_items_111196051_medium_standart_1385009498610.jpg',
            'title' => 'Teragrip Forte 24h x 10 Tabletas Día + 4 Tabletas Noche',
            'quantity' => 4,
            'price' => 2.5
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://www.farmapana.com/1410-home_default/diclofenaco-potasico-calox.jpg',
            'title' => 'Diclofenac Potásico Calox 50 mg x 20 Tabletas',
            'quantity' => 2,
            'price' => 5
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://www.dencorub.com.ve/media/cache/8e/a1/8ea14223ec2fb24314bb6b3431114f30.png?114917270613',
            'title' => 'Dencorub Gel x 80 gr',
            'quantity' => 15,
            'price' => 7
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://www.dencorub.com.ve/media/cache/5e/1e/5e1ecf2cb2b476907755204124bcd405.png?334601200613',
            'title' => 'Dencorub Gel x 40 gr',
            'quantity' => 25,
            'price' => 5
        ]);
        $product->save();
    }
}
