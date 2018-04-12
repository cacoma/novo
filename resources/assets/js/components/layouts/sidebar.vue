// descontinuado por solucao mais simples -> resources/views/layout/sidebar.vue
// rcaziraghi - 24062018

<template>
<div id="sidebar">
<ul class="nav nav-pills nav-stacked">
            <li role="presentation" @click="selected = 1" :class="{ active: selected == 1}"><a href="/home">Dashboard<span class="sr-only">(current)</span></a></li>
            <li role="presentation" @click="selected = 2" :class="{ active: selected == 2}"><a href="/stocks/create">Criar acoes</a></li>
            <li role="presentation" @click="selected = 3" :class="{ active: selected == 3}"><a href="">Nav item again</a></li>
            <li role="presentation" @click="selected = 4" :class="{ active: selected == 4}"><a href="/users">Usuarios</a></li>
            <li role="presentation" @click="selected = 5" :class="{ active: selected == 5}"><a href="">One more nav</a></li>
            <li><!-- Link with dropdown items -->
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Acoes</a>
                <ul class="collapse list-unstyled" id="stockSubmenu">
                    <li><a href="/stocks">Todas acoes</a></li>
                    <li><a href="/stocks/create">Incluir</a></li>
                    <li><a href="#">teste</a></li>
                </ul>
                </li>
          </ul>
</div>
</template>
<script>
export default {
  data() {
    return { selected: undefined }
  }
}
</script>
