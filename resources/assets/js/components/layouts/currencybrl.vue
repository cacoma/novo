<template>
  <div>
    <input v-show="false" v-money="money" v-model="tvalue">{{ tvalue }}
  </div>
</template>

<script>
  import {Money} from 'v-money'

  export default {
    components: {Money},
    props: ['brl'],
    data () {
      return {
        tvalue: this.brl,
        money: {
          decimal: ',',
          thousands: '.',
          prefix: 'R$ ',
          precision: 2,
          masked: false
        }
      }
    },

  }
</script>