<template>
  <div>
    <img :src="imagem_src" :alt="descricao" />
    <MundarImagem @mudar-imagem="trocarImagem" />
  </div>
</template>
<script>
import MundarImagem from "./MudarImagem.vue";
export default {
  name: "Imagem",
  components: {
    MundarImagem,
  },
  data() {
    return {
      imagem_src: "/img/avatar.png",
      descricao: "Williany Veras",
    };
  },
  methods: {
    trocarImagem() {
        this.imagem_src="/img/avatar2.png";
    },
  },
};
</script>