<template>
    <div class="list">
        <h1>{{ title }}</h1>
        <ul>
            <li v-for="element in items" :key="element">
                {{ element }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "List",
    props: {
        title: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            items: [
                "Element 1",
                "Element 2",
                "Element 3",
                "Element 4"
            ]
        }
    },
    computed: {
       titleUppercase(){
           this.title.toUpperCase();
       } 
    }
}
</script>

<style scoped>
.list{
    border: 2px solid black;
    padding: 0.5rem;
    margin-top: 1rem;
    width: 90%;
    margin: auto;
}
.list ul li{
    border: solid 1px black;
    margin: 10px auto;
}
</style>