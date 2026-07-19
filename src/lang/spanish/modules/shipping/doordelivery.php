<?PHP
/* -----------------------------------------------------------------------------------------
   $Id: Spanish doordelivery.php 2026-06-11 12:00:00Z benax $

   modified eCommerce Shopsoftware
   http://www.modified-shop.org

   Copyright (c) 2009 - 2013 [www.modified-shop.org]
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce( freeamount.php,v 1.01 2002/01/24 03:25:00); www.oscommerce.com
   (c) 2003 nextcommerce (freeamount.php,v 1.4 2003/08/13); www.nextcommerce.org
   (c) 2006 xt:Commerce; www.xt-commerce.com

   Released under the GNU General Public License
   -----------------------------------------------------------------------------------------
   Third Party contributions:
   selfpickup         Autor: sebthom

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_TITLE', 'Entrega a Domicilio');
define('MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION', 'Entregamos los productos directamente en su puerta.');

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_WAY', MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION);

define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_TITLE' , 'Zonas Permitidas');
define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_DESC' , 'Especifique <b>individualmente</b> las zonas a las que es posible el envío. (por ejemplo, AT,DE (deje este campo vacío si desea permitir todas las zonas))');

define('MODULE_SHIPPING_DOORDELIVERY_STATUS_TITLE', 'Habilitar Entrega a Domicilio');
define('MODULE_SHIPPING_DOORDELIVERY_STATUS_DESC', '¿Desea ofrecer entrega a domicilio?');

define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_TITLE', 'Orden de Clasificación');
define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_DESC', 'Orden de visualización');

define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_TITLE', 'Métodos de Pago Permitidos');
define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_DESC', 'Especifique <b>individualmente</b> los métodos de pago permitidos para este envío (por ejemplo, cod,banktransfer,cc (deje este campo vacío si desea permitir todos los métodos de pago))');

define('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS_TITLE', 'Clase de Impuesto');
define('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS_DESC', 'Seleccione la clase de impuesto para este envío.');

define('MODULE_SHIPPING_DOORDELIVERY_ZIP_CODE_TITLE', 'Código Postal');
define('MODULE_SHIPPING_DOORDELIVERY_ZIP_CODE_DESC', 'Ingrese un código postal o un rango.');

define('MODULE_SHIPPING_DOORDELIVERY_COST_NET', 'Costo de Envío (Neto)');
define('MODULE_SHIPPING_DOORDELIVERY_COST_NET_DESC', 'Ingrese el costo de envío (neto)...');

define('MODULE_SHIPPING_DOORDELIVERY_COST_GROSS', 'Costo de Envío (Bruto)');
define('MODULE_SHIPPING_DOORDELIVERY_COST_GROSS_DESC', 'Ingrese el costo de envío (bruto)...');

define('MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER', 'Valor mínimo de pedido');
define('MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_DESC', 'Valor mínimo de pedido para esta zona de entrega (0 = sin mínimo).');

define('MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE', 'Áreas de Envío');
define('MODULE_SHIPPING_DOORDELIVERY_AREAS_DESC', 'Ingrese los códigos postales o rangos de códigos postales que están dentro de su área de envío.<br>Por ejemplo, 12345, 23456 o 45*, 501* para todos los códigos postales que comienzan con 45 o 501. Elimine una entrada haciendo clic en ella.');

define('MODULE_SHIPPING_DOORDELIVERY_ERROR_NOT_IN_AREA', '<br>'.xtc_image(DIR_WS_ICONS . 'bx-nodelivery.png', MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE, '', '', 'title="' . MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE . '" style="max-height: 64px;"') . '<br>Código postal no está en el área de envío');
define('MODULE_SHIPPING_DOORDELIVERY_ERROR_MIN_ORDER', '<br>Valor mínimo de pedido para esta zona: %s (carrito actual: %s)');

define ('MODULE_SHIPPING_DOORDELIVERY_TXT_ADD', 'Agregar');
