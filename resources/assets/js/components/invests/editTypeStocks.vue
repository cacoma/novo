<template>
  <div>
		<form method="POST" action="/stocks/investupdate">
		<input type="hidden" name="_method" value="PATCH">
		<input type="hidden" name="_token" :value="csrf">
		<input type="hidden" name="type" value="stock">
		<input type="hidden" name="id" v-bind:value="id">

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
												<div class="form-group col-md-4">
													<label class="control-label" for="broker_name">Corretora:</label>
													<input type="text" list="listbrokers" placeholder="corretora" v-model="querybroker" v-on:keyup="autoCompleteBroker" class="form-control" name="broker_name" id="broker_name" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira a corretora')" required>
                          <datalist id="listbrokers">
                                    <option v-for="resultbroker in resultbrokers" v-bind:value="resultbroker.name" v-bind:label="resultbroker.name"></option>
                            </datalist>
<!-- 			                   <input type="text" class="form-control" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira a corretora')" required> -->
                        </div>
                         
 		</div>
    <div class="form-row">
                      <div class="form-group col-md-3">
                          <label class="control-label" for="price">Preço:</label>
													<div class="input-group"> 
        										<span class="input-group-addon" for="price">R$</span>
														<money name="price" v-model="price" v-bind="money" class="form-input input-lg form-control" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira o preco')" required></money>
<!-- 														 <input v-model.lazy="price" v-money="money" class="form-input input-lg form-control" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira o preco')" required> -->
                        	</div>
											 </div>
											<div class="form-group col-md-3">
                          <label class="control-label" for="quant">Quantidade:</label>
                          		<input type="number" class="form-control input-lg" name="quant" v-model.number="quant" step="1" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira a quantidade.')" required>
                        </div>
												<div class="form-group col-md-3">
                          <label class="control-label" for="broker_fee">Corretagem e taxas:</label>
													<div class="input-group"> 
        										<span class="input-group-addon" for="broker_fee">R$</span>
														<money value="broker_fee" name="broker_fee" v-model="broker_fee" v-bind="money" class="form-input input-lg form-control" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Insira o valor')" required></money>
                        </div>
                        </div>
													<div class="form-group col-md-3">
                          <label class="control-label" for="total">Total:</label>
													<div class="input-group"> 
        										<span class="input-group-addon" for="price">R$</span>
														<money :value="total" v-bind="money" class="form-input input-lg form-control" required disabled></money>
                        </div>
                        </div>
			
                           
  
		      <div class="form-group">
         <div class="form-row col-md-12">
         <label class="control-label col-md-4"></label>
           <button type="submit" class="btn btn-success form-control">Atualizar ação</button>
        </div>
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
	
	//import momento for date parsing
	import moment from 'moment'
	
 export default{
	 props: ['invest'],
 	 data(){
   return {		 
//		 {
// 			 invest: {
// 				 type: Object		 
// 			 }
//		 },
		 money: {
        decimal: ',',
        thousands: '.',
        precision: 2,
        masked: false
        },
		csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    query: this.invest.symbol,
    querybroker: '',
    results: [],
    resultbrokers: [],
		id: this.invest.id,
		type: this.invest.type,
		quant: parseFloat(this.invest.quant).toFixed(0),
		 price: parseFloat(this.invest.price).toFixed(2),
		 broker_fee: parseFloat(this.invest.broker_fee).toFixed(2),
		 date_invest: moment(this.invest.date_invest, 'YYYY-MM-DD hh:mm:ss').format('DD/MM/YYYY hh:mm:ss'),
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
    // a computed getter
    total: function () {
      // `this` points to the vm instance
      return this.price * this.quant + this.broker_fee
    }
  },
	 
	 components: {
      datePicker
    },
	 
	 created(){
		   axios.get('/api/searchbroker', {
       params: {query: this.invest.broker_id
               }
     }).then(response => {
      this.querybroker = response.data;
     }).then(response => { 
	console.log(response)
})
.catch(error => {
    console.log(error.response)
});
	 },

  methods: {
		//busca as corretoras
   autoCompleteBroker(){
    this.resultsbrokers = [];
    if(this.querybroker.length > 2){
     axios.get('/api/searchbrokers', {
       params: {query: this.querybroker
               }
     }).then(response => {
      this.resultbrokers = response.data;
     }).then(response => { 
	console.log(response)
})
.catch(error => {
    console.log(error.response)
});
    }
   },
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