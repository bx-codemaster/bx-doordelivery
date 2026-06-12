<?php
/* -------------------------------------------------------------------------------------------------
   Module:    Versand Zahlungsweisen
   Anpassung: benax
   Platform:  modified eCommerce Shopsoftware 2.x.x.x (http://www.modified-shop.org)
   -----------------------------------------------------------------------------------------------*/

class doordelivery_payment_unallowed {
	public string $code; 
	public string $title;
	public string $name;	
	public string $description;	
	public string $sort_order;
	public bool $enabled;
	public bool|int $_check;
	
	public function __construct() {
        $this->code        = 'doordelivery_payment_unallowed';
        $this->name        = 'MODULE_CHECKOUT_'.strtoupper($this->code);
		$this->title       = defined($this->name.'_TITLE') ? constant($this->name.'_TITLE') : '';        
        $this->description = defined($this->name.'_DESCRIPTION') ? constant($this->name.'_DESCRIPTION') : '';        
        $this->enabled     = defined($this->name.'_STATUS') && constant($this->name.'_STATUS') == 'true' ? true : false;
        $this->sort_order  = defined($this->name.'_SORT_ORDER') ? constant($this->name.'_SORT_ORDER') : ''; 
    }

    public function check(): bool|int {
      if (!isset($this->_check)) {
        if (defined($this->name.'_STATUS')) {
          $this->_check = true;
        } else {
          $check_query = xtc_db_query("SELECT configuration_value 
                                         FROM " . TABLE_CONFIGURATION . " 
                                        WHERE configuration_key = '".$this->name."_STATUS'");
          $this->_check = xtc_db_num_rows($check_query);
        }
      }
      return $this->_check;
    }

    public function keys(): array {
        define($this->name.'_STATUS_TITLE', TEXT_DEFAULT_STATUS_TITLE);
        define($this->name.'_STATUS_DESC', TEXT_DEFAULT_STATUS_DESC);
        define($this->name.'_SORT_ORDER_TITLE', TEXT_DEFAULT_SORT_ORDER_TITLE);
        define($this->name.'_SORT_ORDER_DESC', TEXT_DEFAULT_SORT_ORDER_DESC);

        return array(
            $this->name.'_STATUS',
            $this->name.'_SORT_ORDER'
        );
    }

    public function install(): void {
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, 
                                                                     configuration_value, 
                                                                     configuration_group_id, 
                                                                     sort_order, 
                                                                     set_function, 
                                                                     date_added) 
                                                             VALUES ('".$this->name."_STATUS', 
                                                                     'true', 
                                                                     '6', 
                                                                     '1', 
                                                                     'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");

        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, 
                                                                     configuration_value, 
                                                                     configuration_group_id, 
                                                                     sort_order, 
                                                                     date_added) 
                                                             VALUES ('".$this->name."_SORT_ORDER', 
                                                                     '99', 
                                                                     '6', 
                                                                     '2', 
                                                                     now())");
    }

    public function remove(): void {
        xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE '".$this->name."_%'");
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
            $fehlende_werte = array_diff($array1_clean, $array2);
            
            return $unallowed_modules = array_merge($unallowed_modules,$fehlende_werte);
        }
        return $unallowed_modules;
    }
}
