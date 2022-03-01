<template>
  <section class="ticketzone">
      <p>TICKET NO# {{ id }}</p>
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
        <td>
        </td>
      </tr>
    </table>
    <Link id="retour" class="coolbutton" :href="$route('oneticket', { id })">Retour</Link>
  </section>
</template>

<script>
export default {
  name: "ListeOpe",
data() {
    return {
        id: this.ticket.id
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
  methods: {},
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
</style>