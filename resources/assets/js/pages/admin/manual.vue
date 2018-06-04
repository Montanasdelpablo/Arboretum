<template>
    <v-container grid-list-md>
        <v-layout row wrap>
            <v-flex xs12 md3>
                <h2 class="headline" id="top">Inhoudsopgave</h2>

                <v-list>
                    <v-list-tile href="#priority">
                        <v-list-tile-content>
                            <v-list-tile-title>Belang</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#treetypes">
                        <v-list-tile-content>
                            <v-list-tile-title>Boomtypes</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#users">
                        <v-list-tile-content>
                            <v-list-tile-title>Gebruikers</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#sexes">
                        <v-list-tile-content>
                            <v-list-tile-title>Geslachten</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#groups">
                        <v-list-tile-content>
                            <v-list-tile-title>Groepen</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#sizes">
                        <v-list-tile-content>
                            <v-list-tile-title>Groottes</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#colors">
                        <v-list-tile-content>
                            <v-list-tile-title>Kleuren</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#crossings">
                        <v-list-tile-content>
                            <v-list-tile-title>Kruisingen</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#suppliers">
                        <v-list-tile-content>
                            <v-list-tile-title>Leveranciers</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#months">
                        <v-list-tile-content>
                            <v-list-tile-title>Maanden</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#names">
                        <v-list-tile-content>
                            <v-list-tile-title>Namen</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#plants">
                        <v-list-tile-content>
                            <v-list-tile-title>Planten</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#species">
                        <v-list-tile-content>
                            <v-list-tile-title>Soorten</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#synonyms">
                        <v-list-tile-content>
                            <v-list-tile-title>Synoniemen</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#types">
                        <v-list-tile-content>
                            <v-list-tile-title>Types</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#subspecies">
                        <v-list-tile-content>
                            <v-list-tile-title>Variëteiten</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile href="#winners">
                        <v-list-tile-content>
                            <v-list-tile-title>Winners</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-flex>

            <v-flex xs12 md6>
                <section id="priority">
                    <h1 class="display-4">Belangen</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'priorityIndex' }">overzichtspagina</router-link> voor alle
                        belangen.
                        Je kunt hier belangen toevoegen, bewerken en verwijderen.
                        De belangen die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        belang.
                    </p>
                </section>

                <v-divider />

                <section id="treetypes">
                    <h1 class="display-4">Boomtypes</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'treetypeIndex' }">overzichtspagina</router-link> voor alle
                        boomtypes.
                        Je kunt hier boomtypes toevoegen, bewerken en verwijderen.
                        De boomtypes die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        boomtype.
                    </p>
                </section>

                <v-divider />

                <section id="users">
                    <h1 class="display-4">Gebruikers</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'userIndex' }">overzichtspagina</router-link> voor alle
                        gebruikers.
                        Je kunt hier gebruikers toevoegen, bewerken en verwijderen.
                    </p>

                    <p>
                        Alle gebruikers die in het overzicht staan hebben dezelfde rechten. Dit wil zeggen dat iedere
                        gebruiker overal bij kan en dus ook dezelfde acties kan uitvoeren. Zorg er daarom voor dat alleen
                        mensen toegang hebben die ook daadwerkelijk toegang mogen hebben. Verwijderd gebruikers die geen
                        toegang meer mogen hebben.
                    </p>

                    <p>
                        Bij het bewerken van een gebruiker is het niet perse nodig om ook het wachtwoord in te vullen.
                        Wanneer je wel het wachtwoord invult dan zal het wachtwoord ook bewerkt worden.
                    </p>
                </section>

                <v-divider />

                <section id="sexes">
                    <h1 class="display-4">Geslachten</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'sexIndex' }">overzichtspagina</router-link> voor alle
                        geslachten.
                        Je kunt hier geslachten toevoegen, bewerken en verwijderen.
                        De geslachten die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        geslacht.
                    </p>
                </section>

                <v-divider />

                <section id="groups">
                    <h1 class="display-4">Groepen</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'groupIndex' }">overzichtspagina</router-link> voor alle
                        groepen.
                        Je kunt hier groepen toevoegen, bewerken en verwijderen.
                        De groepen die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        groep.
                    </p>
                </section>

                <v-divider />

                <section id="sizes">
                    <h1 class="display-4">Groottes</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'sizeIndex' }">overzichtspagina</router-link> voor alle
                        groottes.
                        Je kunt hier groottes toevoegen, bewerken en verwijderen.
                        De groottes die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        groottes.
                    </p>
                </section>

                <v-divider />

                <section id="colors">
                    <h1 class="display-4">Kleuren</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'colorIndex' }">overzichtspagina</router-link> voor alle kleuren.
                        Je kunt hier kleuren toevoegen, bewerken en verwijderen.
                        De kleuren die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        bloei- en maculekleur.
                    </p>
                </section>

                <v-divider />

                <section id="crossings">
                    <h1 class="display-4">Kruisingen</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'crossingIndex' }">overzichtspagina</router-link> voor alle
                        kruisingen.
                        Je kunt hier kruisingen toevoegen, bewerken en verwijderen.
                        De kruisingen die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        kruisingen.
                    </p>
                </section>

                <v-divider />

                <section id="suppliers">
                    <h1 class="display-4">Leveranciers</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'supplierIndex' }">overzichtspagina</router-link> voor alle
                        leveranciers.
                        Je kunt hier leveranciers toevoegen, bewerken en verwijderen.
                        De leveranciers die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten
                        onder leveranciers.
                    </p>

                    <p>
                        Wanneer je voor een leverancier een website link toevoegd kun je dit gebruiken als snelkoppeling.
                    </p>
                </section>

                <v-divider />

                <section id="months">
                    <h1 class="display-4">Maanden</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'monthIndex' }">overzichtspagina</router-link> voor alle
                        maanden.
                        Je kunt hier maanden toevoegen, bewerken en verwijderen.
                        De maanden die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        maanden.
                    </p>
                </section>

                <v-divider />

                <section id="names">
                    <h1 class="display-4">Namen</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'nameIndex' }">overzichtspagina</router-link> voor alle
                        namen.
                        Je kunt hier namen toevoegen, bewerken en verwijderen.
                        De namen die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        namen.
                    </p>
                </section>

                <v-divider />

                <section id="plants">
                    <h1 class="display-4">Planten</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'plantIndex' }">overzichtspagina</router-link> voor alle planten.
                        Je kunt hier planten toevoegen, bewerken en verwijderen.
                        Voor het toevoegen en bewerken van een plant worden de gegevens van de andere tabellen gebruikt.
                    </p>

                    <p>
                        Wanneer er dus bijvoorbeeld een kleur ontbreek bij voor de bloeikleur dan moet deze nog
                        toegevoegd worden onder kleuren. Het is dan ook alleen mogelijk om uit een waarde te kiezen die
                        getoond wordt. Het is wel mogelijk om te zoeken naar een waarde. Je kunt namelijk net als bij
                        Google gebruik maken van een zogenoemde autocomplete. Dit zorgt ervoor dat wanneer je de helft
                        van een waarde hebt ingevuld de rest automatisch toegevoegd wordt.
                    </p>

                    <p>
                        Voor de maanden, bloei- en maculekleur kunnen meerdere waarden geselecteerd worden.
                    </p>
                </section>

                <v-divider />

                <section id="species">
                    <h1 class="display-4">Soorten</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'specieIndex' }">overzichtspagina</router-link> voor alle
                        soorten.
                        Je kunt hier soorten toevoegen, bewerken en verwijderen.
                        De soorten die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        soorten.
                    </p>
                </section>

                <v-divider />

                <section id="synonyms">
                    <h1 class="display-4">Synoniemen</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'synonymIndex' }">overzichtspagina</router-link> voor alle
                        synoniemen.
                        Je kunt hier synoniemen toevoegen, bewerken en verwijderen.
                        De synoniemen die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        synoniemen.
                    </p>
                </section>

                <v-divider />

                <section id="types">
                    <h1 class="display-4">Types</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'typeIndex' }">overzichtspagina</router-link> voor alle
                        types.
                        Je kunt hier types toevoegen, bewerken en verwijderen.
                        De types die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        types.
                    </p>
                </section>

                <v-divider />

                <section id="subspecies">
                    <h1 class="display-4">Variëteiten</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'subspecieIndex' }">overzichtspagina</router-link> voor alle
                        variëteiten.
                        Je kunt hier variëteiten toevoegen, bewerken en verwijderen.
                        De variëteiten die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        variëteiten.
                    </p>
                </section>

                <v-divider />

                <section id="winners">
                    <h1 class="display-4">Winners</h1>

                    <p style="margin-top:32px">
                        Dit is een <router-link :to="{ name: 'winnerIndex' }">overzichtspagina</router-link> voor alle
                        winners.
                        Je kunt hier winners toevoegen, bewerken en verwijderen.
                        De winners die hier staan worden ook getoond tijdens het toevoegen en bewerken van planten onder
                        winners.
                    </p>
                </section>

                <v-divider />
            </v-flex>
        </v-layout>
    </v-container>
</template>