<template>
  <div>
    <h1>Olá vue!</h1>
    <p>Meu nome é {{ nome }} e trabalho como {{ profissao }}</p>
    <MultiposEventos />
    <Reutilizacao />
    <Reutilizacao />
    <Reutilizacao />
    <Reutilizacao />
  </div>
</template>

<script>
import MultiposEventos from "./MultiposEventos.vue";
import Reutilizacao from './Reutilizacao.vue';

export default {
  name: "PrimeiroComponente",
  components: {
    MultiposEventos,
    Reutilizacao,
  },
  data() {
    return {
      nome: "Williany",
      profissao: "Programadora",
    };
  },
};
</script>
