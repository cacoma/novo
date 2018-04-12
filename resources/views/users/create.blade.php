@extends('layouts.app')

@section('content')
    <div class="container-fluid">
            <h2>
       Criação de usuários somente pela página principal.
      </h2>
      
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
      
     @endif
      
      <a href="{{ URL::previous() }}"class="btn btn-success pull-right">Retornar</a>
  </div>
@endsection