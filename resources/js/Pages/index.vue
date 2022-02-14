<template>
    <div>
        <h1>Hello World</h1>
        <input v-model="title">
        <List :title="title"></List>
        <Link :href="$route('bonjour')">Bonjour !</Link>
    </div>
</template>

<script>
import List from "../Components/List.vue";
export default {
    name: "Index",
    components: {
        List
    },
    props:{
        title: {
            type: String,
            required: true
        },
        items:{

        }
    },
    mounted() {
        setInterval(reloadData, 5000);
    },
    methods: {
        reloadData(){
            this.$inertia.reload();
        }
    }

}
</script>