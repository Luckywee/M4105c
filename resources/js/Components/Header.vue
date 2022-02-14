<template>
    <header id="app">
        <div class="leheader">
            <img id="helpdeskimg" :src="'/img/Helpdesk.png'"/>
            <h1>Liste des tickets</h1>
            <a href="/logout" id="logout" value="logout">Déconnexion</a>
        </div>
        <p id="bienvenu">Bienvenue : </p>
    </header>
</template>

<script>
export default {
    name: "Header",
    data(){
        return {
            title: "Header"
        }
    },
    props: {
        username: String,
        lastname: String
    },
    methods: {

    },
    mounted(){
            let bienvenu = document.getElementById("bienvenu");
            let username = document.querySelector("meta[name='user_firstname']").getAttribute('content'); //le app.blade.php sert à passer du php laravel et avec vueJS on va le chercher avec un querySelector.
            let lastname = document.querySelector("meta[name='user_lastname']").getAttribute('content');
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
div img{
    float: left;
    width: 100px;
    left: 10px;
    top: -15px !important;
}
div a{
    float: right;
    right: 15px;
}
div a, div img{
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