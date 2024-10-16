<?php

$cart_file='xmldb/cart.xml';
//////////////////////////////////////////////////////
function AddToCart($id_prod, $quantity){

    echo "AddToCart <br>";
    echo $id_prod;

    if (ExistProduct($id_prod)){
        _ExecuteAddToCart($id_prod, $quantity);
    }else{
        echo 'No hay suficiente producto';
    };

}
//////////////////////////////////////////////////////
function _ExecuteAddToCart($id_prod, $quantity){

    $cart = GetCart();
  
    $item = $cart->addChild('product_item');

    $item->addChild('id_product', $id_prod);
    $item->addChild('quantity', $quantity);
    
    $item_price = $item->addChild('price_item');
    $item_price->addChild('price', '0');
    $item_price->addChild('currency', 'EU');

    $cart->asXML($cart_file);
}

//////////////////////////////////////////////////////
function GetCart(){


  if (file_exists($cart_file)) {
        echo 'existe el fichero <br>';
        $cart = simplexml_load_file($cart_file);
    } else {
        $cart = new SimpleXMLElement('<cart></cart>');
    }

    return $cart;
}
//////////////////////////////////////////////////////
?>