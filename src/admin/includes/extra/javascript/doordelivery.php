<?php 
/**
 * Javascript für die Modulversion (read-only)
 */
  defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

  if (defined('MODULE_SHIPPING_DOORDELIVERY_STATUS') && 'True' == MODULE_SHIPPING_DOORDELIVERY_STATUS && basename($_SERVER['PHP_SELF']) == 'modules.php') {
    $delivery_tax_rate    = xtc_get_tax_rate('1');
    $customersCountryCode = strtoupper($_SESSION['language_code']) ?? 'DE'; // Fallback auf 'DE', wenn kein Land gesetzt ist
    
    $country_query = xtDBquery("SELECT countries_name
                            FROM ".TABLE_COUNTRIES."
                            WHERE countries_iso_code_2 = '".(string)$customersCountryCode."'");
    if (xtc_db_num_rows($country_query, true) > 0) {
        $country = xtc_db_fetch_array($country_query, true);
        $customersCountryName = $country['countries_name'] ?? 'Germany';
    }
?>
<script>
(function() {
    function initDoorDelivery() {
        /* BOF Calculate NET / GROSS */
        const nettotext  = document.getElementById('feeInputNetto');
        const bruttotext = document.getElementById('feeInputBrutto');
        
        // Fester Faktor basierend auf dem Steuersatz
        const FAKTOR = 1 + (<?php echo (float)$delivery_tax_rate; ?> / 100);
        
        if (nettotext && bruttotext) {
            // Initialen Wert berechnen, falls Netto vorhanden ist
            if (nettotext.value && !isNaN(parseFloat(nettotext.value.replace(',', '.')))) {
                const initialNetto = parseFloat(nettotext.value.replace(',', '.'));
                bruttotext.value = (initialNetto * FAKTOR).toFixed(4);
            }

            // Event für Netto-Eingabe (Berechnet Brutto)
            nettotext.addEventListener('input', function () {
                let wert = parseFloat(this.value.replace(',', '.'));
                if (!isNaN(wert)) {
                    bruttotext.value = (wert * FAKTOR).toFixed(4);
                } else {
                    bruttotext.value = '';
                }
            });

            // Event für Brutto-Eingabe (Berechnet Netto)
            bruttotext.addEventListener('input', function () {
                let wert = parseFloat(this.value.replace(',', '.'));
                if (!isNaN(wert)) {
                    nettotext.value = (wert / FAKTOR).toFixed(4);
                } else {
                    nettotext.value = '';
                }
            });
        }
        /* EOF Calculate NET / GROSS */

        /* BOF AD ZIPS */
        const areaInput   = document.getElementById('areaInput');
        const feeInput    = document.getElementById('feeInputNetto'); 
        const addButton   = document.getElementById('addArea');
        const areaList    = document.getElementById('areaList');
        const hiddenInput = document.getElementById('jsonHiddenInput');

        if (!hiddenInput) return; // Falls das Modul nicht aktiv gerendert ist, hier abbrechen

        let zipsArray = [];
        
        function renderListItem(zip, fee) {
            if (!areaList) return;
            const newZip = document.createElement('li');
            newZip.innerHTML = `<strong>${zip}</strong> - Gebühr: ${parseFloat(fee).toFixed(2)} € <span style="color:red; cursor:pointer; margin-left:10px; font-weight:bold;">[X]</span>`;
            newZip.setAttribute('data-zip', zip); 
            newZip.setAttribute('data-fee', fee); 
            areaList.appendChild(newZip);
        }

        // JSON einlesen und Liste initial aufbauen
        if (hiddenInput.value) {
            try {
                zipsArray = JSON.parse(hiddenInput.value);
                if (Array.isArray(zipsArray)) {
                    areaList.innerHTML = ''; // Liste leeren gegen Doppel-Rendering
                    zipsArray.forEach(item => {
                        if (typeof item === 'object' && item !== null) {
                            renderListItem(item.zip, item.fee);
                        } else {
                            renderListItem(item, "0.00");
                        }
                    });
                }
            } catch (e) {
                console.error("Fehler beim Parsen der initialen PLZ-Daten:", e);
                zipsArray = [];
            }
        }

        function addPostalCode() {
            if (!areaInput || !feeInput) return;

            const text = areaInput.value.trim();
            let fee  = feeInput.value.trim().replace(',', '.'); 

            if (fee === "") {
                fee = "0.00";
            }

            if (text !== "") {
                const result = validateEuropeanPostalCode(text, '<?php echo $customersCountryCode; ?>');
                
                if (!result) {
                    alert("Ungültiges PLZ-Format! Bitte eine gültige PLZ aus " + '<?php echo $customersCountryName; ?>' + " eingeben.");
                    return;
                }
                
                if (isNaN(parseFloat(fee)) || parseFloat(fee) < 0) {
                    alert("Bitte eine gültige Gebühr eingeben (z.B. 4.50 oder 0 für kostenlos).");
                    return;
                }

                const exists = zipsArray.some(item => typeof item === 'object' && item !== null ? item.zip === text : item === text);
                if (exists) {
                    alert("Diese PLZ oder dieser Bereich existiert bereits in der Liste.");
                    return;
                }

                fee = parseFloat(fee).toFixed(2);
                renderListItem(text, fee);

                zipsArray.push({ zip: text, fee: fee });
                hiddenInput.value = JSON.stringify(zipsArray);

                areaInput.value = "";
                feeInput.value = "";
                if(bruttotext) bruttotext.value = "";
                areaInput.focus();
            }
        }

        function validateEuropeanPostalCode(postalCode, countryCode) {
            countryCode = countryCode.trim().toUpperCase();
            postalCode  = postalCode.trim();

            const patterns = {
                'AT': /^\d{4}$/,'BE': /^\d{4}$/,'BG': /^\d{4}$/,'CY': /^\d{4}$/,'CZ': /^\d{3}\s?\d{2}$/,'DE': /^\d{5}$/,'DK': /^\d{4}$/,'EE': /^\d{5}$/,'ES': /^\d{5}$/,'FI': /^\d{5}$/,'FR': /^\d{5}$/,'GR': /^\d{3}\s?\d{2}$/,'HR': /^\d{5}$/,'HU': /^\d{4}$/,'IE': /^[A-Z]\d{2}\s?[A-Z\d]{4}$/i,'IT': /^\d{5}$/,'LT': /^\d{5}$/,'LU': /^\d{4}$/,'LV': /^\d{4}$/,'MT': /^[A-Z]{3}\s?\d{4}$/i,'NL': /^\d{4}\s?[A-Z]{2}$/i,'PL': /^\d{2}-\d{3}$/,'PT': /^\d{4}-\d{3}$/,'RO': /^\d{6}$/,'SE': /^\d{3}\s?\d{2}$/,'SI': /^\d{4}$/,'SK': /^\d{3}\s?\d{2}$/,'CH': /^\d{4}$/,'IS': /^\d{3}$/,'LI': /^\d{4}$/,'NO': /^\d{4}$/,'GB': /^[A-Z]{1,2}\d[A-Z\d]?\s?\d[A-Z]{2}$/i,'AD': /^AD\d{3}$/i,'MC': /^980\d{2}$/,'SM': /^4789\d$/,'VA': /^00120$/,'AL': /^\d{4}$/,'BA': /^\d{5}$/,'BY': /^\d{6}$/,'MD': /^\d{4}$/,'ME': /^85\d{3}$/,'MK': /^\d{4}$/,'RS': /^\d{5}$/,'RU': /^\d{6}$/,'TR': /^\d{5}$/,'UA': /^\d{5}$/
            };

            if (!patterns.hasOwnProperty(countryCode)) return false;

            if (postalCode.includes('*')) {
                if (postalCode === '*') return false; 
                const prefix = postalCode.split('*')[0]; 
                let regexString = patterns[countryCode].source;
                if (regexString.endsWith('$')) {
                    regexString = regexString.slice(0, -1);
                }
                regexString = regexString.replace(/\{(\d+)\}/g, '{1,$1}');
                const wildcardRegex = new RegExp(regexString, patterns[countryCode].flags);
                return wildcardRegex.test(prefix);
            }

            return patterns[countryCode].test(postalCode);
        }

        if (addButton && areaInput) {
            addButton.addEventListener('click', addPostalCode);
            
            [areaInput, feeInput, bruttotext].forEach(input => {
                if (input) { 
                    input.addEventListener('keypress', (event) => {
                        if (event.key === 'Enter') {
                            event.preventDefault();
                            addPostalCode();
                        }
                    });
                }
            });
        }

        if (areaList) {
            areaList.addEventListener('click', (event) => {
                const liElement = event.target.closest('li');
                if (liElement) {
                    const zipToDelete = liElement.getAttribute('data-zip');
                    zipsArray = zipsArray.filter(item => typeof item === 'object' && item !== null ? item.zip !== zipToDelete : item !== zipToDelete);
                    liElement.remove();
                    hiddenInput.value = JSON.stringify(zipsArray);
                }
            });
        }
        /* EOF AD ZIPS WITH FEES */
    }

    // Sicherstellen, dass das Skript läuft, egal wann es geladen wird
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initDoorDelivery);
    } else {
        initDoorDelivery();
    }
})();
</script>
<?php
  }
