<template>
  <div>
    <h1>Olá vue!</h1>
    <p>Meu nome é {{ nome }} e trabalho como {{ profissao }}</p>
    <MultiposEventos />
  </div>
</template>

<script>
import MultiposEventos from "./MultiposEventos.vue";
export default {
  name: "PrimeiroComponente",
  components: {
    MultiposEventos,
  },
  data() {
    return {
      nome: "Williany",
      profissao: "Programadora",
    };
  },
};
</script>
