<?PHP
/* -----------------------------------------------------------------------------------------
   $Id: doordelivery.php 2026-06-11 12:00:00Z benax $

   modified eCommerce Shopsoftware
   http://www.modified-shop.org

   Copyright (c) 2009 - 2013 [www.modified-shop.org]
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(freeamount.php,v 1.01 2002/01/24); www.oscommerce.com 
   (c) 2003	 nextcommerce (freeamount.php,v 1.12 2003/08/24); www.nextcommerce.org
   (c) 2006 xt:Commerce; www.xt-commerce.com

   Released under the GNU General Public License 
   -----------------------------------------------------------------------------------------
   Third Party contributions:
   selfpickup         	Autor:	sebthom

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

class doordelivery {
    public string $code;
    public string $title;
    public string $description;
    public string $icon;
    public string $tax_class;
    public bool $enabled;
    public string $sort_order;
    public array $quotes;
    public string $error;

    public function __construct() {
        $this->code        = 'doordelivery';
        $this->title       = MODULE_SHIPPING_DOORDELIVERY_TEXT_TITLE;
        $this->description = MODULE_SHIPPING_DOORDELIVERY_TEXT_DESCRIPTION;
        $this->icon        = DIR_WS_ICONS . 'bx-doordelivery.png';
        $this->sort_order  = ((defined('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER')) ? MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER : '');
        $this->enabled     = ((defined('MODULE_SHIPPING_DOORDELIVERY_STATUS') && MODULE_SHIPPING_DOORDELIVERY_STATUS == 'True') ? true : false);
        $this->tax_class   = ((defined('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS')) ? MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS : '');
        $this->quotes      = array();
        $this->error       = 'False';
    }

    public function quote($method = ''): array|bool {
        global $order;
        
        // 1. PLZ der Lieferadresse ermitteln
        $customerZip = '';
        if (!empty($order->delivery['postcode'])) {
            $customerZip = trim($order->delivery['postcode']);
        } else {
            $this->error = 'True';
        }

        // 2. Deine erlaubten Liefergebiete für die Haustüre definieren
        $deliveryArea = defined('MODULE_SHIPPING_DOORDELIVERY_AREAS') ? json_decode(MODULE_SHIPPING_DOORDELIVERY_AREAS) : array();
    
        // 3. PLZ-Prüfung durchführen
        if (!$this->checkPostcodeMatch($customerZip, $deliveryArea)) {
            // Nicht im Liefergebiet? Modul wird im Checkout nicht angezeigt.
            $this->error = 'True';
        }

        $this->quotes = array(
            'id' => $this->code,
            'module' => MODULE_SHIPPING_DOORDELIVERY_TEXT_TITLE,
        );

        if('True' === $this->error) {
            $this->quotes['error'] = MODULE_SHIPPING_DOORDELIVERY_ERROR_NOT_IN_AREA;
        }

        $this->quotes['methods'] = array(array(
            'id'    => $this->code,
            'title' => MODULE_SHIPPING_DOORDELIVERY_TEXT_WAY,
            'cost'  => (float)MODULE_SHIPPING_DOORDELIVERY_COST,
        ));

        if ($this->tax_class > 0) {
            $this->quotes['tax'] = xtc_get_tax_rate($this->tax_class, $order->delivery['shipping']['id'], $order->delivery['shipping']['zone_id']);
        }


        if(xtc_not_null($this->icon)) {
            $this->quotes['icon'] = xtc_image($this->icon, $this->title);
        }

        return $this->quotes;
    }

    public function cheapest() {
        return false;
    }

    public function check(): int {
        $check = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_SHIPPING_DOORDELIVERY_STATUS'");
        $check = xtc_db_num_rows($check);

        return $check;
    }

    public function install(): void {
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, 
                                                                     configuration_value, 
                                                                     configuration_group_id, 
                                                                     sort_order, 
                                                                     set_function, 
                                                                     date_added) 
                                                            VALUES ('MODULE_SHIPPING_DOORDELIVERY_STATUS', 
                                                                    'True', 
                                                                    '6', 
                                                                    '1', 
                                                                    'xtc_cfg_select_option(array(\'True\', \'False\'), ', 
                                                                    now())");

        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, 
                                                                     configuration_value, 
                                                                     configuration_group_id, 
                                                                     sort_order, 
                                                                     date_added) 
                                                            VALUES ('MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER', 
                                                                    '0', 
                                                                    '6', 
                                                                    '2', 
                                                                    now())");

        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, 
                                                                     configuration_value, 
                                                                     configuration_group_id, 
                                                                     sort_order, 
                                                                     date_added) 
                                                            VALUES ('MODULE_SHIPPING_DOORDELIVERY_ALLOWED', 
                                                                    '', 
                                                                    '6', 
                                                                    '3', 
                                                                    now())");
        
      xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, 
                                                                   configuration_value, 
                                                                   configuration_group_id, 
                                                                   sort_order,  
                                                                   set_function,
                                                                   date_added) 
                                                           VALUES ('MODULE_SHIPPING_DOORDELIVERY_COST', 
                                                                   '0.00', 
                                                                   '6', 
                                                                   '4',
                                                                   'xtc_cfg_doordelivery_fields(', 
                                                                   now())");

      xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, 
                                                                   configuration_value, 
                                                                   configuration_group_id, 
                                                                   sort_order, 
                                                                   use_function, 
                                                                   set_function, 
                                                                   date_added) 
                                                           VALUES ('MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS', 
                                                                   '0', 
                                                                   '6', 
                                                                   '5', 
                                                                   'xtc_get_tax_class_title', 
                                                                   'xtc_cfg_pull_down_tax_classes(', 
                                                                   now())");

      xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, 
                                                                     configuration_value, 
                                                                     configuration_group_id, 
                                                                     sort_order, 
                                                                     set_function, 
                                                                     date_added) 
                                                            VALUES ('MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED', 
                                                                    '', 
                                                                    '6', 
                                                                    '6', 
                                                                    'xtc_cfg_checkbox_unallowed_module(\'payment\', \'configuration[MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED]\',', 
                                                                    now())");

      xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, 
                                                                   configuration_value, 
                                                                   configuration_group_id, 
                                                                   sort_order, 
                                                                   use_function, 
                                                                   set_function, 
                                                                   date_added) 
                                                           VALUES ('MODULE_SHIPPING_DOORDELIVERY_AREAS', 
                                                                   '', 
                                                                   '6', 
                                                                   '7', 
                                                                   '', 
                                                                   'xtc_cfg_doordelivery_areas(', 
                                                                   now())");
    }

    public function remove(): void {
        xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key IN ('" . implode("', '", $this->keys()) . "')");
    }

    public function keys(): array {
        return array('MODULE_SHIPPING_DOORDELIVERY_STATUS', 
                     'MODULE_SHIPPING_DOORDELIVERY_SORT_ORDER',
                     'MODULE_SHIPPING_DOORDELIVERY_ALLOWED',
                     'MODULE_SHIPPING_DOORDELIVERY_COST',
                     'MODULE_SHIPPING_DOORDELIVERY_TAX_CLASS',
                     'MODULE_SHIPPING_DOORDELIVERY_PAYMENTS_ALLOWED',
                     'MODULE_SHIPPING_DOORDELIVERY_AREAS');
    }

    /**
     * Hilfsmethode zur PLZ-Validierung (Exakt, Von-Bis und Wildcard)
     */
    private function checkPostcodeMatch(string $customerZip, array $allowedZips): bool {
        // 1. Eingabe des Kunden säubern und in Großbuchstaben umwandeln
        $customerZip = strtoupper(trim($customerZip));

        foreach ($allowedZips as $zip) {
            // Erlaubte PLZ säubern und in Großbuchstaben umwandeln
            $zip = strtoupper(trim($zip));
        
            // 2. Exakter Treffer
            if ($customerZip === $zip) {
                return true; // Sofort abbrechen und "true" zurückgeben
            }
        
            // 3. Wildcard (z.B. 51* oder D02*)
            if (str_contains($zip, '*')) {
                $quotedZip = preg_quote($zip, '#');
                
                // Modifier 'i' am Ende hinzugefügt für zusätzliche Case-Insensitivity-Sicherheit
                $pattern = '#^' . str_replace('\*', '.*', $quotedZip) . '$#i';
                
                if (preg_match($pattern, $customerZip)) {
                    return true; // Sofort abbrechen und "true" zurückgeben
                }
            }
        }
        
        // Wenn die Schleife ohne Treffer durchläuft
        return false;
    }
}
