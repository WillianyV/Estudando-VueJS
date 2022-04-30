<template>
    <img :src="imagem_src" :alt="descricao">
</template>
<script>
export default {
    name:'Imagem',
    data() {
        return {
            imagem_src:"/img/avatar.png",
            descricao:'Williany Veras'
        }
    }
}
</script>