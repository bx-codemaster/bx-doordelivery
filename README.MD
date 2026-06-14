## Modul-Zusammenfassung: Haustürlieferung & Wechselgeld-Komfort

Dieses dreiteilige Modulpaket erweitert *modified eCommerce* um eine spezialisierte Versandart für die lokale Zustellung (**Haustürlieferung**) sowie um ein intelligentes Zahlungsmanagement. Es optimiert den Checkout-Prozess für Händler, die Ware direkt zum Kunden bringen und dabei Barzahlung oder passgenaue Zahlungsweisen anbieten möchten. [Video ansehen](https://youtu.be/GpuyzdJOCKg)

---

### 1. Haustürlieferung (doordelivery.php)

* **Modul-Typ:** Versandmodul (`shipping`)
* **Funktion:** Dieses Modul stellt die Kernkomponente für den lokalen Vertrieb dar. Es fügt dem Checkout die neue Versandart **„Haustürlieferung“** hinzu. Das Modul ist bewusst schlank und performant gehalten; es übergibt die Lieferung zu einer frei definierbaren Sortierreihenfolge und ermöglicht es, den Bestellprozess für Kunden im eigenen Einzugsgebiet extrem unkompliziert zu gestalten.

### 2. Barzahlung mit Wechselgeld (codchange.php)

* **Modul-Typ:** Zahlungsmodul (`payment`)
* **Funktion:** Speziell für die Barzahlung bei Lieferung entwickelt, erweitert dieses Modul die klassische Nachnahme um ein **komfortables Wechselgeld-Eingabefeld**.
* Der Kunde kann im Checkout direkt angeben, mit welchem Summen (z. B. 50 € oder 100 €) er bezahlen wird.
* Das System validiert die Eingabe automatisch als Fließkommazahl und prüft, ob der Betrag den Warenkorbwert übersteigt.
* Auf der Bestätigungsseite und in der Bestellübersicht wird dem Fahrer sowie dem Kunden der **exakte Wechselgeldbetrag** angezeigt.
* Zur Sicherheit des Händlers lässt sich das Modul über einen konfigurierbaren Warenkorb-Höchstwert (Sicherheitslimit) automatisch ausblenden und bei der Versandart „Selbstabholung“ komplett deaktivieren.

### 3. Ausschluss von Zahlungsweisen (doordelivery_payment_unallowed.php)

* **Modul-Typ:** Checkout-Modul (`checkout`)
* **Funktion:** Dieses administrative Hilfsmodul sorgt für die reibungslose Verknüpfung der beiden oberen Module. Es prüft im Hintergrund, ob der Kunde die Versandart „Haustürlieferung“ gewählt hat. Ist das der Fall, gleicht das Modul die im Adminbereich erlaubten Zahlungsweisen ab und **filtert alle nicht gewünschten Zahlungsarten im Checkout automatisch heraus**. Dadurch wird verhindert, dass Kunden bei einer Lieferung an die Haustür fälschlicherweise Zahlungsarten wählen, die der Lieferant vor Ort nicht abbilden kann.

---

### 💡 Vorteile des Gesamtpakets 

* **Sicherheit im Fokus:** Durch die serverseitige Validierung von Benutzereingaben beim Wechselgeld sind SQL-Injections oder fehlerhafte mathematische Berechnungen im Checkout ausgeschlossen.
* **Modernisierter Code:** Alle Module wurden vollständig auf moderne PHP-Typdeklarationen migriert, laufen stabil unter PHP 8.x und sind für das Ökosystem des *Modified Module Loader Client (MMLC)* optimiert.
* **Bessere Logistik:** Fahrer wissen schon vor der Abfahrt ganz genau, wie viel Wechselgeld sie einpacken müssen.