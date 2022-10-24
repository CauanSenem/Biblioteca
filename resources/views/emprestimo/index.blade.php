@extends('layouts.app')
@section('title','emprestimo de Livros')
@section('content')
<br>
    <h1>Empréstimos</h1>
   @if(Session::has('mensagem'))
        <div class="alert alert-info">
            {{Session::get('mensagem')}}
        </div>
    @endif 
    <br>
    {{Form::open(['url'=>'emprestimos/buscar', 'method'=>'GET'])}}
    <div class="row">
        <div class="col-sm-3">
            <div class="input-group">
                @if($busca !== null)
                &nbsp;<a class="btn btn-info" href="{{url
                    ('emprestimos/')}}">Todos</a>&nbsp;
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
    <tr>
    <th>ID</th>
    <th>Contato</th>
    <th>Livro</th>
    <th>Data</th>
    <th>Devolução</th>
    </tr>
    @foreach ($emprestimos as $emprestimo)
    <tr>
       <td><a href="{{url('emprestimos/'.$emprestimo->id)}}">
            {{$emprestimo->id}}</a>
    </td>
    <td>
            {{$emprestimo->idContato}} -
            {{$emprestimo->contato->nome}}
    </td>
    <td>
            {{$emprestimo->idLivro}} -
            {{$emprestimo->livro->titulo}}
    </td>
    <td>
          
            {{\Carbon\Carbon::create($emprestimo->dataHora)->format('d/m/Y H:i:s')}}
    </td>    
    <td>{!!$emprestimo->devolvido!!}</td>
    </tr>
    @endforeach
</table> 
<h5>Novo Empréstimo</h5>
<a class="btn btn-primary" href="{{url('emprestimos/create')}}">Criar</a> 
        {{$emprestimos->links()}}
        @endsection