<template>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

  <router-view/>
  
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Mukta:wght@500&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Mukta:wght@500&display=swap');
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}

#main-icon{
  font-size: 3rem;
}

#reg{
  width: 50%;
  font-family: 'Ubuntu', sans-serif;
}

#list{
  font-family: 'Mukta', sans-serif;
}

#srch{
  font-family: 'Mukta', sans-serif;
}
</style>
