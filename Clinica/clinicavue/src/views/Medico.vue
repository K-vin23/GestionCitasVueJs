<template>
  <Header/>
  <div class="container border border-primary px-0 my-2">
    <!-- encabezado -->
    <div class="container p-3 mt-0 my-3 bg-primary text-white d-flex justify-content-center">
      <span class="material-symbols-outlined" id="main-icon">
        stethoscope
      </span><h1 class="text-center w-0 mx-2">Consulta de medicos</h1>
    </div>
    <!-- opciones -->
    <div class="btn-group my-3">
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('registro')">Registrar nuevo medico</button>
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('lista')">Lista de medicos</button>
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('search')">Buscar medico</button>  
      </div>
    <!-- mensaje por defecto -->
    <div class="container my-3" v-if="opciones.defect">
      <h1>Selecciona una opción para mostrar</h1>
    </div>
    <!-- busqueda -->
    <div class="input-group container my-2" id="srch" v-if="opciones.search">
      <input type="search" class="form-control rounded" placeholder="Identificacion del medico" aria-label="Search" aria-describedby="search-addon" v-model="idse"/>
      <button type="button" class="btn btn-outline-primary" v-on:click="srchMedico(idse)">buscar</button>
      <button type="button" class="btn btn-outline-danger" v-if="opciones.isearch" v-on:click="getMedicos()">restablecer</button>
    </div>
    <!-- popup -->
    <div class="alert alert-success alert-dismissible mx-3 py-1" v-show="opciones.isadd || opciones.isdelete">
      <strong>Success!</strong> <p v-if="opciones.isadd">{{opciones.isedit? "Medico agregado" : "Medico editado" }}</p>
      <p v-else-if="opciones.isdelete">Medico eliminado</p> correctamente.
      <button type="button" class="close btn" data-dismiss="alert" v-on:click="opciones.isadd = false, opciones.isdelete = false">&times;</button>
    </div>
    <!-- form registro -->
    <div class="container my-3" id="reg" v-if="opciones.registra">
      <form @submit.prevent="addMedico" class="was-validated mx-3">
        <div class="form-group">
          <label for="sel1">Tipo documento:</label>
          <select v-model="medico.tipo_documento" class="form-control" id="sel1" required>
            <option disabled value="">Seleccionar</option>
            <option v-for="tipodoc in tipodocs" :key="tipodoc.id_tipodoc" :value="tipodoc.id_tipodoc">{{ tipodoc.tipo_documento }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="ident" class="my-2">Identificacion:</label>
          <input type="text" class="form-control" placeholder="Ident." v-model="medico.id_medico" id="ident" required>
        </div>
        <div class="form-group">
          <label for="nomb" class="my-2">Nombre:</label>
          <input type="text" class="form-control" placeholder="Nombre" v-model="medico.nombre" id="nomb" required>
        </div>
        <div class="form-group">
          <label for="tel" class="my-2">Telefono:</label>
          <input type="text" class="form-control" placeholder="Telefono" v-model="medico.telefono" id="tel" required>
        </div>
        <div class="form-group">
          <label for="sela" class="my-2">Area:</label>
          <select v-model="medico.area" class="form-control" id="sela" required>
            <option disabled value="">Seleccionar</option>
            <option v-for="area in areas" :key="area.id_area" :value="area.id_area">{{ area.area }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="selc" class="my-2">Clinica:</label>
          <select v-model="medico.clinica" class="form-control" id="selc" required>
            <option disabled value="">Seleccionar</option>
            <option v-for="clinica in clinicas" :key="clinica.id_clinica" :value="clinica.id_clinica">{{ clinica.clinica }}</option>
          </select>
        </div>
        <div class="form-group">
          <button class="btn btn-primary my-4 container-fluid">{{opciones.isedit? "Editar Medico" : "Nuevo Medico" }}</button>
        </div>
      </form>
    </div>
    <!-- lista datos-->
    <div class="container" id="list" v-if="opciones.lista">
      <table class="table table-bordered table-light table-hover">
        <thead class="table-primary">
          <tr>
            <th>Identificacion</th>
            <th>Nombre</th>
            <th>Area</th>
            <th>Clinica</th>
            <th>Telefono</th>
            <th>Opcion</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="medico in medicos" :key="medico.id_medico">
            <td>{{ medico.id_medico }}</td>
            <td>{{ medico.nombre }}</td>
            <td>{{ medico.area }}</td>
            <td>{{ medico.clinica }}</td>
            <td>{{ medico.telefono }}</td>
            <td><button v-on:click="editMedico(medico.id_medico)" class="btn btn-success my-3 mx-1"  v-if="medico.id_medico != undefined">Editar</button><button v-on:click="deleteMedico(medico.id_medico)" class="btn btn-danger my-3 mx-1"  v-if="medico.id_medico != undefined">Eliminar</button></td>
          </tr>
     
        </tbody>
      </table>
      <div v-if@prevent="medicos == false || medicos.error == false">
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
      medicos: [],
      tipodocs: [],
      areas: [],
      clinicas: [],
      opciones: {defect: true, isedit: false, isadd: false, registra: false, lista:false, search: false, isearch: false, isdelete: false,},
      idse: '',
      medico: {id_medico:'', tipo_documento:'', area: '', clinica: '', nombre:'', telefono: ''}
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
      const id = ["tipodoc", "area", "clinica"]
      this.$http.get("vista/utilities/?id="+id[0])
              .then(respuesta => {
                console.log(respuesta.data)
                this.tipodocs = respuesta.data
              })
              .catch(error => {console.log(error) })
      this.$http.get("vista/utilities/?id="+id[1])
              .then(respuesta => {
                console.log(respuesta.data)
                this.areas = respuesta.data
              })
              .catch(error => {console.log(error) })  
      this.$http.get("vista/utilities/?id="+id[2])
              .then(respuesta => {
                console.log(respuesta.data)
                this.clinicas = respuesta.data
              })
              .catch(error => {console.log(error) })                      
     },
     //traer del api
     getMedicos:function(){
      if(this.opciones.isearch){
          this.opciones.isearch = false
          this.idse = ""
        }
      this.$http.get("vista/medico/")
              .then(respuesta => {
                 this.medicos = respuesta.data
                console.log(this.medicos)
              })
              .catch(error => {console.log(error) })
     },
     //agregar a la api
     addMedico:function(e){
      if(this.opciones.isedit){
        const obj = this.medico;
        console.log(obj);
        this.$http.put("vista/medico/" ,obj)
          .then(respuesta => {
          console.log(respuesta.data)
          this.medico = {id_medico: "", tipo_documento: "", area: "", clinica: "", nombre: "", telefono: ""};
          this.getMedicos()
          this.opciones.isedit = false;
          this.opciones.isadd = true;
        }).catch(error => {console.log(error) })
      }else{
        const obj = this.medico;
        console.log(obj);
        this.$http.post("vista/medico/" ,obj)
          .then(respuesta => {
            console.log(respuesta.data)
            this.medico = {id_medico: "", tipo_documento: "", area: "", clinica: "", nombre: "", telefono: ""};
            this.opciones.isadd = true;
            this.getMedicos()
          }).catch(error => {console.log(error) })
      }
     },
     //editar obteniendo el id [del medico]
     editMedico:function(id){
      this.$http.get("vista/medico/?id="+id)
              .then(respuesta => {
                 this.medico = {id_medico: respuesta.data.id_medico, tipo_documento: respuesta.data.tipo_documento, area: respuesta.data.id_area, clinica: respuesta.data.id_clinica, nombre: respuesta.data.nombre, telefono: respuesta.data.telefono};
                 console.log(respuesta.data)
                 this.opciones.isedit = true;
                 this.opciones.registra = true;
                 })
              .catch(error => {console.log(error) })
     },
     //eliminar de la api 
     deleteMedico:function(id){
      this.$http.delete("vista/medico/?id="+id)
              .then(respuesta => {
                 console.log(respuesta.data)
                 this.getMedicos()
                 opciones.isdelete = true;
                 })
              .catch(error => {console.log(error) })
     },
     //buscar en la api
     srchMedico:function(id){
        this.$http.get("vista/medico/?ids="+id)
              .then(respuesta => {
                this.medicos = respuesta.data
                this.opciones.lista = true
                this.opciones.isearch = true
                 console.log(respuesta.data)
                 })
              .catch(error => {console.log(error) })
     }
    },
    created:function(){
      this.getMedicos();
      this.getUtilities();
    }
  }
</script>
<style>


</style>