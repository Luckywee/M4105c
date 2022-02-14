<template>
    <div>
        <h1 id="title"> {{ title }}</h1>
        <Link :href="$route('index')">Index</Link>
    </div>
</template>

<script>
export default {
    name: "Bonjour",
    data(){
        return {
            title: "Bonjour"
        }
    },
    methods: {
    }
}
let i = 0;
setInterval(function(){
    i = i + 20;
    document.querySelector("#title").style.transform = "rotate(" + i + "deg)";
    document.querySelector("#title").style.transition = "transform 1s linear";
},100);
</script>
