<template>
    <div>
        <h2>Meu Form</h2>
        <form action="" @submit="enviarFormulario">
            <div>
                <!-- <InputText /> -->
                <input type="text" v-model="name">
            </div>
            <div>
                <input type="text" v-model="email">
                <!-- <InputText /> -->
            </div>
            <div>
                <Submit />
            </div>
        </form>
        <br><br><br>
    </div>
</template>
<script>
import InputText from './form/InputText.vue' 
import Submit from './form/Submit.vue' 

export default {
    name: 'Form',
    components: {
        InputText,
        Submit
    },
    data() {
        return {
            name: "",
            email: ""
        }
    },
    methods: {
        enviarFormulario(e) {
            e.preventDefault();

            const name = this.name;
            const email = this.email;

            console.log('formulario enviado');
            console.log("Nome: "  + name);
            console.log("Email: " + email);

            //requisição AJAX
            //inserir no BD
        }
    }
}
</script>