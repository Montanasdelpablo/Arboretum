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
- [FileZilla](https://filezilla-project.org/) of vergelijkbaar (ftp bestanden uploaden).

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
10. Wanneer je klaar bent met testen moet je in `.env`, `APP_DEBUG` op false zetten, het command `npm run prod1` uitvoeren en stap 8 en 9 opnieuw uitvoeren.
11. Je kunt nu alles online zetten.

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
	X-CSRF-token: //optioneel
	Content-Type: application/json
	Accept: application/json

**Note** Alle resultaten die onder return staan zijn alleen als voorbeeld bedoeld. De daadwerkelijke return kan dus afwijken.

### Kleuren

- url: colors
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:
 
		[
			{
				"id": 1,
				"name": "Geel",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"bloom_colors_count": 82,
				"macule_colors_count": 55
			}
		]
	
		
---

- url: colors
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

			{
				"success": true,
				"message": "Color created",
				"result": {
					"name": "Voorbeeld",
					"created_at": "2018-06-11 07:42:08",
					"updated_at": "2018-06-11 07:42:08",
					"id": 78
				}
			}
    
	- error:
    
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}

			
---

- url: colors/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"id": 1,
			"name": "Geel",
			"created_at": "2018-06-01 12:05:35",
			"updated_at": "2018-06-01 12:05:35"
		}
	
		
---

- url: colors/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"id": 1,
			"name": "Geel",
			"created_at": "2018-06-01 12:05:35",
			"updated_at": "2018-06-01 12:05:35"
		}
		
				
---

- url: colors/{id}
- id: integer
- method: put
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Color updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
	
			
---

- url: colors/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 1,
				"name": "Geel",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			{
				"id": 21,
				"name": "Geelgroen",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		]

		
---

- url: colors/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"success": true,
			"message": "Color deleted",
			"result": {
				"id": 78,
				"name": "Voorbeelds",
				"created_at": "2018-06-11 07:42:08",
				"updated_at": "2018-06-11 07:46:33"
			}
		}

### Kruisingen

- url: crossings
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 1,
				"name": "'Conestoga' x ?",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"plant_count": 1
			}
		]
	
		
---

- url: crossings
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

			{
				"success": true,
				"message": "Crossing created",
				"result": {
					"name": "Voorbeeld",
					"created_at": "2018-06-11 07:50:58",
					"updated_at": "2018-06-11 07:50:58",
					"id": 24
				}
			}
    
   - error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
	
			
---

- url: crossings/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:
 
		{
			"id": 24,
			"name": "Voorbeeld",
			"created_at": "2018-06-11 07:50:58",
			"updated_at": "2018-06-11 07:50:58"
		}
	
		
---

- url: crossings/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"id": 24,
			"name": "Voorbeeld",
			"created_at": "2018-06-11 07:50:58",
			"updated_at": "2018-06-11 07:50:58"
		}
			
		
---

- url: crossings/{id}	

- id: integer
- method: put  
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:
	- success:
	
			{
				"success": true,
				"message": "Crossing updated",
				"result": true
			}
    
   - error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			} 	

		
---

- url: crossings/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		[
			{
				"id": 2,
				"name": "Red. catawbiense x 'Cunningham's White'",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			{
				"id": 19,
				"name": "R mucronulatum x R. dauricum",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		]
	
		
---

- url: crossings/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"success": true,
			"message": "Crossing deleted",
			"result": {
				"id": 24,
				"name": "Voorbeelds",
				"created_at": "2018-06-11 07:50:58",
				"updated_at": "2018-06-11 07:55:20"
			}
		}

### Groepen

- url: groups
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:
 
		[
			{
				"id": 1,
				"name": "Groep Thomsonii",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"plant_count": 4
			}
		]	
		
		
---

- url: groups
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

			{
				"success": true,
				"message": "Group created",
				"result": {
					"name": "Voorbeeld",
					"created_at": "2018-06-11 07:50:58",
					"updated_at": "2018-06-11 07:50:58",
					"id": 24
				}
			}
	
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
        	
		
---

- url: groups/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"id": 78,
			"name": "Voorbeeld",
			"created_at": "2018-06-11 08:43:46",
			"updated_at": "2018-06-11 08:43:46"
		}
    	
		
---

- url: groups/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"id": 78,
			"name": "Voorbeeld",
			"created_at": "2018-06-11 08:43:46",
			"updated_at": "2018-06-11 08:43:46"
		}
        	
		
---

- url: groups/{id}
- id: integer
- method: put   
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Group updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
     	
		
---

- url: groups/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 30,
				"name": "boom",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			{
				"id": 71,
				"name": "wilde soort",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		]
       	
		
---

- url: groups/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"success": true,
			"message": "Group deleted",
			"result": {
				"id": 78,
				"name": "Voorbeelds",
				"created_at": "2018-06-11 08:43:46",
				"updated_at": "2018-06-11 08:45:03"
			}
		}

### Maanden

- url: months
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:
 
		[
			{
				"id": 1,
				"name": "Mei",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"plants_count": 499
			}
		]
        	
		
---

- url: months
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

			{
				"success": true,
				"message": "Month created",
				"result": {
					"name": "Voorbeeld",
					"created_at": "2018-06-11 07:50:58",
					"updated_at": "2018-06-11 07:50:58",
					"id": 24
				}
			}
        
	- error:

			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
         	
		
---

- url: months/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"id": 14,
			"name": "Voorbeeld",
			"created_at": "2018-06-11 08:50:06",
			"updated_at": "2018-06-11 08:50:06"
		}
      	
		
---

- url: months/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"id": 14,
			"name": "Voorbeeld",
			"created_at": "2018-06-11 08:50:06",
			"updated_at": "2018-06-11 08:50:06"
		}
    	
		
---

- url: months/{id}
- id: integer
- method: put     
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Month updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
       	
		
---

- url: months/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 1,
				"name": "Mei",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		]
     	
		
---

- url: months/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"success": true,
			"message": "Month deleted",
			"result": {
				"id": 14,
				"name": "Voorbeeld",
				"created_at": "2018-06-11 08:50:06",
				"updated_at": "2018-06-11 08:50:06"
			}
		}

### Planten

- url: plants
- method: get
- return: 

		[
			{
				"id": 1,
				"latin_name": "Rhododendron litiense ",
				"follow_number": 14,
				"purchase_number": 1221,
				"control": "2003-04-28",
				"place": "J11d",
				"latitude": "918",
				"longitude": "1053",
				"replant": 0,
				"moved": null,
				"dead": 0,
				"planted": "1984-05-22",
				"note": " ",
				"description": null,
				"image": null,
				"name_id": 1,
				"type_id": 1,
				"sex_id": 1,
				"specie_id": 1,
				"subspecie_id": null,
				"group_id": 1,
				"synonym_id": 1,
				"crossing_id": null,
				"winner_id": null,
				"treetype_id": 1,
				"priority_id": 1,
				"supplier_id": 1,
				"size_id": null,
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"name": {
					"id": 1,
					"name": "wilde soort",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"bloom_colors": [
					{
						"id": 1,
						"name": "Geel",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 1,
							"color_id": 1
						}
					}
				],
				"macule_colors": [],
				"crossing": null,
				"group": {
					"id": 1,
					"name": "Groep Thomsonii",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"months": [
					{
						"id": 1,
						"name": "Mei",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 1,
							"month_id": 1
						}
					},
					{
						"id": 2,
						"name": "Juni",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 1,
							"month_id": 2
						}
					}
				],
				"priority": {
					"id": 1,
					"name": "2",
					"color": "#0080c0",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-04 14:42:14"
				},
				"sex": {
					"id": 1,
					"name": "Rhododendron",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"size": null,
				"specie": {
					"id": 1,
					"name": "litiense",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"supplier": {
					"id": 1,
					"name": "Jørgensen",
					"street": null,
					"number": null,
					"addition": null,
					"zip_code": null,
					"city": null,
					"phone_number": null,
					"website": null,
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"synonym": {
					"id": 1,
					"name": "R wardii var wardii Litiense Group",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"treetype": {
					"id": 1,
					"name": "Rhododendron",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"type": {
					"id": 1,
					"name": "Rhodo",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"subspecie": null,
				"winner": null
			}
		]
        	
		
---

- url: plants
- method: post
- body: name_id (nullable|integer|exists:names,id), follow_number (integer|unique), purchase_number (integer|unique), control (nullable|string|date), place (string), latitude (string), longitude (string), replant (nullable|boolean), moved (nullable|string|date), dead (nullable|boolean), planted (nullable|string|date), note (nullable|string), description (nullable|string), image (nullable) // base64 image, type_id (nullable|integer|exists:types,id), sex_id (nullable|integer|exists:sexes,id), specie_id (nullable|integer|exists:species,id), subspecie_id (nullable|integer|exists:subspecies,id), group_id (nullable|integer|exists:groups,id), synonym_id (nullable|integer|exists:synonyms,id), crossing_id (nullable|integer|exists:crossings,id), winner_id (nullable|integer|exists:winners,id), treetype_id (nullable|integer|exists:treetypes,id), priority_id (nullable|integer|exists:priorities,id), supplier_id (nullable|integer|exists:suppliers,id), size_id (nullable|integer|exists:sizes,id), bloom_colors (nullable|array) // array of color ids, months (nullable|array) // array of month ids, macule_colors (nullable|array) // array of color ids
- extra header: `Authorization: Bearer <api_token>`
- return 
	- success:
		
			{
                "success": true,
                "message": "Plant created",
                "result": {
                    "latin_name": "Rhododendron alutaceum 'Golden Star'",
                    "follow_number": "12",
                    "purchase_number": "12",
                    "control": "2018-06-22",
                    "place": "2K",
                    "latitude": "12.1212",
                    "longitude": "12.1212",
                    "replant": null,
                    "moved": null,
                    "dead": null,
                    "planted": null,
                    "note": null,
                    "description": null,
                    "image": "/images/9c3e08caae01025da73f838b1ee03719.png",
                    "name_id": 1,
                    "type_id": 2,
                    "sex_id": 1,
                    "specie_id": 6,
                    "subspecie_id": 6,
                    "group_id": 2,
                    "synonym_id": 2,
                    "crossing_id": 6,
                    "winner_id": 3,
                    "treetype_id": 2,
                    "priority_id": 1,
                    "supplier_id": 1,
                    "size_id": 1,
                    "created_at": "2018-06-11 09:29:57",
                    "updated_at": "2018-06-11 09:29:57",
                    "id": 1019
                }
            }
            
	- error:
    		
    		{
                "message": "The given data was invalid.",
                "errors": {
                    "follow_number": [
                        "The follow number must be an integer."
                    ]
                }
            }   	
		
		
---

- url: plants/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"id": 1019,
			"latin_name": "Rhododendron alutaceum 'Golden Star'",
			"follow_number": 12,
			"purchase_number": 12,
			"control": "2018-06-22",
			"place": "2K",
			"latitude": "12.1212",
			"longitude": "12.1212",
			"replant": null,
			"moved": null,
			"dead": null,
			"planted": null,
			"note": null,
			"description": null,
			"image": "/images/9c3e08caae01025da73f838b1ee03719.png",
			"name_id": 1,
			"type_id": 2,
			"sex_id": 1,
			"specie_id": 6,
			"subspecie_id": 6,
			"group_id": 2,
			"synonym_id": 2,
			"crossing_id": 6,
			"winner_id": 3,
			"treetype_id": 2,
			"priority_id": 1,
			"supplier_id": 1,
			"size_id": 1,
			"created_at": "2018-06-11 09:29:57",
			"updated_at": "2018-06-11 09:29:57",
			"name": {
				"id": 1,
				"name": "wilde soort",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"bloom_colors": [
				{
					"id": 7,
					"name": "Roodbruin",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"color_id": 7
					}
				},
				{
					"id": 6,
					"name": "Rood",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"color_id": 6
					}
				}
			],
			"macule_colors": [
				{
					"id": 5,
					"name": "Roze",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"color_id": 5
					}
				},
				{
					"id": 4,
					"name": "Licht",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"color_id": 4
					}
				}
			],
			"crossing": {
				"id": 6,
				"name": "zaailing/Bremen",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"group": {
				"id": 2,
				"name": "clone",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"months": [
				{
					"id": 5,
					"name": "Februari",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"month_id": 5
					}
				},
				{
					"id": 6,
					"name": "Maart",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"month_id": 6
					}
				}
			],
			"priority": {
				"id": 1,
				"name": "2",
				"color": "#0080c0",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-04 14:42:14"
			},
			"sex": {
				"id": 1,
				"name": "Rhododendron",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"size": {
				"id": 1,
				"name": "Groot",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"specie": {
				"id": 6,
				"name": "alutaceum",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"supplier": {
				"id": 1,
				"name": "Jørgensen",
				"street": null,
				"number": null,
				"addition": null,
				"zip_code": null,
				"city": null,
				"phone_number": null,
				"website": null,
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"synonym": {
				"id": 2,
				"name": "'Prelude'",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"treetype": {
				"id": 2,
				"name": "Naaldboom",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"type": {
				"id": 2,
				"name": "Pinaceae",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"subspecie": {
				"id": 6,
				"name": "'Golden Star'",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"winner": {
				"id": 3,
				"name": "Hobbie",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		}
      	
		
---

- url: plants/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"id": 1019,
			"latin_name": "Rhododendron alutaceum 'Golden Star'",
			"follow_number": 12,
			"purchase_number": 12,
			"control": "2018-06-22",
			"place": "2K",
			"latitude": "12.1212",
			"longitude": "12.1212",
			"replant": null,
			"moved": null,
			"dead": null,
			"planted": null,
			"note": null,
			"description": null,
			"image": "/images/9c3e08caae01025da73f838b1ee03719.png",
			"name_id": 1,
			"type_id": 2,
			"sex_id": 1,
			"specie_id": 6,
			"subspecie_id": 6,
			"group_id": 2,
			"synonym_id": 2,
			"crossing_id": 6,
			"winner_id": 3,
			"treetype_id": 2,
			"priority_id": 1,
			"supplier_id": 1,
			"size_id": 1,
			"created_at": "2018-06-11 09:29:57",
			"updated_at": "2018-06-11 09:29:57",
			"name": {
				"id": 1,
				"name": "wilde soort",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"bloom_colors": [
				{
					"id": 7,
					"name": "Roodbruin",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"color_id": 7
					}
				},
				{
					"id": 6,
					"name": "Rood",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"color_id": 6
					}
				}
			],
			"macule_colors": [
				{
					"id": 5,
					"name": "Roze",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"color_id": 5
					}
				},
				{
					"id": 4,
					"name": "Licht",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"color_id": 4
					}
				}
			],
			"crossing": {
				"id": 6,
				"name": "zaailing/Bremen",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"group": {
				"id": 2,
				"name": "clone",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"months": [
				{
					"id": 5,
					"name": "Februari",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"month_id": 5
					}
				},
				{
					"id": 6,
					"name": "Maart",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35",
					"pivot": {
						"plant_id": 1019,
						"month_id": 6
					}
				}
			],
			"priority": {
				"id": 1,
				"name": "2",
				"color": "#0080c0",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-04 14:42:14"
			},
			"sex": {
				"id": 1,
				"name": "Rhododendron",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"size": {
				"id": 1,
				"name": "Groot",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"specie": {
				"id": 6,
				"name": "alutaceum",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"supplier": {
				"id": 1,
				"name": "Jørgensen",
				"street": null,
				"number": null,
				"addition": null,
				"zip_code": null,
				"city": null,
				"phone_number": null,
				"website": null,
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"synonym": {
				"id": 2,
				"name": "'Prelude'",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"treetype": {
				"id": 2,
				"name": "Naaldboom",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"type": {
				"id": 2,
				"name": "Pinaceae",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"subspecie": {
				"id": 6,
				"name": "'Golden Star'",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			"winner": {
				"id": 3,
				"name": "Hobbie",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		}
       	
		
---

- url: plants/{id}
- id: integer
- method: put
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Plant updated",
				"result": true
			}
	
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"follow_number": [
						"The follow number has already been taken."
					],
					"purchase_number": [
						"The purchase number has already been taken."
					]
				}
			}
      	
		
---

- url: plants/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 12,
				"latin_name": "Rhododendron  'White Campanula'",
				"follow_number": 35,
				"purchase_number": 1578,
				"control": "2004-05-27",
				"place": "M16b",
				"latitude": "1292",
				"longitude": "1516",
				"replant": 0,
				"moved": null,
				"dead": 0,
				"planted": "1987-10-05",
				"note": " ",
				"description": null,
				"image": null,
				"name_id": 8,
				"type_id": 1,
				"sex_id": 1,
				"specie_id": null,
				"subspecie_id": 10,
				"group_id": 11,
				"synonym_id": null,
				"crossing_id": null,
				"winner_id": 7,
				"treetype_id": 1,
				"priority_id": 3,
				"supplier_id": 3,
				"size_id": null,
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"name": {
					"id": 8,
					"name": "Hillier hybride",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"bloom_colors": [
					{
						"id": 3,
						"name": "Wit",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 12,
							"color_id": 3
						}
					}
				],
				"macule_colors": [],
				"crossing": null,
				"group": {
					"id": 11,
					"name": "Groep Campanulatum",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"months": [
					{
						"id": 1,
						"name": "Mei",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 12,
							"month_id": 1
						}
					}
				],
				"priority": {
					"id": 3,
					"name": "4",
					"color": "#008000",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-04 14:42:46"
				},
				"sex": {
					"id": 1,
					"name": "Rhododendron",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"size": null,
				"specie": null,
				"supplier": {
					"id": 3,
					"name": "Greer Gardens",
					"street": null,
					"number": null,
					"addition": null,
					"zip_code": null,
					"city": null,
					"phone_number": null,
					"website": null,
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"synonym": null,
				"treetype": {
					"id": 1,
					"name": "Rhododendron",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"type": {
					"id": 1,
					"name": "Rhodo",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"subspecie": {
					"id": 10,
					"name": "'White Campanula'",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"winner": {
					"id": 7,
					"name": "Hillier?",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				}
			},
			{
				"id": 19,
				"latin_name": "Rhododendron  'Lemon Ice'",
				"follow_number": 49,
				"purchase_number": 1421,
				"control": "2010-05-04",
				"place": "B11c",
				"latitude": "169",
				"longitude": "1098",
				"replant": 0,
				"moved": null,
				"dead": 0,
				"planted": null,
				"note": " stond in M16b",
				"description": null,
				"image": null,
				"name_id": 12,
				"type_id": 1,
				"sex_id": 1,
				"specie_id": null,
				"subspecie_id": 14,
				"group_id": 17,
				"synonym_id": null,
				"crossing_id": null,
				"winner_id": 10,
				"treetype_id": 1,
				"priority_id": 1,
				"supplier_id": null,
				"size_id": 2,
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"name": {
					"id": 12,
					"name": "Bosley hybride",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"bloom_colors": [
					{
						"id": 3,
						"name": "Wit",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 19,
							"color_id": 3
						}
					}
				],
				"macule_colors": [
					{
						"id": 1,
						"name": "Geel",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 19,
							"color_id": 1
						}
					}
				],
				"crossing": null,
				"group": {
					"id": 17,
					"name": "hybride",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"months": [
					{
						"id": 1,
						"name": "Mei",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 19,
							"month_id": 1
						}
					},
					{
						"id": 2,
						"name": "Juni",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 19,
							"month_id": 2
						}
					}
				],
				"priority": {
					"id": 1,
					"name": "2",
					"color": "#0080c0",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-04 14:42:14"
				},
				"sex": {
					"id": 1,
					"name": "Rhododendron",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"size": {
					"id": 2,
					"name": "Middel",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"specie": null,
				"supplier": null,
				"synonym": null,
				"treetype": {
					"id": 1,
					"name": "Rhododendron",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"type": {
					"id": 1,
					"name": "Rhodo",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"subspecie": {
					"id": 14,
					"name": "'Lemon Ice'",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"winner": {
					"id": 10,
					"name": "Bosley Paul",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				}
			}
		]
       	
		
---

- url: plants/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"success": true,
			"message": "Plant deleted",
			"result": {
				"id": 1019,
				"latin_name": "Rhododendron alutaceum 'Golden Star'",
				"follow_number": 13,
				"purchase_number": 13,
				"control": "2018-06-22",
				"place": "2K",
				"latitude": "12.1212",
				"longitude": "12.1212",
				"replant": null,
				"moved": null,
				"dead": null,
				"planted": null,
				"note": null,
				"description": null,
				"image": "/images/60726e3a3dca43bbb3a617ae0c9c46cd.png",
				"name_id": 1,
				"type_id": 2,
				"sex_id": 1,
				"specie_id": 6,
				"subspecie_id": 6,
				"group_id": 2,
				"synonym_id": 2,
				"crossing_id": 6,
				"winner_id": 3,
				"treetype_id": 2,
				"priority_id": 1,
				"supplier_id": 1,
				"size_id": 1,
				"created_at": "2018-06-11 09:29:57",
				"updated_at": "2018-06-11 09:42:22",
				"name": {
					"id": 1,
					"name": "wilde soort",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"bloom_colors": [
					{
						"id": 7,
						"name": "Roodbruin",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 1019,
							"color_id": 7
						}
					},
					{
						"id": 6,
						"name": "Rood",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 1019,
							"color_id": 6
						}
					}
				],
				"macule_colors": [
					{
						"id": 5,
						"name": "Roze",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 1019,
							"color_id": 5
						}
					},
					{
						"id": 4,
						"name": "Licht",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 1019,
							"color_id": 4
						}
					}
				],
				"crossing": {
					"id": 6,
					"name": "zaailing/Bremen",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"group": {
					"id": 2,
					"name": "clone",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"months": [
					{
						"id": 5,
						"name": "Februari",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 1019,
							"month_id": 5
						}
					},
					{
						"id": 6,
						"name": "Maart",
						"created_at": "2018-06-01 12:05:35",
						"updated_at": "2018-06-01 12:05:35",
						"pivot": {
							"plant_id": 1019,
							"month_id": 6
						}
					}
				],
				"priority": {
					"id": 1,
					"name": "2",
					"color": "#0080c0",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-04 14:42:14"
				},
				"sex": {
					"id": 1,
					"name": "Rhododendron",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"size": {
					"id": 1,
					"name": "Groot",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"specie": {
					"id": 6,
					"name": "alutaceum",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"supplier": {
					"id": 1,
					"name": "Jørgensen",
					"street": null,
					"number": null,
					"addition": null,
					"zip_code": null,
					"city": null,
					"phone_number": null,
					"website": null,
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"synonym": {
					"id": 2,
					"name": "'Prelude'",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"treetype": {
					"id": 2,
					"name": "Naaldboom",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"type": {
					"id": 2,
					"name": "Pinaceae",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"subspecie": {
					"id": 6,
					"name": "'Golden Star'",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				},
				"winner": {
					"id": 3,
					"name": "Hobbie",
					"created_at": "2018-06-01 12:05:35",
					"updated_at": "2018-06-01 12:05:35"
				}
			}
		}

### Prioriteit

- url: priorities
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 1,
				"name": "2",
				"color": "#0080c0",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-04 14:42:14",
				"plant_count": 248
			}
		]
           	
		
---

- url: priorities
- method: post
- body: name (string|unique|required), color (required|string|min:4|max:7)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:
	
			{
                "success": true,
                "message": "Priority created",
                "result": {
                    "name": "Voorbeeld",
                    "color": "#fff",
                    "created_at": "2018-06-11 09:48:06",
                    "updated_at": "2018-06-11 09:48:06",
                    "id": 6
                }
            }
		
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
             	
		
---

- url: priorities/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"id": 6,
			"name": "Voorbeeld",
			"color": "#fff",
			"created_at": "2018-06-11 09:48:06",
			"updated_at": "2018-06-11 09:48:06"
		}
      	
		
---

- url: priorities/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"id": 6,
			"name": "Voorbeeld",
			"color": "#fff",
			"created_at": "2018-06-11 09:48:06",
			"updated_at": "2018-06-11 09:48:06"
		}
         	
		
---

- url: priorities/{id}
- id: integer
- method: put      
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Priority updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
           	
		
---

- url: priorities/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 6,
				"name": "Voorbeeld",
				"color": "#fff",
				"created_at": "2018-06-11 09:48:06",
				"updated_at": "2018-06-11 09:48:06"
			}
		]
          	
		
---

- url: priorities/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"success": true,
			"message": "Priority deleted",
			"result": {
				"id": 6,
				"name": "Voorbeeld",
				"color": "#fff",
				"created_at": "2018-06-11 09:48:06",
				"updated_at": "2018-06-11 09:48:06"
			}
		}

### Geslachten

- url: sexes
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		[
			{
				"id": 1,
				"name": "Rhododendron",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"plant_count": 648
			}
		]
        	
		
---

- url: sexes
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

			{
				"success": true,
				"message": "Sex created",
				"result": {
					"name": "Voorbeeld",
					"created_at": "2018-06-11 07:50:58",
					"updated_at": "2018-06-11 07:50:58",
					"id": 24
				}
			}
		
	- error:

			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
        	
		
---

- url: sexes/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"id": 24,
			"name": "Viburnum",
			"created_at": "2018-06-01 12:05:35",
			"updated_at": "2018-06-01 12:05:35"
		}
         	
		
---

- url: sexes/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"id": 24,
			"name": "Viburnum",
			"created_at": "2018-06-01 12:05:35",
			"updated_at": "2018-06-01 12:05:35"
		}
      	
		
---

- url: sexes/{id}
- id: integer
- method: put   
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Sex updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
        	
		
---

- url: sexes/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		[
			{
				"id": 24,
				"name": "Viburnum",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		]
         	
		
---

- url: sexes/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"success": true,
			"message": "Sex deleted",
			"result": {
				"id": 6,
				"name": "Voorbeeld",
				"created_at": "2018-06-11 09:48:06",
				"updated_at": "2018-06-11 09:48:06"
			}
		}

### Groottes

- url: sizes
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		[
			{
				"id": 1,
				"name": "Groot",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"plant_count": 77
			}
		]
     	
		
---

- url: sizes
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

			{
				"success": true,
				"message": "Size created",
				"result": {
					"name": "Voorbeeld",
					"created_at": "2018-06-11 07:50:58",
					"updated_at": "2018-06-11 07:50:58",
					"id": 24
				}
			}
		
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
      	
		
---

- url: sizes/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"id": 23,
			"name": "Voorbeeld",
			"created_at": "2018-06-11 09:59:09",
			"updated_at": "2018-06-11 09:59:09"
		}
     	
		
---

- url: sizes/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"id": 23,
			"name": "Voorbeeld",
			"created_at": "2018-06-11 09:59:09",
			"updated_at": "2018-06-11 09:59:09"
		}
         	
		
---

- url: sizes/{id}
- id: integer
- method: put      
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Size updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
        	
		
---

- url: sizes/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 1,
				"name": "Groot",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			{
				"id": 6,
				"name": "Groot (6 m)",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		]
      	
		
---

- url: sizes/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"success": true,
			"message": "Size deleted",
			"result": {
				"id": 23,
				"name": "Voorbeeld",
				"created_at": "2018-06-11 09:59:09",
				"updated_at": "2018-06-11 09:59:09"
			}
		}

### Soorten

- url: species
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 1,
				"name": "litiense",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"plant_count": 1
			}
		]
      	
		
---

- url: species
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

			{
				"success": true,
				"message": "Specie created",
				"result": {
					"name": "Voorbeeld",
					"created_at": "2018-06-11 07:50:58",
					"updated_at": "2018-06-11 07:50:58",
					"id": 24
				}
			}
		
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
    	
		
---

- url: species/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"id": 286,
			"name": "Voorbeeld",
			"created_at": "2018-06-11 10:03:39",
			"updated_at": "2018-06-11 10:03:39"
		}
		
		
---

- url: species/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:
	
		{
            "id": 286,
            "name": "Voorbeeld",
            "created_at": "2018-06-11 10:03:39",
            "updated_at": "2018-06-11 10:03:39"
        }
       	
		
---

- url: species/{id}
- id: integer
- method: put    
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Specie updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
      	
		
---

- url: species/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:
	
		[
			{
				"id": 143,
				"name": "nootkatensis",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			{
				"id": 284,
				"name": "burkwoodii",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		]
      	
		
---

- url: species/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"success": true,
			"message": "Specie deleted",
			"result": {
				"id": 286,
				"name": "Voorbeeld",
				"created_at": "2018-06-11 10:03:39",
				"updated_at": "2018-06-11 10:03:39"
			}
		}

### Leveranciers

- url: suppliers
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		[
			{
				"id": 1,
				"name": "Jørgensen",
				"street": null,
				"number": null,
				"addition": null,
				"zip_code": null,
				"city": null,
				"phone_number": null,
				"website": null,
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"plant_count": 24
			}
		]
       	
		
---

- url: suppliers
- method: post
- body: name (string|unique|required), street (nullable|string), number (nullable|integer), addition (nullable|string), zip_code (nullable|string), city (nullable|string), phone_number (nullable|string|min:10|max:13), website (nullable|string|url)
- extra header: `Authorization: Bearer <api_token>`
- return
	- success:       	
       	
			{
				"success": true,
				"message": "Supplier created",
				"result": {
					"name": "Voorbeeld",
					"street": "Noord",
					"number": "12",
					"addition": "a",
					"zip_code": "1212AT",
					"city": "Grunn",
					"phone_number": "1234567890",
					"website": "http://google.nl",
					"created_at": "2018-06-11 10:12:04",
					"updated_at": "2018-06-11 10:12:04",
					"id": 64
				}
			}   	
		
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}	
			
			
---

- url: suppliers/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:
	
		{
			"id": 64,
			"name": "Voorbeeld",
			"street": "Noord",
			"number": 12,
			"addition": "a",
			"zip_code": "1212AT",
			"city": "Grunn",
			"phone_number": "1234567890",
			"website": "http://google.nl",
			"created_at": "2018-06-11 10:12:04",
			"updated_at": "2018-06-11 10:12:04"
 	   	}
     	
		
---

- url: suppliers/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"id": 64,
			"name": "Voorbeeld",
			"street": "Noord",
			"number": 12,
			"addition": "a",
			"zip_code": "1212AT",
			"city": "Grunn",
			"phone_number": "1234567890",
			"website": "http://google.nl",
			"created_at": "2018-06-11 10:12:04",
			"updated_at": "2018-06-11 10:12:04"
		}
        	
		
---

- url: suppliers/{id}
- id: integer
- method: put
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Supplier updated",
				"result": true
			}
    
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
        	
		
---

- url: suppliers/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		[
			{
				"id": 14,
				"name": "Briarwood",
				"street": null,
				"number": null,
				"addition": null,
				"zip_code": null,
				"city": null,
				"phone_number": null,
				"website": null,
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		]
        	
		
---

- url: suppliers/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
			"success": true,
			"message": "Supplier deleted",
			"result": {
				"id": 64,
				"name": "Voorbeelds",
				"street": "Noord",
				"number": 12,
				"addition": "a",
				"zip_code": "1212AT",
				"city": "Grunn",
				"phone_number": "1234567890",
				"website": "http://google.nl",
				"created_at": "2018-06-11 10:12:04",
				"updated_at": "2018-06-11 10:16:50"
			}
		}

### Synonym

- url: synonyms
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:
- success:

		[
			{
				"id": 1,
				"name": "R wardii var wardii Litiense Group",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"plant_count": 2
			}
		]
         	
		
---

- url: synonyms
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

			{
				"success": true,
				"message": "Synonym created",
				"result": {
					"name": "Voorbeeld",
					"created_at": "2018-06-11 07:50:58",
					"updated_at": "2018-06-11 07:50:58",
					"id": 24
				}
			}
		
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
        	
		
---

- url: synonyms/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
            "id": 61,
            "name": "Voorbeelds",
            "created_at": "2018-06-11 10:27:16",
            "updated_at": "2018-06-11 10:27:16"
        }
     	
		
---

- url: synonyms/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
            "id": 61,
            "name": "Voorbeelds",
            "created_at": "2018-06-11 10:27:16",
            "updated_at": "2018-06-11 10:27:16"
        }
        	
		
---

- url: synonyms/{id}
- id: integer
- method: put    
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Synonym updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
      	
		
---

- url: synonyms/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 1,
				"name": "R wardii var wardii Litiense Group",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		]
        	
		
---

- url: synonyms/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"success": true,
			"message": "Synonym deleted",
			"result": {
				"id": 61,
				"name": "Voorbeelds",
				"created_at": "2018-06-11 10:27:16",
				"updated_at": "2018-06-11 10:27:16"
			}
		}

### Boomtype

- url: treetypes
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
            {
                "id": 1,
                "name": "Rhododendron",
                "created_at": "2018-06-01 12:05:35",
                "updated_at": "2018-06-01 12:05:35",
                "plant_count": 643
            }
		]
      	
		
---

- url: treetypes
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

				{
					"success": true,
					"message": "Treetype created",
					"result": {
						"name": "Voorbeeld",
						"created_at": "2018-06-11 07:50:58",
						"updated_at": "2018-06-11 07:50:58",
						"id": 24
					}
				}
			
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
            	
		
---

- url: treetypes/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
            "id": 4,
            "name": "Voorbeelds",
            "created_at": "2018-06-11 10:29:07",
            "updated_at": "2018-06-11 10:29:07"
        }
            	
		
---

- url: treetypes/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
            "id": 4,
            "name": "Voorbeelds",
            "created_at": "2018-06-11 10:29:07",
            "updated_at": "2018-06-11 10:29:07"
        }
        	
		
---

- url: treetypes/{id}
- id: integer
- method: put  
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Treetype updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
       	
		
---

- url: treetypes/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
            {
                "id": 1,
                "name": "Rhododendron",
                "created_at": "2018-06-01 12:05:35",
                "updated_at": "2018-06-01 12:05:35"
            }
		]
   	
		
---

- url: treetypes/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
            "success": true,
            "message": "Treetype deleted",
            "result": {
                "id": 4,
                "name": "Voorbeelds",
                "created_at": "2018-06-11 10:29:07",
                "updated_at": "2018-06-11 10:29:07"
            }
        }

### Types

- url: types
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
            {
                "id": 1,
                "name": "Rhodo",
                "created_at": "2018-06-01 12:05:35",
                "updated_at": "2018-06-01 12:05:35",
                "plant_count": 645
            }
		]
        	
		
---

- url: types
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

			{
				"success": true,
				"message": "Type created",
				"result": {
					"name": "Voorbeeld",
					"created_at": "2018-06-11 07:50:58",
					"updated_at": "2018-06-11 07:50:58",
					"id": 24
				}
			}
			
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}

- url: types/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
            "id": 48,
            "name": "Voorbeelds",
            "created_at": "2018-06-11 10:31:04",
            "updated_at": "2018-06-11 10:31:04"
        }
            	
		
---

- url: types/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			  "id": 48,
			  "name": "Voorbeelds",
			  "created_at": "2018-06-11 10:31:04",
			  "updated_at": "2018-06-11 10:31:04"
		}
      	
		
---

- url: types/{id}
- id: integer
- method: put   
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Type updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
         	
		
---

- url: types/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 48,
				"name": "Voorbeelds",
				"created_at": "2018-06-11 10:31:04",
				"updated_at": "2018-06-11 10:31:04"
			}
		]
          	
		
---

- url: types/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
            "success": true,
            "message": "Type deleted",
            "result": {
                "id": 48,
                "name": "Voorbeelds",
                "created_at": "2018-06-11 10:31:04",
                "updated_at": "2018-06-11 10:31:04"
            }
        }

### Varieteiten

- url: subspecies
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 1,
				"name": "'Wyanokie'",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"plant_count": 1
			}
		]
           	
		
---

- url: subspecies
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

			{
				"success": true,
				"message": "Subspecie created",
				"result": {
					"name": "Voorbeeld",
					"created_at": "2018-06-11 07:50:58",
					"updated_at": "2018-06-11 07:50:58",
					"id": 24
				}
			}
			
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}

- url: subspecies/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"id": 788,
			"name": "Voorbeelds",
			"created_at": "2018-06-11 10:35:01",
			"updated_at": "2018-06-11 10:35:01"
		}
        	
		
---

- url: subspecies/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
            "id": 788,
            "name": "Voorbeelds",
            "created_at": "2018-06-11 10:35:01",
            "updated_at": "2018-06-11 10:35:01"
        }
      	
		
---

- url: subspecies/{id}
- id: integer
- method: put  
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Subspecie updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
        	
		
---

- url: subspecies/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 12,
				"name": "'Caroline Allbrook'",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			},
			{
				"id": 45,
				"name": "'Redwood'",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		]
      	
		
---

- url: subspecies/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
			"success": true,
			"message": "Subspecie deleted",
			"result": {
				"id": 788,
				"name": "Voorbeelds",
				"created_at": "2018-06-11 10:35:01",
				"updated_at": "2018-06-11 10:35:01"
			}
		}

### Winners

- url: winners
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		[
			{
				"id": 1,
				"name": "Nearing",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35",
				"plant_count": 2
			}
		]
        	
		
---

- url: winners
- method: post
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return:	
	- success:

			{
				"success": true,
				"message": "Winner created",
				"result": {
					"name": "Voorbeeld",
					"created_at": "2018-06-11 07:50:58",
					"updated_at": "2018-06-11 07:50:58",
					"id": 24
				}
			}
			
	- error:
	
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
          	
		
---

- url: winners/{id}
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
            "id": 134,
            "name": "Voorbeelds",
            "created_at": "2018-06-11 10:40:00",
            "updated_at": "2018-06-11 10:40:00"
        }
         	
		
---

- url: winners/{id}/edit
- id: integer
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
            "id": 134,
            "name": "Voorbeelds",
            "created_at": "2018-06-11 10:40:00",
            "updated_at": "2018-06-11 10:40:00"
        }
      	
		
---

- url: winners/{id}
- id: integer
- method: put 
- body: name (string|unique|required)
- extra header: `Authorization: Bearer <api_token>`
- return: 
	- success:
	
			{
				"success": true,
				"message": "Winner updated",
				"result": true
			}
    
	- error:
   
			{
				"message": "The given data was invalid.",
				"errors": {
					"name": [
						"The name has already been taken."
					]
				}
			}
       	
		
---

- url: winners/{search}/search
- search: integer(id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return: 

		[
			{
				"id": 5,
				"name": "Boskoop research centre",
				"created_at": "2018-06-01 12:05:35",
				"updated_at": "2018-06-01 12:05:35"
			}
		]
       	
		
---

- url: winners/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return: 

		{
            "success": true,
            "message": "Winner deleted",
            "result": {
                "id": 134,
                "name": "Voorbeelds",
                "created_at": "2018-06-11 10:40:00",
                "updated_at": "2018-06-11 10:40:00"
            }
        }
        
###Gebruikers

- url: users
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:
	
		[
			{
				"id": 1,
				"first_name": "Derkjan",
				"last_name": "Super",
				"email": "super.derkjan@gmail.com",
				"created_at": null,
				"updated_at": null
			}
		]
       	
		
---

- url: users/{id}
- id: integer (id)
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
            "id": 1,
            "first_name": "Derkjan",
            "last_name": "Super",
            "email": "super.derkjan@gmail.com",
            "created_at": null,
            "updated_at": null
        }
               	
		
---

- url: users/{id}/edit
- id: integer (id)
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
            "id": 1,
            "first_name": "Derkjan",
            "last_name": "Super",
            "email": "super.derkjan@gmail.com",
            "created_at": null,
            "updated_at": null
        } 
                   	
		
---

- url: users/{id}
- id: integer
- method: put
- body: first_name (required|string), last_name (required|string), email (required|email|string|exists:users), password (nullable|string|min:6) // base64 encoded so it is not plain text. After submit it is decoded for validation
- extra header: `Authorization: Bearer <api_token>`
- return:
	- success:
	
			{
				"success": true,
				"message": "User updated",
				"result": true
			}
	
	- error:
	
			{
                "message": "The given data was invalid.",
                "errors": {
                    "email": [
                        "The email has already been taken."
                    ]
                }
            }		
	   	
		
---

- url: users/{search}/search
- search: integer (id)/ string
- method: get
- extra header: `Authorization: Bearer <api_token>`
- return:

		[
            {
                "id": 1,
                "first_name": "Voornaam",
                "last_name": "Achternaam",
                "email": "super.derkjan@gmail.com",
                "created_at": null,
                "updated_at": "2018-06-11 11:03:02"
            }
        ]
          	   	
		
---

- url: users/{id}
- id: integer
- method: delete
- extra header: `Authorization: Bearer <api_token>`
- return:

		{
            "success": true,
            "message": "User deleted",
            "result": {
                "id": 3,
                "first_name": "Derkjan",
                "last_name": "Super",
                "email": "sur.derkjan@gmail.com",
                "created_at": "2018-06-11 11:10:21",
                "updated_at": "2018-06-11 11:10:21"
            }
        }
    
        
---
	
- url: register
- method: post
- body: first_name (required|string), last_name (required|string), email (required|email|string|exists:users), password (nullable|string|min:6) // base64 encoded so it is not plain text. After submit it is decoded for validation 
- extra header: `Authorization: Bearer <api_token>`
- return:
	- success:
	
			{
                "success": true,
                "message": "Created account succesfully",
                "result": {
                    "first_name": "Derkjan",
                    "last_name": "Super",
                    "email": "sur.derkjan@gmail.com",
                    "created_at": "2018-06-11 11:10:21",
                    "updated_at": "2018-06-11 11:10:21",
                    "id": 3
                }
            }
            
	- error:
		
			 {
                 "message": "The given data was invalid.",
                 "errors": {
                     "email": [
                         "The email has already been taken."
                     ]
                 }
             }

- url: login
- method: post
- body: email (required|email|string|exists:users), password (required|string|min:6) // base64 encoded so it is not plain text. After submit it is decoded for validation
- **Note*** the token is what is used for Authorization.
- return:
	- success:
	
			{
				"success": true,
				"message": "You are logged in",
				"token": "eyJ0eXAiOiJKV1QiWM5Y2RjODk1NGVjNWM1MzExNjdkYzBiNGJhNzdiNDNkMDQxMzJmYmQ3MWM1OTRjZDdmMjZiMmYwYWNlMjFhOTU1ODVlMjQyIn0.eyJhdWQiOiIxIiwianRpIjoiMzllYWE1N2NlYzljZGM4OTU0ZWM1YzUzMTE2N2RjMGI0YmE3N2I0M2QwNDEzMmZiZDcxYzU5NGNkN2YyNmIyZjBhY2UyMWE5NTU4NWUyNDIiLCJpYXQiOjE1Mjg3MTQwOTEsIm5iZiI6MTUyODcxNDA5MSwiZXhwIjoxNTYwMjUwMDkxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.rDSz-w9Z-v9bVixn5o9SMuGvgTxX2igGGmcZn63O0os-GGLIGHfXyynZBYPiEIQrEWVdNrNp9-UB0XxoO4-MY9LvBZ1SKJ9aw355xRakrHQaGYT4GH6Uq5quSXRilmEclIVZISchLMpuHdlPYJVs8C1WEOUl_opaXBzRGV45whiqKVAl338aQiYS-odsAAjj5zS2QMq5lkyDSmT8njBr1aPIXMGnuW91AjKQIotop4OCsdKuo7MjKteCQuLXrvrBS6k6rMmfE8U9O3k6dJUH3818E0EHQlP9LJ2L9dZe8Zl_c_RCMQH8j7GfFux99j8oU2pf3MW6NXKsAVw_mwQlhnYPqyC-QRxEdsqJxj2cOwkY3xNJu2rBy1nT5ZXKBMChjHMsH8aIJArF7SJlrhvVPSo41aJU8h6OlDb426opSJWzl4U-LvHw3Zh3Z_TTiBAm_YeCMNW7HlYJIoYTksANeuidcgMt92JjtU-m86rBTmr-yujmTIzsyozWafoZ-eWFpfTRsdWK4JjkvvH9x7_9cJ4Pwo7u-pjIl_jeoOmfyvuiWIk6rQLR-lJyP8jS7YzV_pRUVS5Rq46gfcWBJxEGRTLDE3SXDSg_udz9WBMudwm5l4MfBFxNHo7Ye74Tj1dIIrD1I03rQzmUu9WfEqKvEhoEO4by-bgduUFEhDD4bxU",
				"user": {
					"id": 1,
					"first_name": "Derkjan",
					"last_name": "Super",
					"email": "super.derkjan@gmail.com",
					"created_at": null,
					"updated_at": null
				}
			}
	
	- error:
	
			{
                "message": "The given data was invalid.",
                "errors": {
                    "password": [
                        "The password must be at least 6 characters."
                    ]
                }
            }
	
	