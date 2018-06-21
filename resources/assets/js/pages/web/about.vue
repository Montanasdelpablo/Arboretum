<template>
    <v-container grid-list-md>
        <v-layout row wrap>
            <v-flex xs4>
                <h1 class="display-1">Over de website</h1>

                <p>
                    Er is aan een tweetal studenten van de
                    <a href="//www.hanze.nl/nld/onderwijs/techniek/instituut-voor-communicatie-media--it" target="_blank">Hanzehogeschool Groningen</a>
                    gevraagd om de planten database van het
                    <a href="//arboretumeenrum.nl/" target="_blank">Arboretum Eenrum</a>
                    te digitaliseren.
                </p>

                <p>
                    We hebben de database gedigitaliseerd door een
                    <a href="//products.office.com/nl-nl/access" target="_blank">access database</a>
                    om te zetten naar een gestructureerde <a href="//www.mysql.com/" target="_blank">MySQL database</a>.
                    Na het omzetten zijn we begonnen met het maken van een API. Via de API is het mogelijk om de data in de database te beheren.
                    Nadat de API gemaakt is, was het mogelijk om te beginnen aan de front-end ofwel de daadwerkelijke website.
                    Als eerste hebben we voor de website een dashboard gemaakt. Via het dashboard is het mogelijk om de database te beheren.
                    Als laatste hebben we de website gemaakt die voor alle gebruikers te bekijken is.
                </p>

                <p>
                    Via de website is het mogelijk dat een gebruiker kan zien waar hij in de tuin staat.
                    Van daaruit is het mogelijk om te zien welke planten er in de buurt zijn.
                    Het is daarnaast mogelijk om meer informatie over een plant te krijgen.
                    Via QR-codes die uiteindelijk op de informatiebordjes komen is het ook mogelijk om direct de informatie te krijgen.
                    Een gebruiker kan de QR-code namelijk scannen met een smartphone of tablet waarnaar de gebruiker naar de desbetreffende URL van de plant geleid wordt.
                </p>

                <p>
                    Voor het maken van de website is er gebruik gemaakt van <a href="//laravel.com/" target="_blank">Laravel</a> voor de back-end/ API.
                    De API wordt weer aangeroepen vanuit <a href="//vuejs.org/" target="_blank">VueJS</a> waarmee de front-end gemaakt is.
                    Doordat er een API gemaakt is, is het ook mogelijk om eventueel in de toekomst een app toe te voegen die van de API gebruik maakt.
                </p>
            </v-flex>
        </v-layout>
    </v-container>
</template>
