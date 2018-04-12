@extends('layouts.app')

@section('content')
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <!-- <meta name="content" content="{{ csrf_token() }}"> -->
    
    <a href="{{action('BrokerController@create')}}" class="btn btn-success pull-right">Adicionar corretoras</a>
 
  <table class="table table-striped">
    <thead>
      <tr>
        <!-- cabecalho da lista e entrada da função de ordenamento -->
        <th>ID</th>
        <th>Nome</th>
        <th>CNPJ</th>
        <th>Editar</th>
        <th>Deletar</th>
      </tr>
     </thead>
   


    <tbody name="flip-list">

      @foreach ($brokers as $broker)
       <tr>
          
        <td><a href="{{action('BrokerController@show', $broker->id)}}" class="btn btn-info">{{ $broker->id }}</a></td>
        <td>{{ $broker->name }}</td>
        <td>{{ $broker->cnpj }}</td>
        <td><a href="{{action('BrokerController@edit', $broker->id)}}" class="btn btn-warning">Editar</a></td>
        <td>
          <form action="{{action('BrokerController@destroy', $broker->id)}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Deletar</button>
          </form>
         
      </tr>
       @endforeach
      {{ $brokers->links() }}

    </tbody>  
  </table>
</div>
@endsection