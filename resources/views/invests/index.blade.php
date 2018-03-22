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
        <th>Código</th>
        <th>Tipo</th>
        <th>Dono</th>
        <th colspan="2">Opção</th>
      </tr>
    </thead>
    <tbody>
      @foreach($invests as $invest)
      <tr>
        <td>{{$invest->id}}</td>
        <td>{{$invest->name}}</td>
        <td>{{$invest->type}}</td>
        <td>{{$invest->user->name}}</td>
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
    </tbody>
  </table>
  </div>
@endsection