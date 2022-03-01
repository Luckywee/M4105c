<template>
  <div>
    <section id="headerlogin">
      <h1>Connexion</h1>
	    <img id="helpdeskimg" :src="'/img/Helpdesk.png'"/>
    </section>
    <form @submit.prevent="form.post($route('login'))">
      <div>       
        <label for="email">E-mail : </label>
        <input id="email" type="email" v-model="form.email" placeholder="Email" />
          <b v-if="form.errors.email" class="text-danger">
            {{ form.errors.email }}</b>
      </div>
      <div>
        <label for="password">Password : </label>
        <input id="password" type="password" v-model="form.password" placeholder="Mot de passe"/>
          <b v-if="form.errors.password" class="text-danger"> {{ form.errors.password }}</b>
      </div>
      <input type="submit" id="logmein" value="Connexion" />
    </form>
  </div>
</template>

<script>
export default {
  name: "login",
  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
      }),
    };
  },
  name: 'headerlogin', //custom fonction JS
  mounted() {
    let helpdeskimg = document.getElementById("helpdeskimg");
    let logmein = document.getElementById("logmein");
    helpdeskimg.setAttribute("style","margin: auto; width: 200px; display: block;");
          //en gros ça disable le button, comme ça la personne ne spam pas si un input est vide
          let loginbuttondisabled = (state) => {
            if(state){
              logmein.disabled=true;
              logmein.style.backgroundColor = "grey";
            } else {
              logmein.disabled=false;
              logmein.style.backgroundColor = "black";
            }
          }
          var urmom = () => {
              if(email.value == "" || password.value == "") {
                loginbuttondisabled(true);
              } else {
                loginbuttondisabled(false);
              }     
            }
          window.addEventListener("load", function(){ //pendant le chargement
            urmom();
          });
          window.addEventListener("click", function(){
            urmom();
          });  
          email.addEventListener("change", function(){
              urmom();
          });
          password.addEventListener("change", function(){
              urmom();
          });
  },
};
</script>
