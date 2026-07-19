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

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_TITLE', 'Door Delivery');
define('MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION', 'We deliver the goods directly to your door.');

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_WAY', MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION);

define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_TITLE' , 'Allowed Zones');
define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_DESC' , 'Specify <b>individually</b> the zones to which shipping is possible. (e.g. AT,DE (leave this field empty if you want to allow all zones))');

define('MODULE_SHIPPING_DOORDELIVERY_STATUS_TITLE', 'Enable Door Delivery');
define('MODULE_SHIPPING_DOORDELIVERY_STATUS_DESC', 'Do you want to offer door delivery?');

define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_DESC', 'Order of display');

define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_TITLE', 'Allowed Payment Methods');
define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_DESC', 'Specify <b>individually</b> the payment methods allowed for this shipping (e.g. cod,banktransfer,cc (leave this field empty if you want to allow all payment methods))');

define('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS_TITLE', 'Tax Class');
define('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS_DESC', 'Select the tax class for this shipping.');
define('MODULE_SHIPPING_DOORDELIVERY_ZIP_CODE_TITLE', 'Zip Code');
define('MODULE_SHIPPING_DOORDELIVERY_ZIP_CODE_DESC', 'Enter a zip code or a range.');

define('MODULE_SHIPPING_DOORDELIVERY_COST_NET', 'Shipping Cost (Net)');
define('MODULE_SHIPPING_DOORDELIVERY_COST_NET_DESC', 'Enter the shipping cost (net)...');

define('MODULE_SHIPPING_DOORDELIVERY_COST_GROSS', 'Shipping Cost (Gross)');
define('MODULE_SHIPPING_DOORDELIVERY_COST_GROSS_DESC', 'Enter the shipping cost (gross)...');

define('MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER', 'Minimum order value');
define('MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_DESC', 'Minimum order value for this delivery area (0 = no minimum).');

define('MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE', 'Shipping Areas');
define('MODULE_SHIPPING_DOORDELIVERY_AREAS_DESC', 'Enter the zip codes or zip code ranges that are within your shipping area.<br>For example, 12345, 23456 or 45*, 501* for all zip codes starting with 45 or 501. Remove an entry by clicking on it.');

define('MODULE_SHIPPING_DOORDELIVERY_ERROR_NOT_IN_AREA', '<br>'.xtc_image(DIR_WS_ICONS . 'bx-nodelivery.png', MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE, '', '', 'title="' . MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE . '" style="max-height: 64px;"') . '<br>Zip code not in shipping area');
define('MODULE_SHIPPING_DOORDELIVERY_ERROR_MIN_ORDER', '<br>Minimum order value for this delivery area: %s (current cart: %s)');

define ('MODULE_SHIPPING_DOORDELIVERY_TXT_ADD', 'Add');
