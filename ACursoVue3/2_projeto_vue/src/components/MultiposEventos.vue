<template>
    <div>
        <button @click="primeiro(txt_primeiro,event),segundo(txt_segundo,event),terceiro(event)">Ativar múltiplos eventos</button>
        <p>{{ multiplos_eventos }}</p>
    </div>
</template>

<script>
export default {
    name:'MultiposEventos',
    data() {
        return {
            multiplos_eventos:"",
            txt_primeiro:"Primeiro evento",
            txt_segundo:"Segundo evento",
        }
    },
    methods: {
        primeiro(txt, e){
            this.multiplos_eventos = txt
        },
        segundo(txt, e){
            setTimeout(() => this.multiplos_eventos = txt,500)
        },
        terceiro(e){
            setTimeout(() => this.multiplos_eventos = "",1500)
        }
    }
}
</script>
<style scoped>
    div{
        margin: 100px;
    }
</style>