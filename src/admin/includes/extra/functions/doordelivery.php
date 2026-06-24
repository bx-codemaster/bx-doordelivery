<?php
/**
 * Konfigurationseingabefeld für die Modulversion (read-only)
 */

if (!function_exists('xtc_cfg_doordelivery_areas')) {
  function xtc_cfg_doordelivery_areas(string $value, string $constant): string {
    $areasArrayQuery  = xtc_db_query("SELECT `configuration_value` FROM `configuration` WHERE `configuration_key` = 'MODULE_SHIPPING_DOORDELIVERY_AREAS' LIMIT 1");
    $areasArrayResult = xtc_db_fetch_array($areasArrayQuery);
    $areasJson        = $areasArrayResult['configuration_value']; 
    
    $doordelivery_areas = '<input type="hidden" name="configuration[MODULE_SHIPPING_DOORDELIVERY_AREAS]" value=\''.$areasJson.'\' id="jsonHiddenInput">'
    .'<div class="parent" style="display: grid; grid-template-columns: 1fr 2fr; grid-template-rows: auto; gap:10px; margin-top: 10px;">' . "\n"
    .'  <div class="areaInput">
          <label for="areaInput"><strong>'.MODULE_SHIPPING_DOORDELIVERY_ZIP_CODE_TITLE.'</strong></label>'
          .xtc_draw_input_field( '', '', 'id="areaInput" placeholder="'.MODULE_SHIPPING_DOORDELIVERY_ZIP_CODE_DESC.'" autofocus').'

          <label for="feeInputNetto"><strong>'.MODULE_SHIPPING_DOORDELIVERY_COST_NET.'</strong></label>'
          .xtc_draw_input_field( '', '', 'id="feeInputNetto" placeholder="'.MODULE_SHIPPING_DOORDELIVERY_COST_NET_DESC.'"').'

          <label for="feeInputBrutto"><strong>'.MODULE_SHIPPING_DOORDELIVERY_COST_GROSS.'</strong></label>'
          .xtc_draw_input_field( '', '', 'id="feeInputBrutto" placeholder="'.MODULE_SHIPPING_DOORDELIVERY_COST_GROSS_DESC.'"').'
          
          <button type="button" id="addArea">'.MODULE_SHIPPING_DOORDELIVERY_TXT_ADD.'</button>'
    .'  </div>' . "\n"
    .'  <div class="areaOutput">
          <strong>'.MODULE_SHIPPING_DOORDELIVERY_AREAS_TITLE.'</strong>
          <div class="collector-container">
            <ul id="areaList"></ul>
          </div>
        </div>' . "\n"
    .'</div>' . "\n";
    return $doordelivery_areas;
  }
}