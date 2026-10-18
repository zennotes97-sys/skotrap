<?php

namespace App\Http\Controllers;
use App\Models\Estampa;
use App\Models\Promocao;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $estampas = Estampa::latest('id')->get();

        // 1. Cálculos e estatísticas para os cards
        $total_pedidos = DB::table('pedidos')->where('usuario_id', $user->id)->count();
        $total_compras = DB::table('compras')->where('usuario_id', $user->id)->count();
        $total_vendido = DB::table('compras')->where('usuario_id', $user->id)->sum('preco') ?? 0;
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
        return view('admin.dashboard', compact(
            'user',
            'estampas',
            'total_pedidos',
            'total_compras',
            'total_vendido',
            'mensagens_nao_lidas',
            'pedidos'
        ));
    }

    public function produtos()
    {
        $estampas = Estampa::latest('id')->get();

        return view('admin.produtos', compact('estampas'));
    }
     public function pedidos()
    {
        $user = Auth::user();
        $pedidos = DB::table('pedidos')
            ->where('usuario_id', $user->id)
            ->orderBy('data_criacao', 'desc')
            ->get();

        return view('admin.pedidos', compact('pedidos'));
    }
     public function usuarios()
     {
        $user = Auth::user();
        $usuarios = \App\Models\User::where('id', '!=', $user->id)
            ->orderBy('nome', 'asc')
            ->paginate(15);

        return view('admin.usuarios', compact('usuarios'));
     }
    public function relatorios()
    {
        $user = Auth::user();
        $pedidos = DB::table('pedidos')
            ->where('usuario_id', $user->id)
            ->orderBy('data_criacao', 'desc')
            ->get();

        return view('admin.relatorios', compact('pedidos'));
    }
    public function compras()
    {
        $user = Auth::user();
        $compras = DB::table('compras')
            ->where('usuario_id', $user->id)
            ->orderBy('data_compra', 'desc')
            ->get();

        return view('admin.compras', compact('compras'));
    }

    public function log()
    {
        return view('admin.log');
    }

    public function configuracoes()
    {
        return view('admin.configuracoes');
    }

    public function promocoes()
    {
        $promocoes = Promocao::with('estampa')->latest('id')->get();
        $estampas = Estampa::where('ativo', true)->latest('id')->get();

        return view('admin.promocoes', compact('promocoes', 'estampas'));
    }

    public function storePromocao(Request $request)
    {
        $request->validate([
            'estampa_id' => 'required|exists:estampas,id',
            'tipo' => 'required|in:percent,fixed',
            'valor' => 'required|numeric|min:0',
            'inicio' => 'nullable|date',
            'fim' => 'nullable|date|after_or_equal:inicio',
            'ativo' => 'nullable|boolean',
        ]);

        $valor = (float) $request->valor;
        if ($request->tipo === 'percent' && $valor > 100) {
            return redirect()->back()->withErrors(['valor' => 'A porcentagem não pode ser maior que 100%.'])->withInput();
        }

        Promocao::create([
            'estampa_id' => $request->estampa_id,
            'tipo' => $request->tipo,
            'valor' => $valor,
            'inicio' => $request->inicio ?? now(),
            'fim' => $request->fim,
            'ativo' => $request->boolean('ativo', true),
        ]);

        return redirect()->route('admin.promocoes')->with('success', 'Promoção criada com sucesso!');
    }

    public function destroyPromocao($id)
    {
        $promocao = Promocao::findOrFail($id);
        $promocao->delete();

        return redirect()->route('admin.promocoes')->with('success', 'Promoção removida com sucesso!');
    }

    public function editarEstampa($id)
    {
        $estampa = Estampa::findOrFail($id);
        $estampas = Estampa::latest('id')->get();

        return view('admin.produtos', compact('estampas', 'estampa'));
    }

    public function atualizarEstampa(Request $request, $id)
    {
        $estampa = Estampa::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:150',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'tecnica' => 'nullable|string|max:100',
            'produto' => 'nullable|string|max:150',
            'imagem' => 'nullable|image|max:2048',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        $data = $request->only(['nome', 'descricao', 'preco', 'tecnica', 'produto', 'categoria_id']);
        $data['slug'] = Str::slug($request->nome) . '-' . time();
        $data['atualizado_por'] = Auth::id();

        if ($request->hasFile('imagem')) {
            if ($estampa->imagem && Storage::disk('public')->exists($estampa->imagem)) {
                Storage::disk('public')->delete($estampa->imagem);
            }

            $path = $request->file('imagem')->store('estampas', 'public');
            $data['imagem'] = $path;
        }

        $estampa->update($data);

        return redirect()->route('admin.produtos')->with('success', 'Estampa atualizada com sucesso!');
    }

    public function destroyEstampa($id)
    {
        $estampa = Estampa::findOrFail($id);

        if ($estampa->imagem && Storage::disk('public')->exists($estampa->imagem)) {
            Storage::disk('public')->delete($estampa->imagem);
        }

        $estampa->delete();

        return redirect()->route('admin.produtos')->with('success', 'Estampa removida com sucesso!');
    }

    public function storeEstampa(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:150',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'tecnica' => 'nullable|string|max:100',
            'produto' => 'nullable|string|max:150',
            'imagem' => 'nullable|image|max:2048',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        $data = $request->only(['nome', 'descricao', 'preco', 'tecnica', 'produto', 'categoria_id']);
        $data['slug'] = Str::slug($request->nome) . '-' . time();
        $data['criado_por'] = Auth::id();
        $data['atualizado_por'] = Auth::id();
        $data['ativo'] = true;

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('estampas', 'public');
            $data['imagem'] = $path;
        }

        Estampa::create($data);

        return redirect()->back()->with('success', 'Estampa cadastrada com sucesso!');
    }

    public function editUsuario($id)
    {
        $usuario = \App\Models\User::findOrFail($id);
        return view('admin.usuarios_edit', compact('usuario'));
    }

    public function updateUsuario(Request $request, $id)
    {
        $usuario = \App\Models\User::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . $usuario->id,
            'telefone' => 'nullable|string|max:20',
            'pais' => 'nullable|string|max:100',
            'cidade' => 'nullable|string|max:100',
            'role' => 'required|in:usuario,admin',
            'ativo' => 'required|boolean',
        ]);

        $data = $request->only(['nome', 'email', 'telefone', 'pais', 'cidade', 'role', 'ativo']);

        $usuario->update($data);

        return redirect()->route('admin.usuarios')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroyUsuario($id)
    {
        // Evita que o admin logado se auto-delete
        if ($id == Auth::id()) {
            return redirect()->route('admin.usuarios')->with('error', 'Você não pode deletar sua própria conta.');
        }

        $usuario = \App\Models\User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin.usuarios')->with('success', 'Usuário removido com sucesso!');
    }
}
