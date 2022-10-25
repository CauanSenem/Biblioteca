<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Support\Facades\Auth;
use App\Models\Livro;
use App\Models\Contato;
use Illuminate\Http\Request;
use Session;

class EmprestimosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $emprestimos = Emprestimo::simplepaginate(5);
            return view('emprestimo.index',array('emprestimos' => $emprestimos,'busca'=>null));
        } else {
            return redirect('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function buscar(Request $request) {
        $emprestimos = Emprestimo::with('contato')->with('livro')->where('idContato','=',$request->input('busca'))
        ->orwhere('idLivro','=',$request->input('busca'))->orwhere('obs','LIKE','%'.$request->input('busca').'%')
        ->paginate(5); return view('emprestimo.index',array('emprestimos' => $emprestimos,'busca'=>$request->input('busca')));
    }


    public function create()
    {
       if (Auth::check()) {
        $contatos = Contato::all();
        $livros = Livro::all();
        return view('emprestimo.create',['contatos'=>$contatos,'livros'=>$livros]);
    } else {
        return redirect('login');
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request,[
                'idContato' => 'required',
                'idLivro' => 'required',
                'dataHora' => 'required'
            ]);
            $emprestimo = new Emprestimo();
            $emprestimo->idContato = $request->input('idContato');
            $emprestimo->idLivro = $request->input('idLivro');
            $emprestimo->dataHora = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $request->input('dataHora'));
            $emprestimo->obs = $request->input('obs');
            $emprestimo->dataDevolucao = null;

            if($emprestimo->save()) {
                return redirect('emprestimos');
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param  \App\Models\Emprestimo  $emprestimo
     */
    public function show($id)
    {
        $emprestimo = Emprestimo::find($id);
        return view('emprestimo.show',array('emprestimo' =>
        $emprestimo,'busca'=>null));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function edit(Emprestimo $emprestimo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */

    public function devolver(Request $request, $id)
    {
        if (Auth::check()) {
            $emprestimo = Emprestimo::find($id);
            $emprestimo->datadevolucao = \Carbon\Carbon::now();
            $emprestimo->save();

            if($emprestimo->save()) {
                Session::flash('mensagem','Empréstimo Devolvido');
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emprestimo $emprestimo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request 
     * @param int $id
     * @return \Illuminate\Http\Response 
     */
    public function destroy(Request $request, $id)
    {
        if (Auth::check()) {
            $emprestimo = Emprestimo::find($id);

            $emprestimo->delete();
            Session::flash('mensagem','Empréstimo Excluído com Sucesso');
            return redirect(url('emprestimos/'));
        } else {
            return redirect('login');
        }
    }
}
