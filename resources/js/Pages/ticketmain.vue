<template>
  <div>
    <Header/>
  <div>
    <TableOpe :tickets="tickets"/> <!-- pour passer le une donnée à un component-->
  </div>
  </div>
</template> 

<script>
import Header from "../Components/Header.vue";
import TableOpe from "../Components/TableOperateur.vue";
export default {
    name: "Ticketmain",
        props:{
        title: {
            type: String
        },
        tickets: {
            type: Array
        },
        username: {
            type: String
        },
        lastname: {
            type: String
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