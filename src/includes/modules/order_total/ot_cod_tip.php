<?php
/* -----------------------------------------------------------------------------------------
   $Id: ot_cod_tip.php 2026-08-28 12:00:00Z benax $

   modified eCommerce Shopsoftware
   http://www.modified-shop.org

   Copyright (c) 2009 - 2013 [www.modified-shop.org]
   -----------------------------------------------------------------------------------------
   Zusatzmodul: Trinkgeld bei Nachnahme (codchange)
   -----------------------------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

/**
 * Order Total Module: Trinkgeld (COD Tip)
 *
 * Zeigt das vom Kunden im Zahlungsmodul "codchange" freiwillig angegebene
 * Trinkgeld als eigenen Posten in der Bestellübersicht/Rechnung an und
 * addiert es auf die Gesamtsumme.
 *
 * Trinkgelder sind gem. § 3 Nr. 51 EStG steuer- und sozialversicherungsfrei,
 * sofern sie freiwillig und zusätzlich von einem Dritten (Kunden) gezahlt
 * werden. Daher findet in diesem Modul bewusst KEINE Steuerberechnung statt.
 */
class ot_cod_tip {
    public string $code;
    public string $title;
    public string $description;
    public bool $enabled;
    public string $sort_order;
    public array $output;
    /** @var bool|int */
    public $_check;

    public function __construct() {
        $this->code        = 'ot_cod_tip';
        $this->title       = MODULE_ORDER_TOTAL_COD_TIP_TITLE;
        $this->description = MODULE_ORDER_TOTAL_COD_TIP_DESCRIPTION;
        $this->enabled     = (defined('MODULE_ORDER_TOTAL_COD_TIP_STATUS') && MODULE_ORDER_TOTAL_COD_TIP_STATUS === 'true');
        $this->sort_order  = defined('MODULE_ORDER_TOTAL_COD_TIP_SORT_ORDER') ? MODULE_ORDER_TOTAL_COD_TIP_SORT_ORDER : '';
        $this->output      = array();
    }

    public function process(): void {
        global $order, $xtPrice;

        if (!defined('MODULE_ORDER_TOTAL_COD_TIP_STATUS') || MODULE_ORDER_TOTAL_COD_TIP_STATUS !== 'true') {
            return;
        }

        // Trinkgeld gilt ausschließlich für die Zahlungsart "codchange"
        // (Barzahlung bei Lieferung mit Wechselgeld-/Trinkgeld-Feldern).
        if (!isset($_SESSION['payment']) || $_SESSION['payment'] !== 'codchange') {
            return;
        }

        if (!isset($_SESSION['cod_tip']) || !is_numeric($_SESSION['cod_tip'])) {
            return;
        }

        $tip = (float)$_SESSION['cod_tip'];

        if ($tip <= 0.00) {
            return;
        }

        // Bewusst keine Steuerberechnung (§ 3 Nr. 51 EStG) - der Betrag
        // wird ungemindert der Gesamtsumme hinzugerechnet.
        $order->info['total'] = (float)$order->info['total'] + $tip;

        $this->output[] = array(
            'title' => $this->title . ':',
            'text'  => $xtPrice->xtcFormat($tip, true),
            'value' => $xtPrice->xtcFormat($tip, false),
        );
    }

    public function check(): bool {
        if (!isset($this->_check)) {
            if (defined('MODULE_ORDER_TOTAL_COD_TIP_STATUS')) {
                $this->_check = true;
            } else {
                $check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_ORDER_TOTAL_COD_TIP_STATUS'");
                $this->_check = xtc_db_num_rows($check_query);
            }
        }
        return (bool)$this->_check;
    }

    public function keys(): array {
        return array(
            'MODULE_ORDER_TOTAL_COD_TIP_STATUS',
            'MODULE_ORDER_TOTAL_COD_TIP_SORT_ORDER',
        );
    }

    public function install(): void {
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) 
                      VALUES ('MODULE_ORDER_TOTAL_COD_TIP_STATUS', 'true', '6', '1', 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");

        // Standardmäßig knapp unter dem Sort-Order der Gesamtsumme (ot_total) einsortiert.
        // Bitte in Admin > Konfiguration > Bestellsummen-Module prüfen/anpassen, damit
        // dieses Modul VOR "Gesamtsumme" verarbeitet wird.
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) 
                      VALUES ('MODULE_ORDER_TOTAL_COD_TIP_SORT_ORDER', '51', '6', '2', now())");
    }

    public function remove(): void {
        xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE 'MODULE_ORDER_TOTAL_CODTIP_%'");
    }
}
