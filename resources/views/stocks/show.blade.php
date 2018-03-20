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
     <h1>Id Da Acao: {{ $stock->id }}</h1>
    <ul>
      <li>Código(Simbolo): {{ $stock->symbol }}</li>
    </ul><ul>
      <li>Tipo: {{ $stock->type }}</li>
    </ul>
</div>
      
@endsection