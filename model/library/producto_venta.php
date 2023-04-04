<?php
function getCliente($cliente_id, $cliente_rs)
{
    mysqli_data_seek($cliente_rs, 0);
    while ($cliente_r = mysqli_fetch_assoc($cliente_rs)) {
        if ($cliente_id == $cliente_r['cliente_id']) {
            return $cliente_r;
        }
    }
    return false;
}
function getProducto_salida_array($producto_venta_id, $producto_salida_rs, $producto_venta_r)
{
    mysqli_data_seek($producto_salida_rs, 0);
    $totalPrice = 0;
    $producto_salida_array = array();
    while ($producto_salida_r = mysqli_fetch_assoc($producto_salida_rs)) {
        if ($producto_venta_id == $producto_salida_r['producto_venta_id']) {
            $product_price = $producto_salida_r['producto_salida_precio'];
            $totalPrice += ($product_price * $producto_salida_r['producto_salida_cantidad']);
            $producto_salida_array[] = $producto_salida_r;
        }
    }
    $totalPrice = $totalPrice + (($totalPrice / 100) * $producto_venta_r['producto_venta_iva']);
    $producto_venta_r['producto_venta_total'] = redondeado($totalPrice);
    $producto_venta_r['producto_salida_array'] = $producto_salida_array;
    return $producto_venta_r;
}


function getProductoVenta_array($producto_ventaDao, $producto_salidaDao, $clienteDao)
{
    $cliente_campos = [
        "cliente_nombre1",
        "cliente_nombre2",
        "cliente_apellido1",
        "cliente_apellido2",
        "cliente_cedula",
        "cliente_ruc",
        "cliente_ciudad",
        "cliente_direccion",
        "cliente_telefono",
        "cliente_celular",
        "cliente_email"
    ];
    $producto_venta_rs = $producto_ventaDao->select();
    $producto_salida_rs = $producto_salidaDao->select();
    $cliente_rs = $clienteDao->select();
    $producto_venta_array = array();
    while ($producto_venta_r = mysqli_fetch_assoc($producto_venta_rs)) {
        if ($producto_venta_r['cliente_id'] != 0) {
            $cliente = getCliente($producto_venta_r['cliente_id'], $cliente_rs);
            foreach ($cliente_campos as $index => $cliente_campos_r) {
                $producto_venta_r[$cliente_campos_r] = $cliente[$cliente_campos_r];
            }
        } else {
            foreach ($cliente_campos as $index => $cliente_campos_r) {
                $producto_venta_r[$cliente_campos_r] = false;
            }
        }
        $producto_venta_r = getProducto_salida_array($producto_venta_r['producto_venta_id'], $producto_salida_rs, $producto_venta_r);
        $producto_venta_array[] = $producto_venta_r;
    }
    return $producto_venta_array;
}


function getProducto($producto_rs, $producto_id)
{
    mysqli_data_seek($producto_rs, 0);
    while ($r = mysqli_fetch_assoc($producto_rs)) {
        if ($r['producto_id'] == $producto_id) {
            return $r;
        }
    }
    return false;
}
