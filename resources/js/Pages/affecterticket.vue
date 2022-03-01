<template>
    <div>
        <Header :title="title"/> <!--Props doit etre dans le header et non sur cette page ou sinon erreur -->
        <div class="listeoperateur">
            <ListeOpe :operateurs="operateurs" :ticket="ticket"/>
        </div>
    </div>
</template>

<script>
import Header from "../Components/Header.vue";
import ListeOpe from "../Components/ListeOperateurs.vue";
export default {
    name: "affecterticket",
        props:{
        operateurs: {
            type: Array
            },
        ticket: {
            type: Object
        }
        },
        data() {
        return {
            title: "Affecter le ticket"
            }
        },
    components: {
        Header, ListeOpe
    },
    methods: {

    },
    mounted(){
    },
    computed: {

    }
}
</script>