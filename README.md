# REGISTER
veebirakendus
Siin on I244 kodutöö rakenduse failid. 
Rakendus võimaldab registreerida kõnekeskuse pöördumisi,esitab neid nimekirjana ning võimaldab kasutajal seda nimkirja filtreerida.
Nimekirja vaates võib kasutaja märkida probleemi lahendatuks, lahendatud küsimuselt kaob ära nupp staatuse muutmise kohta.

Rakenduse piirang on see, e kuna probleemi lahendamise tähtag on kuupäev, siis näiteks kuna mozilla ja ie ei toeta kuupäevformaati, siis 
kasutaja poolt sisetatud kuupäev korrektselt salvestuda kui ta ei kasuta täpset mysqlis kasutatud kupäevaformaati. Tähtaja määramine pole
andmebaasi poolel kohustuslik väli, mistõttu ebaõigesti sisestatud kuupäev ei tekita rakenduse toimimise kontekstis viga. Viga on pigem funktsionaalne
kuna tähtaeg ei registreeru.

Filtreerimise tingimustesse on sisse kirjutatud et aktiivseid projekte kuvatakse alati kriitilisuse ning lähima tähtaja kriteeriumi võtmes.

Css stiilifaili põhiosa pärineb ühest veebinäidisest, address on viidatud css faili kommentaarides.
Rakenduse poole peal kontrollib pöördumise väljade täitmist väike javascripti programm, mis jälgib et kõik sisestusväljad oleksid täidetud.
