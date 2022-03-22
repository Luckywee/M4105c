<template>
  <div>
    <section id="headerlogin">
      <h1>Connexion</h1>
	    <img id="helpdeskimg" :src="'/img/Helpdesk.png'"/>
    </section>
    <form @submit.prevent="form.post($route('login'))">
      <div>       
        <label id="inputemail" for="email">E-mail : </label>
        <input @change="checkifeverythingok" id="email" type="email" v-model="form.email" placeholder="Email" />
          <b v-if="form.errors.email" class="text-danger">
            {{ form.errors.email }}</b>
      </div>
      <div>
        <label id="inputpass" for="password">Mot de passe : </label>
        <input @change="checkifeverythingok" id="password" type="password" v-model="form.password" placeholder="Mot de passe"/>
          <b v-if="form.errors.password" class="text-danger"> {{ form.errors.password }}</b>
      </div>
      <input :disabled="buttondisabled" :class="buttondisabled === true ? 'disabled' : ''" type="submit" id="logmein" value="Connexion" />
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
      buttondisabled: true,
    };
  },
  //name: 'headerlogin', //custom fonction JS
  methods: {
    checkifeverythingok(ev){ //nouveau code pour check si on a mis ou non des données dans les deux champs. (v-model email et password)
      if(email.value == "" || password.value == ""){
          this.buttondisabled = true;
      } else if (email.value !== "" && password.value !== ""){
        this.buttondisabled = false;
    }
    }
  },
  mounted() {
    let helpdeskimg = document.getElementById("helpdeskimg");
    let logmein = document.getElementById("logmein");
    helpdeskimg.setAttribute("style","margin: auto; width: 200px; display: block;");
          //en gros ça disable le button, comme ça la personne ne spam pas si un input est vide
          /*let loginbuttondisabled = (state) => {
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
          });*/
  },
};
</script>
