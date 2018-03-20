@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif 
                  
                    @auth
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
                    @endauth
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
