<template>
  <div>
    <Header :title="title" :moi="moi"/>
  <div id="modifplane" v-for="yourmom in listeticketmodif" :key="yourmom.id">
      <h1>Traiter le ticket de {{ yourmom.firstname }} {{ yourmom.lastname }}</h1><br>
      <h2>Ticket effectué le {{yourmom.datecreation}}</h2>
      <div>
          <form class="modifform" @submit.prevent="form.post($route('updateticket', {id: yourmom.id}))">
              <div>
                <section class="sectionmodif">
                    <label id="typeprobleme" for="typeprobleme">Type problèmes</label>
                    <select id="typeprobleme" name="typeprobleme">
                        <option> {{ yourmom.libelle }} </option>
                        <option v-for="listeprobleme in compareprobleme" :key="listeprobleme.id">{{ listeprobleme.libelle }}</option>
                    </select>
                    <br>
                    <label id="description" for="description">Description</label>
                    <textarea name="description" v-model="form.description">{{ yourmom.description }}</textarea>
                    <label for="piecejointe">Pièce-jointe</label>
                    <div name="piecejointe" class="piecejointe">
                        <img @click="imagezoom" :src="'/img/upload/'+ yourmom.piecejointe" width="200" height="200" />
                    </div>
                </section>
                <section class="sectionmodif leftzero">
                    <label id="etatticket" for="etatticket">État du ticket</label>
                    <select v-model="form.etat_id" id="etatticket" name="etatticket">
                        <option> {{ yourmom.libelle_etat }} </option>
                        <option v-for="listedesetat in compareetat" :key="listedesetat.id" :value="listedesetat.id">{{ listedesetat.libelle_etat }}</option>
                    </select>
                    <br>
                    <label id="commentaire" for="commentaire">Commentaire du opérateur</label>
                    <textarea v-if="roz || rop" name="commentaire" placeholder="Ecrivez votre avis à propos de ce problème." v-model="form.commentaire">{{ yourmom.commentaire }}</textarea>
                    <textarea v-else name="commentaire" placeholder="" disabled v-model="form.commentaire">{{ yourmom.commentaire }}</textarea>                    
                </section>
                </div>
                <br>
              <figure v-if="roz === true || rop === true"> <!-- ou sinon v-if="roz || rop" -->
                    <input type="submit" id="maj" class="coolbutton" value="Mettre à jour"/>
                    <Link id="affecter" class="coolbutton" :href="$route('affecterticket', {id : yourmom.id})">Affecter ce ticket</Link>
                    <a id="retour" class="coolbutton" href="/ticketmain">Retour</a>
              </figure>
                <figure v-else>
                    <a id="retour" class="coolbutton" href="/ticketmain">Retour</a>
              </figure>

          </form>
      </div>
  </div>
  </div>
</template> 

<script>
import Header from "../Components/Header.vue";
var imageclick = 0;
let body = document.querySelector('body');
export default {
    name: "Ticketmodification",
        props:{
        tickets: { //all tickets, j'ai mis ça pour la liste des problèmes
            type: Array
        },
        ticket: {
            type: Object //Ticket::find Object car même en faisant avec le this.tickets on a un "" car c'est devenu un form.attribut
        },
        listeprobleme: {
            type: Array
        },
        listeetat: {
            type: Array
        },
        roleop: {
            type: Boolean
        },
        roleresp: {
            type: Boolean
        },
        moi : {
            type: Object
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                description: this.ticket.description, //yay pour recup les données de la BDD au lieu de faire un "" qui va faire un textarea empty
                commentaire: this.ticket.commentaire,
                etat_id: this.ticket.etat_id
            }),
            title: "Modification du ticket",
            piej: this.ticket.piecejointe,
            roz: this.roleop,
            rop: this.roleresp
        }
    },
    components: {
        Header
    },
    methods: {
        imagezoom(e){
            let modifplane = document.getElementById("modifplane");
            if(imageclick == 0 && this.piej != null){
                imageclick++;
                //console.log('eee image clicked');
                let ay = document.createElement('div');
                let imag = document.createElement('img');
                let exit = document.createElement('div');
                ay.setAttribute('style','width: 80%; height: 600px; background-color: #00010080; position: fixed; display: block; margin: auto; z-index: 10; top:0; right:0; left:0; bottom: 0; text-align: center;');
                exit.setAttribute('style','flot:right; right: 10px; top: 15px; position: absolute; width: 50px; height: 50px; text-align: center; font-size: 2em; cursor: pointer; border-radius: 100%; background-color: white; padding-top: 10px;');
                imag.setAttribute('style','position: relative; height: 80%; margin: auto; display: block; width: 60%;');
                ay.innerText = "Image du ticket : " + this.piej; 
                imag.src = "/img/upload/" + this.piej;
                exit.innerText = "X";
                body.appendChild(ay);
                ay.appendChild(imag);
                ay.appendChild(exit);
                modifplane.style.filter = "blur(8px)";
                exit.addEventListener("click",() => {
                    imageclick = 0;
                    modifplane.style.filter = "blur(0)";
                    ay.remove();
                })
            }

        },
    },
    mounted() {
        let opts = document.querySelectorAll('option');
        console.log(opts)
        opts.forEach((opt) => { //pour tous les options (problemes et etats)
            if (opt.innerText == ""){
                opt.remove();
                console.log("removed");
            }
        })
    },
    computed: {
        listeticketmodif(){
        let modifTickets = [];
        this.tickets.forEach(function(modift){
            if(modift.piecejointe === null){
                modift.piecejointe = "null.png";
            }
            //console.log(modift.commentaire)
            modifTickets.push({
                ...modift,
                datecreation:
                modift.datecreation.split("-")[2] + "/" + modift.datecreation.split("-")[1] + "/" + modift.datecreation.split("-")[0],
            })
            })
            return modifTickets;
        },
        compareprobleme(){
            let lesproblemes = [];
                this.listeprobleme.forEach((pb) => { //pour pas perdre la valeur de this à chaque foreach, comme ça on peut foreach autant de array qu'on veut
                    this.tickets.forEach((lo) => {
                        if(pb.libelle == lo.libelle){
                            delete pb.libelle; 
                        }
                        lesproblemes.push({
                            ...pb,
                        })
                    
                    })
                })
            return lesproblemes;
            },
        compareetat(){
            let lesetats = [];
                this.listeetat.forEach((et) => { 
                    this.tickets.forEach((lt) => {
                        if(et.libelle_etat == lt.libelle_etat){
                            delete et.libelle_etat; //comment remove ou splice ???
                        }
                        lesetats.push({
                            ...et,
                        })
                    
                    })
                })
            return lesetats;
            }
        }
    }
</script>