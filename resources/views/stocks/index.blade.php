@extends('layouts.app')

@section('content')
    <div class="container-fluid">
      <h2>
       Listagem de ações:
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
    
 <stocklist></stocklist>
      
</div>
@endsection