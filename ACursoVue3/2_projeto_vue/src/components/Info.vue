<template>
  <div>
    <p v-if="esta_trabalhando">Estou trabalhando no momento.</p>
    <p v-else>Estou em busca de novas oportunidades.</p>

    <p>Utilizo as seguintes tecnologias para back-end</p>
    <ul>
      <li v-for="(tecnologia, index) in back_end_tecnologias" v-bind:key="index" >
        {{tecnologia}}
        </li>
    </ul>

    <p>Utilizo as seguintes tecnologias para front-end</p>
    <ul>
      <li v-for="tecnologia in front_end_tecnologias" :key="tecnologia.id">
        {{tecnologia.lingaguem}}
      </li>
    </ul>

    <p v-if="4 > 2">Testando</p>

    <div>
      <button @click="mostrarEmail">{{ textoBotao }}</button>
    </div>
    <p v-show="mostrar_email">Mande uma mensagem para: {{ email }}</p>

    <p class="teste">Para acessar meu portfólio <a v-bind:href="meu_link" target="_blank">basta clicar aqui</a></p>
    
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
      meu_link:'https://www.google.com/',
      textoBotao: 'Mostrar e-mail',
      back_end_tecnologias:['JavaScript','PHP','Laravel'],
      front_end_tecnologias:[
        {id:1, lingaguem:'HTML'},
        {id:2, lingaguem:'CSS'},
        {id:3, lingaguem:'VueJS'},
      ],
    }
  },
  methods: {
    mostrarEmail() {
      this.mostrar_email = !this.mostrar_email
      if (!this.mostrar_email) {
        this.textoBotao = 'Mostrar e-mail'
      } else {
        this.textoBotao = 'Esconder e-mail'
      }
    }
  }
};
</script>

<style>
  .paragrafo-pai{
    color: red;
  }
</style>