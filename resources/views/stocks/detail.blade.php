@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
     <h1>Id Da Acao: {{ $stock->id }}</h1>
    <ul>
      <li>Código(Simbolo): {{ $stock->symbol }}</li>
    </ul>
      <ul>
      <li>Tipo: {{ $stock->type }}</li>
    </ul>
      <ul>
      <li>Criado em: {{ $stock->created_at->format('d/m/Y H:i') }}</li>
    </ul>
      <ul>
      <li>Atualizado em: {{ $stock->updated_at->format('d/m/Y H:i') }}</li>
    </ul>
      <br>
      <a href="{{ URL::previous() }}"class="btn btn-info">Retornar</a>
</div>
      
@endsection