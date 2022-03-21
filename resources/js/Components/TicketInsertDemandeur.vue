<template>
    <div>
        <form enctype="multipart/form-data" @submit.prevent="form.post($route('insererticket'))">
            <section>
                <p>La date à laquel votre ticket va être envoyé <b id="timenow"></b></p>
                <label for="typeasaisir">Quel est votre type de problème ?</label>
                <select v-model="form.type_probleme_id" name="typeasaisir">
                    <option id="problemeselect" v-for="listederoul in listeprobleme" :key="listederoul.id" :value="listederoul.id">{{ listederoul.libelle}}</option>
                </select>
                <br>
                <label for="description">La description de votre problème ?</label>
                <textarea v-model="form.description" maxlength = "250" name="description"></textarea>
            </section>
            <section>
                <label for="uploadfile">Mettre en ligne des pièces-jointes</label>
                <input type="file" name="uploadfile" id="uploader" ref="photo" @input="form.piecejointe = $event.target.files[0]"/>
            </section>
            <input type="submit" id="inserer" class="coolbutton" value="INSERER TICKET"/>
        </form>
    </div>
</template>

<script>
export default {
    name: "ticketform",
        props:{
        tickets: {
            type: Array
        },
        listeprobleme : {
            type: Array
        }

    },
    data() {
        return {
            title: "Formulaire de ticket",
             form: this.$inertia.form({ //recup du formulaire avec v-model="form..."
                 description: "", //quand la page s'affiche en post, on aura des nouvelle données. Genre description.setText("") comme en Java pour faire un champs vide
                 type_probleme_id: this.tickets.type_probleme_id,
                 '_method': 'POST',
                 piecejointe: ""
                 //piecejointe: this.tickets.piecejointe
             }),
            }
        },
    components: {
    },
    methods: {
        /*nomfichier(event){
        let uploader = document.querySelector('#uploader');
        //console.log(event.target.files[0]);
        return uploader.value = event.target.files[0].name;
        },*/
        submit() {
            /*if (this.$refs.photo) {
                this.form.piecejointe = this.$refs.photo.files[0];
            }*/
            this.form.post(route("insererticket"));
        }
    },
    mounted(){
        let timenow = document.querySelector('#timenow');
        //let datre = Date.now();
        timenow.innerText = new Date(Date.now()).toLocaleString().split(',')[0]; 
    },
    computed: {

    },
}
</script>

<style scoped>
form section{
    display: block;
    position: relative;
    text-align: center;
    margin-top: 50px;
}
</style>