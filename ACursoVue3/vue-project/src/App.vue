<template>
  <div>
    <PrimeiroComponente />
    <p>O dado de App Vue é: {{ testando }}</p>
    <life-cycle></life-cycle> <!-- Também o componente pode ser chamado dessa forma, mas usada <PrimeiroComponente /> -->
  </div>
</template>
<script>
  import PrimeiroComponente from './components/PrimeiroComponente.vue'
  import LifeCycle from './components/LifeCycle.vue'

  export default {
    name:"app",
    components:{
      PrimeiroComponente,
      LifeCycle
    },
    data() {
      return {
        testando: "Teste",
      }
    }

  }
</script>
