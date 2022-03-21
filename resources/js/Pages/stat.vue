<template>
    <div>
        <Header :title="title" :moi="moi"/> <!--Props doit etre dans le header et non sur cette page ou sinon erreur -->
        <p>Nombre total de tickets : {{ nbAllTickets }}</p>
        <p>Nombre de tickets résolus : {{ nbTicketsReso }}</p>
        <p>Nombre de tickets non résolus : {{ nbTicketsNonReso }}</p>
        <p>Durée moyenne de résolution des tickets (en jours) : {{ Math.round(ticketLengthAverage*100)/100 }}</p>
        <p>Nombre de opérateurs : {{ nbAllOperateurs }}</p>
        <p>Nombre de demandeurs : {{ nbAllDemandeurs }}</p>
        <p>Pourcentage de tickets résolus : {{ percentageTicketReso }}%</p>
        <a id="retour" class="coolbutton" href="/ticketmain">Retour</a>
    </div>
</template>

<script>
import Header from "../Components/Header.vue";
export default {
    name: "stat",
        props:{
        tickets: {
            type: Array
            },
        users: {
            type: Array
            },
        operateurs: {
            type: Array
            },
        demandeurs: {
            type: Array
            },
        ticketsResolved : {
            type: Array
        },
        moi : {
            type: Object
        }
        },
        data() {
        return {
            title: "Statistiques générales",
            }
        },
    components: {
        Header
    },
    methods: {

    },
    computed: {
        nbAllTickets: function () {
            return this.tickets.length;
        },
        nbAllDemandeurs: function () {
            return this.demandeurs.length;
        },
        nbAllOperateurs: function () {
            return this.operateurs.length;
        },
        nbTicketsReso: function () {
            return this.ticketsResolved.length;
        },
        nbTicketsNonReso: function () {
            return this.tickets.length - this.ticketsResolved.length;
        },
        percentageTicketReso: function(){
            return this.nbAllTickets==0 ? 0 : Math.round(this.nbTicketsReso/this.nbAllTickets*100*100)/100; // *100 puis /100 pour round 2chiffres apres la virgule
        },

        ticketLengthAverage: function () {
            let time=0;
            this.ticketsResolved.forEach(ticket => {
                var date1 = new Date(ticket.datecreation);
                var date2 = new Date(ticket.resolu_at);
                var Difference_In_Time = date2.getTime() - date1.getTime();
                var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                time+=Difference_In_Days;
            });
            return time / this.ticketsResolved.length;
        }
    }
}
</script>