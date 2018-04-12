@extends('layouts.app')

@section('content')
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
     @if (\Session::has('errors'))
       <div class="help-block">
         <p>{{ \Session::get('errors') }}</p>
       </div><br />
      @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Codigo (simbolo)</th>
        <th>Data da cotação</th>
        <th>Abertura</th>
        <th>Alta</th>
        <th>Baixa</th>
        <th>Fechamento</th>
        <th>Volume</th>
        <th colspan="2">Opção</th>
      </tr>
    </thead>
    <tbody>
      @foreach($monthlyQuotes as $monthlyQuote)
      <tr>
        <td>{{$monthlyQuote->id}}</td>
        <td>{{$monthlyQuote->stock->symbol}}</td>
        <td>{{$monthlyQuote->timestamp->format('d/m/Y')}}</td>
        <td>R$ {{number_format($monthlyQuote->open, 2, ',', '.')}}</td>
        <td>R$ {{number_format($monthlyQuote->high, 2, ',', '.')}}</td>
        <td>R$ {{number_format($monthlyQuote->low, 2, ',', '.')}}</td>
        <td>R$ {{number_format($monthlyQuote->close, 2, ',', '.')}}</td>
        <td>{{number_format($monthlyQuote->volume, 0, ',', '.')}}</td>
         <td><a href="{{action('MonthlyQuotesController@edit', $monthlyQuote->id)}}" class="btn btn-warning">Editar</a></td> 
        <td>
          <form action="{{action('MonthlyQuotesController@destroy', $monthlyQuote->id)}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Deletar</button>
          </form>
        </td>
      </tr>
      @endforeach
      
            {{ $monthlyQuotes->links() }}

    </tbody>
  </table>
  </div>
@endsection