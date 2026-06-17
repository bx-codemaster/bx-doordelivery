<?PHP
/* -----------------------------------------------------------------------------------------
   $Id: English doordelivery.php 2026-06-11 12:00:00Z benax $

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

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_TITLE', 'Home Delivery');
define('MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION', 'We deliver the goods directly to your doorstep.');

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_WAY', MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION);

define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_TITLE' , 'Allowed Zones');
define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_DESC' , 'Specify <b>individually</b> the zones that are allowed for this shipping method. (e.g., AT,DE (leave this field empty to allow all zones))');

define('MODULE_SHIPPING_DOORDELIVERY_STATUS_TITLE', 'Enable Home Delivery');
define('MODULE_SHIPPING_DOORDELIVERY_STATUS_DESC', 'Do you want to offer home delivery?');

define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_DESC', 'Order of display');

define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_TITLE', 'Allowed Payment Methods');
define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_DESC', 'Specify <b>individually</b> the payment methods that are allowed for this shipping method. (e.g., cod,banktransfer,cc (leave this field empty to allow all payment methods))');

define('MODULE_SHIPPING_DOORDELIVERY_COST_TITLE', 'Delivery Costs');
define('MODULE_SHIPPING_DOORDELIVERY_COST_DESC', 'Delivery flat rate (e.g., 4.50). Please enter a net amount.');

define('MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE', 'Delivery Areas');
define('MODULE_SHIPPING_DOORDELIVERY_AREAS_DESC', 'Specify the postal codes or postal code ranges that are within your delivery area.<br>For example, 12345, 23456 or 45*, 501* for all postal codes starting with 45 or 501. Remove an entry by clicking on it.');

define('MODULE_SHIPPING_DOORDELIVERY_ERROR_NOT_IN_AREA', 'Not in the delivery area');