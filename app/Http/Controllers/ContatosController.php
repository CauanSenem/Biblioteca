<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use Session;

class ContatosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contatos = Contato::paginate(5);
        return view('contato.index', array('contatos'=> $contatos,
    'busca'=>null));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request) {
        $contatos = Contato::where('nome','LIKE','%'.$request->input('busca').'%')
        ->orwhere('email','LIKE','%'.$request->input('busca').'%')->paginate(5);
        return view('contato.index',array('contatos' => $contatos,'busca'=>$request->input('busca')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('contato.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contato = new Contato();
        $contato->nome = $request->input('nome');
        $contato->email = $request->input('email');
        $contato->telefone = $request->input('telefone');
        $contato->cidade = $request->input('cidade');
        $contato->estado = $request->input('estado');
        if($contato->save()){
            if($request->hasFile('foto')){
                $imagem = $request->file('foto');
                $nomearquivo = md5($contato->id).".".$imagem->getClientOriginalExtension();
                //dd($imagem, $nomearquivo,$contato->id);
                $request->file('foto')->move(public_path('.\img\contatos'),$nomearquivo);
            }
            return redirect('contatos');
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param \App\Models\Contato $contato
     */
    public function show($id)
    {
        $contatos = Contato::find($id);
        return view('contato.show', array('contato'=> $contatos, 'busca'=>null));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contato = Contato::find($id);
        return view('contato.edit', array('contato'=> $contato));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contato = Contato::find($id);
        if($request->hasFile('foto')){
            $imagem = $request->file('foto');
            $nomearquivo = md5($contato->id).".".$imagem->getClientOriginalExtension();
            $request->file('foto')->move(public_path('.\img\contatos'),$nomearquivo);
        }
        $contato->nome = $request->input('nome');
        $contato->email = $request->input('email');
        $contato->telefone = $request->input('telefone');
        $contato->cidade = $request->input('cidade');
        $contato->estado = $request->input('estado');
        if($contato->save()){
            Session::flash('mensagem', 'Contato alterado com sucesso');
            return redirect(url('contatos/'));
    }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contato = Contato::find($id);
        $contato->delete();
        Session::flash('mensagem','Contato excluído com sucesso');
        return redirect(url('contatos/'));
    }
}
