<template>
<section class="ticketzone">
    <table>
        <tr>
            <th>ID</th>
            <th>Date création</th>
            <th>Demandeur</th>
            <th>Type problème</th>
            <th>Description</th>
        </tr>
        <tr class="listedestickets" v-for="row in tickets" :key="row">
            <td> {{ row.id }}</td>
            <td>{{ row.datecreation }}</td>
            <td>{{ row.firstname }} {{ row.lastname }}</td>
            <td> {{ row.libelle }}</td>
            <td> {{ row.description }} </td>
        </tr>
    </table>
</section>
</template>

<script>
export default {
    name: "TableOpe",
    data(){
        return {
            title: "Tickets opérateurs",
        }
    },
    props: {
        tickets: Array,
    },
    methods: {

    },
    mounted(){
    }
}
</script>
<style scoped>

.ticketzone{
    margin-top: 100px;
}
table, th, td{
    border: solid 1px;
    margin: auto;
}
th{
    width: 250px;
}
</style>