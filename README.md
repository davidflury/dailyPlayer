# dailyPlayer

Der *dailyPlayer* ist ein HTML5 Web Audio Player, welcher als iframe eingebettet werden kann.
Der Player sucht fürm jeden Tag die korrespondierende Audiodatei und spielt diese ab.

Damit die Datein gefunden werden können müssen sie folgenem Namensschema entsprechen:

`KWx-y_Vorname_Nachname_Tag1_...TagX.mp3`

- `KWx-x`: Kalenderwoche x (1-52) und Wochentag y (1-7)
- Name des Autors und eine beliebige Anzahl Tags

Falls der heutige Tag ein (schweizer) Feiertag ist, wird die entsprechende Datei im Order `specials` gesucht.
Folgende Feiertage werden unterstützt wobei der exakte Dateinamen beachtet werden muss:

- Sylvester 31.12. `Sylvester.mp3`
- Neujahrstag 01.01. `Neujahrstag.mp3`
- Heilige Drei Könige 06.01. `Heilige_Drei_Könige.mp3`
- Tag der Arbeit 01.05. `Tag_der_Arbeit.mp3`
- Bundesfeier (1. August) 01.08. `Bundesfeier.mp3`
- Heiliger Abend 24.12. `Heiliger_Abend.mp3`
- Weihnachtstag 25.12. `Weihnachtstag.mp3`
- Stephanstag / 2. Weihnachtstag 26.12. `Stephanstag.mp3`

Die Feiertage um Ostern werden variabel berechnet ([PHP easter-date](https://www.php.net/manual/de/function.easter-date))

- Gründonnerstag `Gründonnerstag.mp3`
- Karfreitag `Karfreitag.mp3`
- Ostersonntag `Ostersonntag.mp3`
- Ostermontag `Ostermontag.mp3`
- Auffahrt `Auffahrt.mp3`
- Pfingstsonntag `Pfingstsonntag.mp3`
- Pfingstmontag `Pfingstmontag.mp3`
