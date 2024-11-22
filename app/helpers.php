<?php

//remove unicodes from string
function removeUnicodeCharacters($string)
{
    return trim(preg_replace('/[^\x00-\x7F]/u', '', $string));
}

//Diccionary for requisitions and orders buy
function getDiccionaryRequisionOrder($value)
{
    $diccionary = [
        'fecha' => 'Fecha de solicitud',
        'estatus' => 'Estatus',
        'referencia' => 'Referencia',
        'descripcion' => 'Descripción',
        'cantidad' => 'Cantidad',
        'contrato_id' => 'Contrato asociado',
        'comprador_id' => 'Comprador seleccionado',
        'sucursal_id' => 'Sucursal',
        'producto_id' => 'Producto',
        'user' => 'Usuario',
        'area' => 'Área',
        'archivo' => 'Archivo',
        'proveedor_id' => 'Proveedor seleccionado',
        'id_user' => 'Solicitante',
        'proveedor_catalogo' => 'Proveedor de la requisición',
        'proveedor_catalogo_oc' => 'Proveedor de la orden de compra',
        'proveedor_catalogo_id' => 'Proveedor seleccionado',
        'ids_proveedores' => 'Proveedores',
        'proveedoroc_id' => 'Proveedor de la orden de compra',
        'email' => 'Correo',
        'fecha_entrega' => 'Fecha de entrega',
        'pago' => 'Monto a pagar',
        'dias_credito' => 'Días de crédito',
        'moneda' => 'Tipo de moneda',
        'cambio' => 'Tipo de cambio de la moneda',
        'direccion_envio_proveedor' => 'Dirección de envío del proveedor',
        'credito_proveedor' => 'Crédito del proveedor',
        'sub_sub_total' => 'Subtotal',
        'sub_iva' => 'Subtotal IVA',
        'sub_iva_retenido' => 'Subtotal IVA retenido',
        'sub_descuento' => 'Subtotal descuento',
        'sub_otro' => 'Subtotal otros',
        'sub_isr' => 'Subtotal ISR',
        'sub_total_total' => 'Total del subtotal',
        'sub_total' => 'Subtotal',
        'iva' => 'IVA',
        'iva_retenido' => 'IVA retenido',
        'isr_retenido' => 'ISR retenido',
        'total' => 'Total',
        'facturacion' => 'Facturación',
        'direccion' => 'Dirección',
        'espesificaciones' => 'Especificaciones',
        'detalles' => 'Detalles',
        'tipo' => 'Tipo',
        'comentarios' => 'Comentarios',
        'contacto' => 'Contacto',
        'contacto_correo' => 'Correo del contacto',
        'cel' => 'Celular',
        'url' => 'Url',
        'fecha_inicio' => 'Fecha de inicio',
        'fecha_fin' => 'Fecha de finalización',
        'cotizacion' => 'Cotización',
        'centro_costo_id' => 'Centro de costos',
        'no_personas' => 'Número de personas',
        'porcentaje_involucramiento' => 'Porcentaje de involucramiento',
        'descuento' => 'Descuento',
        'otro_impuesto' => 'Otro impuesto',
        'envio' => 'Envío',
        'credito' => 'Crédito',
    ];

    $valor = array_key_exists($value, $diccionary) ? $diccionary[$value] : $value;

    return $valor;
}
