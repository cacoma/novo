<template>
  <!--
  Stock list view - painel de indexamento de acoes.
  Rafael Caziraghi
  02mar2018 - primeira versao
  -->
<div>  
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
    <a href="/stocks/create" class="btn btn-success btn-xs pull-right">Adicionar ação</a>
  </h6>
  
  <table class="table table-bordered table-condensed table-hover">
    <thead>
      <tr colspan="4">
        <th class="col-sm-1"><div @click="sortBy('id')">ID
                      <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" v-if="orderer === 'id' & order === 'desc'"></span>
                      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" v-if="orderer === 'id' & order === 'asc'"></span>
          </div></th>
        <th class="col-sm-5"><div @click="sortBy('symbol')">Ticket
                      <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" v-if="orderer === 'symbol' & order === 'desc'"></span>
                      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" v-if="orderer === 'symbol' & order === 'asc'"></span>
          </div></th>
        <th class="col-sm-5"><div @click="sortBy('type')">Tipo
                      <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" v-if="orderer === 'type' & order === 'desc'"></span>
                      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" v-if="orderer === 'type' & order === 'asc'"></span>
          </div></th>
        <th class="col-sm-1">Opções</th>
      </tr>
      <tr >
        <!--
        inputs de pesquisa
      -->
        <td colspan="4" class="hiddenRow">
          <div class="accordian-body collapse" id="searchRow">
          <input class="col-sm-1" type="text" v-model="searchId">
          <input class="col-sm-5" type="text" v-model="searchSymbol">
          <input class="col-sm-5" type="text" v-model="searchType">
          </div>
        </td>
      </tr>
     </thead>
     <!--    montagem da lista, com animacao de ordesymbolnto  -->
    <tbody name="flip-list" is="transition-group">
      <tr v-for="(result, index) in filtered" :key="index">
        <td align="center" :key="result.id + '-first'"><a :href="'/stock/' + result.id" class="btn btn-info btn-xs">{{ result.id }}</a></td>
        <td v-text="result.symbol" :key="result.symbol"></td>
        <td v-text="result.type" :key="result.type"></td>
        <td align="center">
          <button type="button" class="btn btn-warning btn-xs" @click="setEditStock(result.id)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
          <button type="button" class="btn btn-danger btn-xs" @click="setDeleteStock(result.id)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        </td>
      </tr>
    </tbody>
  </table>
  <!--
  Modal editar
   -->
  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Editar a ação: {{ this.updateData.symbol }}</h5>
        </div>
        <form v-on:submit.prevent="updateStock">
          <div class="modal-body">
            <!--
            inputs (puxam do que foi mostrado) para atualizacao de dados
          -->
            <div class="row">
              <div class="col-md-4"></div>
              <div class="form-group col-md-4">
                <label for="id">ID:</label>
                <input class="form-control" type="text" name="id" v-model="updateData.id" disabled>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4"></div>
              <div class="form-group col-md-4">
                <label for="symbol">Ticket:</label>
<!--                 <input type="text" class="form-control" symbol="symbol" v-model="updateData.symbol"> -->
                <the-mask name="symbol" class="form-control" mask="AAAA#.AA" :masked="true" v-model="updateData.symbol" :value="updateData.symbol"></the-mask>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4"></div>
              <div class="form-group col-md-4">
                <label for="type">Tipo:</label>
                <input type="text" class="form-control" name="type" v-model="updateData.type">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button class="btn btn-primary">Salvar alterações</button>
          </div>
        </form>
      </div>
    </div>
  </div>
    <!--
  modal excluir
-->
  <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form v-on:submit.prevent="deleteStock">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Excluir a ação: {{ this.deleteData.symbol }}</h5>

        </div>
        <div class="modal-body">
          Voce tem certeza?
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button class="btn btn-danger">Excluir</button>
        </div>
      </form>
      </div>
    </div>
  </div>
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
        searchSymbol: "",
        searchType: "",
        order: "",
        updateData: {},
        deleteData: {},
        orderer: ""
      }
    },
   mounted() {
      // ao montar a instancia, traz todos os dados do BD
      this.stockList();
      this.token = document.head.querySelector('meta[name="csrf-token"]');
    },
    methods: {
      //busca todos os brokers no bd
      stockList: function() {
        this.results = [];
        axios.get('/api/searchstocks')
          .then(response => response.data)
          .then(data => Vue.set(this, 'results', data));
      },      
      //metodo para limpar inputs de pesquisa
      clearSearch: function() {
        this.searchId = "";
        this.searchSymbol = "";
        this.searchType = "";
      },
      // metodo para ordenar a lista, sem fazer outro download do bd
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
              case 'symbol':
                return i.symbol.toLowerCase();
                break;
              case 'type':
                return i.type.toLowerCase();
                break;
            }
          },
          this.order)
      },
       setEditStock: function(id) {
        // funcao para editar o usuario, acionando o modal. copia os dados da linha clicada
        this.errors = [];
        this.successes = [];
        this.updateData = [];
        $("#modalEdit").modal('show');
        axios.get('/stocks/' + id)
          .then(response => this.updateData = response.data)
      },
      setDeleteStock: function(id) {
        // funcao para editar o usuario, acionando o modal. copia os dados da linha clicada
        this.errors = [];        
        this.successes = [];
        this.deleteData = [];
        $("#modalDelete").modal('show');
        axios.get('/stocks/' + id)
          .then(response => this.deleteData = response.data)
      },
      updateStock: function() {
        // funcao para enviar os dados do moal para o BD por patch
        axios.put('/stocks/' + this.updateData.id, {
              symbol: this.updateData.symbol,
              type: this.updateData.type,
            }
          )
          .then((response) => {
                      this.errors = [];
                      this.success = [];          
                         if (response.data.error) {
                              this.errors.push(response.data.error);
                            }
                          if (response.data.success) {
                            this.successes.push(response.data.success);
                          }
                    })
          .catch((error)  => {
                if (error.response) {
                  // The request was made and the server responded with a status code
                  // that falls out of the range of 2xx
                  //console.log(error.response.data);
                  //console.log(error.response.status);
                  //console.log(error.response.headers);
                  this.successes = [];
                  this.errors = [];
                    if (error.response.data.errors.symbol) {
                      this.errors.push(error.response.data.errors.symbol[0]);
                    }
                    if (error.response.data.errors.type) {
                      this.errors.push(error.response.data.errors.type[0]);
                    }
                } else if (error.request) {
                  // The request was made but no response was received
                  // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                  // http.ClientRequest in node.js 
                  console.log(error.request);
                } else {
                  // Something happened in setting up the request that triggered an Error
                  console.log('Error', error.message);
                }
                console.log(error.config);
              })
          .then(response => {
            $("#modalEdit").modal("hide");
            //update the list
            this.stockList();
          });
      },
      deleteStock: function() {
        axios.delete('/stocks/' + this.deleteData.id)
          .then((response) => {
                      this.errors = [];
                      this.success = [];          
                         if (response.data.error) {
                              this.errors.push(response.data.error);
                            }
                          if (response.data.success) {
                            this.successes.push(response.data.success);
                          }
                      //this.errors.push(response.data.error);
                    })
          .catch((error)  => {
                if (error.response) {
                  // The request was made and the server responded with a status code
                  // that falls out of the range of 2xx
                  console.log(error.response.data);
                  console.log(error.response.status);
                  console.log(error.response.headers);
                } else if (error.request) {
                  // The request was made but no response was received
                  // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                  // http.ClientRequest in node.js
                  console.log(error.request);
                } else {
                  // Something happened in setting up the request that triggered an Error
                  console.log('Error', error.message);
                }
                console.log(error.config);
              }) 
          .then(response => {
            $("#modalDelete").modal("hide");
            //atualiza a lista
            this.stockList();
          });
      }
    },
    computed: {
      // funcoes de filtro, o primeiro chama os que seguem, de forma que os filtros se sobreponham
      filtered() {
        return getById(getBysymbol(getByType(this.results, this.searchType), this.searchSymbol), this.searchId)
      },
      filteredById() {
        return getById(this.results, this.searchId)
      },
      filteredBysymbol() {
        return getBysymbol(this.results, this.searchSymbol)
      },
      filteredByType() {
        return getByType(this.results, this.searchType)
      },
    }
  }
    // funcoes de pesquisa fora do componente principal. as funcoes computadas secundarias chamam estas para ordenar , com input da lista e do que foi digitado
  function getById(results, searchId) {
    const Id = searchId.trim()
    if (!Id.length) return results
    return results.filter(result => result.id.toString().indexOf(Id) > -1)
  }

  function getBysymbol(results, searchSymbol) {
    const symbol = searchSymbol.trim().toLowerCase()
    if (!symbol.length) return results
    return results.filter(result => result.symbol.toLowerCase().indexOf(symbol) > -1)
  }

  function getByType(results, searchType) {
    const Type = searchType.trim()
    if (!Type.length) return results
    return results.filter(result => result.type.toLowerCase().indexOf(Type) > -1)
  }
</script>
