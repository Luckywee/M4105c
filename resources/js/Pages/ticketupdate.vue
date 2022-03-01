<template>
    <div>
        <Header :title="title"/> <!--Props doit etre dans le header et non sur cette page ou sinon erreur -->
        <div class="majpage">
            <p >Le ticket numéro {{ this.tickets.id }} a été mise à jour !</p>
            <p>Vous serez redirigé vers la page des tickets dans : <b id="showtimer">3</b></p>
        </div>
    </div>
</template>

<script>
import Header from "../Components/Header.vue";
export default {
    name: "ticketupdate",
        props:{
        tickets: {
            type: Object
            }
        },
        data() {
        return {
            title: "Mise a jour du ticket",
            id: this.tickets.id, //yay pour recup les données de la BDD au lieu de faire un "" qui va faire un textarea empty
            }
        },
    components: {
        Header
    },
    methods: {

    },
    mounted(){
        let recule = 2;
        let showtimerrt = document.getElementById('showtimer');
        setInterval(() => {
            showtimerrt.innerText = recule;
            recule--;
            if(recule == 0){
                window.location = "/ticketmain";
            }
        },1000)
    },
    computed: {

    }
}
</script>