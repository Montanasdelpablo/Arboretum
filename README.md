# Arboretum Eenrum

## Inhoud

- [Software](#software)
- [Server](#server)
- [Frameworks](#frameworks)
- [Installatie](#installatie)
- [API](#api)

## Software<a name="software"></a>
Voor het maken van de API is de volgende software gebruikt:

- IDE/ text editor zoals: [Atom](https://atom.io/), [VSCode](https://code.visualstudio.com/) of [PHPStorm](https://www.jetbrains.com/phpstorm/)
- [Git](https://git-scm.com/) (Versie beheer)
- [Composer](https://getcomposer.org/) (PHP package manager)
- [NodeJS](https://nodejs.org/en/)
- [NPM](https://www.npmjs.com/) (JS package manager)
- [FileZilla](https://filezilla-project.org/) (ftp bestanden uploaden) of vergelijkbaar.

## Server<a name="server"></a>
Voor de installatie is het nodig dat de server waar de API op draait aan een aantal eisen voldoet.
De eisen voor de server staan [hier](https://laravel.com/docs/5.6#server-requirements) beschreven.

- [MySQL](https://www.mysql.com/) Dit **moet** op de server staan
- [phpMyAdmin](https://www.phpmyadmin.net/) Dit staat waarschijnlijk ook op de server

Of de server hier aan voldoet kun je navragen bij je hosting provider.

## Frameworks<a name="frameworks"></a>
De gebruikte frameworks voor dit project zijn de volgende:

- [Laravel](https://laravel.com/)
- [VueJS](https://vuejs.org/)
- [Vuetify](https://vuetifyjs.com/en/)

## Installatie<a name="installatie"></a>
Voor dat je met de installatie begint zorg ervoor dat je alle programma's hebt geinstalleerd die bij [software](#software) staan.
Zorg er daarnaast voor dat je server aan de eisen voldoet die bij [server](#server) worden genoemd.

*Wanneer over een command wordt gesproken gaan we ervan uit dat een command word uitgevoerd in de map waarin alle bestanden (komen te) staan.*

Download of clone vervolgens alle bestanden van de [repository](https://github.com/Montanasdelpablo/Arboretum). Of gebruik het volgende command: `git clone https://github.com/Montanasdelpablo/Arboretum`

### Laravel

1. Kopieer alles van de het `.env.example` bestand naar een nieuw bestand en noem dit bestand `.env`. Of gebruik het volgende command: `mv .env.example .env`
2. Run command: `composer install` om alle benodigde PHP pakketten te installeren.
3. Run command: `npm install` om alle JS pakketten te installeren. Je zou nu een extra map moeten zien genaamd `node_modules`.
4. Run command: `php artisan key:generate`. Je zou nu in het `.env` bestand bij `APP_KEY` tekst moeten zien (vergelijkbaar met: base64:K4Un5HYHrU2JiS+WHOWQ4WziUaVOzi0V1rPtrD6TQno+).
5. In `.env` kun je `APP_URL` wijzigen naar de url waar de API komt te staan.
6. Bij de hosting in phpMyAdmin (of vergelijkbaar) maak een nieuwe database aan.
7. In `.env` moet je vervolgens de gegevens voor de database invullen. Dit zijn de alle waarden waar `DB_` voor staat **behalve** `DB_CONNECTION`. Voor het testen van de API zullen dit andere gegevens zijn dan wanneer de API online staat bij de hosting.
8. Run command: `php artisan config:clear`.
9. Run command: `php artisan config:cache`.

Stap 8 en 9 zijn altijd nodig wanneer je gegevens wijzigd in het `.env` bestand.

### FTP

Voor het online zetten/ uploaden van de API zijn er nog een aantal extra stappen nodig. Als eerste ben je een ftp programma nodig zoals bij [software](#software) wordt genoemd.

1. Maak vervolgens verbinding met de hosting.
2. Ga naar de map waar je de API wil uploaden.
3. Maak hier een nieuwe map aan voor `laravel` en `public`.
4. Kopieer het volledige path van de net aangemaakt map `laravel`.
5. Open het bestand `config.php` in `bootstrap` > `cache`.
6. Wijzig alle paths die in dit bestand staan van bijvoorbeeld `C:\\xampp\\htdocs\\Arboretum\\storage\\framework/sessions` naar het `gekopieerde path` + `/framework/sessions`. Zorg er wel voor dat er overal maar **1** `/` staat.    
7. Upload vervolgens de volgende mappen en bestanden naar de map `laravel`: <alle mappen en bestaden>.
8. Upload de inhoud van de map `public` naar de map `public` op de server.

## API<a name="api"></a>

Voor de RESTFUL API zijn er de onderstaande routes.
Voor elke route wordt beschreven wat de route verwacht te krijgen en wat je terug krijgt.

Voor alle routes gaan we ervan uit dat deze de volgende prefix heeft: `voorbeeld.nl/api/`. Waar `voorbeeld.nl` vervangen dient te worden door hosting url.

Alle routes verwachten in ieder geval de volgende headers:

	X-Requested-With: XMLHttpRequest
	X-CSRF-token: window.token //optioneel
	Content-Type: application/json
	Accept: application/json

Van alle `post`, `put`, `delete` routes krijg je de volgende resultaten terug:

    success: (boolean) true of false afhankelijk van of een actie geslaagd is ja of nee
    message: (string) Bericht over de actie zoals "Color has been added" of "Color has not been added"
    result: (array) Wanneer een actie geslaagd zoals store of update is geslaagd krijg je verstuurde waardes terug in een array

<Laravel error voorbeeld toevoegen>

### Kleuren

	url: colors
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: colors
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: colors/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde item

	url: colors/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde item

	url: colors/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: colors/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: colors/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Kruisingen

	url: crossings
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle items

	url: crossings
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: crossings/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde item

	url: crossings/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde item

	url: crossings/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: crossings/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: crossings/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Groepen

	url: groups
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: groups
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: groups/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: groups/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: groups/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: groups/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: groups/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Maanden

	url: months
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle items

	url: months
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: months/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: months/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: months/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: months/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: months/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Planten

	url: plants
    method: get
    return: (json) alle items

    url: plants
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: plants/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: plants/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: plants/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: plants/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: plants/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Prioriteit

	url: priorities
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: priorities
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: priorities/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: priorities/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: priorities/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: priorities/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: priorities/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Geslachten

	url: sexes
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: sexes
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: sexes/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: sexes/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: sexes/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: sexes/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: sexes/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Groottes

	url: sizes
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: sizes
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: sizes/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: sizes/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: sizes/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: sizes/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: sizes/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Soorten

	url: species
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: species
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: species/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: species/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: species/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: species/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: species/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Leveranciers

	url: suppliers
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: suppliers
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: suppliers/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: suppliers/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: suppliers/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: suppliers/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: suppliers/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Synonym

	url: synonyms
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: synonyms
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: synonyms/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: synonyms/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: synonyms/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: synonyms/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: synonyms/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Boomtype

	url: treetypes
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: treetypes
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: treetypes/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: treetypes/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: treetypes/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: treetypes/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: treetypes/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Types

	url: types
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: types
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: types/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: types/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: types/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: types/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: types/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Varieteiten

	url: varieties
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: varieties
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: varieties/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: varieties/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: varieties/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: varieties/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: varieties/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item

### Winners

	url: winners
    method: get
    extra header: Authorization: 'Bearer <api_token>'
    return: (json) alle items

    url: winners
	method: post
	body: name (string)
	extra header: Authorization: 'Bearer <api_token>'

	url: winners/{id}
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: winners/{id}/edit
	id: integer
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data gespecificeerde kleur

	url: winners/{id}
	id: integer
	method: put
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) geupdate data

	url: winners/{search}/search
	search: integer(id)/ string
	method: get
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) alle resultaten die overeen komen met de zoek opdracht

	url: winners/{id}
	id: integer
	method: delete
	extra header: Authorization: 'Bearer <api_token>'
	return: (json) data verwijderde item
