<template>
  <section class="ticketzone">
    <form  @submit.prevent="form.post($route('affectationnow', { id }))">
      <p>Affecter le ticket numéro {{ id }}</p>
    <table>
      <tr>
        <th>ID Opérateur</th>
        <th>Prénom et nom</th>
        <th>Compétence</th>
      </tr>
      <tr class="listedestickets" v-for="row in operateurs" :key="row.id">
        <td>{{ row.id }}</td>
        <td>{{ row.firstname }} {{ row.lastname }}</td>
        <td>{{ row.libelle }}</td>
        <input @change="test" id="checkop" type="radio" name="checkop" v-model="form.operateur_id" v-bind:value="row.id"/>
      </tr>
    </table>
    <input type="submit" id="affecterticket" class="coolbutton" value="Affecter le ticket"/>
    </form>
    <Link id="retour" class="coolbutton" :href="$route('oneticket', { id })">Retour</Link>
  </section>
</template>

<script>
export default {
  name: "ListeOpe",
data() {
    return {
       form: this.$inertia.form({
          operateur_id : this.operateurs.id,
          checkd: null
        }),
        id: this.ticket.id,
        compete: this.ticket.lastname
        }
  },
  props: {
    operateurs: { 
      type: Array
    },
    ticket: {
        type: Object
    }
  },
  computed: {
  },
  methods: {
    test(e){
      let checko = document.getElementById('checkop');
      console.log(this.form.operateur_id);
    }
  },
  mounted() { 
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
#checkop {
  left: 0;
}
#affecterticket{
  width: 120px;
  left: 0;
  margin: auto;
  display: block;
  margin-top: 100px;
}
</style>