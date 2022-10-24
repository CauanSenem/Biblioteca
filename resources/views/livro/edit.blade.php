@extends('layouts.app')
@section('title','Criar novo Contato')
@section('content')
<br>
    <h1>Alteração de livro</h1>
@if(Session::has('mensagem'))
    <div class="alert alert-success">
        {{Session::get('mensagem')}}
    </div>    
@endif
<br>
{{Form::open(['route' => ['livros.update', $livro->id], 'method' => 'PUT',
    'enctype'=>'multipart/form-data'])}}
        {{Form::label('titulo', 'Titulo')}}
        {{Form::text('titulo', $livro->titulo, ['class'=>'form-control', 'required', 
        'placeholder' =>'título do livro'])}}        
        {{Form::label('descricao', 'Descricao')}}
        {{Form::textarea('descricao', $livro->descricao, ['class'=>'form-control', 'required', 
        'placeholder' =>'descrição do livro'])}}
        {{Form::label('autor', 'Autor')}}
        {{Form::text('autor', $livro->autor, ['class'=>'form-control', 'required', 
        'placeholder' =>'autor do livro'])}}
        {{Form::label('editora', 'Editora')}}
        {{Form::text('editora', $livro->editora, ['class'=>'form-control', 'required', 
        'placeholder' =>'Editora do livro'])}}
        {{Form::label('ano', 'Ano')}}
        {{Form::text('ano', $livro->ano, ['class'=>'form-control', 'required', 
        'placeholder' =>'Ano de publicação'])}}
        {{Form::label('foto', 'Foto')}}
        {{Form::file('foto',['class'=>'form-control','id'=>'foto'])}}
        <br>
        {{Form::submit('Salvar', ['class'=>'btn btn-success'])}}
        {!!Form::button('Cancelar', ['onclick'=>'javascript:history.go(-1)',
            'class'=> 'btn btn-danger'])!!}
        {{Form::close()}}
        @endsection