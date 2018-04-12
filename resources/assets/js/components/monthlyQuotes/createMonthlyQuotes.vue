<template>
  <div>
		<form method="POST" action="/monthlyQuotes/store">
		<input type="hidden" name="_token" :value="csrf">
    <div class="form-row">
           <div class="form-group col-md-4">
                          <label class="control-label" for="symbol">Código(simbolo):</label>
                        <input type="text" list="liststocks" placeholder="simbolo" v-model="query" v-on:keyup="autoComplete" class="form-control" name="symbol" id="symbol" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira o stock')" required>
                          <datalist id="liststocks">
                                    <option v-for="result in results" v-bind:value="result.symbol" v-bind:label="result.symbol"></option>
                            </datalist>
                        </div>
												<div class="form-group col-md-4">
                          <label class="control-label" for="date_invest">Data:</label>
													<div class="input-group"> 
                          <date-picker :config="config" class="form-control" name="date_invest" v-model="date_invest" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira a data')" required></date-picker>
													<span class="input-group-addon glyphicon glyphicon-calendar" for="date_invest"></span>
                        </div>
                        </div>
                         
 		</div>
      <div class="form-row">
		      <div class="form-group col-md-4">
 

           <button type="submit" class="btn btn-success form-control">Adicionar cotações mensais</button>
        </div>
        </div>
		</form>
		
  </div>                       
  </template>

<script>
	// Import required dependencies datetimepicker
  //import 'bootstrap/dist/css/bootstrap.css';
  
  // Import this component datetimepicker
  import datePicker from 'vue-bootstrap-datetimepicker';
  
  // Import date picker css datetimepicker
  import 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css';
	
 export default{
  data(){
   return {
		csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    query: '',
    errors: [],
    results: [],
		 date_invest: new Date(),
        config: {
					format: 'DD-MM-YYYY hh:mm:ss',
          useCurrent: true,
					showClear: true,
      		showClose: true,
					daysOfWeekDisabled: [0, 6],
					locale: 'pt-br'
        }       
   }
  },
	   computed: {
    
  },
	 
	 components: {
      datePicker
    },
	 
  methods: {
		//busca as acoes
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
   },

	},
 }
</script>