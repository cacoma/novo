@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="col-md-4"></div>
      <h2>Adicionar investimento</h2><br  />
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
      <createinvests></createinvests>
       </div>

@endsection