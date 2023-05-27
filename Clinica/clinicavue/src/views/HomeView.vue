<template>
  <Header/>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <HelloWorld msg="App para citas clinicas"/>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'
import Header from '@/components/Header.vue';

export default {
  
  name: 'HomeView',
  components: {
    HelloWorld,
    Header
  }
}
</script>
