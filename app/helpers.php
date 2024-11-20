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
        'fecha' => 'Fecha de Solicitud',
        'estatus' => 'Estatus',
        'referencia' => 'Referencia',
        'descripcion' => 'Descripción',
        'cantidad' => 'Cantidad',
        'contrato_id' => 'Contrato Asociado',
        'comprador_id' => 'Comprador Seleccionado',
        'sucursal_id' => 'Sucursal',
        'producto_id' => 'Producto',
        'user' => 'Usuario',
        'area' => 'Área',
        'archivo' => 'Archivo',
        'proveedor_id' => 'Proveedor Seleccionado',
        'id_user' => 'Solicitante',
        'proveedor_catalogo' => 'Proveedor de la Requisición',
        'proveedor_catalogo_oc' => 'Proveedor de la Orden de Compra',
        'proveedor_catalogo_id' => 'Proveedor Seleccionado',
        'ids_proveedores' => 'Proveedores',
        'proveedoroc_id' => 'Proveedor de la Orden de Compra',
        'email' => 'Correo',
        'fecha_entrega' => 'Fecha de Entrega',
        'pago' => 'Monto a Pagar',
        'dias_credito' => 'Días de Crédito',
        'moneda' => 'Tipo de Moneda',
        'cambio' => 'Tipo de Cambio de la Moneda',
        'direccion_envio_proveedor' => 'Dirección de Envío del Proveedor',
        'credito_proveedor' => 'Crédito del Proveedor',
        'sub_sub_total' => 'Subtotal',
        'sub_iva' => 'Subtotal IVA',
        'sub_iva_retenido' => 'Subtotal IVA Retenido',
        'sub_descuento' => 'Subtotal Descuento',
        'sub_otro' => 'Subtotal Otros',
        'sub_isr' => 'Subtotal ISR',
        'sub_total_total' => 'Total del Subtotal',
        'sub_total' => 'Subtotal',
        'iva' => 'IVA',
        'iva_retenido' => 'IVA Retenido',
        'isr_retenido' => 'ISR Retenido',
        'total' => 'Total',
        'facturacion' => 'Facturación',
        'direccion' => 'Dirección',
        'espesificaciones' => 'Especificaciones',
        'detalles' => 'Detalles',
        'tipo' => 'Tipo',
        'comentarios' => 'Comentarios',
        'contacto' => 'Contacto',
        'contacto_correo' => 'Correo del Contacto',
        'cel' => 'Celular',
        'url' => 'Url',
        'fecha_inicio' => 'Fecha de Inicio',
        'fecha_fin' => 'Fecha de Finalización',
        'cotizacion' => 'Cotización',
        'centro_costo_id' => 'Centro de Costos',
    ];

    $valor = array_key_exists($value, $diccionary) ? $diccionary[$value] : $value;

    return $valor;
}
