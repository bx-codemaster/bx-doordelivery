<?php 
/**
 * Konfigurationseingabefeld für die Modulversion (read-only)
 */

if (!function_exists('xtc_cfg_doordelivery_fields')) {
  function xtc_cfg_doordelivery_fields(string $value, string $constant): string {
    $doordelivery_fields = '<div class="parent" style="display: grid; grid-template-columns: repeat(2, 1fr); grid-template-rows: repeat(1, 1fr); gap: 4px; margin-top: 10px;">' . "\n"
                         . '  <div class="calculate_netto"><label for="calculate_netto"><strong>'.MODULE_SHIPPING_DOORDELIVERY_COST_NET.'</strong></label>'.xtc_draw_input_field( 'configuration['.$constant.']', $value, 'id="calculate_netto" class="inputModule" onkeydown="if(event.key === \',\'){event.preventDefault(); this.value += \'.\';}"').'</div>' . "\n"
                         . '  <div class="calculate_brutto "><label for="calculate_brutto"><strong>'.MODULE_SHIPPING_DOORDELIVERY_COST_GROSS.'</strong></label>'.xtc_draw_input_field( 'calculate_vat', '', 'id="calculate_brutto" class="inputModule" onkeydown="if(event.key === \',\'){event.preventDefault(); this.value += \'.\';}"').'</div>' . "\n"
                         . '</div>' . "\n";
    return $doordelivery_fields;
  }
}

if (!function_exists('xtc_cfg_doordelivery_areas')) {
  function xtc_cfg_doordelivery_areas(string $value, string $constant): string {
    // SELECT `configuration_value` FROM `configuration` WHERE `configuration_key` = 'MODULE_SHIPPING_DOORDELIVERY_AREAS' LIMIT 1;
    // $value enthält den gespeicherten JSON-String, z.B. '["12345","1234*","12*"]'
    $areasArrayQuery  = xtc_db_query("SELECT `configuration_value` FROM `configuration` WHERE `configuration_key` = 'MODULE_SHIPPING_DOORDELIVERY_AREAS' LIMIT 1");
    $areasArrayResult = xtc_db_fetch_array($areasArrayQuery);
    $areasJson         = $areasArrayResult['configuration_value']; // Der gespeicherte JSON-String
    $areasArray       = json_decode($areasArrayResult['configuration_value'], false) ?? []; // In ein Array umwandeln, falls JSON korrekt ist, sonst leeres Array
    
    
    $doordelivery_areas = '<input type="hidden" name="configuration[MODULE_SHIPPING_DOORDELIVERY_AREAS]" value=\''.$areasJson.'\' id="jsonHiddenInput">'
    .'<div class="parent" style="display: grid; grid-template-columns: 1fr 2fr; grid-template-rows: auto; gap:10px; margin-top: 10px;">' . "\n"
    .'  <div class="areaInput">
          <label for="areaInput"><strong>Postleitzahl</strong></label>'
          .xtc_draw_input_field( '', '', 'id="areaInput" placeholder="Postleitzahl eingeben..." autofocus').'
          <button type="button" id="addArea">Hinzufügen</button>'
    .'  </div>' . "\n"
    .'  <div class="areaOutput">
          <strong>Liefergebiet</strong>
          <div class="collector-container">
            <ul id="areaList">'.
            implode('', array_map(function($area) {
                return '<li>' . htmlspecialchars($area) . '</li>';
            }, $areasArray)).'</ul>
          </div>
        </div>' . "\n"
    .'</div>' . "\n";
    return $doordelivery_areas;
  }
}