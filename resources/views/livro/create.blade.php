@extends('layouts.app')
@section('title','Criar novo Livro')
@section('content')
<br>
    <h1>Criar novo livro</h1>
<br>
    {{Form::open(['route' => 'livros.store', 'method' => 'POST',
        'enctype'=>'multipart/form-data'])}}
        {{Form::label('titulo', 'Titulo')}}
        {{Form::text('titulo', '', ['class'=>'form-control', 'required', 
        'placeholder' =>'título do livro'])}}        
        {{Form::label('descricao', 'Descricao')}}
        {{Form::textarea('descricao', '', ['class'=>'form-control', 'required', 
        'placeholder' =>'descrição do livro'])}}
        {{Form::label('autor', 'Autor')}}
        {{Form::text('autor', '', ['class'=>'form-control', 'required', 
        'placeholder' =>'autor do livro'])}}
        {{Form::label('editora', 'Editora')}}
        {{Form::text('editora', '', ['class'=>'form-control', 'required', 
        'placeholder' =>'Editora do livro'])}}
        {{Form::label('ano', 'Ano')}}
        {{Form::text('ano', '', ['class'=>'form-control', 'required', 
        'placeholder' =>'Ano de publicação'])}}
        {{Form::label('foto', 'Foto')}}
        {{Form::file('foto',['class'=>'form-control','id'=>'foto'])}}
        <br>
        {{Form::submit('Salvar', ['class'=>'btn btn-success'])}}
        {!!Form::button('Cancelar', ['onclick'=>'javascript:history.go(-1)',
            'class'=> 'btn btn-danger'])!!}
        {{Form::close()}}
        @endsection