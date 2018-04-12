<template>
<!--  cabecalho -->
<b-container fluid>
  <!-- User Interface controls -->
  <b-row>
    <a href="/invests/create" class="btn btn-success btn-xs pull-right">Adicionar investimento</a>
  </b-row>
  <b-row>
    <b-col md="6" class="my-1">Pesquisar:
      <div class="input-group">
        <input type="text" class="form-control" v-model="filter" placeholder="Procurar">
        <!-- <b-form-select class="form-control" :options="symbolsIndex" v-model="filter"></b-form-select> -->
        <span class="input-group-btn">
        <button :disabled="!filter" @click="filter = ''" class="btn btn-default" type="button">Limpar</button>
      </span>
      </div>
      <!-- /input-group -->
      <!--         <div class="input-group">Filtro:

              <button :disabled="!filter" @click="filter = ''" id="addonFilter" class="input-group-addon">
                 <span class="input-group-addon" id="addonFilter">@example.com</span>Limpar</button>
        </div> -->
    </b-col>
    <b-col md="6" class="my-1">
      Registros por página
      <b-form-select :options="pageOptions" v-model="perPage" />

    </b-col>
  </b-row>
  <br>
  <!--     corpo da tabela -->
  <!--     cabecalho da tabela -->
  <b-table show-empty stacked="md" :bordered="true" :hover="true" :items="items" :fields="fields" :current-page="currentPage" :per-page="perPage" :filter="filter" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" @filtered="onFiltered">

    <template slot="id" slot-scope="row">{{row.value}}</template>
    <template slot="type" slot-scope="row">{{row.value}}</template>
    <template slot="symbol" slot-scope="row">{{row.value}}</template>
    <template slot="quant" slot-scope="row">{{row.value}}</template>
    <template slot="broker_fee" slot-scope="row">{{row.value}}</template>
    <template slot="price" slot-scope="row">{{row.value}}</template>
    <template slot="total" slot-scope="row">{{row.value}}</template>
    <template slot="quote" slot-scope="row"> {{row.value}}</template>
    <template slot="sit" slot-scope="row">{{row.value}}</template>
    <!--           template das opcoes -->
    <template slot="actions" slot-scope="row">
<!--             traz a opcao de modal e de detalhes -->
            <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
            <!-- o toggle details nao funciona trazendo os dados da view -->
<!--             <b-button size="xs" @click.stop="row.toggleDetails"> -->
            <b-button size="xs" @click.stop="toggleInfo(row.item, row.index, $event.target)">
              {{ row.detailsShowing ? 'Esconder' : 'Mostrar'}} detalhes
            </b-button>
          <b-button size="xs" @click.stop="info(row.item, row.index, $event.target)" class="mr-1">
            Detalhes
          </b-button>

          <!-- <b-form-checkbox @click.native.stop @change="row.toggleDetails" v-model="row.detailsShowing">
          Ver detalhes
          </b-form-checkbox> -->
          <a :href="`${row.value}/investedit`" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
          <a :href="`${row.value}/investdestroy`" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
        </template>
    <!--         template slot dos detalhes -->
    <template slot="row-details" slot-scope="row">
 <!--           <tr v-for="(value, key) in row.item" :key="key">
            <td>{{ key }}:</td>
            <td>{{ value}}</td>
          </tr> -->
<!--           <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value}}</li>
          </ul> -->
          <b-card>
          <b-row class="mb-2">
          <b-col sm="3" class="text-sm-right"><b>Codigo:</b></b-col>
          <b-col>{{ row.item.symbol }}</b-col>
          <b-col sm="3" class="text-sm-right"><b>Corretora:</b></b-col>
          <!-- <b-col></b-col> -->
          <b-col>{{ row.item.broker.name }}</b-col>
        </b-row>
        <b-row class="mb-2">
          <b-col sm="3" class="text-sm-right"><b>Data do investimento:</b></b-col>
          <b-col>{{ row.item.date_invest }}</b-col>
          <b-col sm="3" class="text-sm-right"><b>Criado em:</b></b-col>
          <b-col>{{ row.item.created_at }}</b-col>
          <b-col sm="3" class="text-sm-right"><b>Atualizado por ultimo em:</b></b-col>
          <b-col>{{ row.item.updated_at }}</b-col>
        </b-row>
        </b-card>
      </template>
  </b-table>
 

  <!-- Info modal -->
  <!--     <b-modal id="modalInfo" @hide="resetModal" :title="modalInfo.title" ok-only>
      <pre>{{ modalInfo.content }}</pre>
    </b-modal> -->
  <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoLabel" @hide="resetModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ this.modalInfo.symbol }}</h5>
        </div>
        <div class="modal-body">
          <!--           {{ modalInfo.id }} -->
          <!--           <b-table striped hover :items="modalInfo"></b-table> -->
          <b-card>
            <b-row class="mb-4">
              <b-col sm="4" class="text-sm-right"><b>Codigo:</b></b-col>
              <b-col>{{ modalInfo.symbol }}</b-col>
              <b-col sm="4" class="text-sm-right"><b>Preço:</b></b-col>
              <b-col>{{ this.currency(modalInfo.price) }}</b-col>
              <b-col sm="4" class="text-sm-right"><b>Quantidade:</b></b-col>
              <b-col>{{ modalInfo.quant }}</b-col>
              <b-col sm="4" class="text-sm-right"><b>Corretagem:</b></b-col>
              <b-col>{{ this.currency(modalInfo.broker_fee) }}</b-col>
              <b-col sm="4" class="text-sm-right"><b>Total:</b></b-col>
              <b-col>{{this.currency(modalInfo.total)}}</b-col>
              <b-col sm="4" class="text-sm-right"><b>Corretora:</b></b-col>
              <b-col>{{ this.modalInfo.brokerName }}</b-col>
              <b-col sm="4" class="text-sm-right"><b>Data do investimento:</b></b-col>
              <b-col>{{ modalInfo.date_invest }}</b-col>
              <b-col sm="4" class="text-sm-right"><b>Criado em:</b></b-col>
              <b-col>{{ modalInfo.created_at }}</b-col>
              <b-col sm="4" class="text-sm-right"><b>Atualizado por ultimo em:</b></b-col>
              <b-col>{{ modalInfo.updated_at }}</b-col>
            </b-row>
          </b-card>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <!--     pagination -->
  <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
</b-container>
</template>
<script>
const items = {};
//   const symbols = [];
//   const symbolsIndex = [];
//   const types = [];
//   const typesIndex = [];
var i;
var locale = 'pt-BR';
var options = {
  style: 'currency',
  currency: 'brl',
  minimumFractionDigits: 2,
  maximumFractionDigits: 2
};
var formatter = new Intl.NumberFormat(locale, options);
var percentageOptions = {
  style: 'percent',
  minimumFractionDigits: 3,
  maximumFractionDigits: 3
}
var percentager = new Intl.NumberFormat(locale, percentageOptions);
export default {
  props: ['items'],
  data() {
    return {
      fields: [{
          key: 'id',
          label: 'ID',
          sortable: true
        },
        {
          key: 'type',
          label: 'Tipo',
          sortable: true
        },
        {
          key: 'symbol',
          label: 'Codigo',
          sortable: true
        },
        {
          key: 'quant',
          label: 'Quantidade',
          sortable: true,
          'class': 'text-center',
          formatter: (value, key, item) => {
            return parseFloat(item.quant).toFixed(0);
          }
        },
        {
          key: 'broker_fee',
          label: 'Corretagem',
          sortable: true,
          formatter: (value, key, item) => {
            return formatter.format(item.broker_fee);
          }
        },
        {
          key: 'price',
          label: 'Preço',
          sortable: true,
          formatter: (value, key, item) => {
            return formatter.format(item.price);
          }
        },
        {
          key: 'total',
          label: 'Total',
          sortable: true,
          formatter: (value, key, item) => {
            //return formatter.format(item.quant * item.price + item.broker_fee)
            return formatter.format(item.total);
            //return parseFloat(Math.round(item.quant * 100) / 100).toFixed(2) * parseFloat(Math.round(item.price * 100) / 100).toFixed(2) + parseFloat(Math.round(item.broker_fee * 100) / 100).toFixed(2);
          }
        },
        //label da cotacao diaria
        {
          key: 'quote',
          label: 'Cotação',
          sortable: true,
          formatter: (value, key, item) => {
            return formatter.format(item.quote);
          }
        },
        {
          key: 'sit',
          label: 'Situação',
          'class': (value, key, item) => {
            return item.class;
          },
          formatter: (value, key, item) => {
            //return parseFloat((item.quote / item.price - 1) * 100).toFixed(3);
            return percentager.format(item.quote / item.price - 1);
         }
        },
        //formatter da key options serve para as opcoes de editar e excluir um investimento
        {
          key: 'actions',
          label: 'Actions',
          formatter: (value, key, item) => {
            return `/${item.type}s/${item.id}`
          }
        },
      ],
      currentPage: 1,
      perPage: 15,
      totalRows: items.length,
      pageOptions: [5, 10, 15, 20, 25, 30],
      sortBy: null,
      sortDesc: false,
      filter: null,
      modalInfo: [],
      symbols: {},
      symbolsIndex: {},
      types: {},
      typesIndex: []
    }
  },
  computed: {
    sortOptions() {
      // Create an options list from our fields
      // nao precisa, somente em caso de filtro por campo, que nao está implementado
      return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return {
            text: f.label,
            value: f.key
          }
        })
    },

  },
  methods: {
    //nao precisa, pois estamos trazendo as informacoes com a view
    investList() {
      this.items = [];
      axios.get('/indexinvests')
        .then(response => response.data)
        .then(data => Vue.set(this, 'items', data))
      //Vue.set(this, 'items', this.invests)
    },
    //faz um indexamento dos dados trazidos: quantos sao de cada tipo (acao, td, etc), e quais são
    dataIndex() {
      //       this.symbols = this.items.reduce(function(acc, item) {
      //             //return [...prev, ...curr.symbol];
      //               (acc[item.symbol] = acc[item.symbol] || []).push(item.symbol)
      //               return acc
      //       }, {})
      //primeira separa cada investimento pelo simbolo

      this.symbols = this.items.reduce(function(cont, item) {
        cont[item.symbol] = cont[item.symbol] || [];
        cont[item.symbol].push(item);
        return cont;
      }, Object.create(null));
      //este indexa todos os simbolos que vieram
      this.symbolsIndex = Object.keys(this.symbols);


      //this.symbolsIndex = Object.assign({}, this.symbols, Object.keys(this.symbols))

      //primeira separa cada investimento pelo tipo
      this.types = this.items.reduce(function(cont, item) {
        cont[item.type] = cont[item.type] || [];
        cont[item.type].push(item);
        return cont;
      }, Object.create(null));

      //este indexa todos os tipos que vieram
      this.typesIndex = Object.keys(this.types);
      //       response.data.trips.reduce(function(r, a) {
      //                         r[a.start_date] = r[a.start_date] || [];
      //                         r[a.start_date].push(a);
      //                         return r;
      //                     }, Object.create(null));
    },
    //somente logica para implementar depois a questao de cores das celulas
    redOrGreen() {
      for (i = 0; i < this.items.length; i++) {

        //Vue.set(this.item[i], '_cellVariants', 'danger')
        //this.items = Object.assign({}, this.items, { _showDetails: false, teste: 2 });

        //this.items[i]._cellVariants = {};
        //this.items[i]._cellVariants["total"] = 'danger';
        //this.items[i]._showDetails = false;
        //this.items.splice(i, _showDetails, false);
        //this.items[i].brokerName = this.items[i].broker.name;


        if (!typeof this.items[i].monthly_quotes[0].close === 'undefined') {
          console.log("sem preco")
        } else if (this.items[i].price > this.items[i].monthly_quotes[0].close) {
          console.log(this.items[i].price + this.items[i].monthly_quotes[0].close + "maior")
        } else if (this.items[i].price < this.items[i].monthly_quotes[0].close) {
          console.log(this.items[i].price + this.items[i].monthly_quotes[0].close + "maior")
        } else if (this.items[i].price = this.items[i].monthly_quotes[0].close) {
          console.log(this.items[i].price + this.items[i].monthly_quotes[0].close + "igual")
        }
      }
    },
    //transforma os dados em
    currency(item) {
      return formatter.format(item)
    },
    //traz as informacoes para o modal
    info(item, index, button) {
      //this.modalInfo.title = `Investimento: ${item.symbol}`
      //this.modalInfo.content = JSON.stringify(item, null, 2)
      this.modalInfo = item
      this.modalInfo.brokerName = item.broker.name
      $("#modalInfo").modal('show')
      //this.$root.$emit('bv::show::modal', 'modalInfo', button)
    },
    toggleInfo(item, index, button) {
      //this.modalInfo.title = `Investimento: ${item.symbol}`
      //this.modalInfo.content = JSON.stringify(item, null, 2)
      if (!item._showDetails) {
        Vue.set(item, '_showDetails', true)
      } else if (item._showDetails == false) {
        Vue.set(item, '_showDetails', true)
      } else {
        Vue.set(item, '_showDetails', false)
      }
      this.$forceUpdate()
      //this.$root.$emit('bv::show::modal', 'modalInfo', button)
    },
    //reseta o modal, depois de mostrar as infos
    resetModal() {
      //this.modalInfo.title = ''
      this.modalInfo = []
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    },
  },
  created() {
    // ao criar a instancia, traz todos os dados do BD
    //this.investList();
    //this.invests = this.items,
    this.dataIndex();
    //this.redOrGreen();
    this.token = document.head.querySelector('meta[name="csrf-token"]');
  },
  mounted() {
    //Vue.set(this.invests, 'invests', this.items)
    //this.items = Object.assign({}, this.items, this.invests)

  },
}
</script>
