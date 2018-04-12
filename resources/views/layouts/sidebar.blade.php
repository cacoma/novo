<div class="panel-group nav-sidebar" id="sidebar">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
        <a href="{{ url('/home') }}">Dashboard</a>
        </h4>
      </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#sidebar" href="#collapseusers">
        Usuarios</a>
      </h4>
    </div>
    <div id="collapseusers" class="panel-collapse collapse">
      <ul class="list-group">
       <li class="list-group-item"><a href="{{ url('/users') }}">Listar</a></li>
       <li class="list-group-item"><a href="{{ url('/users/create') }}">Incluir</a></li>
      </ul>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#sidebar" href="#collapseinvestments">
        Investimentos</a>
      </h4>
    </div>
    <div id="collapseinvestments" class="panel-collapse collapse">
      <ul class="list-group">
       <li class="list-group-item"><a href="{{ url('/invests') }}">Listar</a></li>
       <li class="list-group-item"><a href="{{ url('/invests/create') }}">Incluir</a></li>
      </ul>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#sidebar" href="#collapsestocks">
        Ações</a>
      </h4>
    </div>
    <div id="collapsestocks" class="panel-collapse collapse">
      <ul class="list-group">
       <li class="list-group-item"><a href="{{ url('/stocks') }}">Listar</a></li>
       <li class="list-group-item"><a href="{{ url('/stocks/create') }}">Incluir</a></li>
      </ul>
    </div>
  </div>
    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#sidebar" href="#collapsebrokers">
        Corretoras</a>
      </h4>
    </div>
    <div id="collapsebrokers" class="panel-collapse collapse">
      <ul class="list-group">
       <li class="list-group-item"><a href="{{ url('/brokers') }}">Listar</a></li>
       <li class="list-group-item"><a href="{{ url('/brokers/create') }}">Incluir</a></li>
      </ul>
    </div>
  </div>
      <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#sidebar" href="#collapsemontlhyquotes">
        Cotações mensais</a>
      </h4>
    </div>
    <div id="collapsemontlhyquotes" class="panel-collapse collapse">
      <ul class="list-group">
       <li class="list-group-item"><a href="{{ url('/monthlyQuotes') }}">Listar</a></li>
       <li class="list-group-item"><a href="{{ url('/monthlyQuotes/create') }}">Incluir</a></li>
      </ul>
    </div>
  </div>
</div>