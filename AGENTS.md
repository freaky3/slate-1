# Onlinefact API Slate richtlijnen

Deze repository bevat de bron van de API-documentatie voor `https://api.onlinefact.be`.

## Bronstructuur

- Hoofdnavigatie en include-volgorde: `source/index.html.md`
- Inhoud per domein: `source/includes/_*.md`
- Gegenereerde output: `build/index.html`

## Synchronisatie met API-code (verplicht)

Bij elke wijziging in `C:\Sources\api_onlinefact` die impact heeft op API-contracten, moet Slate onmiddellijk mee aangepast worden.

Onder API-contracten vallen:
- endpoint routes en HTTP-methodes
- query/body parameters
- response velden en types
- foutresponses en validaties

## Werkwijze

1. Zoek de endpoint-implementatie in `api_onlinefact` (typisch `api2/**/*.php`).
2. Zoek of maak de overeenkomstige sectie in `source/includes/_*.md`.
3. Werk voorbeeldrequest(s), URL, parameter-tabellen en response JSON bij.
4. Controleer of de include-file in `source/index.html.md` staat.
5. Bevestig dat docs exact hetzelfde pad/methode gebruiken als code.

## Kwaliteitsregels

- Geen API codewijziging zonder docs-update.
- Geen nieuwe endpoint in code zonder sectie in Slate.
- Geen pad-typo's in URL's.
- Houd voorbeelden realistisch en consistent met actuele payloads.
