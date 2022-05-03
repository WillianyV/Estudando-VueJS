<template>
    <div class="reutilizacao">
        <div>
            <button @click="ativar">Clique aqui</button>
        </div>
        <div>
            <span v-show="ativou">Ativado</span>
        </div>
    </div>
</template>
<script>
export default {
    name:'Reutilizacao',
    data() {
        return {
            ativou: false,
        }
    },
    methods: {
        ativar() {
            this.ativou = !this.ativou
        }
    }
}
</script>

<style scoped>
    .reutilizacao{
        margin: 50px;
    }
</style>