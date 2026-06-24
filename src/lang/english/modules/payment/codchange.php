<?php
/* -----------------------------------------------------------------------------------------
   $Id: English codchange.php 2026-06-11 12:00:00Z benax $

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

define('MODULE_PAYMENT_CODCHANGE_TEXT_TITLE', 'Cash on Delivery');
define('MODULE_PAYMENT_CODCHANGE_TEXT_DESCRIPTION', xtc_image(DIR_WS_ICONS . 'bx-codchange.png', MODULE_PAYMENT_CODCHANGE_TEXT_TITLE, '', '', 'title="' . MODULE_PAYMENT_CODCHANGE_TEXT_TITLE . '" style="max-height: 64px;"') . ' Cash on Delivery.');
define('MODULE_PAYMENT_CODCHANGE_TEXT_INFO', 'Please pay the invoice amount upon delivery to the courier.');
define('MODULE_PAYMENT_CODCHANGE_ZONE_TITLE', 'Payment Zone');
define('MODULE_PAYMENT_CODCHANGE_ZONE_DESC', 'If a zone is selected, the payment method will only be valid for that zone.');
define('MODULE_PAYMENT_CODCHANGE_ALLOWED_TITLE', 'Allowed Zones');
define('MODULE_PAYMENT_CODCHANGE_ALLOWED_DESC', 'Specify <b>individually</b> the zones that are allowed for this module. (e.g., AT,DE (if empty, all zones are allowed))');
define('MODULE_PAYMENT_CODCHANGE_STATUS_TITLE', 'Enable Cash on Delivery Module');
define('MODULE_PAYMENT_CODCHANGE_STATUS_DESC', 'Do you want to accept payments via Cash on Delivery?');
define('MODULE_PAYMENT_CODCHANGE_SORT_ORDER_TITLE', 'Display Order');
define('MODULE_PAYMENT_CODCHANGE_SORT_ORDER_DESC', 'Order of display. Lowest number is displayed first.');
define('MODULE_PAYMENT_CODCHANGE_ORDER_STATUS_ID_TITLE', 'Set Order Status');
define('MODULE_PAYMENT_CODCHANGE_ORDER_STATUS_ID_DESC', 'Orders made with this module will be set to this status');
define('MODULE_PAYMENT_CODCHANGE_LIMIT_ALLOWED_TITLE', 'Maximum Amount');
define('MODULE_PAYMENT_CODCHANGE_LIMIT_ALLOWED_DESC', 'Above which amount should Cash on Delivery no longer be allowed?<br />The entered value is compared with the subtotal, which is rounded.<br />This means that only the pure product value, without shipping costs and any surcharges, is considered.');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO_TITLE', 'Display in Checkout');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO_DESC', 'Should a notice about additional costs be displayed in the checkout?');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO_TEXT', '<div class="infomessage">The invoice amount is to be paid upon delivery to the courier.</div>');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_BILL_TEXT', 'Planned Change:');
define('MODULE_PAYMENT_CODCHANGE_DISPLAY_NOTE_TEXT', '<div class="successmessage" style="display: grid; grid-template-columns: repeat(2, 1fr); grid-template-rows: repeat(3, 1fr); gap: 5px; margin-bottom: 10px;">
    <div>You pay with </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>The invoice amount is </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>Your change will be </div><div style="text-align: right; font-weight: bold;">%s</div>
</div>');
define('MODULE_PAYMENT_CODCHANGE_QUESTION_TEXT', 'What amount would you like to pay with?');
define('MODULE_PAYMENT_CODCHANGE_COURIER_CHANGE_TEXT', ' The courier will receive the appropriate change.');
define('MODULE_PAYMENT_CODCHANGE_ERROR_TEXT', '<div class="errormessage" style="display: grid; grid-template-columns: repeat(2, 1fr); grid-template-rows: repeat(3, 1fr); gap: 5px; margin-bottom: 10px;">
    <div>You pay by </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>The invoice amount is </div><div style="text-align: right; font-weight: bold;">%s</div>
    <div>Still missing </div><div style="text-align: right; font-weight: bold;">%s</div>
</div>');

define('MODULE_PAYMENT_CODCHANGE_ERROR_LIMIT_TEXT', 'A change amount of %s or more is not allowed for security reasons. Please enter a smaller amount.');
