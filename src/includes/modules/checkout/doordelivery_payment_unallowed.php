<?php
/* -------------------------------------------------------------------------------------------------
   Module:    Versand Zahlungsweisen
   Anpassung: benax
   Platform:  modified eCommerce Shopsoftware 2.x.x.x (http://www.modified-shop.org)
   -----------------------------------------------------------------------------------------------*/

class doordelivery_payment_unallowed {
	public string $code; 
	public string $title;	
	public string $description;	
	public string $sort_order;
	public bool $enabled;
	public bool $_check;
	
	public function __construct() {
        $this->code        = 'doordelivery_payment_unallowed';
		$this->title       = MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_STATUS_TITLE;
        $this->description = MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_STATUS_DESC;
        $this->enabled     = defined('MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_STATUS') && constant('MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_STATUS') == 'true' ? true : false;
        $this->sort_order  = defined('MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_SORT_ORDER') ? constant('MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_SORT_ORDER') : ''; 
    }

    public function check(): bool {
      if (!isset($this->_check)) {
        if (defined('MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_STATUS')) {
          $this->_check = true;
        } else {
          $this->_check = false;
        }
      }
      return $this->_check;
    }

    public function keys(): array {
        return array(
            'MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_STATUS',
            'MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_SORT_ORDER'
        );
    }

    public function install(): void {
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, 
                                                                     configuration_value, 
                                                                     configuration_group_id, 
                                                                     sort_order, 
                                                                     set_function, 
                                                                     date_added) 
                                                             VALUES ('MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_STATUS', 
                                                                     'true', 
                                                                     '6', 
                                                                     '1', 
                                                                     'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");

        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, 
                                                                     configuration_value, 
                                                                     configuration_group_id, 
                                                                     sort_order, 
                                                                     date_added) 
                                                             VALUES ('MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_SORT_ORDER', 
                                                                     '99', 
                                                                     '6', 
                                                                     '2', 
                                                                     now())");
    }

    public function remove(): void {
        xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE 'MODULE_CHECKOUT_DOORDELIVERY_PAYMENT_UNALLOWED_%'");
    }

    public function unallowed_payment_modules(array $unallowed_modules): array {
        if( isset($_SESSION["shipping"]["id"]) && $_SESSION["shipping"]["id"] === 'doordelivery_doordelivery') {
            $string1 = defined('MODULE_PAYMENT_INSTALLED') ? MODULE_PAYMENT_INSTALLED : '';
            $string2 = defined('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED') ? MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED : '';

            // 1. Strings in Arrays umwandeln (auf die Trennzeichen ; und , achten)
            $array1 = explode(';', $string1);
            $array2 = explode(',', $string2);

            // 2. Die Dateiendungen (.php) aus dem ersten Array entfernen
            $array1_clean = array_map(function($value) {
                return basename($value, '.php');
            }, $array1);

            // 3. Vergleichen: Welche Werte aus Array 1 fehlen in Array 2?
            $fehlende_werte    = array_diff($array1_clean, $array2);
            $unallowed_modules = array_merge($unallowed_modules,$fehlende_werte);

            return $unallowed_modules;
        }
        return $unallowed_modules;
    }
}
