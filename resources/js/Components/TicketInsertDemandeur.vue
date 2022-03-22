<template>
    <div>
        <form enctype="multipart/form-data" @submit.prevent="form.post($route('insererticket'))">
            <section>
                <p>La date à laquel votre ticket va être envoyé <b id="timenow"></b></p>
                <label for="typeasaisir">Quel est votre type de problème ?</label>
                <select v-model="form.type_probleme_id" name="typeasaisir">
                    <option id="problemeselect" v-for="listederoul in listeprobleme" :key="listederoul.id" :value="listederoul.id">{{listederoul.libelle}}</option>
                </select>
                <b v-if="form.errors.type_probleme_id" class="text-danger">Un type problème est requis.</b> <!-- v-if avec message de base dom-->
                <br>
                <article>
                    <label for="description">La description de votre problème ?</label>
                    <textarea v-model="form.description" maxlength = "250" name="description"></textarea>
                    <p id="textlen" :class="form.description.length == 250 ? 'max' : ''">{{form.description.length}}/250</p>
                    <b v-if="form.errors.description" class="text-danger">Une description est requise.</b>
                </article>
            </section>
            <section>
                <label for="uploadfile">Mettre en ligne des pièces-jointes</label>
                <input type="file" name="uploadfile" id="uploader" ref="photo" @input="form.piecejointe = $event.target.files[0]"/>
            </section>
            <input type="submit" id="inserer" class="coolbutton" value="INSERER TICKET"/>
            <a id="retour" class="coolbutton xl" href="/ticketmain">Retour vers la liste des tickets</a>
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
#textlen{
    position: absolute;
    right: 0;
    float: right;
    display: block;
    width: 42%;
    font-size: 1.5em;
    transform: scale(1);
    transition: transform 0.5s ease;
}
#textlen.max{
    color: red;
    animation: descriptionmax infinite 0.5s ease alternate-reverse;
}
.xl{
    width: 20%;
}
@keyframes descriptionmax{
    From {transform: scale(0.75);}
    to {transform: scale(1);}
}
</style>