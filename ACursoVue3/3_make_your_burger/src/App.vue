<template>
  <NavBar />
  <router-view/>
  <Footer />
</template>

<script>

import NavBar from './components/Navbar.vue'
import Footer from './components/Footer.vue'

export default {
  components:{
    NavBar,
    Footer
  }  
}
</script>

<style>

</style>
