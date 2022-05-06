<template>
  <div>
    <div>
      <Message :msg="msg" v-show="msg"/>
    </div>
    <div>
      <form id="burger-form" @submit="createBurger">
        <div class="input-container">
          <label for="name">Nome do Cliente:</label>
          <input
            type="text"
            id="name"
            name="name"
            v-model="name"
            placeholder="Digite o nome"
          />
        </div>
        <div class="input-container">
          <label for="pao">Escolha o Pão:</label>
          <select name="pao" id="pao" v-model="pao">
            <option value="" hidden>Selecione o seu Pão</option>
            <option :value="pao.tipo" v-for="pao in paes" :key="pao.id">{{ pao.tipo }}</option>
          </select>
        </div>
        <div class="input-container">
          <label for="carne">Escolha a Carne:</label>
          <select name="carne" id="carne" v-model="carne">
            <option value="" hidden>Selecione a sua Carne</option>
            <option :value="carne.tipo" v-for="carne in carnes" :key="carne.id">{{ carne.tipo }}</option>
          </select>
        </div>
        <div id="optionais_container" class="input-container">
          <label for="optionais" id="optionais_title">Escolha os Opcionais</label>
          <div class="checkbox-container" v-for="opcional in opcionaisData" :key="opcional.id">
            <input type="checkbox" name="optionais" id="optionais" v-model="optionais" :value="opcional.tipo" />
            <span>{{ opcional.tipo }}</span>
          </div>
        </div>
        <div class="input-container">
          <input type="submit" class="submit-btn" value="Criar meu Burger" />
        </div>
      </form>
    </div>
  </div>
</template>

<script>
// breadsData - Dados no plural são os que veem do servido
// bread - Dados no singular serão os enviados

import Message from './Message.vue';

export default {
  name: "BurgerForm",
  components: {
    Message,
  },
  data() {
    return {
      paes: null,
      carnes: null,
      opcionaisData: null,
      name: null,
      pao: null,
      carne: null,
      optionais: [],
      msg: null,
    };
  },
  methods: {
    async getIngredientes(){
      const req = await fetch("http://localhost:3000/ingredientes");
      const data = await req.json();
    
      this.paes = data.paes;
      this.carnes = data.carnes;
      this.opcionaisData = data.opcionais;
    },
    async createBurger(e){
      e.preventDefault();
      const data = {
        nome: this.name,
        carne: this.carne,
        pao: this.pao,
        optionais: Array.from(this.optionais),
        status: "Solicitado",
      }

      const dataJson = JSON.stringify(data);
      
      const req = await fetch("http://localhost:3000/burgers", {
        method:"POST",
        headers: {"Content-Type":"application/json"},
        body: dataJson
      });

      const res = await req.json();
      
      //colocar um msg de sistema 
      this.msg = `Pedido de Nº ${res.id}. Realizado com sucesso!`
      //limpar msg
      setTimeout(() => this.msg = "", 3000);

      // limpar os campos
      this.name="";
      this.carne="";
      this.pao="";
      this.optionais="";
    }
  },
  mounted(){
    this.getIngredientes()
  }
};
</script>

<style scoped>
#burger-form {
  max-width: 400px;
  margin: 0 auto;
}

.input-container {
  display: flex;
  flex-direction: column;
  margin-bottom: 20px;
}

label {
  font-weight: bold;
  margin-bottom: 15px;
  color: #222;
  padding: 5px 10px;
  border-left: 4px solid #fcba03;
}

input,
select {
  padding: 5px 10px;
  width: 100%;
}

#optional_container {
  flex-direction: row;
  flex-wrap: wrap;
}

#optional_title {
  width: 100%;
}

.checkbox-container {
  display: flex;
  align-items: flex-start;
  width: 50%;
  margin-bottom: 20px;
}

.checkbox-container span,
.checkbox-container input {
  width: auto;
}

.checkbox-container span {
  margin-left: 6px;
  font-weight: bold;
}

.submit-btn {
  background-color: #222;
  color: #dfdbdb;
  font-weight: bold;
  border: 2px solid #222;
  padding: 10px;
  font-size: 16px;
  margin: 0 auto;
  cursor: pointer;
  transition: 0.5s;
  width: 80%;
}
.submit-btn:hover {
  background-color: transparent;
  color: #222;
}
</style>