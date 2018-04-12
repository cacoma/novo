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
       <div class="help-error">
         <p>{{ \Session::get('errors') }}</p>
       </div><br />
      @endif
      <a href="{{action('InvestController@create')}}" class="btn btn-success pull-right">Adicionar investimentos</a>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tipo</th>
        <th>Codigo (simbolo)</th>
        <th>Quantidade</th>
        <th>Preco</th>
        <th>Corretagem</th>
        <th>Total</th>
        <th>Data Compra</th>
        <th>Corretora</th>
         @if ($user->role_id == '1')
        <th>Dono</th>
         @endif
        <th colspan="2">Opção</th>
      </tr>
    </thead>
    <tbody>
      @foreach($invests as $invest)
      <tr>
        <td>{{$invest->id}}</td>
        <td>{{$invest->type}}</td>
        <td>{{$invest->symbol}}</td>
        <td>{{number_format($invest->quant)}}</td>
        <td>R$ {{number_format($invest->price, 2, ',', '.')}}</td>
        <td>R$ {{number_format($invest->broker_fee, 2, ',', '.')}}</td>
<!--         <td><currencybrl brl="{{$invest->broker_fee}}"></currencybrl></td>
        <td><currencybrl brl="{{$invest->broker_fee}}"></currencybrl></td> -->
<!--         <td>R$ {{strtr(((float)$invest->quant * (float)$invest->price + (float)$invest->broker_fee), 'X' , ',')}}</td> -->
        <td>R$ {{number_format(($invest->quant * $invest->price + $invest->broker_fee), 2, ',', '.')}}</td>
        <td>{{$invest->date_invest->format('d/m/Y')}}</td>
        <td>{{$invest->broker->name}}</td>
         @if ($user->role_id == '1')
        <td>{{$invest->user->name}}</td>
        @endif
         <td><a href="{{action('InvestController@edit', $invest->id)}}" class="btn btn-warning">Editar</a></td> 
        <td>
          <form action="{{action('InvestController@destroy', $invest->id)}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Deletar</button>
          </form>
        </td>
      </tr>
      @endforeach
            {{ $invests->links() }}

    </tbody>
  </table>
  </div>
@endsection