
@extends('layouts.app')
@section('title','Empréstimo - '.$emprestimo->id)
@section('content')
<br><br>
    <div class="card w-50 m-auto">
        <div class="card-header">
        @if(Session::has('mensagem'))
        <div class="alert alert-success">
            {{Session::get('mensagem')}}
        </div>
    @endif 
            <h1>Empréstimo - {{$emprestimo->id}}</h1>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <h3 class="card-title">ID: {{$emprestimo->id}}</h3>
                    </div>
                    <div class="col-4">
                        @if($emprestimo->dataDevolucao==null)
                        {{Form::open(['route'=>['emprestimos.devolver',$emprestimo->id],'method'=>'PUT'])}}
                        {{form::submit('Devolver',['class'=>'btn btn-success','onclick'=>'return confim("Confirma devolução?")'])}}
                        {{Form::close()}}
                        @endif
                    </div>
                </div>
            </div>
            Data:
            {{\Carbon\Carbon::create($emprestimo->dataHora)->format('d/m/Y H:i:s')}}<br/> Devolução: {!!$emprestimo->devolvido!!}
            <br/>
            Contato: {{$emprestimo->idContato}} - {{$emprestimo->contato->nome}}<br/>
            Livro: {{$emprestimo->idLivro}} - {{$emprestimo->livro->titulo}}<br/>
            <p class="text">obs: {{$emprestimo->obs}}</p>
        </div>
        <div class="card-footer">
            {{Form::open(['route' => ['emprestimos.destroy',$emprestimo->id],'method' => 'DELETE'])}}
            {{Form::submit('Excluir',['class'=>'btn btn-danger','onclick'=>'return confirm("Confirma exclusão?")'])}}
            <a href="{{url('emprestimos/')}}" class="btn btn-warning">Voltar</a>
            {{Form::close()}}
          
        </div>
    </div>
@endsection