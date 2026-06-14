<?php 
/**
 * Javascript für die Modulversion (read-only)
 */
  defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

  if (defined('MODULE_SHIPPING_DOORDELIVERY_STATUS') && 'True' == MODULE_SHIPPING_DOORDELIVERY_STATUS && basename($_SERVER['PHP_SELF']) == 'modules.php') {
    $delivery_tax_rate = xtc_get_tax_rate('1');
?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // 1. Elemente anhand der Selektoren auswählen
    const nettotext = document.getElementById('calculate_netto');
    const bruttotext = document.getElementById('calculate_brutto');
    
    // Fester Faktor basierend auf dem Steuersatz
    const FAKTOR = 1 + (<?php echo $delivery_tax_rate; ?> / 100);

    // Hilfsfunktion: Berechnet den initialen Wert beim Laden der Seite
    if (nettotext && nettotext.value) {
        const initialNetto = parseFloat(nettotext.value.replace(',', '.'));
        if (!isNaN(initialNetto)) {
            bruttotext.value = (initialNetto * FAKTOR).toFixed(4);
        }
    }

    // 2. Event für die Eingabe im ersten Feld (Multiplikation)
    nettotext.addEventListener('input', function () {
        // Komma durch Punkt ersetzen, um Rechenfehler zu vermeiden
        let wert = parseFloat(this.value.replace(',', '.'));
        
        if (!isNaN(wert)) {
            bruttotext.value = (wert * FAKTOR).toFixed(4);
        } else {
            bruttotext.value = ''; // Feld leeren, wenn die Eingabe ungültig ist
        }
    });

    // 3. Event für die Eingabe im zweiten Feld (Division)
    bruttotext.addEventListener('input', function () {
        let wert = parseFloat(this.value.replace(',', '.'));
        
        if (!isNaN(wert)) {
            nettotext.value = (wert / FAKTOR).toFixed(4);
        } else {
            nettotext.value = ''; // Feld leeren, wenn die Eingabe ungültig ist
        }
    });
});
</script>
<?php
  }
