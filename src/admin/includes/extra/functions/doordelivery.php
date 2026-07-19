<?php
/**
 * Konfigurationseingabefeld für die Modulversion (read-only)
 */

if (!function_exists('xtc_cfg_doordelivery_areas')) {
  function xtc_cfg_doordelivery_areas(string $value, string $constant): string {
    $areasArrayQuery  = xtc_db_query("SELECT `configuration_value` FROM `configuration` WHERE `configuration_key` = 'MODULE_SHIPPING_DOORDELIVERY_AREAS' LIMIT 1");
    $areasArrayResult = xtc_db_fetch_array($areasArrayQuery);
    $areasJson        = $areasArrayResult['configuration_value']; 
    
    $doordelivery_areas = '<input type="hidden" name="configuration[MODULE_SHIPPING_DOORDELIVERY_AREAS]" value=\''.$areasJson.'\' id="jsonHiddenInput">'.PHP_EOL
    .'<div class="parent" style="display: grid; grid-template-columns: 380px 1fr; grid-template-rows: auto; gap:10px; margin-top: 10px;">'.PHP_EOL
    . '  <div class="areaInput">'.PHP_EOL
    . '  <!-- Postleitzahl bleibt über die volle Breite -->'.PHP_EOL
    . '  <div style="display: flex; gap: 10px; margin-bottom: 10px;">'.PHP_EOL
    . '    <div style="flex: 1; display: flex; flex-direction: column;">'.PHP_EOL
    . '      <label for="areaInput"><strong>'.MODULE_SHIPPING_DOORDELIVERY_ZIP_CODE_TITLE.'</strong></label>'.PHP_EOL
    . xtc_draw_input_field( '', '', 'id="areaInput" placeholder="'.MODULE_SHIPPING_DOORDELIVERY_ZIP_CODE_DESC.'" autofocus').PHP_EOL
    . '    </div>'.PHP_EOL
    . '    <div style="flex: 1; display: flex; flex-direction: column;">&nbsp;</div>'.PHP_EOL
    . '  </div>'.PHP_EOL
    . '  <!-- Reihe 1: Liefergebühr (Netto & Brutto nebeneinander) -->'.PHP_EOL
    . '  <div class="input-row" style="display: flex; gap: 10px; margin-bottom: 10px;">'.PHP_EOL
    . '  <div style="flex: 1; display: flex; flex-direction: column;">'.PHP_EOL
    . '    <label for="feeInputNetto"><strong>'.MODULE_SHIPPING_DOORDELIVERY_COST_NET.'</strong></label>'.PHP_EOL
    . xtc_draw_input_field( '', '', 'id="feeInputNetto" placeholder="'.MODULE_SHIPPING_DOORDELIVERY_COST_NET_DESC.'"').PHP_EOL
    . '  </div>'.PHP_EOL
    . '  <div style="flex: 1; display: flex; flex-direction: column;">'.PHP_EOL
    . '    <label for="feeInputBrutto"><strong>'.MODULE_SHIPPING_DOORDELIVERY_COST_GROSS.'</strong></label>'.PHP_EOL
    . xtc_draw_input_field( '', '', 'id="feeInputBrutto" placeholder="'.MODULE_SHIPPING_DOORDELIVERY_COST_GROSS_DESC.'"').PHP_EOL
    . '  </div>'.PHP_EOL
    . '</div>'.PHP_EOL
    . '  <!-- Reihe 2: Mindestbestellwert (Netto & Brutto nebeneinander) -->'.PHP_EOL
    . '  <div class="input-row" style="display: flex; gap: 10px; margin-bottom: 15px;">'.PHP_EOL
    . '    <div style="flex: 1; display: flex; flex-direction: column;">'.PHP_EOL
    . '      <label for="minimumOrderNetto"><strong>'.MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_NET.'</strong></label>'.PHP_EOL
    . xtc_draw_input_field( '', '', 'id="minimumOrderNetto" placeholder="'.MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_NET_DESC.'"').PHP_EOL
    . '    </div>'.PHP_EOL
    . '    <div style="flex: 1; display: flex; flex-direction: column;">'.PHP_EOL
    . '      <label for="minimumOrderBrutto"><strong>'.MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_GROSS.'</strong></label>'.PHP_EOL
    . xtc_draw_input_field( '', '', 'id="minimumOrderBrutto" placeholder="'.MODULE_SHIPPING_DOORDELIVERY_MINIMUM_ORDER_GROSS_DESC.'"').PHP_EOL
    . '    </div>'.PHP_EOL
    . '  </div>'.PHP_EOL
    . '  <div style="display: flex; gap: 10px; margin-bottom: 10px;">'.PHP_EOL
    . '    <div style="flex: 1; display: flex; flex-direction: column;">&nbsp;</div>'.PHP_EOL
    . '    <div style="flex: 1; display: flex; flex-direction: column;">'.PHP_EOL
    . '      <button type="button" id="addArea" style="width: 100%;">'.MODULE_SHIPPING_DOORDELIVERY_TXT_ADD.'</button>'.PHP_EOL
    . '    </div>'.PHP_EOL
    . '  </div>'.PHP_EOL
    . '</div>'.PHP_EOL
  . '  <div class="areaOutput">'.PHP_EOL
    . '    <strong>'.MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE.'</strong>'.PHP_EOL
    . '    <div class="collector-container">'.PHP_EOL
    . '      <ul id="areaList"></ul>'.PHP_EOL
    . '    </div>'.PHP_EOL
    . '  </div>'.PHP_EOL
    . '</div>'.PHP_EOL;
    return $doordelivery_areas;
  }
}