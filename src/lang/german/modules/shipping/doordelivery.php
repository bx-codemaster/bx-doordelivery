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

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_TITLE', 'Haustürlieferung');
define('MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION', xtc_image(DIR_WS_ICONS . 'bx-codchange.png', MODULE_SHIPPING_DOORDELIVERY_TEXT_TITLE, '', '', 'title="' . MODULE_SHIPPING_DOORDELIVERY_TEXT_TITLE . '" style="max-height: 64px;"') . '<br>Wir liefern Ihnen die Ware direkt an Ihre Haustüre.');

define('MODULE_SHIPPING_DOORDELIVERY_TEXT_WAY', MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION);

define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_TITLE' , 'Erlaubte Zonen');
define('MODULE_SHIPPING_DOORDELIVERY_ALLOWED_DESC' , 'Geben Sie <b>einzeln</b> die Zonen an, in welche ein Versand möglich sein soll. (z.B. AT,DE (lassen Sie dieses Feld leer, wenn Sie alle Zonen erlauben wollen))');

define('MODULE_SHIPPING_DOORDELIVERY_STATUS_TITLE', 'Haustürlieferung aktivieren');
define('MODULE_SHIPPING_DOORDELIVERY_STATUS_DESC', 'Möchten Sie Haustürlieferung anbieten?');

define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_TITLE', 'Sortierreihenfolge');
define('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER_DESC', 'Reihenfolge der Anzeige');

define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_TITLE', 'Erlaubte Zahlungsarten');
define('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED_DESC', 'Geben Sie <b>einzeln</b> die Zahlungsarten an, welche für diesen Versand erlaubt sein sollen  (z.B. cod,banktransfer,cc (lassen Sie dieses Feld leer, wenn Sie alle Zahlungsarten erlauben wollen))');

define('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS_TITLE', 'Steuerklasse');
define('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS_DESC', 'Wählen Sie die Steuerklasse für diesen Versand aus.');

define('MODULE_SHIPPING_DOORDELIVERY_ZIP_CODE_TITLE', 'Postleitzahl');
define('MODULE_SHIPPING_DOORDELIVERY_ZIP_CODE_DESC', 'Geben Sie eine Postleitzahl oder einen Bereich ein.');

define('MODULE_SHIPPING_DOORDELIVERY_COST_NET', 'Liefergebühr (netto)');
define('MODULE_SHIPPING_DOORDELIVERY_COST_NET_DESC', 'Netto eingeben...');

define('MODULE_SHIPPING_DOORDELIVERY_COST_GROSS', 'Liefergebühr (brutto)');
define('MODULE_SHIPPING_DOORDELIVERY_COST_GROSS_DESC', 'Brutto eingeben...');

define('MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_NET', 'Mindestbestellwert (netto)');
define('MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_NET_DESC', '0 = kein Mindestwert.');

define('MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_GROSS', 'Mindestbestellwert (brutto)');
define('MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_GROSS_DESC', '0 = kein Mindestwert.');

define('MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE', 'Liefergebiete');
define('MODULE_SHIPPING_DOORDELIVERY_AREAS_DESC', 'Geben Sie die Postleitzahlen oder Postleitzahlenbereiche an, welche in Ihrem Liefergebiet liegen.<br>Z.B. 12345, 23456 oder 45*, 501* für alle PLZ die mit 45 oder 501 beginnen. Sie entfernen einen Eintrag, indem Sie ihn anklicken.');

define('MODULE_SHIPPING_DOORDELIVERY_ERROR_NOT_IN_AREA', '<table>
<tr><td>'.xtc_image(DIR_WS_ICONS . 'bx-nodelivery.png', MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE, '', '', 'title="' . MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE . '" style="max-height: 64px;"')
 . '</td></tr><tr><td>Nicht im Liefergebiet liegende Postleitzahl</td></tr></table>');
define('MODULE_SHIPPING_DOORDELIVERY_ERROR_MIN_ORDER', '<br>'.xtc_image(DIR_WS_ICONS . 'bx-minimum-order-value.png', MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_GROSS, '', '', 'title="' . MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_GROSS . '" style="max-height: 64px;"') . '<br>Mindestbestellwert: %s (aktueller Warenkorb: %s)');

define ('MODULE_SHIPPING_DOORDELIVERY_TXT_ADD', 'Hinzufügen');
