# Hinweise zur Implementation einer dynamischen Grafik mit dem Visualisierungsframework D3.js (im Kontext des KomDiKoLa Projekts)
Kurzbeschreibung der einzelnen Dateien und Hinweise zur Integration ins Moodle-Plugin

## script.js
Diese Datei enthält die Definition der D3.js-Grafik und sollte als Template (z.B. ``komdikola.mustache``) eingebunden werden. Das Vorgehen ist in Kapitel "Exemplarische technische Umsetzung" im Repository osa-doc beschrieben.

## style.css
Diese Datei enthält die Style-Informationen, die das Aussehen der Grafik definieren. Diese CSS-Datei muss in das Template ``viewresults.mustache`` eingebunden werden.

## Data.csv
Diese Datei enthält die Beschreibung der einzelnen Kategorien und Kompetenzbereiche für die Beschriftung der Grafik. Ebenfalls enthält sie die anzuzeigenden Ergebniswerte. Sie wird über die Funktion ``draw('Data.csv')`` integriert. Die Werte müssen für den Einsatz im Plugin statt aus der CSV aus der ``view_results.php`` kommen, die an das Template ``viewresults.mustache`` weitergeleitet werden.

## index.html
Diese Datei entspricht der Datei ``viewresults.mustache``. In der beispielhaften Visualisierung, außerhalb von Moodle, dient sie zum Aufruf der Java Script-Funktion zum Generieren der Grafik.