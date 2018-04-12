@extends('layouts.app')

@section('content')
    <div>
      
      <h2>Adicionar monthly quotes</h2><br  />
                 @if (\Session::has('success'))
                      <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                      </div>
                     @endif
                     @if (\Session::has('error'))
                       <div class="alert alert-danger">
                         <p>{{ \Session::get('error') }}</p>
                       </div>
                      @endif
                  @if (\Session::has('status'))
                       <div class="alert alert-info">
                         <p>{{ \Session::get('status') }}</p>
                       </div>
                      @endif
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
      <createmonthlyquotes></createmonthlyquotes>
      <div class="form-row">
        <div class="form-group col-md-4">
      <br><a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
       </div>
       </div>
       </div>

@endsection