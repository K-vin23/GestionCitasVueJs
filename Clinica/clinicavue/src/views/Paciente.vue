<template>
  <Header/>
  <div class="container border border-primary px-0 my-2">
    <!-- encabezado -->
    <div class="container p-3 mt-0 my-3 bg-primary text-white d-flex justify-content-center">
      <span class="material-symbols-outlined" id="main-icon">
        person_2
      </span><h1 class="text-center  w-0 mx-2">Consulta de pacientes</h1>
    </div>
    <!-- opciones -->
    <div class="btn-group my-3">
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('registro')">Registrar nuevo paciente</button>
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('lista')">Lista de pacientes</button>
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('search')">Buscar paciente</button>  
    </div>
    <!-- mensaje por defecto -->
    <div class="container my-3" v-if="opciones.defect">
      <h1>Selecciona una opción para mostrar</h1>
    </div>
    <!-- busqueda -->
    <div class="input-group container my-2" id="srch" v-if="opciones.search">
      <input type="search" class="form-control rounded" placeholder="Identificacion del paciente" aria-label="Search" aria-describedby="search-addon" v-model="idse"/>
      <button type="button" class="btn btn-outline-primary" v-on:click="srchPaciente(idse)">buscar</button>
      <button type="button" class="btn btn-outline-danger" v-if="opciones.isearch" v-on:click="getPacientes()">restablecer</button>
    </div>
    <!-- popup -->
    <div class="alert alert-success alert-dismissible mx-3 py-1" v-show="opciones.isadd || opciones.isdelete">
      <strong>Success!</strong> <p v-if="opciones.isadd">{{opciones.isedit? "Paciente agregado" : "Paciente editado" }}</p>
      <p v-else-if="opciones.isdelete">Paciente eliminado</p>  correctamente.
      <button type="button" class="close btn" data-dismiss="alert" v-on:click="opciones.isadd = false">&times;</button>
    </div>
    <!-- form registro -->
    <div class="container my-3" id="reg" v-if="opciones.registra">
      <form @submit.prevent="addPaciente" class="was-validated mx-3">
        <div class="form-group">
          <label for="sel1">Tipo documento:</label>
          <select v-model="paciente.tipo_documento" class="form-control" id="sel1" required>
            <option disabled value="">Seleccionar</option>
            <option v-for="tipodoc in tipodocs" :key="tipodoc.id_tipodoc" :value="tipodoc.id_tipodoc">{{ tipodoc.tipo_documento }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="ident" class="my-2">Identificacion:</label>
          <input type="text" class="form-control" placeholder="Ident." v-model="paciente.id_paciente" id="ident" required>
        </div>
        <div class="form-group">
          <label for="nomb" class="my-2">Nombre:</label>
          <input type="text" class="form-control" placeholder="Nombre" v-model="paciente.nombre" id="nomb" required>
        </div>
        <div class="form-group">
          <label for="tel" class="my-2">Telefono:</label>
          <input type="text" class="form-control" placeholder="Telefono" v-model="paciente.telefono" id="tel" required>
        </div>
        <div class="form-group">
          <button class="btn btn-primary my-4 container-fluid">{{opciones.isedit? "Editar Paciente" : "Nuevo paciente" }}</button>
        </div>
      </form>
    </div>
    <!-- lista datos-->
    <div class="container" id="list" v-if="opciones.lista">
      <table class="table table-bordered table-light table-hover">
        <thead class="table-info">
          <tr>
            <th>Identificacion</th>
            <th>Tipo Documento</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Opcion</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="paciente in pacientes" :key="paciente.id_paciente">
            <td>{{ paciente.id_paciente }}</td>
            <td>{{ paciente.tipo_documento }}</td>
            <td>{{ paciente.nombre }}</td>
            <td>{{ paciente.telefono }}</td>
            <td><button v-on:click="editPaciente(paciente.id_paciente)" class="btn btn-success my-3 mx-1" v-if="paciente.id_paciente != undefined">Editar</button><button v-on:click="deletePaciente(paciente.id_paciente)" class="btn btn-danger my-3 mx-1" v-if="paciente.id_paciente != undefined">Eliminar</button></td>
          </tr>
        </tbody>
      </table>
      <div v-if@prevent="pacientes == false || pacientes.error == false">
       <h1>no hay datos para mostrar</h1>
      </div>
    </div>
  </div>
</template>
<script>
import Header from '@/components/Header.vue';
export default {
  components:{
      Header
  },
  data(){
    return {
      pacientes: null,
      tipodocs: [],
      opciones: {defect: true, isedit: false, isadd: false, registra: false, lista:false, search: false, isearch: false, isdelete: false},
      idse: '',
      paciente: {id_paciente:'', tipo_documento:'', nombre:'', telefono: ''}
       }
    },
    methods:{
     //Contenidos por opciones
     mostrar:function(tipo){
      if(tipo == 'registro'){
        if(this.opciones.registra && this.opciones.search || this.opciones.registra && this.opciones.lista){
          this.opciones.registra = false;
          this.opciones.defect = false;
        }else if(this.opciones.registra){
          this.opciones.registra = false;
          this.opciones.defect = true;
        }else{
          this.opciones.registra = true;
          this.opciones.defect = false;
        }
      }else if(tipo == 'lista'){
        if(this.opciones.lista && this.opciones.search || this.opciones.lista && this.opciones.registra){
          this.opciones.lista = false;
          this.opciones.defect = false;
        }else if(this.opciones.lista){
          this.opciones.lista = false;
          this.opciones.defect = true;
        }else{
          this.opciones.lista = true;
          this.opciones.defect = false;
        }
      }else if(tipo == 'search'){
        if(this.opciones.lista && this.opciones.search || this.opciones.search && this.opciones.registra){
          this.opciones.search = false;
          this.opciones.defect = false;
        }else if(this.opciones.search){
          this.opciones.search = false;
          this.opciones.defect = true;
        }else{
          this.opciones.search = true;
          this.opciones.defect = false;
        }
      }
     }, 
     //traer campos necesarios
     getUtilities:function(){
      const id = "tipodoc"
      this.$http.get("vista/utilities/?id="+id)
              .then(respuesta => {
                console.log(respuesta.data)
                this.tipodocs = respuesta.data
              })
              .catch(error => {console.log(error) })            
     },
    //traer del api
     addPaciente:function(e){
      if(this.opciones.isedit){
        const obj = this.paciente;
        console.log(obj);
        this.$http.put("vista/paciente/" ,obj)
          .then(respuesta => {
          console.log(respuesta.data)
          this.paciente = {id_paciente: "", tipo_documento: "", nombre: "", telefono: ""};
          this.getPacientes()
          this.opciones.isadd = true;
          this.opciones.isedit = false;
        }).catch(error => {console.log(error) })
      }else{
        const obj = this.paciente;
        console.log(obj);
        this.$http.post("vista/paciente/" ,obj)
          .then(respuesta => {
            console.log(respuesta.data)
            this.paciente = {id_paciente: "", tipo_documento: "", nombre: "", telefono: ""};
            this.opciones.isadd = true;
            this.getPacientes()
          }).catch(error => {console.log(error) })
      }
     },
     //agregar a la api
     getPacientes:function(){
      if(this.opciones.isearch){
          this.opciones.isearch = false
          this.idse = ""
        }
      this.$http.get("vista/paciente/")
              .then(respuesta => {
                 this.pacientes = respuesta.data
                 console.log(respuesta.data)
                console.log(this.pacientes) })
              .catch(error => {console.log(error) })
     },
     //editar obteniendo el id [del paciente]
     editPaciente:function(id){
      this.$http.get("vista/paciente/?id="+id)
              .then(respuesta => {
                 this.paciente ={id_paciente: respuesta.data.id_paciente, tipo_documento: respuesta.data.tipo_documento, nombre: respuesta.data.nombre, telefono: respuesta.data.telefono};
                 this.opciones.isedit = true;
                 this.opciones.registra = true;
                 console.log(respuesta.data)
                 })
              .catch(error => {console.log(error) })
     },
     //eliminar de la api 
     deletePaciente:function(id){
      this.$http.delete("vista/paciente/?id="+id)
              .then(respuesta => {
                 console.log(respuesta.data)
                 this.getPacientes()
                 opciones.isdelete = true;
                 })
              .catch(error => {console.log(error) })
     },
     //buscar en la api
     srchPaciente:function(id){
        this.$http.get("vista/paciente/?ids="+id)
              .then(respuesta => {
                this.pacientes = respuesta.data
                this.opciones.lista = true
                this.opciones.isearch = true
                 console.log(respuesta.data)
                 })
              .catch(error => {console.log(error) })
     }

    },
    created:function(){
      this.getPacientes();
      this.getUtilities();
    }
  }
</script>
<style>

</style>