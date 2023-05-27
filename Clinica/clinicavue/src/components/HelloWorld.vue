<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <h1>realizada con Vue.js</h1>

    <h3><span class="material-symbols-outlined" id="main-icon">
library_add
</span>&nbsp; Librerias usadas</h3>
    <ul>
      <li><a href="https://github.com/vuejs/vue-cli/tree/dev/packages/%40vue/cli-plugin-babel" target="_blank" rel="noopener">babel</a></li>
      <li><a href="https://github.com/vuejs/vue-cli/tree/dev/packages/%40vue/cli-plugin-router" target="_blank" rel="noopener">router</a></li>
      <li><a href="https://stackoverflow.com/questions/65547199/using-bootstrap-5-with-vue-3" target="_blank" rel="noopener">Boostrap</a></li>
      <li><a href="https://www.npmjs.com/package/vue-axios" target="_blank" rel="noopener">VueAxios</a></li>
      <li><a href="https://fonts.google.com/?preview.text=consulta&preview.text_type=custom" target="_blank" rel="noopener">Google Fonts</a></li>
      <li><a href="https://fonts.google.com/icons?preview.text=consulta&preview.text_type=custom" target="_blank" rel="noopener">Google Icons</a></li>
    </ul>
    <h3><span class="material-symbols-outlined" id="main-icon">
api
</span>Api desarrollada personalmente</h3>
    <ul>
      <li><a href="https://github.com/K-vin23/GestionCitasVueJs" target="_blank" rel="noopener">Api+Proyecto Vue.js Disponible en Github</a></li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  props: {
    msg: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
