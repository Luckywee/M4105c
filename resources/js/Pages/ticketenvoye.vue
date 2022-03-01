<template>
    <div>
        <Header :title="title"/>   
        <div class="majpage">
            <p >Le nouveau ticket numéro {{ this.tickets.id }} a été enregistré</p>
            <p>Vous serez redirigé vers la page des tickets dans : <b id="showtimer">3</b></p>
        </div>
    </div>
</template>

<script>
import Header from "../Components/Header.vue";
export default {
    name: "ticketenvoye",
        props:{
        tickets: {
            type: Array
            }
        },
        data() {
        return {
            title: "Ticket inséré !",
            id: this.tickets.id
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