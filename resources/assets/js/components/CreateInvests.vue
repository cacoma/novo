<template>
  <div>
     <form method="post" action="">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label class="control-label" for="type">Tipo de investimento:</label>
              <select v-model="type" name="type" class="form-control" required>
                <option selected value="">Selecionar</option>
                <option value="A">Acoes</option>
                <option value="B">Nao usar</option>
                <option value="C">Nao usar tambem</option>
              </select>

            </div>
            </div>
            
            <createinveststypestocks v-if="type === 'A'">
                
            </createinveststypestocks>
            <template v-else-if="type === 'B'">
            <div class="form-row">
              <div class="form-group col-md-12">
                          <label class="control-label col-md-6" for="nu">Nao usar</label>
                          <input type="text" class="form-control col-md-6" name="nu" disabled>
                        </div>
            </div>
            </template>
            <template v-else-if="type === 'C'">
              <div class="form-row">
              <div class="form-group col-md-12">
                 <label class="control-label col-md-6" for="nut">Nao usar tambem</label>
                          <input type="text" class="form-control col-md-6" name="nut" disabled>
                          </div> 
              </div>
            </template>           
            <template v-else>
              <div class="form-row">
              <div class="form-group col-md-12" >
              <label class="control-label col-md-6">Selecione uma opção acima.</label>
              </div>
              </div>
            </template>
       <div class="form-group">
         <div class="form-row col-md-12">
         <label class="control-label col-md-4"></label>
           <button type="submit" class="btn btn-success form-control">Adicionar</button>
        </div>
        </div>

       </form>
     </div> 
  </template>
  <script>
    export default {
        data() {
          return {
            type: "",
            errors: []
            }
          },
        mounted() {
            console.log('Component mounted.')
        },
        
    }
</script>