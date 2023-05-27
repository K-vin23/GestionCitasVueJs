<template>
     <div class="input-group container my-2" id="srch" v-if="search">
        <input type="search" class="form-control rounded" placeholder="Identificacion del paciente" aria-label="Search" aria-describedby="search-addon" v-model="idse"/>
        <button type="button" class="btn btn-outline-primary" v-on:click="activador=true">buscar</button>
        <button type="button" class="btn btn-outline-danger" v-if="isearch" v-on:click="getCitas()">restablecer</button>
    </div>
</template>

<script>
export default {
 
  props: {
    search: Boolean

  },
  data(){
    return{
        id: '',
        activador: ''
    }
  },
  mounted(){
    this.$emit('id', this.id);
    this.$emit('activar', this.activador);
  }
}
</script>

<style>

</style>