<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtendimentoRequest;
use App\Models\Atendimento;
use App\Models\Municipe;
use App\Models\Vereador;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtendimentoController extends Controller
{

    //Listar todos atendimentos
    public function all(Request $request)
    {
        //Busca atendimentos no banco de dados conforme parametros do form de pesquisa
        $atendimentos = Atendimento::when($request->has('data'), function($whenQuery) use ($request){
            $whenQuery->whereDate('dataHora', '=', $request->data);
        })
        ->orderByDesc('dataHora')
        ->paginate(5);

        //Carrega a view
        return view('atendimentos.all', [
            'atendimentos' => $atendimentos
        ]);
    }

    //Listar atendimentos do municipe 
    public function index(Request $request, Municipe $municipe)
    {
        //Busca atendimentos do municipe no banco de dados conforme parametros do form de pesquisa
        $atendimentos = Atendimento::when($request->has('data'), function($whenQuery) use ($request){
            $whenQuery->whereDate('dataHora', '=', $request->data);
        })
        ->where('municipe_id', $municipe->id)
        ->orderBy('dataHora')
        ->paginate(15)
        ->withQueryString();

        // $atendimentos = Atendimento::with('municipe')
        //     ->where('municipe_id', $municipe->id)
        //     ->orderBy('dataHora')
        //     ->paginate(10);

        //Carrega a view
        return view('atendimentos.index', [
            'municipe' => $municipe,
            'atendimentos' => $atendimentos
        ]);
    }

    //Abrir formulario para registrar atendimento
    public function create(Municipe $municipe)
    {
        $vereadores = Vereador::orderBy('nome')->get();
        return view('atendimentos.create', [
            'municipe' => $municipe,
            'vereadores' => $vereadores
        ]);
    }

    //Cadastrar atendimento ao municipe
    public function store(AtendimentoRequest $request, Municipe $municipe)
    {
        //Validar o formulario de atendimento ao municipe
        $request->validated();
        //Marca ponto inicial da transação
        DB::beginTransaction();

        try {
            //Cadastra atendimento no banco de dados
            $atendimento = Atendimento::create([
                'vereador' => $request->vereador,
                'status' => $request->status,
                'dataHora' => $request->dataHora,
                'municipe_id' => $request->municipe_id
            ]);

            DB::commit();
            //Redireciona com msg de sucesso
            return redirect()->route('atendimento.index', ['municipe' => $request->municipe_id])
                ->with('success', 'Atendimento registrado para o munícipe: ' . $request->nome);
        } catch (Exception $e) {
            //Transaçõ não concluida com exito
            DB::rollBack();
            //Redireciona com msg de erro
            return redirect()->back()->with('error', 'Atendimento não foi registrado! Tente novamente.');
        }
    }

    //Editar atendimento do municipe
    public function edit(Atendimento $atendimento, Municipe $municipe)
    {
        //Carrega lista de vereadores do banco de dados
        $vereadores = Vereador::orderBy('nome')->get();
        //Carrega view para editar o atendimento
        return view('atendimentos.edit', [
            'atendimento' => $atendimento,
            'municipe' => $municipe,
            'vereadores' => $vereadores
        ]);
    }

    //Atualizar atendimento do municipe
    public function update(AtendimentoRequest $request, Atendimento $atendimento)
    {
        //Valida o formulario
        $request->validated();
        //Inicia a transação de update
        DB::beginTransaction();

        try {
            //Edita as informações
            $atendimento->update([
                'vereador' => $request->vereador,
                'status' => $request->status,
                'dataHora' => $request->dataHora,
            ]);
            //Transação com sucesso
            DB::commit();
            //Redireciona com msg de sucesso
            return redirect()->route('atendimento.all')->with('success', 'Atendimento atualizado!');

        } catch (Exception $e) {
            //Transação não concluida
            DB::rollBack();            
            //Redireciona usuario, envia mensagem de erro
            return redirect()->back()->with('error', 'Atendimento não atualizado! Tente novamente.' . $e->getMessage());
        }
    }

    //Excluir atendimento 
    public function destroy(Atendimento $atendimento){
        try{
            //Exclui do anco de dados
            $atendimento->delete();
            //Redireciona com msg de sucesso
            return redirect()->route('atendimento.index', ['municipe' => $atendimento->municipe_id])
                ->with('success', 'Atendimento excluido!');
        }catch(Exception $e){   
            //Redireciona ususario com msg de erro
            return redirect()->back()->with('error', 'Atendimento não excluído! Tente novamente.');
        }
    }
}
