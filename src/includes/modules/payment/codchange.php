<?php
/* -----------------------------------------------------------------------------------------
   $Id: codchange.php 2026-06-11 12:00:00Z benax $

   modified eCommerce Shopsoftware - community made shopping
   http://www.modified-shop.org

   Released under the GNU General Public License - Wechselgeld-Edition
   ---------------------------------------------------------------------------------------*/

class codchange {
  public string $code;
  public string $title;
  public string $info;
  public string $description;
  public string $icon;
  public int $sort_order;
  public bool $enabled;
  public int $order_status;
  private bool $_check;
  private float $limit_subtotal;

  public function __construct() {
    global $order, $xtPrice;

    $this->code        = 'codchange';
    $this->title       = defined('MODULE_PAYMENT_CODCHANGE_TEXT_TITLE') ? MODULE_PAYMENT_CODCHANGE_TEXT_TITLE : 'Barzahlung mit Wechselgeld';
    $this->description = defined('MODULE_PAYMENT_CODCHANGE_TEXT_DESCRIPTION') ? MODULE_PAYMENT_CODCHANGE_TEXT_DESCRIPTION : 'Barzahlung bei Lieferung mit Wechselgeld-Angabe';
    $this->icon        = DIR_WS_ICONS . 'bx-codchange.png';
    $this->sort_order  = ((defined('MODULE_PAYMENT_CODCHANGE_SORT_ORDER')) ? (int)MODULE_PAYMENT_CODCHANGE_SORT_ORDER : 0);
    $this->enabled     = ((defined('MODULE_PAYMENT_CODCHANGE_STATUS') && MODULE_PAYMENT_CODCHANGE_STATUS == 'True') ? true : false);
    
    $desc_text = defined('MODULE_PAYMENT_CODCHANGE_TEXT_DESCRIPTION') ? MODULE_PAYMENT_CODCHANGE_TEXT_DESCRIPTION : '';
    $info_text = defined('MODULE_PAYMENT_CODCHANGE_TEXT_INFO') ? MODULE_PAYMENT_CODCHANGE_TEXT_INFO : '';
    $this->info        = ((defined('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO') && MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO == 'True') ? $desc_text.'<br />'.$info_text : $desc_text);
    
    if ($this->check() === true) {
      $this->limit_subtotal = defined('MODULE_PAYMENT_CODCHANGE_LIMIT_ALLOWED') ? floatval(MODULE_PAYMENT_CODCHANGE_LIMIT_ALLOWED) : 600.00;
      if (defined('MODULE_PAYMENT_CODCHANGE_ORDER_STATUS_ID') && (int) MODULE_PAYMENT_CODCHANGE_ORDER_STATUS_ID > 0) {
        $this->order_status = (int)MODULE_PAYMENT_CODCHANGE_ORDER_STATUS_ID;
      }
    }
    
    if (!defined('RUN_MODE_ADMIN') && is_object($order)) {
      $this->update_status();
    }
  }

  public function update_status(): void {
    global $order;
    
    // Deaktivierung bei Selbstabholung
    if (isset($_SESSION['shipping']) 
        && is_array($_SESSION['shipping'])
        && array_key_exists('id', $_SESSION['shipping']) 
        && strpos($_SESSION['shipping']['id'], 'selfpickup') !== false
        )
    {
      $this->enabled = false;
    }
    
    // Geografische Zonenprüfung
    if (($this->enabled == true) && (defined('MODULE_PAYMENT_CODCHANGE_ZONE') && (int) MODULE_PAYMENT_CODCHANGE_ZONE > 0)) {
      $check_flag = false;
      $check_query = xtc_db_query("SELECT zone_id 
                                     FROM ".TABLE_ZONES_TO_GEO_ZONES." 
                                    WHERE geo_zone_id = '".(int)MODULE_PAYMENT_CODCHANGE_ZONE."' 
                                      AND zone_country_id = '".(int)$order->billing['country']['id']."' 
                                 ORDER BY zone_id");
      while ($check = xtc_db_fetch_array($check_query)) {
        if ($check['zone_id'] < 1) {
          $check_flag = true;
          break;
        } elseif ($check['zone_id'] == $order->billing['zone_id']) {
          $check_flag = true;
          break;
        }
      }

      if ($check_flag == false) {
        $this->enabled = false;
      }
    }
  }

  public function javascript_validation(): bool {
    return false;
  }

  public function selection(): false|array {
    global $xtPrice;

    // Sicherer Check auf Warenkorb-Objekt zur Vermeidung von Fatal Errors im Checkout
    if ($this->limit_subtotal && isset($_SESSION['cart']) && is_object($_SESSION['cart']) && ($xtPrice->xtcRemoveCurr($_SESSION['cart']->show_total()) >= $this->limit_subtotal)) {
      return false; // WICHTIG: false statt null, damit modified das Modul sauber ausblendet
    }
    
    // Zusätzliches Eingabefeld für das Wechselgeld definieren
    $fields_array = array(
      array(
        'title' => MODULE_PAYMENT_CODCHANGE_QUESTION_TEXT,
        'field' => xtc_draw_input_field('cod_change_bill', $_SESSION['cod_change_bill'] ?? '', 'placeholder="z.B. 50" style="width:100px;"').' '.MODULE_PAYMENT_CODCHANGE_COURIER_CHANGE_TEXT,
      )
    );

    return array ('id'          => $this->code,
                  'module'      => $this->title,
                  'description' => $this->info,
                  'fields'      => $fields_array
                 );
  }

  public function pre_confirmation_check(): bool {
    if (isset($_POST['cod_change_bill'])) {
      // Bereinigen (Sonderzeichen entfernen)
      $bill = trim(strip_tags($_POST['cod_change_bill']));
      if (!empty($bill)) {
        $_SESSION['cod_change_bill'] = $bill;
      } else {
        unset($_SESSION['cod_change_bill']);
      }
    }
    return false;
  }

  public function confirmation(): array|false {
    global $xtPrice;
    if (isset($_SESSION['cod_change_bill']) && !empty($_SESSION['cod_change_bill'])) {
      return array(
        'title'  => MODULE_PAYMENT_CODCHANGE_DISPLAY_BILL_TEXT,
        'fields' => array(
          array('title' => MODULE_PAYMENT_CODCHANGE_DISPLAY_BILL_TEXT, 
                'field' => $xtPrice->xtcFormatCurrency($_SESSION['cod_change_bill']) . ' - ' 
                         . $xtPrice->xtcFormatCurrency($_SESSION['cart']->show_total()). ' = <strong>' 
                         . $xtPrice->xtcFormatCurrency($_SESSION['cod_change_bill'] - $_SESSION['cart']->show_total()) . '</strong>')
        )
      );
    }
    return false;
  }

  public function process_button(): string {
    global $xtPrice;
    $note = '';
    if (defined('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO') && MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO == 'True') {
      $note = sprintf(MODULE_PAYMENT_CODCHANGE_DISPLAY_NOTE_TEXT, 
                      $xtPrice->xtcFormatCurrency($_SESSION['cod_change_bill'] ?? 0), 
                      $xtPrice->xtcFormatCurrency($_SESSION['cart']->show_total()), 
                      $xtPrice->xtcFormatCurrency(($_SESSION['cod_change_bill'] ?? 0) - $_SESSION['cart']->show_total())
                     );
    }
    return $note;
  }

  public function before_process(): bool {
    global $insert_order;

    if (isset($_SESSION['cod_change_bill']) && !empty($_SESSION['cod_change_bill'])) {
      $bill_value = trim(strip_tags($_SESSION['cod_change_bill']));
      
      $insert_order['orders_change_bill'] = $bill_value;
      
      // Session aufräumen
      unset($_SESSION['cod_change_bill']);
    }
    
    return false;
  }

  public function after_process(): void {
    global $insert_id;

    if (isset($this->order_status) && $this->order_status) {
      $orders_query = xtc_db_query("SELECT orders_status 
                                      FROM ".TABLE_ORDERS." 
                                     WHERE orders_id = '".(int)$insert_id."'");
      $orders = xtc_db_fetch_array($orders_query);
      
      if ($orders && $this->order_status != $orders['orders_status']) {
        xtc_db_query("UPDATE ".TABLE_ORDERS." 
                         SET orders_status = '".$this->order_status."' 
                       WHERE orders_id = '".(int)$insert_id."'");

        $sql_data_array = array(
          'orders_id'        => (int)$insert_id,
          'orders_status_id' => $this->order_status,
          'date_added'       => 'now()',
        );
        xtc_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
      }
    }
  }

  public function get_error(): bool {
    return false;
  }

  public function check(): bool {
    if (!isset($this->_check)) {
      if (defined('MODULE_PAYMENT_CODCHANGE_STATUS') && MODULE_PAYMENT_CODCHANGE_STATUS == 'True') {
        $this->_check = true;
      } else {
        $check_query = xtc_db_query("SELECT configuration_value FROM ".TABLE_CONFIGURATION." 
                                             WHERE configuration_key = 'MODULE_PAYMENT_CODCHANGE_STATUS' 
                                               AND configuration_value = 'True'");
        $result = xtc_db_num_rows($check_query);
        if($result > 0) {
          $this->_check = true;
        } else {
          $this->_check = false;
        }
      }
    }
    return $this->_check;
  }

  public function install(): void {
    // Spalte für das Wechselgeld in der Bestell-Tabelle hinzufügen, falls sie noch nicht existiert
    $check_column = xtc_db_query("SHOW COLUMNS FROM " . TABLE_ORDERS . " LIKE 'orders_change_bill'");
    if (xtc_db_num_rows($check_column) == 0) {
      xtc_db_query("ALTER TABLE " . TABLE_ORDERS . " ADD orders_change_bill VARCHAR(32) DEFAULT NULL");
    }

    xtc_db_query("INSERT INTO ".TABLE_CONFIGURATION." (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) 
                       VALUES ('MODULE_PAYMENT_CODCHANGE_STATUS', 'True', '6', '1', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");

    xtc_db_query("INSERT INTO ".TABLE_CONFIGURATION." (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) 
                       VALUES ('MODULE_PAYMENT_CODCHANGE_ALLOWED', '', '6', '2', now())");

    xtc_db_query("INSERT INTO ".TABLE_CONFIGURATION." (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) 
                       VALUES ('MODULE_PAYMENT_CODCHANGE_ZONE', '0', '6', '3', 'xtc_get_zone_class_title', 'xtc_cfg_pull_down_zone_classes(', now())");

    xtc_db_query("INSERT INTO ".TABLE_CONFIGURATION." (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) 
                       VALUES ('MODULE_PAYMENT_CODCHANGE_SORT_ORDER', '0', '6', '4', now())");

    xtc_db_query("INSERT INTO ".TABLE_CONFIGURATION." (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, use_function, date_added) 
                       VALUES ('MODULE_PAYMENT_CODCHANGE_ORDER_STATUS_ID', '0', '6', '5', 'xtc_cfg_pull_down_order_statuses(', 'xtc_get_order_status_name', now())");

    xtc_db_query("INSERT INTO ".TABLE_CONFIGURATION." (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) 
                       VALUES ('MODULE_PAYMENT_CODCHANGE_LIMIT_ALLOWED', '600', '6', '6', now())");

    xtc_db_query("INSERT INTO ".TABLE_CONFIGURATION." (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) 
                       VALUES ('MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO', 'True', '6', '7', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
  }

  public function remove(): void {
    // Info: Um Datensicherungen bei Upgrades/Modul-Wechseln nicht zu gefährden, entfernen wir die Spalte orders_change_bill hier nicht automatisch.
    xtc_db_query("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key in ('".implode("', '", $this->keys())."')");
  }

  public function keys(): array {
    return array (
      'MODULE_PAYMENT_CODCHANGE_STATUS',
      'MODULE_PAYMENT_CODCHANGE_ALLOWED',
      'MODULE_PAYMENT_CODCHANGE_ZONE',
      'MODULE_PAYMENT_CODCHANGE_SORT_ORDER',
      'MODULE_PAYMENT_CODCHANGE_ORDER_STATUS_ID',
      'MODULE_PAYMENT_CODCHANGE_LIMIT_ALLOWED',
      'MODULE_PAYMENT_CODCHANGE_DISPLAY_INFO',
    );
  }
}
