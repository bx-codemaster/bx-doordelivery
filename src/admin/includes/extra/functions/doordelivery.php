<?php 
/**
 * Konfigurationseingabefeld für die Modulversion (read-only)
 */

if (!function_exists('xtc_cfg_doordelivery_fields')) {
  function xtc_cfg_doordelivery_fields(string $value, string $constant): string {
    $doordelivery_fields = '<div class="parent" style="display: grid; grid-template-columns: repeat(2, 1fr); grid-template-rows: repeat(1, 1fr); gap: 4px; margin-top: 10px;">' . "\n"
                         . '  <div class="div1"><label for="calculate_netto"><strong>'.MODULE_SHIPPING_DOORDELIVERY_COST_NET.'</strong></label>'.xtc_draw_input_field( 'configuration['.$constant.']', $value, 'id="calculate_netto" class="inputModule" onkeydown="if(event.key === \',\'){event.preventDefault(); this.value += \'.\';}"').'</div>' . "\n"
                         . '  <div class="div2"><label for="calculate_brutto"><strong>'.MODULE_SHIPPING_DOORDELIVERY_COST_GROSS.'</strong></label>'.xtc_draw_input_field( 'calculate_vat', '', 'id="calculate_brutto" class="inputModule" onkeydown="if(event.key === \',\'){event.preventDefault(); this.value += \'.\';}"').'</div>' . "\n"
                         . '</div>' . "\n";
    return $doordelivery_fields;
  }
}