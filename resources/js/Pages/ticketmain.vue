<template>
  <div>
    <Header :title="title" :moi="moi"/>
  <div>
    <TableOpe :tickets="tickets" :roledem="dem" :roleresp="resp" :typeprobleme="probleme"/> <!-- pour passer une donnée à un component-->
  </div>
  </div>
</template> 

<script>
import Header from "../Components/Header.vue";
import TableOpe from "../Components/TableOperateur.vue";
export default {
    name: "Ticketmain",
        props:{

        tickets: {
            type: Array
        },
        moi : {
            type: Object
        },
        dem: {
            type: Boolean
        },
        resp: {
            type: Boolean
        },
        probleme: {
            type: Array
        }
    },
    data(){
        return {
            title: "Liste des tickets"
        }
    },
    components: {
        Header, TableOpe
    },
    methods: {
    },
    mounted() {
    },
    }
</script>