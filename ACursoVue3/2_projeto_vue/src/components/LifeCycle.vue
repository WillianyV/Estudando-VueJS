<template>
    <h1>Meu nome é: {{ nome }}</h1>
</template>

<script>
export default {
    name:'LyfeCycle',
    data() {
        return {
            nome: 'Ainda não sei'
        }
    },
    created() {
        setTimeout(() => {
            this.nome = 'Williany'
        },1000);    
        this.lifeCycle()
    },
    mounted() {
        setTimeout(() => {
            this.nome = 'Veras'
        },2000);  
        this.lifeCycle()       
    },
    methods: {
        lifeCycle() {
            console.log("Executou");
        }
    }
}
</script>
