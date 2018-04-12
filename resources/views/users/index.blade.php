@extends('layouts.app')

@section('content')
    <div class="container-fluid">
            <h2>
       Listagem de usuários:
      </h2>
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

      <userlist></userlist>



  </div>
@endsection