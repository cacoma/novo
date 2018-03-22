<template>
  <div>
    <div class="form-row">
           <div class="form-group col-md-6">
                          <label class="control-label" for="symbol">Código(simbolo):</label>
                        <input type="text" list="liststocks" placeholder="simbolo" v-model="query" v-on:keyup="autoComplete" class="form-control" name="symbol" id="symbol" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira o stock')" required>
                          <datalist id="liststocks">
                                    <option v-for="result in results" v-bind:value="result.symbol" v-bind:label="result.symbol"></option>
                            </datalist>
                        </div>
                         <div class="form-group col-md-6">
                          <label class="control-label" for="quant">Quantidade:</label>
                          <input type="number" class="form-control" name="quant" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira a quantidade.')" required>
                        </div>
 </div>
    <div class="form-row">
                      <div class="form-group col-md-6">
                          <label class="control-label" for="price">Preço:</label>
                          <input type="number" class="form-control" name="price" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira o preco')" required>
                        </div>
                         <div class="form-group col-md-6">
                          <label class="control-label" for="date">Data:</label>
                          <date-picker :config="config" class="form-control" name="date" id="date" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira a data')" required></date-picker>
                        </div>  
                        </div>  
  </div>                       
  </template>
<script>
	// Import required dependencies datetimepicker
  import 'bootstrap/dist/css/bootstrap.css';
  
  // Import this component datetimepicker
  import datePicker from 'vue-bootstrap-datetimepicker';
  
  // Import date picker css datetimepicker
  import 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css';
 export default{
  data(){
   return {
    query: '',
    results: [],
		 date: new Date(),
        config: {
          format: 'DD/MM/YYYY',
          useCurrent: false,
        }       
   }
  },
	 components: {
      datePicker
    },
  methods: {
   autoComplete(){
    this.results = [];
    if(this.query.length > 2){
     axios.get('/api/searchstocks', {
       params: {query: this.query
               }
     }).then(response => {
      this.results = response.data;
     }).then(response => { 
	console.log(response)
})
.catch(error => {
    console.log(error.response)
});
    }
   }
  }
 }
</script>