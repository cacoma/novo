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

  <table class="table table-striped">
    <thead>
      <tr>
        <!-- cabecalho da lista e entrada da função de ordenamento -->
        <th>ID</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Editar</th>
        <th>Deletar</th>
      </tr>
     </thead>
   


    <tbody name="flip-list">

      @foreach ($stocks as $stock)
       <tr>
          
        <td><a href="{{action('StockController@show', $stock->id)}}" class="btn btn-info">{{ $stock->id }}</a></td>
        <td>{{ $stock->symbol }}</td>
        <td>{{ $stock->type }}</td>
        <td><a href="{{action('StockController@edit', $stock->id)}}" class="btn btn-warning">Editar</a></td>
        <td>
          <form action="{{action('StockController@destroy', $stock->id)}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Deletar</button>
          </form>
         
      </tr>
       @endforeach
      {{ $stocks->links() }}

    </tbody>  
  </table>
</div>
@endsection