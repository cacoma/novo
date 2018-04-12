@extends('layouts.app')

@section('content')
            <div class="panel panel-default">
                 <br />
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                  
                    @auth
<!--                     @if (session()->has('success'))
                      <div class="alert alert-success">
                        <p>{{ session('success') }}</p>
                      </div><br />
                     @endif
                     @if (session()->has('errors'))
                       <div class="help-block">
                         <p>{{ session('errors') }}</p>
                       </div><br />
                      @endif
                  @if (session()->has('status'))
                      <div class="alert alert-info">
                          {{ session('status') }}
                      </div>
                  @endif -->
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
                  
                         <div class="content">
                           <div class="title m-b-md">
                              Ações
                               <li><a href="{{ url('/stocks/create') }}">Adicionar ação</a></li>
                             <li><a href="{{ url('/stocks') }}">Listar ações</a></li>
                           </div>
                           <div class="title m-b-md">
                                Usuarios:
                                <li><a href="{{ route('users.index') }}">Index</a></li>
                           </div> 
                           <div class="title m-b-md">
                                Invests:
                                <li><a href="{{ route('invests.index') }}">Index</a></li>
                                <li><a href="{{ route('invests.create') }}">Criar</a></li>
                           </div>
                           </div>
                    @endauth

              </div>
    </div>
@endsection
