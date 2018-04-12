@extends('layouts.app')

@section('content')
    <div>
      <h2>Adicionar corretora</h2><br  />
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
     <form method="post" action="{{ route('brokers.store')}}">
        {{csrf_field()}}
         <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="name">
            @if($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
            @endif
           </div>
           <div class="form-group col-md-6">
              <label for="cnpj">CPNJ:</label>
             <the-mask class="form-control" name="cnpj" :mask="['###.###.###-##', '##.###.###/####-##']"></the-mask>
               @if($errors->has('cnpj'))
                        <span class="help-block">{{ $errors->first('cnpj') }}</span>
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