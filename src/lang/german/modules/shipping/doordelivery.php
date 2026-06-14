<?PHP
/* -----------------------------------------------------------------------------------------
   $Id: Deutsch doordelivery.php 2026-06-11 12:00:00Z benax $

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

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_TITLE', 'Lieferung nach Hause');
define('MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION', 'Wir liefern Ihnen die Ware direkt an Ihre Haustüre.');

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_WAY', MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION);

define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_TITLE' , 'Erlaubte Zonen');
define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_DESC' , 'Geben Sie <b>einzeln</b> die Zonen an, in welche ein Versand möglich sein soll. (z.B. AT,DE (lassen Sie dieses Feld leer, wenn Sie alle Zonen erlauben wollen))');

define('MODULE_SHIPPING_DOORDELIVERY_STATUS_TITLE', 'Lieferung nach Hause aktivieren');
define('MODULE_SHIPPING_DOORDELIVERY_STATUS_DESC', 'Möchten Sie Lieferung nach Hause anbieten?');

define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_TITLE', 'Sortierreihenfolge');
define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_DESC', 'Reihenfolge der Anzeige');

define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_TITLE', 'Erlaubte Zahlungsarten');
define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_DESC', 'Geben Sie <b>einzeln</b> die Zahlungsarten an, welche für diesen Versand erlaubt sein sollen  (z.B. cod,banktransfer,cc (lassen Sie dieses Feld leer, wenn Sie alle Zahlungsarten erlauben wollen))');

define('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS_TITLE', 'Steuerklasse');
define('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS_DESC', 'Wählen Sie die Steuerklasse für diesen Versand aus.');

define('MODULE_SHIPPING_DOORDELIVERY_COST_TITLE', 'Zustellkosten');
define('MODULE_SHIPPING_DOORDELIVERY_COST_DESC', 'Zustellung-Pauschale (z.B. 4.50).');

define('MODULE_SHIPPING_DOORDELIVERY_COST_NET', 'Zustellkosten (netto)');
define('MODULE_SHIPPING_DOORDELIVERY_COST_GROSS', 'Zustellkosten (brutto)');
