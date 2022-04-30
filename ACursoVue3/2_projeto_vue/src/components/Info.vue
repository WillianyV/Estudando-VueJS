<template>
  <div>
    <p v-if="esta_trabalhando">Estou trabalhando no momento.</p>
    <p v-else>Estou em busca de novas oportunidades.</p>
    <p>Utilzo as seguintes tecnologias</p>
    <ul>
      <li>JavaScript</li>
      <li>PHP</li>
      <li>Laravel</li>
      <li>PostgreSQL</li>
    </ul>
    <p v-if="4 > 2">Testando</p>
    <p v-show="mostrar_email">Mande uma mensagem para: {{ email }}</p>
    <p>Para acessar meu portfólio <a v-bind:href="meu_link" target="_blank">basta clicar aqui</a></p>
    <Imagem />
  </div>
</template>

<script>
import Imagem from './Imagem.vue'
export default {
  name: "Info",
  components: {
    Imagem,
  },
  data() {
    return {
      esta_trabalhando: false,
      mostrar_email: false,
      email:'williany.veras@gmai.com',
      meu_link:'https://www.google.com/'
    }
  }
};
</script>