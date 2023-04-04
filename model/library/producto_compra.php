<?php
function getProducto_entrada_array($producto_compra_id, $producto_entrada_rs, $producto_compra_r)
{
    mysqli_data_seek($producto_entrada_rs, 0);
    $totalPrice = 0;
    $producto_entrada_array = array();
    while ($producto_entrada_r = mysqli_fetch_assoc($producto_entrada_rs)) {
        if ($producto_compra_id == $producto_entrada_r['producto_compra_id']) {
            $product_price = $producto_entrada_r['producto_entrada_precio'];
            $totalPrice += ($product_price * $producto_entrada_r['producto_entrada_cantidad']);
            $producto_entrada_array[] = $producto_entrada_r;
        }
    }
    $totalPrice = $totalPrice + (($totalPrice / 100) * $producto_compra_r['producto_compra_iva']);
    $producto_compra_r['producto_compra_total'] = redondeado($totalPrice);
    $producto_compra_r['producto_entrada_array'] = $producto_entrada_array;
    return $producto_compra_r;
}


function getProductoCompra_array($producto_compraDao, $producto_entradaDao)
{
    $producto_compra_rs = $producto_compraDao->select();
    $producto_entrada_rs = $producto_entradaDao->select();
    $producto_compra_array = array();
    while ($producto_compra_r = mysqli_fetch_assoc($producto_compra_rs)) {
        $producto_compra_r = getProducto_entrada_array($producto_compra_r['producto_compra_id'], $producto_entrada_rs, $producto_compra_r);
        $producto_compra_array[] = $producto_compra_r;
    }
    return $producto_compra_array;
}
