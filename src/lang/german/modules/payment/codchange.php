<?php
/* -----------------------------------------------------------------------------------------
   $Id: Deutsch codchange.php 2026-06-11 12:00:00Z benax $

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

define('MODULE_PAYMENT_CODCHANGE_TEXT_TITLE', 'Barzahlung bei Lieferung');
define('MODULE_PAYMENT_CODCHANGE_TEXT_DESCRIPTION', xtc_image(DIR_WS_ICONS . 'bx-codchange.png', MODULE_PAYMENT_CODCHANGE_TEXT_TITLE, '', '', 'title="' . MODULE_PAYMENT_CODCHANGE_TEXT_TITLE . '" style="max-height: 64px;"') . ' Barzahlung bei Lieferung.');
define('MODULE_PAYMENT_CODCHANGE_TEXT_INFO', 'Bitte bezahlen Sie den Rechnungsbetrag bei Übergabe an den Boten.');
define('MODULE_PAYMENT_CODCHANGE_ZONE_TITLE', 'Zahlungszone');
define('MODULE_PAYMENT_CODCHANGE_ZONE_DESC', 'Wenn eine Zone ausgewählt ist, gilt die Zahlungsmethode nur für diese Zone.');
define('MODULE_PAYMENT_CODCHANGE_ALLOWED_TITLE', 'Erlaubte Zonen');
define('MODULE_PAYMENT_CODCHANGE_ALLOWED_DESC', 'Geben Sie <b>einzeln</b> die Zonen an, welche für dieses Modul erlaubt sein sollen. (z.B. AT,DE (wenn leer, werden alle Zonen erlaubt))');
define('MODULE_PAYMENT_CODCHANGE_STATUS_TITLE', 'Barzahlung bei Lieferung Modul aktivieren');
define('MODULE_PAYMENT_CODCHANGE_STATUS_DESC', 'Möchten Sie Zahlungen per Barzahlung bei Lieferung akzeptieren?');
define('MODULE_PAYMENT_CODCHANGE_SORT_ORDER_TITLE', 'Anzeigereihenfolge');
define('MODULE_PAYMENT_CODCHANGE_SORT_ORDER_DESC', 'Reihenfolge der Anzeige. Kleinste Ziffer wird zuerst angezeigt.');
define('MODULE_PAYMENT_CODCHANGE_ORDER_STATUS_ID_TITLE', 'Bestellstatus festlegen');
define('MODULE_PAYMENT_CODCHANGE_ORDER_STATUS_ID_DESC', 'Bestellungen, welche mit diesem Modul gemacht werden, auf diesen Status setzen');
define('MODULE_PAYMENT_CODCHANGE_LIMIT_ALLOWED_TITLE', 'Maximalbetrag');
define('MODULE_PAYMENT_CODCHANGE_LIMIT_ALLOWED_DESC', 'Ab welchem Betrag soll Barzahlung bei Lieferung nicht mehr erlaubt werden?<br />Der eingegebene Wert wird mit der Zwischensumme (subtotal) verglichen, welche gerundet wird.<br />Das bedeutet, dass der nur reine Warenwert, ohne Versandkosten und evtl. Zuschläge berücksichtigt wird.');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO_TITLE', 'Anzeige im Checkout');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO_DESC', 'Soll ein Hinweis auf zusätzlich anfallende Kosten im Checkout angezeigt werden?');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO_TEXT', '<div class="infomessage">Der Rechnungsbetrag ist bei Sendungsübergabe an den Zusteller zu entrichten.</div>');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_BILL_TEXT', 'Geplantes Wechselgeld:');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_TIP_TEXT', 'Geplantes Trinkgeld:');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_NOTE_TEXT', '<div class="successmessage" style="display: grid; grid-template-columns: repeat(2, 1fr); grid-template-rows: repeat(3, 1fr); gap: 5px; margin-bottom: 10px;">
    <div>Sie zahlen mit </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>Der Rechnungsbetrag beträgt </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>Ihr Wechselgeld beträgt dann </div><div style="text-align: right; font-weight: bold;">%s</div>
</div>');
define('MODULE_PAYMENT_CODCHANGE_QUESTION_TEXT', 'Mit welchem Barbetrag möchten Sie bezahlen?');
define('MODULE_PAYMENT_CODCHANGE_COURIER_CHANGE_TEXT', ' Der Bote bekommt das passende Wechselgeld mit.');
define('MODULE_PAYMENT_CODCHANGE_ERROR_TEXT', '<div class="errormessage" style="display: grid; grid-template-columns: repeat(2, 1fr); grid-template-rows: repeat(3, 1fr); gap: 5px; margin-bottom: 10px;">
    <div>Sie zahlen mit </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>Der Rechnungsbetrag beträgt </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>Es fehlen noch </div><div style="text-align: right; font-weight: bold;">%s</div>
</div>');

define('MODULE_PAYMENT_CODCHANGE_ERROR_LIMIT_TEXT', 'Ein Wechselgeldbetrag von %s oder mehr ist aus Sicherheitsgründen nicht möglich. Bitte geben Sie einen kleineren Betrag ein.');

define('MODULE_PAYMENT_CODCHANGE_MEMO_TITLE', 'Barzahlung mit Wechselgeld');
define('MODULE_PAYMENT_CODCHANGE_MEMO_TEXT_CHANGE', 'Der Kunde hat angegeben, dass er mit einem Betrag von %s bezahlen möchte. Der Gesamtbetrag der Bestellung beträgt %s. Das Wechselgeld beträgt somit %s.');
define('MODULE_PAYMENT_CODCHANGE_MEMO_TEXT_TIP', 'Der Kunde hat angegeben, dass er dem Boten ein Trinkgeld von %s geben möchte.');
