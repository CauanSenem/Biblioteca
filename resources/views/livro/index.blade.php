@extends('layouts.app')
@section('title','Listagem de Livros')
@section('content')
<br>
    <h1>Listagem de Livros</h1>
   @if(Session::has('mensagem'))
        <div class="alert alert-info">
            {{Session::get('mensagem')}}
        </div>
    @endif 
    <br>
    {{Form::open(['url'=>'livros/buscar', 'method'=>'GET'])}}
    <div class="row">
        <div class="col-sm-3">
            <div class="input-group">
                @if($busca !== null)
                &nbsp;<a class="btn btn-info" href="{{url
                    ('livros/')}}">Todos</a>&nbsp;
                    @endif
            {{Form::text('busca', $busca, ['class'=>'form-control',
                'required', 'placeholder'=>'buscar'])}}
                &nbsp;
                <span class="input-group-btn">
                {{Form::submit('Buscar', ['class'=>'btn btn-warning'])}}
            </span>
            </div>
            </div>
            </div>
            {{Form::close()}}
            <br><br>
  <table class="table table-striped">
    @foreach ($livros as $livro)
    <tr>
       <td><a href="{{url('livros/'.$livro->id)}}">
            {{$livro->titulo}}</a>
    </td>
        @endforeach
    </tr>
</table> 
<h5>Novo Livro</h5>
<a class="btn btn-primary" href="{{url('livros/create')}}">Criar</a> 
        {{$livros->links()}}
        @endsection