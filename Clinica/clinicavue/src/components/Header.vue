<template>
  <nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link"><router-link to="/home"><span class="material-symbols-outlined">
home
</span>Home</router-link> |</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"><router-link to="/citas">
        <span class="material-symbols-outlined">
            clinical_notes
            </span>Citas</router-link> |</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"><router-link to="/agenda">
        <span class="material-symbols-outlined">
            demography
            </span>Agenda</router-link> |</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"><router-link to="/pacientes"><span class="material-symbols-outlined">
person_2
</span>Pacientes</router-link> |</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"><router-link to="/medicos"><span class="material-symbols-outlined">
        stethoscope
        </span>Medicos</router-link> |</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"><router-link to="/"><span class="material-symbols-outlined">
logout
</span>>Salir</router-link></a>
    </li>
  </ul>
</nav>
</template>

<script>
export default {

}
</script>

<style>

</style>