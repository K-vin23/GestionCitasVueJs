<template>
  <div class="container-fluid">
    <div class="container-fluid p-3 my-3 bg-primary text-white">
        <h1 class="text-center">Bienvenido de nuevo</h1>
    </div>
      <div class="alert alert-danger alert-dismissible mx-3 py-1" v-if="resp.error">
      <strong>Error!</strong> Usuario o contraseña incorrectos.
      <button type="button" class="close btn" data-dismiss="alert" v-on:click="resp = false">&times;</button>
      </div>

    <div class="d-flex justify-content-center align-items-center" style="margin-top: 2%;">
            <div class="col-md-4 p-5 shadow-sm border rounded-5 border-primary">
                <h2 class="text-center mb-4 text-primary">Inicia Sesion</h2>
                <form @submit.prevent="verifyUser">
                    <div class="mb-3">
                        <label for="us" class="form-label">Identificacion</label>
                        <input type="text" class="form-control border border-primary" id="us" aria-describedby="emailHelp" v-model="identi">
                    </div>
                    <div class="mb-3">
                        <label for="con" class="form-label">Contraseña</label>
                        <input type="password" class="form-control border border-primary" id="con" v-model="pss">
                    </div>
                    <p class="small"><a class="text-primary">Olvidaste tu contraseña?</a></p>
                    <div class="d-grid">
                        <button class="btn btn-primary">Entrar</button>
                    </div>
                </form>
            </div>
        </div>

   <div>
    <!-- <h1>{{ console.log(roles) }}</h1> -->
    <!-- <li v-for="rol in roles" :key="rol.id_rol">
       {{ rol.id_rol }} - {{ rol.rol }}
    </li> -->
   </div>
  </div>
</template>

<script>
export default {
  
  data(){
    return {
      usuario: [],
      identi: '',
      pss: '',
      resp:'',
       }
    },
    methods:{
     verifyUser:function(){
      let identificacion = this.identi;
      let psswd = this.pss;
      const obj = {identificacion, psswd};
      this.$http.post("vista/usuario/", obj)
              .then(respuesta => {
                 this.resp = respuesta.data
                 console.log(respuesta.data)
                 console.log(this.resp)
                 if(this.resp.error == false){
                  this.$router.push('/home')
                 }
                 })
              .catch(error => {console.log(error) })
     }
    },
    created:function(){
    }
  }
</script>

<style>

</style>