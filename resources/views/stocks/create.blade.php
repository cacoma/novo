@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="col-md-4"></div>
      <h2>Criar acao</h2><br  />
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
     <form method="post" action="{{ route('stocks.store')}}">
        {{csrf_field()}}
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="symbol">Código(simbolo):</label>
            <input type="text" class="form-control" name="symbol">
            @if($errors->has('symbol'))
                        <span class="help-block">{{ $errors->first('symbol') }}</span>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="type">Tipo:</label>
              <input type="text" class="form-control" name="type">
               @if($errors->has('type'))
                        <span class="help-block">{{ $errors->first('type') }}</span>
              @endif
            </div>
          </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success" style="margin-left:50px">Adicionar</button>
          </div>
        </div>
       </form>
       </div>

@endsection