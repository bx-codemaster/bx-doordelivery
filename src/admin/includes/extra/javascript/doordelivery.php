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
document.addEventListener("DOMContentLoaded", function () {
    /* BOF Calculate NET / GROSS */
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

    }
    if (bruttotext && bruttotext.value) {
        // 3. Event für die Eingabe im zweiten Feld (Division)
        bruttotext.addEventListener('input', function () {
            let wert = parseFloat(this.value.replace(',', '.'));
            
            if (!isNaN(wert)) {
                nettotext.value = (wert / FAKTOR).toFixed(4);
            } else {
                nettotext.value = ''; // Feld leeren, wenn die Eingabe ungültig ist
            }
        });
    }
    /* EOF Calculate NET / GROSS */

    /* BOF AD ZIPS */
    const areaInput   = document.getElementById('areaInput');
    const addButton   = document.getElementById('addArea');
    const areaList    = document.getElementById('areaList');
    const hiddenInput = document.getElementById('jsonHiddenInput');

    let zipsArray = [];
    
    if (hiddenInput && hiddenInput.value) {
        try {
            // Parsen der Daten (wir wandeln z.B. '["12345","50*"]' wieder in ein echtes JS-Array um)
            zipsArray = JSON.parse(hiddenInput.value);
        } catch (e) {
            console.error("Fehler beim Parsen der initialen PLZ-Daten:", e);
            zipsArray = [];
        }
    }

    function addPostalCode() {
        const text = areaInput.value.trim();

        if (text !== "") {
            // 1. PLZ-Format prüfen (optional, je nach Anforderung)
            const result = validateEuropeanPostalCode(text, '<?php echo $customersCountryCode; ?>');
            if (!result) {
                alert("Ungültiges PLZ-Format! Bitte eine gültige PLZ aus " + '<?php echo $customersCountryName; ?>' + " eingeben.");
                return;
            }

            // 2. Visuell: Element an die HTML-Liste (ul) anhängen
            const newZip = document.createElement('li');
            newZip.textContent = text;
            areaList.appendChild(newZip);

            // 3. Daten-Ebene (NEU): Begriff in unser JavaScript-Array pushen
            zipsArray.push(text);

            // 4. JSON-Konvertierung (NEU): Array in JSON-String umwandeln
            const jsonString = JSON.stringify(zipsArray);

            // 5. Zuweisung (NEU): Den JSON-String in das Hidden-Input schreiben
            hiddenInput.value = jsonString;

            // 6. Eingabefeld leeren
            areaInput.value = "";
            areaInput.focus();
        }
    }

    function validateEuropeanPostalCode(postalCode, countryCode) {
        // Eingaben säubern (Trimmen und Ländercode in Großbuchstaben)
        countryCode = countryCode.trim().toUpperCase();
        postalCode  = postalCode.trim();

        // Regex-Katalog aller europäischen Länder
        const patterns = {
            // Europäische Union (EU)
            'AT': /^\d{4}$/,                           // Österreich
            'BE': /^\d{4}$/,                           // Belgien
            'BG': /^\d{4}$/,                           // Bulgarien
            'CY': /^\d{4}$/,                           // Zypern
            'CZ': /^\d{3}\s?\d{2}$/,                   // Tschechien (z.B. 123 45)
            'DE': /^\d{5}$/,                           // Deutschland
            'DK': /^\d{4}$/,                           // Dänemark
            'EE': /^\d{5}$/,                           // Estland
            'ES': /^\d{5}$/,                           // Spanien
            'FI': /^\d{5}$/,                           // Finnland
            'FR': /^\d{5}$/,                           // Frankreich
            'GR': /^\d{3}\s?\d{2}$/,                   // Griechenland
            'HR': /^\d{5}$/,                           // Kroatien
            'HU': /^\d{4}$/,                           // Ungarn
            'IE': /^[A-Z]\d{2}\s?[A-Z\d]{4}$/i,        // Irland (Eircode, z.B. D02 X285)
            'IT': /^\d{5}$/,                           // Italien
            'LT': /^\d{5}$/,                           // Litauen
            'LU': /^\d{4}$/,                           // Luxemburg
            'LV': /^\d{4}$/,                           // Lettland
            'MT': /^[A-Z]{3}\s?\d{4}$/i,               // Malta (z.B. VLT 1115)
            'NL': /^\d{4}\s?[A-Z]{2}$/i,               // Niederlande
            'PL': /^\d{2}-\d{3}$/,                     // Polen (z.B. 00-001)
            'PT': /^\d{4}-\d{3}$/,                     // Portugal (z.B. 1234-567)
            'RO': /^\d{6}$/,                           // Rumänien
            'SE': /^\d{3}\s?\d{2}$/,                   // Schweden
            'SI': /^\d{4}$/,                           // Slowenien
            'SK': /^\d{3}\s?\d{2}$/,                   // Slowakei

            // EFTA & Nicht-EU Westeuropa
            'CH': /^\d{4}$/,                           // Schweiz
            'IS': /^\d{3}$/,                           // Island
            'LI': /^\d{4}$/,                           // Liechtenstein
            'NO': /^\d{4}$/,                           // Norwegen
            'GB': /^[A-Z]{1,2}\d[A-Z\d]?\s?\d[A-Z]{2}$/i, // Großbritannien

            // Europäische Zwergstaaten
            'AD': /^AD\d{3}$/i,                        // Andorra (z.B. AD500)
            'MC': /^980\d{2}$/,                        // Monaco (z.B. 98000)
            'SM': /^4789\d$/,                          // San Marino (z.B. 47890)
            'VA': /^00120$/,                           // Vatikanstadt (exakt 00120)

            // Osteuropa & Balkan (Kandidaten & Weitere)
            'AL': /^\d{4}$/,                           // Albanien
            'BA': /^\d{5}$/,                           // Bosnien und Herzegowina
            'BY': /^\d{6}$/,                           // Belarus
            'MD': /^\d{4}$/,                           // Moldawien
            'ME': /^85\d{3}$/,                         // Montenegro
            'MK': /^\d{4}$/,                           // Nordmazedonien
            'RS': /^\d{5}$/,                           // Serbien
            'RU': /^\d{6}$/,                           // Russland
            'TR': /^\d{5}$/,                           // Türkei
            'UA': /^\d{5}$/,                           // Ukraine
        };

        // Prüfen, ob das Land im Katalog existiert
        if (!patterns.hasOwnProperty(countryCode)) {
            return false;
        }

        // --- WILDCARD LOGIK ---
        if (postalCode.includes('*')) {
            if (postalCode === '*') return false; 
            
            const prefix = postalCode.split('*')[0]; 
            let regexString = patterns[countryCode].source;
            
            // 1. Anker am Ende ($) entfernen
            if (regexString.endsWith('$')) {
                regexString = regexString.slice(0, -1);
            }
            
            // 2. Fixe Quantifier wie {5} zu {1,5} umwandeln, damit auch kürzere Eingaben matchen
            regexString = regexString.replace(/\{(\d+)\}/g, '{1,$1}');
            
            // 3. Optionale Strukturen am Ende für den Teilmatch erlauben
            // Erstellt eine dynamische Regex mit den originalen Flags (z.B. 'i')
            const wildcardRegex = new RegExp(regexString, patterns[countryCode].flags);
            
            return wildcardRegex.test(prefix);
        }
        // --- ENDE WILDCARD LOGIK ---

        // Validierung durchführen (Gibt true oder false zurück)
        return patterns[countryCode].test(postalCode);
    }

    addButton.addEventListener('click', addPostalCode);
    areaInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault(); // Verhindert das Absenden des Formulars
            addPostalCode();
        }
    });
    // Event-Listener für das Löschen per Klick
    areaList.addEventListener('click', (event) => {
        // Prüfen, ob wirklich auf ein LI-Element geklickt wurde
        if (event.target.tagName === 'LI') {
            const geklickterText = event.target.textContent;

            // 1. Aus dem JavaScript-Array entfernen
            // Wir suchen den Index des Textes und schneiden ihn aus dem Array
            const index = zipsArray.indexOf(geklickterText);
            if (index !== -1) {
                zipsArray.splice(index, 1);
            }

            // 2. Das HTML-Element aus der Liste löschen
            event.target.remove();

            // 3. Das Hidden-Input aktualisieren
            const jsonString = JSON.stringify(zipsArray);
            hiddenInput.value = jsonString;
        }
    });
    /* EOF AD ZIPS */
});
</script>
<?php
  }
