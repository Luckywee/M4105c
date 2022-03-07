<template>
    <div>
        <Header :title="title" :moi="moi"/> <!--Props doit etre dans le header et non sur cette page ou sinon erreur -->
        {{ nbAllTickets }} {{ nbTicketsReso }} {{ nbTicketsNonReso }}
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
        ticketsResolved : {
            type: Array
        },
        moi : {
            type: Object
        }
        },
        data() {
        return {
            title: "Statistiques par rapport aux tickets",
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
        nbTicketsReso: function () {
            return this.ticketsResolved.length;
        },
        nbTicketsNonReso: function () {
            return this.tickets.length - this.ticketsResolved.length;
        }
    }
}
</script>