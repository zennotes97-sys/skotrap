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

    public function produtos(Request $request)
    {
        $query = Estampa::query();

        if ($search = trim((string) $request->input('search', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('descricao', 'like', "%{$search}%")
                  ->orWhere('produto', 'like', "%{$search}%")
                  ->orWhere('tecnica', 'like', "%{$search}%");
            });
        }

        if ($categoriaId = $request->input('categoria_id')) {
            $query->where('categoria_id', $categoriaId);
        }

        if ($status = $request->input('status')) {
            if ($status === 'ativo') {
                $query->where('ativo', true);
            } elseif ($status === 'inativo') {
                $query->where('ativo', false);
            }
        }

        $perPage = in_array((int) $request->input('per_page', 8), [8, 12, 24, 48], true)
            ? (int) $request->input('per_page', 8)
            : 8;

        $estampas = $query->latest('id')->paginate($perPage)->appends($request->query());
        $totalEstampas = Estampa::count();

        return view('admin.produtos', compact('estampas', 'totalEstampas'));
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
    public function usuarios(Request $request)
    {
        $query = \App\Models\User::query();

        if ($search = trim((string) $request->input('search', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telefone', 'like', "%{$search}%");
            });
        }

        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        if ($status = $request->input('status')) {
            if ($status === 'ativo') {
                $query->where('ativo', true);
            } elseif ($status === 'inativo') {
                $query->where('ativo', false);
            }
        }

        $perPage = in_array((int) $request->input('per_page', 15), [10, 15, 25, 50], true)
            ? (int) $request->input('per_page', 15)
            : 15;

        $usuarios = $query->orderBy('nome', 'asc')->paginate($perPage)->appends($request->query());

        return view('admin.usuarios', compact('usuarios'));
    }
    public function relatorios()
    {
        $total_vendas = DB::table('compras')->count();
        $receita_total = (float) (DB::table('compras')->sum('preco') ?? 0);
        $clientes_ativos = DB::table('usuarios')->count();
        $produtos_mais_vendidos = DB::table('pedido_itens')
            ->select('estampa_id', DB::raw('SUM(quantidade) as quantidade_total'))
            ->groupBy('estampa_id')
            ->orderByDesc('quantidade_total')
            ->limit(5)
            ->get();

        $vendasMensais = DB::table('compras')
            ->selectRaw("DATE_FORMAT(data_compra, '%Y-%m') as mes, COUNT(*) as vendas, COALESCE(SUM(preco), 0) as receita")
            ->whereNotNull('data_compra')
            ->groupBy(DB::raw("DATE_FORMAT(data_compra, '%Y-%m')"))
            ->orderBy('mes', 'asc')
            ->limit(6)
            ->get();

        $vendasMensais = $vendasMensais->map(function ($item) {
            $item->mes_label = \Carbon\Carbon::createFromFormat('Y-m', $item->mes)->translatedFormat('M');
            $item->receita = (float) $item->receita;
            return $item;
        });

        $receitaMaxima = $vendasMensais->max('receita') ?: 1;
        $vendasMensais = $vendasMensais->map(function ($item) use ($receitaMaxima) {
            $item->altura = $receitaMaxima > 0 ? max(16, round(($item->receita / $receitaMaxima) * 100)) : 0;
            return $item;
        });

        $pedidos_totais = DB::table('pedidos')->count();
        $taxa_conversao = $pedidos_totais > 0 ? round(($total_vendas / $pedidos_totais) * 100, 1) : 0;

        $crescimento = 0;
        if ($vendasMensais->count() > 1) {
            $primeira = (float) $vendasMensais->first()->receita;
            $ultima = (float) $vendasMensais->last()->receita;
            $crescimento = $primeira > 0 ? round((($ultima - $primeira) / $primeira) * 100, 1) : 0;
        }

        return view('admin.relatorios', compact(
            'total_vendas',
            'receita_total',
            'clientes_ativos',
            'produtos_mais_vendidos',
            'vendasMensais',
            'taxa_conversao',
            'crescimento',
            'pedidos_totais'
        ));
    }

    public function gerarRelatorio(Request $request)
    {
        $tipo = $request->input('tipo', 'vendas');
        $inicio = $request->input('inicio', now()->subDays(30)->toDateString());
        $fim = $request->input('fim', now()->toDateString());

        if (! in_array($tipo, ['vendas', 'produtos', 'clientes'], true)) {
            return back()->with('error', 'Tipo de relatório inválido.');
        }

        $filename = 'relatorio-' . $tipo . '-' . now()->format('YmdHis') . '.csv';

        $callback = function () use ($tipo, $inicio, $fim) {
            $handle = fopen('php://output', 'w');

            if ($tipo === 'vendas') {
                fputcsv($handle, ['id', 'usuario_id', 'produto', 'quantidade', 'preco', 'data_compra']);
                $registros = DB::table('compras')
                    ->whereBetween('data_compra', [$inicio . ' 00:00:00', $fim . ' 23:59:59'])
                    ->orderBy('data_compra', 'desc')
                    ->get();

                foreach ($registros as $registro) {
                    fputcsv($handle, [
                        $registro->id,
                        $registro->usuario_id,
                        $registro->produto ?? 'Produto',
                        $registro->quantidade ?? 1,
                        $registro->preco ?? 0,
                        $registro->data_compra,
                    ]);
                }
            } elseif ($tipo === 'produtos') {
                fputcsv($handle, ['estampa_id', 'quantidade_total']);
                $registros = DB::table('pedido_itens')
                    ->select('estampa_id', DB::raw('SUM(quantidade) as quantidade_total'))
                    ->groupBy('estampa_id')
                    ->orderByDesc('quantidade_total')
                    ->get();

                foreach ($registros as $registro) {
                    fputcsv($handle, [$registro->estampa_id, $registro->quantidade_total]);
                }
            } else {
                fputcsv($handle, ['id', 'nome', 'email', 'telefone', 'role']);
                $registros = DB::table('usuarios')
                    ->select('id', 'nome', 'email', 'telefone', 'role')
                    ->orderBy('nome')
                    ->get();

                foreach ($registros as $registro) {
                    fputcsv($handle, [$registro->id, $registro->nome, $registro->email, $registro->telefone, $registro->role]);
                }
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function compras()
    {
        $user = Auth::user();
        $compras = DB::table('compras')
            ->where('usuario_id', $user->id)
            ->orderBy('data_compra', 'desc')
            ->paginate(15);

        return view('admin.compras', compact('compras'));
    }

    public function log()
    {
        $atividades = collect([
            [
                'titulo' => 'Login de administrador',
                'descricao' => 'Acesso ao painel administrativo efetuado com sucesso.',
                'data' => now()->subMinutes(12),
                'tipo' => 'seguranca',
            ],
            [
                'titulo' => 'Estampa atualizada',
                'descricao' => 'A estampa “Floral Explosion” foi atualizada com novos detalhes.',
                'data' => now()->subHours(3),
                'tipo' => 'produto',
            ],
            [
                'titulo' => 'Promoção criada',
                'descricao' => 'Nova campanha de desconto adicionada à vitrine.',
                'data' => now()->subDay(),
                'tipo' => 'marketing',
            ],
            [
                'titulo' => 'Pedido confirmado',
                'descricao' => 'Pedido #2048 marcado como pago e em preparação.',
                'data' => now()->subDays(2),
                'tipo' => 'pedido',
            ],
        ]);

        return view('admin.log', compact('atividades'));
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
        $estampas = Estampa::latest('id')->paginate(8);
        $totalEstampas = Estampa::count();

        return view('admin.produtos', compact('estampas', 'estampa', 'totalEstampas'));
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
