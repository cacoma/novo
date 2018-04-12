@extends('layouts.app')

@section('content')
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
     <h1>Id Da corretora: {{ $broker->id }}</h1>
    <ul>
      <li>Nome: {{ $broker->name }}</li>
    </ul>
      <ul>
      <li>CNPJ: {{ $broker->cnpj }}</li>
    </ul>
      <ul>
      <li>Criado em: {{ $broker->created_at->format('d/m/Y H:i') }}</li>
    </ul>
      <ul>
      <li>Atualizado em: {{ $broker->updated_at->format('d/m/Y H:i') }}</li>
    </ul>
      <br>
      <a href="{{ URL::previous() }}"class="btn btn-info">Retornar</a>
</div>
      
@endsection