<template>
  <div>
    <section v-if="hasTicket" class="ticketzone">
      <p v-if="dem">
        Nombre de vos ticket(s) total(s) :
        <b id="countticket">{{ formatedTickets.length }}</b>
      </p>
      <p v-else>
        Nombre de ticket(s) total(s) :
        <b id="countticket">{{ formatedTickets.length }}</b>
      </p>
      <section v-if="rep">
        <label for="selectetat">Trier par état : </label>
        <select v-model="etat">
          <option :value="null">-</option>
          <option :value="1">En attente</option>
          <option :value="2">Résolu</option>
          <option :value="3">Fermé</option>
        </select>
        <label for="selectdem">Trier par problème : </label>
        <select
          v-model="form.idprobleme"
          id="selectdem"
          @change="filtrerparprobleme"
        >
          <option :value="null">-</option>
          <option
            v-for="demandor in typeprobleme"
            :key="demandor.id"
            :v-bind:value="demandor.id">
            {{ demandor.libelle }}
          </option>
        </select>
      </section>
      <table>
        <tr>
          <th>ID</th>
          <th>Date création</th>
          <th>Demandeur</th>
          <th>Type problème</th>
          <th>Description</th>
          <th v-if="!dem">Modifier</th>
          <th v-else>Voir ticket</th>
          <th v-if="rep">Etat du ticket</th>
        </tr>
        <tr
          class="listedestickets"
          @mouseover="ticketMouseOver(row.id)"
          @mouseout="ticketMouseOut()"
          v-for="row in formatedTickets"
          :class="row.id === overTicket ? 'ole' : ''" 
          :key="row.id"
        > <!-- :class condition pour faire un classList. -->
          <td>{{ row.id }}</td>
          <td>{{ row.datecreation }}</td>
          <td>{{ row.firstname }} {{ row.lastname }}</td>
          <td>{{ row.libelle }}</td>
          <td>{{ row.description }}</td>
          <td v-if="!dem">
            <Link
              class="tabmodifier"
              :href="$route('oneticket', { id: row.id })"
            >
              Modifier
            </Link>
          </td>
          <td v-else>
            <Link class="tabvoir" :href="$route('oneticket', { id: row.id })">
              Voir ce ticket
            </Link>
          </td>
          <td class="etatticket" v-if="rep" :class="row.libelle_etat == 'Résolu' ? 'res' : '' || row.libelle_etat == 'En attente' ? 'att' : '' || row.libelle_etat == 'Fermé' ? 'ferm' : ''">{{ row.libelle_etat }}</td>
        </tr>
      </table>
      <div v-if="rep || dem">
        <Link
          id="sendticket"
          class="coolbutton"
          :href="$route('displaymakenewticket')"
          >Créer un nouveau ticket</Link
        >
        <div v-if="rep">
          <Link id="stats" class="coolbutton" :href="$route('stat.view')"
            >Voir les stats</Link
          >
        </div>
      </div>
      <div v-else></div>
    </section>
    <section v-else>
      <p class="noticket">Vous n'avez aucun ticket à regarder.</p>
    </section>
  </div>
</template>

<script>
export default {
  name: "TableOpe",
  props: {
    tickets: {
      type: Array,
    },
    roledem: {
      type: Boolean,
    },
    roleresp: {
      type: Boolean,
    },
    typeprobleme: {
      type: Array,
    },
  },
  data() {
    return {
      dem: this.roledem,
      rep: this.roleresp,
      hasTicket: this.tickets.length != 0,
      form: this.$inertia.form({
        idprobleme: this.typeprobleme.id, //on récup pour ensuite comparer dans le contrôlleur.
      }),
      overTicket: null,
      etat: null,
    };
  },
  filters: {},
  computed: {
    formatedTickets() {
      //pour changer des props
      let newTickets = [];
      this.tickets.forEach((ticket) => {
        //modif normal
        if (!this.etat || this.etat === ticket.etat_id) { //si etat false pas existe ou etat = etat_id | ce etat qui est du select prend en compte les values du option
          newTickets.push({
            //modif avec push direct sans problème et les tickets concernés
            ...ticket,
            datecreation:
              ticket.datecreation.split("-")[2] +
              "/" +
              ticket.datecreation.split("-")[1] +
              "/" +
              ticket.datecreation.split("-")[0],
            //new Date(ticket.datecreation).toLocaleString("fr-FR").split(',')[0]
          });
        }
      });
      return newTickets;
    },
  },
  methods: {
    selectticket(e) {
      //console.log("fegfg");
    },
    filtrerparprobleme(e) {
      this.form.post(route("filtrertype"));
    },
    ticketMouseOver(id) {
      this.overTicket = id;
    },
    ticketMouseOut() {
      this.overTicket = null;
    },
  },
  mounted() {
    let noticket = document.querySelector(".noticket");
    let etats = document.querySelectorAll(".etatticket");
    if (noticket !== null) {
      setInterval(() => {
        noticket.classList.toggle("clignoteomg");
      }, 1000);
    }
    /*if (etats !== null) {
      etats.forEach((ea) => {
        ea.setAttribute(
          "style",
          "background-color: #00b7ff; text-align: center;"
        );
        if (ea.innerText == "Résolu") {
          ea.style.backgroundColor = "#35dd35";
        }
        if (ea.innerText == "Fermé") {
          ea.style.backgroundColor = "gray";
        }
        //console.log("etat?")
      });
    }*/
  },
};
</script>
<style scoped>
.ticketzone {
  margin-top: 100px;
}
table,
th,
td {
  border: solid 1px;
  margin: auto;
}
th {
  width: 250px;
  background: black;
  color: white;
}
#sendticket {
  width: 10%;
}
.tabmodifier,
.tabvoir {
  text-align: center;
  display: block;
  color: blue;
}
.noticket {
  text-align: center;
  display: block;
  margin-top: 15%;
  font-size: 2em;
  color: black;
  transition: color 0.5s ease-in;
}
.noticket.clignoteomg {
  color: red;
}
tr {
  transition: background-color 0.5s ease;
}
.listedestickets.ole {
  background-color: yellow;
}
.etatticket.res{
  background-color: #35dd35;
}
.etatticket.att{
  background-color: #00b7ff;
}
.etatticket.ferm{
  background-color: gray;
}
</style>