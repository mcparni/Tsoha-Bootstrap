# Urheilusovellus
Web sovellus urheilulajien ja -suoritusten tallentamiseen ja tarkasteluun 

Tämä on simppeli web-sivusto, johon voi ylläpitäjä sisäänkirjauduttuaan käydä lisäämässä, poistamassa ja muokkaamassa urheilulajeja, urheilijoita ja tuloksia. Peruskäyttäjä voi taas käydä näitä pelkästään katselemassa.

## Asennus(Linux, yleisempi ohje tulee myöhemmin):

- Kloonaa tämä repo tai lataa zippi tästä reposta ja avaa zippi koneellasi.

- Mene sisään hakemistoon ja avaa install.sh -tiedosto

- Sijoita siellä tiedostossa lainausmerkkien sisään omat tietosi näihin kohtiin:

	USERNAME="{ssh-käyttäjätunnus-tähän}"
	SERVER="{palvelimesi-osoite-tähän}"
	ROOT_FOLDER="{html-dokumenttiesi-osoite-palvelimellasi-tähän}"
	PROJECT_FOLDER="{tämän-projektin-kansionnimi-tähän}"

- Laita tarvittaessa config/database.php:ssä kredentiaalit kohdilleen, jotta voit käyttää palvelimellasi tietokantoja

- Tallenna tiedosto ja aja komento:
	bash install.sh

Sovellus on valmis käytettäväksi

## Sovellus:
Valmis sovellus löytyy osoitteesta: 
<a href="http://mcparni.users.cs.helsinki.fi/urheilusovellus" target="_blank">http://mcparni.users.cs.helsinki.fi/urheilusovellus</a>

## Linkki dokumentaatioon:
Dokumentaatio löytyy osoitteesta:
<a href="https://github.com/mcparni/urheilusovellus/blob/master/doc/dokumentaatio.pdf" target="_blank">https://github.com/mcparni/urheilusovellus/blob/master/doc/dokumentaatio.pdf</a>

## HTML-sivut
Etusivu: http://mcparni.users.cs.helsinki.fi/urheilusovellus <br/>
Urheilijat koontisivu: http://mcparni.users.cs.helsinki.fi/urheilusovellus/players <br/>
Lajien koontisiuv: http://mcparni.users.cs.helsinki.fi/urheilusovellus/sports <br/>
Tulosten koontisivu: http://mcparni.users.cs.helsinki.fi/urheilusovellus/results <br/>
Kirjautumissivu: http://mcparni.users.cs.helsinki.fi/urheilusovellus/login <br/>

## Sisäänkirjautuminen
- Ensin kirjautumissivulle: http://mcparni.users.cs.helsinki.fi/urheilusovellus/login <br/>
- Käyttäjätunnus: admintest
- Salasana: admin_23

## Muokkaukset
Tapahtuvat sisäänkirjautuneena

### Uusi urheilija
http://mcparni.users.cs.helsinki.fi/urheilusovellus/players -sivulla voi mennä lomakkeelle, jossa luodaan uusi urheilija.
### Urheilijan muokkaus
http://mcparni.users.cs.helsinki.fi/urheilusovellus/players/1 -sivulta voi poistaa kyseisen urheilijan tai mennä lomakkeelle, jossa tietoja voi editoida. Tämä edellyttää tosin että urlissa näkyvällä esimerkki-id:llä 1 löytyy urheilija.

### Uusi laji
http://mcparni.users.cs.helsinki.fi/urheilusovellus/sports -sivulla voi mennä lomakkeelle, jossa luodaan uusi laji.

### Urheilijan muokkaus
http://mcparni.users.cs.helsinki.fi/urheilusovellus/sports/1 -sivulta voi poistaa kyseisen lajin tai mennä lomakkeelle, jossa tietoja voi editoida. Tämä edellyttää tosin että urlissa näkyvällä esimerkki-id:llä 1 löytyy laji.

### Uusi tulos tai tuloksen muokkaus
http://mcparni.users.cs.helsinki.fi/urheilusovellus/results -sivulla voi poistaa tai mennä lomakkeelle, jossa luodaan uusi tulos tai mennä lomakkeelle jossa tulosta voi muokata.

### Pääkäyttäjätietojen muutos
Sisäänkirjauduttuaan menemällä päänavigaatiosta "Muokkaa tietojasi" -linkistä, pääset muokkaamaan käyttäjätunnusta tai salasanaa

## Uloskirjautuminen
Päänavigaatiossa on linkki "Kirjaudu ulos" mikäli on kirjautuneena sisään. Sitä klikkaamalla kirjaudutaan ulos.

