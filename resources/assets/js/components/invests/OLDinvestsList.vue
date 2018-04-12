<template>
  <!--
  Invest list view - painel de indexamento de investimentos.
  Rafael Caziraghi
  04mar2018 - primeira versao
  -->
<div class="container-fluid">  
    <!--  alertas de erro e de sucesso  -->
            <div class="alert alert-danger" v-if="this.errors.length > 0"> 
            <button type="button" class="close" aria-label="Close" @click="errors = []"><span aria-hidden="true">&times;</span></button>
                <ul>
                  <li v-for="error in errors">{{ error }}</li>
                </ul>
          </div> 
          <div class="alert alert-success" v-if="this.successes.length > 0"> 
                <button type="button" class="close" aria-label="Close" @click="successes = []"><span aria-hidden="true">&times;</span></button>
                <ul>
                  <li v-for="success in successes">{{ success }}</li>
                </ul>
          </div> 
  <h6>
    Abrir pesquisa: <button type="button" class="btn btn-xs" data-toggle="collapse" data-target="#searchRow" @click="clearSearch"><span class="glyphicon glyphicon-search" style="color:black" aria-hidden="true"></span></button>
    <a href="/invests/create" class="btn btn-success btn-xs pull-right">Adicionar investimento</a>
  </h6>
<table class="table table-bordered table-condensed table-hover">
    <thead>
      <tr>
        <th class="col-sm-1"><div @click="sortBy('id')">ID
                      <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" v-if="orderer === 'id' & order === 'desc'"></span>
                      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" v-if="orderer === 'id' & order === 'asc'"></span>
          </div></th>
        <th class="col-sm-1"><div @click="sortBy('type')">Tipo
                      <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" v-if="orderer === 'type' & order === 'desc'"></span>
                      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" v-if="orderer === 'type' & order === 'asc'"></span>
          </div></th>
        <th class="col-sm-2"><div @click="sortBy('symbol')">Código
                      <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" v-if="orderer === 'symbol' & order === 'desc'"></span>
                      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" v-if="orderer === 'symbol' & order === 'asc'"></span>
          </div></th>
        <th class="col-sm-2"><div @click="sortBy('quant')">Quantidade
                      <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" v-if="orderer === 'quant' & order === 'desc'"></span>
                      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" v-if="orderer === 'quant' & order === 'asc'"></span>
          </div></th>
        <th class="col-sm-2"><div @click="sortBy('broker_fee')">Corretagem
                      <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" v-if="orderer === 'broker_fee' & order === 'desc'"></span>
                      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" v-if="orderer === 'broker_fee' & order === 'asc'"></span>
          </div></th>
        <th class="col-sm-2"><div @click="sortBy('price')">Preço
                      <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" v-if="orderer === 'price' & order === 'desc'"></span>
                      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" v-if="orderer === 'price' & order === 'asc'"></span>
          </div></th>
        <th class="col-sm-2"><div @click="sortBy('total')">Total
                      <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" v-if="orderer === 'total' & order === 'desc'"></span>
                      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" v-if="orderer === 'total' & order === 'asc'"></span>
          </div></th>
      </tr>
      
        <tr >
        <!--
        inputs de pesquisa
      -->
        <td colspan="7" class="hiddenRow">
          <div class="accordian-body collapse" id="searchRow">
          <input class="col-sm-1" type="text" v-model="searchId">
          <input class="col-sm-1" type="text" v-model="searchType">
          <input class="col-sm-2" type="text" v-model="searchSymbol">
          <input class="col-sm-2" type="text" v-model="searchQuant">
          <input class="col-sm-2" type="text" v-model="searchBroker_fee">
          <input class="col-sm-2" type="text" v-model="searchPrice">
          <input class="col-sm-2" type="text" v-model="searchTotal">
          </div>
        </td>
      </tr>
     </thead>
              
          <!--    montagem da lista, com animacao  -->
    <tbody name="flip-list" is="transition-group">
<!--       <tr v-for="(result, index) in filtered" :key="index"> -->
      <template v-for="(result, index) in filtered">
<!--       <tr v-for="(result, index) in filtered" :key="index"> -->
      <tr :key="index">
        <td align="center" :key="result.id + '-first'">
          <button type="button" class="btn btn-xs" @click="toggle">
             {{ result.id }}
         </button></button>
        </td>
        <td v-text="result.type" :key="result.type"></td>
        <td v-text="result.symbol" :key="result.symbol"></td>
        <td v-text="result.quant" :key="result.quant"></td>
        <td v-text="result.broker_fee" :key="result.broker_fee"></td>
        <td v-text="result.price" :key="result.price"></td>
        <td>R$ {{result.quant * result.price + result.broker_fee}}</td>
        <!--       montagem do collapsible row, com mais info -->
        </tr>
        <tr :key="index + '-secondRow'">
           <td colspan="7">
              <div v-show="open">
                <p>Corretora: {{result.broker_id}} 
                  <a href="/invests/edit" class="btn btn-warning btn-xs pull-right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                  <a href="/invests/destroy" class="btn btn-danger btn-xs pull-right"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                </p>
                <p>Criado em: {{result.created_at}}</p>
                <p>Data do investimento: {{result.date_invest}} </p>
              
             </div>
            </td>
     </tr>
      </template>
    </tbody>
  </table>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        results: [],
        errors: [],
        successes: [],
        sortKey: "",
        searchId: "",
        searchType: "",
        searchSymbol: "",
        searchQuant: "",
        searchBroker_fee: "",
        searchPrice: "",
        searchTotal: "",
        order: "",
        updateData: {},
        deleteData: {},
        orderer: "",
        open: false,
      }
    },
     mounted() {
      // ao montar a instancia, traz todos os dados do BD
      this.investList();
      this.token = document.head.querySelector('meta[name="csrf-token"]');
    },
    methods: {
      //busca todos os brokers no bd
      investList: function() {
        this.results = [];
        axios.get('/api/searchinvests')
          .then(response => response.data)
          .then(data => Vue.set(this, 'results', data));
      },      
      //metodo para limpar inputs de pesquisa
      clearSearch: function() {
        this.searchId = "",
        this.searchType = "",
        this.searchSymbol = "",
        this.searchQuant = "",
        this.searchBroker_fee = "",
        this.searchPrice = ""
      },
      sortBy: function(sortKey) {
        this.order == 'desc' ? this.order = 'asc' : this.order = 'desc';
        this.orderer = sortKey;
        // altera a ordem, baseado no fato de quantas vezes a funcao foi acionada
        this.results = _.orderBy(this.results, function(i) {
            // dependendo em qual coluna foi clicado, muda a forma de ordenar
            switch (sortKey) {
              case 'id':
                return i.id;
                break;
              case 'type':
                return i.type.toLowerCase();
                break;
              case 'symbol':
                return i.symbol.toLowerCase();
                break;
              case 'quant':
                return i.quant;
                break;
              case 'broker_fee':
                return i.broker_fee;
                break;
              case 'price':
                return i.price;
                break;
            }
          },
          this.order)
      },
      //para vizualizar o detalhe
      toggle: function () {
			this.open = !this.open;
		  },
     },
     computed: {
      // funcoes de filtro, o primeiro chama os que seguem, de forma que os filtros se sobreponham
      filtered() {
        return getById(getBysymbol(getByType(this.results, this.searchType), this.searchSymbol), this.searchId)
      },
      filteredById() {
        return getById(this.results, this.searchId)
      },
      filteredByType() {
        return getByType(this.results, this.searchType)
      },
      filteredBySymbol() {
        return getBySymbol(this.results, this.searchSymbol)
      },
      filteredByQuant() {
        return getByQuant(this.results, this.searchQuant)
      },
      filteredByBroker_fee() {
        return getByBroker_fee(this.results, this.searchBroker_fee)
      },
      filteredByPrice() {
        return getByPrice(this.results, this.searchPrice)
      },
    }
  }
  // funcoes de pesquisa fora do componente principal. as funcoes computadas secundarias chamam estas para ordenar , com input da lista e do que foi digitado
  function getById(results, searchId) {
    const Id = searchId.trim()
    if (!Id.length) return results
    return results.filter(result => result.id.toString().indexOf(Id) > -1)
  }

    function getByType(results, searchType) {
    const Type = searchType.trim()
    if (!Type.length) return results
    return results.filter(result => result.type.toLowerCase().indexOf(Type) > -1)
  }
  
  function getBysymbol(results, searchSymbol) {
    const symbol = searchSymbol.trim().toLowerCase()
    if (!symbol.length) return results
    return results.filter(result => result.symbol.toLowerCase().indexOf(symbol) > -1)
  }
  
      function getByQuant(results, searchQuant) {
    const Quant = searchQuant.trim()
    if (!Quant.length) return results
    return results.filter(result => result.quant.toString().indexOf(Quant) > -1)
  }
  
  function getByBroker_fee(results, searchBroker_fee) {
    const Broker_fee = searchBroker_fee.trim().toLowerCase()
    if (!Broker_fee.length) return results
    return results.filter(result => result.Broker_fee.toString().indexOf(Broker_fee) > -1)
  }
  
    function getByPrice(results, searchPrice) {
    const Price = searchBroker_fee.trim().toLowerCase()
    if (!Price.length) return results
    return results.filter(result => result.price.toString().indexOf(Price) > -1)
  }

</script>
      