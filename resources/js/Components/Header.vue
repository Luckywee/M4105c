<template>
    <header id="app">
        <div class="leheader">
            <img @click="gohome" id="helpdeskimg" :src="'/img/Helpdesk.png'"/>
            <h1 id="title">{{ title }}</h1>
            <a href="/logout" id="logout" value="logout">Déconnexion</a>
        </div>
        <p id="bienvenu">Bienvenue : </p>
    </header>
</template>

<script>
export default {
    name: "Header",
    props: {
        title: {
            type: String
        }
    },
    methods: {
            gohome(event){
                window.location = '/ticketmain';
            }
    },
    mounted(){
            let bienvenu = document.getElementById("bienvenu");
            let username = document.querySelector("meta[name='user_firstname']").getAttribute('content'); //le app.blade.php sert à passer du php laravel et avec vueJS on va le chercher avec un querySelector.
            let lastname = document.querySelector("meta[name='user_lastname']").getAttribute('content');
            let imggohome = document.getElementById('helpdeskimg');
            function displayuserinfo(){
                if(username == "Defaut" && lastname == "Defaut"){
                    document.location.reload();
                } else {
                    bienvenu.innerText += " " + username + " " + lastname;
                }
            }
            displayuserinfo();
    }
}
</script>

<style scoped>
header{
    top: 0;
    position: relative;
    border-bottom: solid 1px;
    display: block;
    height: 110px;
    width: 100%;
}
div{
    position: relative;
    margin-top: 20px;
}
img{
    float: left;
    width: 100px;
    left: 10px;
    top: -15px !important;
}
#helpdeskimg{
    cursor: pointer;
}
div a{
    float: right;
    right: 15px;
}
div a, img{
    position: absolute;
    top: 20px;
}
#logout{
    border: none;
    background-color: black;
    padding: 10px;
    color: white;
}
#bienvenu{
    bottom: 0;
    position: absolute;
}
</style>