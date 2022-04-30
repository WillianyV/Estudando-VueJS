<template>
  <div>
    <PrimeiroComponente />
    <p>O dado de App Vue é: {{ testando }}</p>
    <life-cycle></life-cycle> <!-- Também o componente pode ser chamado dessa forma, mas usada <PrimeiroComponente /> -->
    <Pessoa />
    <Form />
  </div>
</template>

<script>
  import PrimeiroComponente from './components/PrimeiroComponente.vue'
  import LifeCycle from './components/LifeCycle.vue'
  import Pessoa from './components/Pessoa.vue'
  import Form from './components/Form.vue'

  export default {
    name:"app",
    components:{
      PrimeiroComponente,
      LifeCycle,
      Pessoa,
      Form
    },
    data() {
      return {
        testando: "Teste",        
      }
    }
  }
</script>

