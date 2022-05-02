<template>
  <div>
    <Header :esta_logado="true"/>
    <PrimeiroComponente />
    <p class="paragrafo-pai">O dado de App Vue é: {{ testando }}</p>
    <life-cycle></life-cycle> <!-- Também o componente pode ser chamado dessa forma, mas usada <PrimeiroComponente /> -->
    <Pessoa />
    <Form />
  </div>
</template>

<script>
  import Header from './components/Header.vue'
  import PrimeiroComponente from './components/PrimeiroComponente.vue'
  import LifeCycle from './components/LifeCycle.vue'
  import Pessoa from './components/Pessoa.vue'
  import Form from './components/Form.vue'  

  export default {
    name:"app",
    components:{
      Header,
      PrimeiroComponente,
      LifeCycle,
      Pessoa,
      Form,      
    },
    data() {
      return {
        testando: "Teste",        
      }
    }
  }
</script>

<style>
  body{
    background-color: #333;
    color: #FFF;
  }

  a{
    color: red;
  }

  .teste{
   background-color: black; 
  }
</style>

