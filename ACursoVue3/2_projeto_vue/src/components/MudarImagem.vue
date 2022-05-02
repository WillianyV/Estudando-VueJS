<template>
    <button @click="$emit('mudarImagem')">TrocarImagem</button>
</template>
<script>
export default {
    name:'MundarImagem',
    emits:['mudarImagem']
}
</script>