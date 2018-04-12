@extends('layouts.app')

@section('content')
    <div>
      
      <h2>Adicionar investimento</h2><br  />
                 @if (\Session::has('success'))
                      <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                      </div>
                     @endif
                     @if (\Session::has('errors'))
                       <div class="alert alert-danger">
                         <p>{{ \Session::get('errors') }}</p>
                       </div>
                      @endif
                  @if (\Session::has('status'))
                       <div class="alert alert-info">
                         <p>{{ \Session::get('status') }}</p>
                       </div>
                      @endif
      <createinvests></createinvests>
      <div class="form-row">
        <div class="form-group col-md-4">
      <br><a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
       </div>
       </div>
       </div>

@endsection