<template>
  <section class="ticketzone">
    <p v-if="dem">Nombre de vos ticket(s) total(s) : <b id="countticket"></b></p>
    <p v-else>Nombre de ticket(s) total(s) : <b id="countticket"></b></p>
    <table>
      <tr>
        <th>ID</th>
        <th>Date création</th>
        <th>Demandeur</th>
        <th>Type problème</th>
        <th>Description</th>
        <th>Modifier</th>
      </tr>
      <tr class="listedestickets" v-for="row in formatedTickets" :key="row.id">
        <td>{{ row.id }}</td>
        <td>{{ row.datecreation }}</td>
        <td>{{ row.firstname }} {{ row.lastname }}</td>
        <td>{{ row.libelle }}</td>
        <td>{{ row.description }}</td>
        <td>
          <Link :href="$route('oneticket', { id: row.id })">
            Modifier
          </Link>
        </td>
      </tr>
    </table>
    <div v-if="rep || dem">
      <Link id="sendticket" class="coolbutton" :href="$route('displaymakenewticket')">Créer un nouveau ticket</Link>
    </div>
    <div v-else>
    </div>
  </section>
</template>

<script>
export default {
  name: "TableOpe",
  props: {
    tickets: { 
      type: Array
    },
    roledem: {
      type: Boolean
    },
    roleresp: {
      type: Boolean
    }
  },
  data(){
    return {
            dem: this.roledem,
            rep: this.roleresp
    }
  },
  computed: {
    formatedTickets() {
      //pour changer des props
      let newTickets = [];
      this.tickets.forEach((ticket) => {
        //modif normal
        //if(ticket.libelle === 'Logiciel') { ticket.libelle = "a" + ticket.libelle}
        newTickets.push({
          //modif avec push direct sans problème
          ...ticket,
          datecreation:
            ticket.datecreation.split("-")[2] + "/" + ticket.datecreation.split("-")[1] + "/" + ticket.datecreation.split("-")[0],
          //new Date(ticket.datecreation).toLocaleString("fr-FR").split(',')[0]
        });
      });

      return newTickets;
    },
  },
  methods: {},
  mounted() { 
    const tr = document.querySelectorAll(".listedestickets"); 
    let countticket = document.getElementById("countticket");                
    for(let l = 0; l < tr.length; l++){
       //l++;
       countticket.innerHTML = l+1;
    }
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
}
</style>