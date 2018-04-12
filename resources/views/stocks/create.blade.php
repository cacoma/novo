@extends('layouts.app')

@section('content')
    <div>
      <h2>Criar acao</h2><br  />
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
     <form method="post" action="{{ route('stocks.store')}}">
        {{csrf_field()}}
          <div class="form-row">
          <div class="form-group col-md-6">
            <label for="symbol">Código(simbolo):</label>
<!--             <input type="text" class="form-control" name="symbol"> -->
            <the-mask name="symbol" class="form-control" mask="AAAA#.AA" :masked="true"></the-mask>
            @if($errors->has('symbol'))
                        <span class="help-block">{{ $errors->first('symbol') }}</span>
            @endif
           </div>
           <div class="form-group col-md-6">
              <label for="type">Tipo:</label>
              <input type="text" class="form-control" name="type">
               @if($errors->has('type'))
                        <span class="help-block">{{ $errors->first('type') }}</span>
              @endif
            </div>
            </div>
            <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success">Adicionar</button>
            <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
          </div>
       </form>
</div>
@endsection