<?php

namespace App\Http\Controllers;
use App\Models\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // 1. Cálculos e estatísticas para os cards
        $total_pedidos = DB::table('pedidos')->where('usuario_id', $user->id)->count();
        $total_compras = DB::table('compras')->where('usuario_id', $user->id)->count();
        $total_gasto = DB::table('compras')->where('usuario_id', $user->id)->sum('preco') ?? 0;
        $mensagens_nao_lidas = DB::table('mensagens')
            ->where('usuario_id', $user->id)
            ->where('status', 'nao_lido')
            ->count();

        // 2. Busca os últimos 5 pedidos usando o Query Builder do Laravel
        $pedidos = DB::table('pedidos')
            ->where('usuario_id', $user->id)
            ->orderBy('data_criacao', 'desc')
            ->limit(5)
            ->get();

        // 3. Envia os dados limpos para a View
        return view('user.dashboard', compact(
            'user', 
            'total_pedidos', 
            'total_compras', 
            'total_gasto', 
            'mensagens_nao_lidas', 
            'pedidos'
        ));
    }

    public function compras() 
    {
        $user = Auth::user();

        // 1. Calcula o total gasto somando diretamente do banco de dados (Mais performático)
        $total_gasto = DB::table('compras')
            ->where('usuario_id', $user->id)
            ->sum(DB::raw('preco * quantidade')) ?? 0;

        // 2. Busca as compras paginadas (10 por página) com paginação nativa
        $compras = DB::table('compras')
            ->where('usuario_id', $user->id)
            ->orderBy('data_compra', 'desc')
            ->paginate(10);

        // 3. Injeta as variáveis limpas na View correspondente
        return view('user.compras', compact('user', 'total_gasto', 'compras'));
    }

    public function pedidos() 
    {
        return view('user.pedidos');
    }

    public function criarPedido(Estampa $estampa)
    {
        // Garante que a estampa está ativa antes de permitir o pedido
        if (!$estampa->ativo) {
            abort(404);
        }
        return view('user.pedido-create', compact('estampa'));
    }
    public function perfil() 
    { 
        // CORREÇÃO: Captura o usuário autenticado e envia para a view do perfil
        $user = Auth::user(); 
        return view('user.perfil', compact('user')); 
    }

    public function mensagens(Request $request) 
    {
        $user = Auth::user();
        $topicoId = $request->query('id');

        // Se o usuário clicar em uma conversa específica, carregamos o chat
        if ($topicoId) {
            $conversa_ativa = DB::table('topicos_suporte')
                ->where('id', $topicoId)
                ->where('usuario_id', $user->id)
                ->first();

            if (!$conversa_ativa) {
                return redirect()->route('user.mensagens')->with('error', 'Conversa não encontrada.');
            }

            // Busca todos os balões daquela conversa vinculando o nome do administrador se houver
            $respostas = DB::table('mensagens_suporte')
                ->leftJoin('users', 'mensagens_suporte.remetente_id', '=', 'users.id')
                ->where('topico_id', $topicoId)
                ->select('mensagens_suporte.*', 'users.nome as admin_nome')
                ->orderBy('created_at', 'asc')
                ->get();

            return view('user.mensagens', compact('conversa_ativa', 'respostas'));
        }

        // Caso contrário, renderiza a lista de todos os chamados abertos pelo usuário
        $mensagens = DB::table('topicos_suporte')
            ->where('usuario_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('user.mensagens', compact('mensagens'));
    }

    public function storeContato(Request $request)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'assunto' => ['required', 'string', 'max:255'],
            'mensagem' => ['required', 'string', 'max:5000'],
        ]);

        Mail::raw(
            "Nome: {$validated['nome']}\nEmail: {$validated['email']}\nAssunto: {$validated['assunto']}\n\nMensagem:\n{$validated['mensagem']}",
            function ($message) use ($validated) {
                $message->from(config('mail.from.address'), config('app.name'))
                    ->to(config('mail.from.address'))
                    ->replyTo($validated['email'], $validated['nome'])
                    ->subject('Novo contacto: ' . $validated['assunto']);
            }
        );

        return redirect()->route('home')->with('success', 'Mensagem enviada com sucesso!');
    }

    // Processa o envio do formulário do rodapé do chat
    public function enviarMensagem(Request $request, $id)
    {
        $request->validate(['conteudo' => 'required|string|max:5000']);

        // Insere o novo balão de texto na conversa
        DB::table('mensagens_suporte')->insert([
            'topico_id' => $id,
            'remetente_id' => Auth::id(),
            'conteudo' => $request->conteudo,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Atualiza o carimbo de tempo do tópico para ele subir na listagem
        DB::table('topicos_suporte')->where('id', $id)->update([
            'status' => 'nao_lido', // Volta para não lido para o administrador saber que há nova resposta
            'updated_at' => now()
        ]);

        return redirect()->back();
    }
}