<?php 
  defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

  if (defined('MODULE_SHIPPING_DOORDELIVERY_STATUS') && 'True' == MODULE_SHIPPING_DOORDELIVERY_STATUS && basename($_SERVER['PHP_SELF']) == 'modules.php') {
?>
<style>
.collector-container {
  display: block;
  border: 1px solid #ced4da; /* Moderneres, weicheres Grau */
  background-color: #f8f9fa; /* Hellerer, cleanerer Hintergrund */
  border-radius: 6px;
  min-height: 38px;          /* Etwas höher, damit es wie ein Eingabefeld wirkt */
  padding: 8px 12px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.05); /* Leichte Tiefe nach innen */
}

/* Entfernt die typischen Listenpunkte und sorgt für ein flexibles Layout */
#areaList {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-wrap: wrap; /* Lässt die Tags in die nächste Zeile springen, wenn der Platz fehlt */
  gap: 6px;        /* Abstand zwischen den Tags */
}

/* Styling für die einzelnen Begriffe (Tags) */
#areaList li {
  background-color: #e9ecef; /* Sanfter Grauton für den Badge */
  color: #495057;            /* Dunkelgrauer Text für guten Kontrast */
  padding: 4px 10px;
  border-radius: 4px;
  font-family: monospace;    /* Macht PLZs/Wildcards oft lesbarer */
  font-size: 0.9rem;
  border: 1px solid #dee2e6;
  display: inline-flex;
  align-items: center;
  cursor: pointer;           /* Ändert den Mauszeiger in die bekannte "Klick-Hand" */
  transition: all 0.2s ease; /* Macht den Farbübergang beim Hovern schön geschmeidig */
}

/* Der Hover-Effekt: Wird aktiv, sobald die Maus über das Element fährt */
#areaList li:hover {
  background-color: #f8d7da; /* Ein dezentes, helles Rot */
  color: #721c24;            /* Dunkelroter Text für perfekten Kontrast */
  border-color: #f5c6cb;     /* Ein passender, rötlicher Rahmen */
}


div.parent div.areaInput div div label {
  font-size: 9px;
  color: #495057; /* Dunkelgrau für bessere Lesbarkeit */
}
</style>
<?php 
  }
