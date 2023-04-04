<?php
function getProducto_array($producto_rs, $producto_entrada_rs, $producto_salida_rs)
{
    mysqli_data_seek($producto_rs, 0);
    $producto_array = array();
    while ($producto_r = mysqli_fetch_assoc($producto_rs)) {

        $producto_entrada_contador = 0;
        $producto_entrada_comision = 0;
        $producto_entrada_precio = 0;
        $producto_entrada_cantidad = 0;
        if (mysqli_num_rows($producto_entrada_rs)) {
            mysqli_data_seek($producto_entrada_rs, 0);
            while ($producto_entrada_r = mysqli_fetch_assoc($producto_entrada_rs)) {
                if ($producto_entrada_r['producto_id'] == $producto_r['producto_id']) {
                    $producto_entrada_contador++;
                    $producto_entrada_comision += $producto_entrada_r['producto_entrada_comision'];
                    $producto_entrada_cantidad += $producto_entrada_r['producto_entrada_cantidad'];
                    $producto_entrada_precio += ($producto_entrada_r['producto_entrada_precio'] + $producto_entrada_r['producto_entrada_comision']) * $producto_entrada_r['producto_entrada_cantidad'];
                }
            }
        }

        $producto_salida_cantidad = 0;
        if (mysqli_num_rows($producto_salida_rs) > 0) {
            mysqli_data_seek($producto_salida_rs, 0);
            // $producto_salida_precio = 0;
            while ($producto_salida_r = mysqli_fetch_assoc($producto_salida_rs)) {
                if ($producto_salida_r['producto_id'] == $producto_r['producto_id']) {
                    $producto_salida_cantidad += $producto_salida_r['producto_salida_cantidad'];
                    // $producto_salida_precio += $producto_salida_r['producto_salida_precio'] * $producto_salida_r['producto_salida_cantidad'];
                }
            }
        }

        $producto_cantidad = $producto_entrada_cantidad - $producto_salida_cantidad;
        $producto_precio = $producto_entrada_cantidad != 0 ? $producto_entrada_precio / $producto_entrada_cantidad : 0;

        $producto_r['producto_comision'] = $producto_entrada_contador != 0 ? $producto_entrada_comision / $producto_entrada_contador : 0;
        $producto_r['producto_cantidad'] = $producto_cantidad;
        $producto_r['producto_precio'] = redondeado($producto_precio);

        $producto_array[] = $producto_r;
    }
    return $producto_array;
}







function getProducto($producto_id, $producto_rs)
{
    mysqli_data_seek($producto_rs, 0);
    while ($producto_r = mysqli_fetch_assoc($producto_rs)) {
        if ($producto_id == $producto_r['producto_id']) {
            return $producto_r;
        }
    }
}
