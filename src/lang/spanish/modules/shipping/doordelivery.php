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

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_TITLE', 'Entrega a domicilio');
define('MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION', 'Le entregamos la mercancía directamente en su puerta.');

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_WAY', MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION);

define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_TITLE' , 'Zonas permitidas');
define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_DESC' , 'Especifique <b>individualmente</b> las zonas que están permitidas para este módulo. (por ejemplo, AT,DE (si se deja en blanco, se permitirán todas las zonas))');

define('MODULE_SHIPPING_DOORDELIVERY_STATUS_TITLE', 'Activar entrega a domicilio');
define('MODULE_SHIPPING_DOORDELIVERY_STATUS_DESC', '¿Desea ofrecer entrega a domicilio?');

define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_TITLE', 'Orden de visualización');
define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_DESC', 'Orden de visualización');

define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_TITLE', 'Métodos de pago permitidos');
define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_DESC', 'Especifique <b>individualmente</b> los métodos de pago que están permitidos para este envío (por ejemplo, cod,banktransfer,cc (si se deja en blanco, se permitirán todos los métodos de pago))');

define('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS_TITLE', 'Clase de impuesto');
define('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS_DESC', 'Seleccione la clase de impuesto para este envío.');

define('MODULE_SHIPPING_DOORDELIVERY_COST_TITLE', 'Costos de entrega');
define('MODULE_SHIPPING_DOORDELIVERY_COST_DESC', 'Tarifa plana de entrega (por ejemplo, 4.50). Por favor, ingrese un monto neto.');

define('MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE', 'Áreas de entrega');
define('MODULE_SHIPPING_DOORDELIVERY_AREAS_DESC', 'Especifique los códigos postales o rangos de códigos postales que están dentro de su área de entrega.<br>Por ejemplo, 12345, 23456 o 45*, 501* para todos los códigos postales que comienzan con 45 o 501. Elimine una entrada haciendo clic en ella.');

define('MODULE_SHIPPING_DOORDELIVERY_ERROR_NOT_IN_AREA', 'No está en el área de entrega');
