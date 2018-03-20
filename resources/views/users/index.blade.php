@extends('layouts.app')

@section('content')
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <!-- <meta name="content" content="{{ csrf_token() }}"> -->
<div>
  <table class="table table-striped">
    <thead>
      <tr>
        <!-- cabecalho da lista e entrada da função de ordenamento -->
        <th>Nome</th>
        <th>Email</th>
      </tr>
     </thead>
   
</div>
<div>
    <tbody name="flip-list">
      @foreach ($users as $user)
       <tr>
          
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
         
      </tr>
       @endforeach
      {{ $users->links() }}
</div>
    </tbody>  
  </table>

@endsection