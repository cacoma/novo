@extends('layouts.app')

@section('content')
    <div>
      
      <h2>Editar investimento</h2><br  />
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br />
      @endif
      @if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
      </div><br />
      @endif

      <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
       </div>

@endsection