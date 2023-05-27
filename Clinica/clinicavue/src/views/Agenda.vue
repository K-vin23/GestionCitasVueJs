<template>
  <Header/>
  <div class="container border border-primary px-0 my-2">
    <!-- encabezado -->
    <div class="container p-3 mt-0 my-3 bg-primary text-white d-flex justify-content-center">
      <span class="material-symbols-outlined" id="main-icon">
        demography
      </span><h1 class="text-center w-0 mx-2">Consulta de agendas medicos</h1>
    </div>
    <!-- opciones -->
    <div class="btn-group my-3">
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('registro')">Registrar nueva agenda</button>
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('lista')">Lista de agendas</button>
      <button type="button" class="btn btn-outline-primary btn-block" v-on:click="mostrar('search')">Buscar agenda</button>
    </div>
    <!-- mensaje por defecto -->
    <div class="container my-3" v-if="opciones.defect">
      <h1>Selecciona una opción para mostrar</h1>
    </div>
    <!-- busqueda -->
    <div class="input-group container my-2" id="srch" v-if="opciones.search">
      <input type="search" class="form-control rounded" placeholder="Identificacion del medico" aria-label="Search" aria-describedby="search-addon" v-model="idse"/>
      <button type="button" class="btn btn-outline-primary" v-on:click="srchAgenda(idse)">buscar</button>
      <button type="button" class="btn btn-outline-danger" v-if="opciones.isearch" v-on:click="getAgendas()">restablecer</button>
    </div>
    <!-- popup -->
    <div class="alert alert-success alert-dismissible mx-3 py-1" v-show="opciones.isadd">
      <strong>Success!</strong> {{opciones.isedit? "Agenda editada" : "Agenda agregada" }} correctamente.
      <button type="button" class="close btn" data-dismiss="alert" v-on:click="opciones.isadd = false">&times;</button>
      </div>
    <!-- form registro -->
    <div class="container my-3" id="reg" v-if="opciones.registra">
      <form @submit.prevent="addAgenda" class="was-validated mx-3">
        <div class="form-group">
          <label for="a" class="my-2">Agenda</label>
          <input type="number" class="form-control" placeholder="" v-model="id_agenda" id="a" disabled>
        </div>
        <div class="form-group">
          <label for="ident" class="my-2">Identificacion Medico:</label>
          <input type="text" class="form-control" placeholder="Identificacion" v-model="agenda.identificacion" id="ident" required>
        </div>
        <div class="form-group">
          <label for="seld" class="my-2">Dia:</label>
          <select v-model="agenda.dia" class="form-control" id="seld" required>
            <option disabled value="">Seleccionar</option>
            <option value="1">Lunes</option>
            <option value="2">Martes</option>
            <option value="3">Miercoles</option>
            <option value="4">Jueves</option>
            <option value="5">Viernes</option>
            <option value="6">Sabado</option>
          </select>
        </div>
        <div class="form-group">
          <label for="hi" class="my-2">Hora inicial:</label>
          <input type="time" class="form-control" placeholder="Hora inicio" v-model="agenda.hora_in" id="hi" required>
        </div>
        <div class="form-group">
          <label for="hf" class="my-2">Hora final:</label>
          <input type="time" class="form-control" placeholder="Hora fin" v-model="agenda.hora_fn" id="hf" required>
        </div>
        <div class="form-group">
          <button class="btn btn-primary my-4 container-fluid">{{opciones.isedit? "Editar Agenda" : "Nueva Agenda" }}</button>
        </div>
      </form>
    </div>
    <!-- lista datos-->
    <div class="container" id="list" v-if="opciones.lista">
      <table class="table table-bordered table-light table-hover">
        <thead class="table-primary">
          <tr>
            <th>Identificacion</th>
            <th>Medico</th>
            <th>Area</th>
            <th>Dia</th>
            <th colspan="2">Hora disponibilidad</th>
            <th>Opcion</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="agenda in agendas" :key="agenda.id_agenda">
            <td>{{ agenda.id_medico }}</td>
            <td>{{ agenda.nombre }}</td>
            <td>{{ agenda.area }}</td>
            <td>{{ agenda.dia }}</td>
            <td>{{ agenda.hora_in }}</td>
            <td>{{ agenda.hora_fn }}</td>
            <td><button v-on:click="editAgenda(agenda.id_agenda)" class="btn btn-success my-3 mx-1" v-if="agenda.id_agenda != undefined">Editar</button></td>
          </tr>
        </tbody>
      </table>
      <div v-if@prevent="agendas == false || agendas.error == false">
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
      agendas: null,
      opciones: {defect: true, isedit: false, isadd: false, registra: false, lista:false, search: false, isearch: false},
      idse: '',
      id_agenda: '',
      agenda: {identificacion: '', dia: '', hora_in: '', hora_fn: '', id_user: '1',}
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
     //traer del api 
     getAgendas:function(){
      if(this.opciones.isearch){
          this.opciones.isearch = false
          this.idse = ""
        }
      this.$http.get("vista/agenda/")
              .then(respuesta => {
                 this.agendas = respuesta.data
                 console.log(respuesta.data)
                console.log(this.agendas) })
              .catch(error => {console.log(error) })
     },
     //agregar a la api
     addAgenda:function(e){
      if(this.opciones.isedit){
        this.agenda.push(this.id_agenda);
        const obj = this.agenda;
        console.log(obj);
        this.$http.put("vista/agenda/" ,obj)
          .then(respuesta => {
          console.log(respuesta.data)
          this.agenda = {identificacion: "", dia: "", hora_in: "", hora_fn: ""}
          this.opciones.isedit = false;
          this.opciones.isadd = true;
          this.getAgendas()
        }).catch(error => {console.log(error) })
      }else{
        const obj = this.agenda;
        console.log(obj);
        this.$http.post("vista/agenda/" ,obj)
          .then(respuesta => {
            console.log(respuesta.data)
            this.agenda = {identificacion: "", dia: "", hora_in: "", hora_fn: ""}
            this.opciones.isadd = true;
            this.getAgendas()
          }).catch(error => {console.log(error) })
      }
     },
     //editar obteniendo el id [del medico]
     editAgenda:function(id){
      this.$http.get("vista/agenda/?id="+id)
              .then(respuesta => {
                 this.id_agenda = respuesta.data.id_agenda;
                 this.agenda = {identificacion: respuesta.data.id_medico, dia: respuesta.data.id_dia, hora_in: respuesta.data.hora_in, hora_fn: respuesta.data.hora_fn}
                 this.opciones.isedit = true;
                 this.opciones.registra = true;
                 console.log(respuesta.data)
                 })
              .catch(error => {console.log(error) })
     },
     //buscar en la api
     srchAgenda:function(id){
        this.$http.get("vista/agenda/?ids="+id)
              .then(respuesta => {
                this.agendas = respuesta.data
                this.opciones.lista = true
                this.opciones.isearch = true
                 console.log(respuesta.data)
                 })
              .catch(error => {console.log(error) })
     }
    },
    created:function(){
      this.getAgendas();
    }
  }
</script>
<style>

</style>