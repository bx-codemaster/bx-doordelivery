<?php
/* -----------------------------------------------------------------------------------------
   $Id: Spanish codchange.php 2026-06-11 12:00:00Z benax $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2006 cod.php by GTB / 2006-11-28
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(cod.php,v 1.7 2002/04/17); www.oscommerce.com 
   (c) 2003	 nextcommerce (cod.php,v 1.5 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

define('MODULE_PAYMENT_CODCHANGE_TEXT_TITLE', 'Pago contra reembolso');
define('MODULE_PAYMENT_CODCHANGE_TEXT_DESCRIPTION', xtc_image(DIR_WS_ICONS . 'bx-codchange.png', MODULE_PAYMENT_CODCHANGE_TEXT_TITLE, '', '', 'title="' . MODULE_PAYMENT_CODCHANGE_TEXT_TITLE . '" style="max-height: 64px;"') . ' Pago contra reembolso.');
define('MODULE_PAYMENT_CODCHANGE_TEXT_INFO', 'Por favor, pague el importe de la factura al recibir el pedido.');
define('MODULE_PAYMENT_CODCHANGE_ZONE_TITLE', 'Zona de pago');
define('MODULE_PAYMENT_CODCHANGE_ZONE_DESC', 'Si se selecciona una zona, el método de pago solo se aplicará a esa zona.');
define('MODULE_PAYMENT_CODCHANGE_ALLOWED_TITLE', 'Zonas permitidas');
define('MODULE_PAYMENT_CODCHANGE_ALLOWED_DESC', 'Especifique <b>individualmente</b> las zonas que están permitidas para este módulo. (por ejemplo, AT,DE (si se deja en blanco, se permitirán todas las zonas))');
define('MODULE_PAYMENT_CODCHANGE_STATUS_TITLE', 'Activar módulo de pago contra reembolso');
define('MODULE_PAYMENT_CODCHANGE_STATUS_DESC', '¿Desea aceptar pagos contra reembolso?');
define('MODULE_PAYMENT_CODCHANGE_SORT_ORDER_TITLE', 'Orden de visualización');
define('MODULE_PAYMENT_CODCHANGE_SORT_ORDER_DESC', 'Orden de visualización. El número más pequeño se muestra primero.');
define('MODULE_PAYMENT_CODCHANGE_ORDER_STATUS_ID_TITLE', 'Establecer estado del pedido');
define('MODULE_PAYMENT_CODCHANGE_ORDER_STATUS_ID_DESC', 'Establecer el estado de los pedidos realizados con este módulo');
define('MODULE_PAYMENT_CODCHANGE_LIMIT_ALLOWED_TITLE', 'Cantidad máxima');
define('MODULE_PAYMENT_CODCHANGE_LIMIT_ALLOWED_DESC', '¿A partir de qué cantidad ya no se permitirá el pago contra reembolso?<br />El valor ingresado se comparará con el subtotal, que se redondeará.<br />Esto significa que solo se tendrá en cuenta el valor de los productos, sin incluir los costos de envío y posibles recargos.');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO_TITLE', 'Mostrar información en el checkout');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO_DESC', '¿Desea mostrar un aviso sobre los costos adicionales en el checkout?');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO_TEXT', '<div class="infomessage">El importe de la factura debe pagarse al recibir el pedido.</div>');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_BILL_TEXT', 'Cambio previsto:');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_TIP_TEXT', 'Propina prevista:');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_NOTE_TEXT', '<div class="successmessage" style="display: grid; grid-template-columns: repeat(2, 1fr); grid-template-rows: repeat(3, 1fr); gap: 5px; margin-bottom: 10px;">
    <div>Usted paga con </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>El importe de la factura es </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>Su cambio será </div><div style="text-align: right; font-weight: bold;">%s</div>
</div>');
define('MODULE_PAYMENT_CODCHANGE_QUESTION_TEXT', '¿Con qué cantidad desea pagar?');
define('MODULE_PAYMENT_CODCHANGE_COURIER_CHANGE_TEXT', ' El mensajero recibirá el cambio correspondiente.');
define('MODULE_PAYMENT_CODCHANGE_ERROR_TEXT', '<div class="errormessage" style="display: grid; grid-template-columns: repeat(2, 1fr); grid-template-rows: repeat(3, 1fr); gap: 5px; margin-bottom: 10px;">
    <div>Usted paga con </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>El importe de la factura es </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>Aún falta </div><div style="text-align: right; font-weight: bold;">%s</div>
</div>');

define('MODULE_PAYMENT_CODCHANGE_ERROR_LIMIT_TEXT', 'Un importe de cambio de %s o más no está permitido por razones de seguridad. Por favor, introduzca un importe menor.');

define('MODULE_PAYMENT_CODCHANGE_MEMO_TITLE', 'Pago contra reembolso con cambio');
define('MODULE_PAYMENT_CODCHANGE_MEMO_TEXT_CHANGE', 'El cliente indicó que desea pagar con un importe de %s. El importe total del pedido es %s. El cambio es por lo tanto %s.');
define('MODULE_PAYMENT_CODCHANGE_MEMO_TEXT_TIP', 'El cliente indicó que desea dar una propina al mensajero de %s.');
