<template>
    <div>
        <Header :title="title"/>
        <div>
            <TicketDemandeur :listeprobleme="listeprobleme" :tickets="tickets"/>
        </div>
    </div>
</template>

<script>
import Header from "../Components/Header.vue";
import TicketDemandeur from "../Components/TicketInsertDemandeur.vue"
export default {
    name: "ticketform",
        props:{
        listeprobleme: {
            type: Array
            },
        tickets: {
            type: Array
        }
        },
        data() {
        return {
            title: "Formulaire de ticket"
            }
        },
    components: {
        Header, TicketDemandeur
    },
    methods: {
    },
    mounted(){
    },
    computed: {

    }
}
</script>