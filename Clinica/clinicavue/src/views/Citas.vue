<template>
  <Header/>
  <div class="container border border-primary px-0 my-2">
    <!-- encabezado -->
    <div class="container p-3 mt-0 my-3 bg-primary text-white text d-flex justify-content-center">
      <span class="material-symbols-outlined" id="main-icon">
        clinical_notes
      </span><h1 class="text-center w-0 mx-2">Consulta de citas</h1>
    </div>
    <!-- opciones -->
    <div class="btn-group my-3">
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('registro')">Registrar nueva cita</button>
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('lista')">Lista de citas</button>
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('search')">Buscar cita </button>
    </div>
    <!-- mensaje por defecto -->
    <div class="container my-3" v-if="opciones.defect">
      <h1>Selecciona una opción para mostrar</h1>
    </div>
    <!-- busqueda -->
    <div class="input-group container my-2" id="srch" v-if="opciones.search">
      <input type="search" class="form-control rounded" placeholder="Identificacion del paciente" aria-label="Search" aria-describedby="search-addon" v-model="idse"/>
      <button type="button" class="btn btn-outline-primary" v-on:click="srchCita(idse)">buscar</button>
      <button type="button" class="btn btn-outline-danger" v-if="opciones.isearch" v-on:click="getCitas()">restablecer</button>
    </div>
    <!-- popup -->
    <div class="alert alert-success alert-dismissible mx-3 py-1" v-show="opciones.isadd">
      <strong>Success!</strong> {{opciones.isedit? "Cita agregada" : "Cita editada" }} correctamente.
      <button type="button" class="close btn" data-dismiss="alert" v-on:click="opciones.isadd = false">&times;</button>
    </div>
    <!-- form registro -->
    <div class="container my-3" id="reg" v-if="opciones.registra">
      <form @submit.prevent="addCita" class="was-validated mx-3">
        <div class="form-group">
          <label for="a" class="my-2">Numero de cita</label>
          <input type="number" class="form-control" placeholder="" v-model="cita.numero_cita" id="a" disabled>
        </div>
        <div class="form-group">
          <label for="selc" class="my-2">Clinica:</label>
          <select v-model="cita.id_clinica" class="form-control" id="selc" required>
            <option disabled value="">Seleccionar</option>
            <option  v-for="clinica in clinicas" :key="clinica.id_clinica" :value="clinica.id_clinica">{{ clinica.clinica }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="identp" class="my-2">Identificacion Paciente:</label>
          <input type="text" class="form-control" placeholder="Identificacion" v-model="cita.id_paciente" id="identp" required>
        </div>
        <div class="form-group">
          <label for="identm" class="my-2">Identificacion Medico:</label>
          <input type="text" class="form-control" placeholder="Identificacion" v-model="cita.id_medico" id="identm" required>
        </div>
        <div class="form-group">
          <label for="seld" class="my-2">Tipo de cita:</label>
          <select v-model="cita.tipo_cita" class="form-control" id="seld" required>
            <option disabled value="">Seleccionar</option>
            <option v-for="tipocita in tipocitas" :key="tipocita.id_tipo_cita" :value="tipocita.id_tipo_cita">{{ tipocita.tipo_cita }}</option>
        </select>
        </div>
        <div class="form-group">
          <label for="fec" class="my-2">Fecha cita:</label>
          <input type="datetime-local" class="form-control" placeholder="Fecha" v-model="cita.fecha_cita" id="fec" required>
        </div>
        <div class="form-group">
          <label for="sele" class="my-2">Estado:</label>
            <select v-model="cita.estado" class="form-control" id="sele" required>
              <option disabled value="">Seleccionar</option>
              <option value="A">Activa</option>
              <option value="C">En curso</option>
              <option value="P">Perdida</option>
              <option value="T">Terminada</option>
            </select>
        </div>
        <div class="form-group">
          <button class="btn btn-primary my-4 container-fluid">{{opciones.isedit? "Editar Cita" : "Nueva Cita" }}</button>
        </div>
      </form>
    </div>
    <!-- lista datos-->
    <div class="container" id="list" v-if="opciones.lista">
      <table class="table table-bordered table-light table-hover">
        <thead class="table-primary">
          <tr>
            <th>#</th>
            <th colspan="2">Paciente</th>
            <th colspan="2">Medico</th>
            <th colspan="6">Cita</th>
          </tr>
          <tr>
            <th>Numero</th>
            <th>Ident.</th>
            <th>Nombre</th>
            <th>Ident.</th>
            <th>Nombre</th>  
            <th>Clinica</th>
            <th>Tipo</th>
            <th>Registrada</th>
            <th>Programada</th>
            <th>Estado</th>
            <th>Opcion</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cita in citas" :key="cita.numero_cita">
            <td>{{ cita.numero_cita }}</td>
            <td>{{ cita.id_paciente }}</td>
            <td>{{ cita.nombre_paciente }}</td>
            <td>{{ cita.id_medico }}</td>
            <td>{{ cita.nombre_medico }}</td>
            <td>{{ cita.clinica }}</td>
            <td>{{ cita.tipo_cita }}</td>
            <td>{{ cita.fechaprogram }}</td>
            <td>{{ cita.fechacita }}</td>
            <td>{{ cita.estado }}</td>
            <td><button v-on:click="editCita(cita.numero_cita)" class="btn btn-success my-3 mx-1" v-if="cita.numero_cita != undefined">Editar</button></td>
          </tr>
        </tbody>
      </table>
      <div v-if@prevent="citas == false || citas.error == false">
       <h1>no hay datos para mostrar</h1>
   </div>
    </div>
  </div>
</template>
<script>
import Header from '@/components/Header.vue';
import Search from '@/components/Search.vue';
export default {
  components:{
      Header,
      Search
  },
  data(){
    return {
      citas: [],
      clinicas: [],
      tipocitas: [],
      opciones: {defect: true, isedit: false, isadd: false, registra: false, lista:false, search: false, isearch: false},
      idse: '',
      cita: {numero_cita: '', id_clinica: '', id_paciente: '', id_medico: '', tipo_cita: '', fecha_cita: '', estado: '', id_usuario:'1'}
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
      const id = ["clinica", "tipocit"];
      this.$http.get("vista/utilities/?id="+id[0])
              .then(respuesta => {
                console.log(respuesta.data)
                this.clinicas = respuesta.data
              })
              .catch(error => {console.log(error) })
      this.$http.get("vista/utilities/?id="+id[1])
              .then(respuesta => {
                console.log(respuesta.data)
                this.tipocitas = respuesta.data
              })
              .catch(error => {console.log(error) })              
    },
    //traer del api
    getCitas:function(){
        if(this.opciones.isearch){
          this.opciones.isearch = false
          this.idse = ""
        }
      this.$http.get("vista/citas/")
              .then(respuesta => {
                console.log(respuesta.data)
                this.citas = respuesta.data
              })
              .catch(error => {console.log(error) })
     },
     //agregar a la api
     addCita:function(e){
      if(this.opciones.isedit){
        const obj =  this.cita   
        console.log(obj);
        this.$http.put("vista/citas/" ,obj)
          .then(respuesta => {
          console.log(respuesta.data)
          this.cita = {numero_cita: "", id_medico: "", id_paciente: "", id_clinica: "", tipo_cita: "", fecha_cita: "", estado: ""};
          this.getCitas()
          this.opciones.isadd = true;
          this.opciones.isedit = false;
        }).catch(error => {console.log(error) })
      }else{
          const obj = this.cita
        console.log(obj);
        this.$http.post("vista/citas/" ,obj)
          .then(respuesta => {
            console.log(respuesta.data)
            this.cita = {numero_cita: "", id_medico: "", id_paciente: "", id_clinica: "", tipo_cita: "", fecha_cita: "", estado: ""};
            this.opciones.isadd = true;
            this.getCitas()
          }).catch(error => {console.log(error) })
      }
     },
     //editar obteniendo el id [del paciente]
     editCita:function(id){
      this.$http.get("vista/citas/?id="+id)
              .then(respuesta => {
                this.cita = {numero_cita: respuesta.data.numero_cita, id_clinica: respuesta.data.id_clinica, id_paciente: respuesta.data.id_paciente, id_medico: respuesta.data.id_medico, tipo_cita: respuesta.data.tipo_cita, fecha_cita: respuesta.data.fechacita, estado: respuesta.data.estado, id_usuario: "1"};
                this.opciones.isedit = true;
                this.opciones.registra = true;
                 console.log(respuesta.data)
                 })
              .catch(error => {console.log(error) })
     },
     //buscar en la api
     srchCita:function(id){
        this.$http.get("vista/citas/?ids="+id)
              .then(respuesta => {
                this.citas = respuesta.data
                this.opciones.lista = true
                this.opciones.isearch = true
                 console.log(respuesta.data)
                 })
              .catch(error => {console.log(error) })
     },
     //Intento de command en Vue - Aún en desarrollo
     citac:class{
        constructor(obj){
         this.cita = obj
        }

        executeCommand(command){
          this.obj = command.execute()
        }

        getCitas(){
          return this.cita
        }
     },
     getCommand:class{
      constructor(){
  
      }
       execute(currentObj){
        this.$http.get("vista/citas/")
              .then(respuesta => {
                 let rec = new this.citac(respuesta.data)
                 currentObj = rec.getCitas()
                 console.log(respuesta.data) 
                 return currentObj
              })
              .catch(error => {console.log(error) })
       }
     },
     addCommand:class{
      constructor(objtoAdd){
        this.objtoAdd = objtoAdd
      }

        execute(currentObj){
          this.$http.post("vista/citas/" ,currentObj)
          .then(respuesta => {
            console.log(respuesta.data)
            this.isadd = true;
            this.getCitas()
          }).catch(error => {console.log(error) })
          this.objtoAdd = {}
          return this.objtoAdd
        }
     },
     editCommand:class{
      constructor(objtoEdit){
        this.objtoEdit = objtoEdit
      }

        execute(id){
          this.$http.get("vista/citas/?id="+id)
              .then(respuesta => {
                this.objtoEdit = {numero_cita: respuesta.data.numero_cita, id_clinica: respuesta.data.id_clinica, id_paciente: respuesta.data.id_paciente, id_medico: respuesta.data.id_medico, tipo_cita: respuesta.data.tipo_cita, fecha_cita: respuesta.data.fechacita, estado: respuesta.data.estado, id_usuario: "1"};
                this.isedit = true;
                this.registra = true;
                 console.log(respuesta.data)
                 })
              .catch(error => {console.log(error) })
          return this.objtoEdit
        }
     }
    },
    created:function(){
      this.getCitas();
      this.getUtilities();
    }
  }
</script>
<style>

</style>