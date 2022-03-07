<template>
    <div>
        <Header :title="title" :moi="moi"/>
        <div class="majpage">
            <p >Le ticket numéro {{ this.ticket.id }} a été affecté</p>
            <p>Vous serez redirigé vers la page des tickets dans : <b id="showtimer">3</b></p>
        </div>
    </div>
</template>

<script>
import Header from "../Components/Header.vue";
export default {
    name: "ticketEstAffecte",
        props:{
        ticket: {
            type: Array
            },
        moi : {
            type: Object
        }
        },
        data() {
        return {
            title: "Ticket affecté !",
            id: this.ticket.id
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