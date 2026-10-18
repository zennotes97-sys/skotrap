<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Processamento do Login (Antigo POST do login.php)
    public function login(Request $request)
    {
        // Validação nativa (Substitui seus filtros manuais)
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'senha' => 'required|string',
        ], [
            'email.email' => 'Por favor, insira um e-mail válido.'
        ]);

        // Busca o usuário ativo mapeando a tabela antiga
        $user = User::where('email', $credentials['email'])->where('ativo', 1)->first();

        if ($user && Hash::check($credentials['senha'], $user->senha)) {
            Auth::login($user);
            $request->session()->regenerate(); // Proteção nativa contra fixação de sessão

            // Redirecionamento inteligente baseado em Role (Substitui o header antigo)
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/');
        }

        // Se falhar, retorna com erro para a tela anterior
        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas estão incorretas ou a conta está inativa.'],
        ]);
    }

    // Processamento do Cadastro (Antigo POST do registro.php)
    public function registro(Request $request)
    {
        // Validações de Regra de Negócio tratadas nativamente pelo Laravel
        $request->validate([
            'nome'            => 'required|string|max:255',
            'email'           => 'required|string|email|max:255|unique:usuarios,email',
            'telefone'        => 'nullable|string',
            'pais'            => 'nullable|string',
            'cidade'          => 'nullable|string',
            'senha'           => 'required|string|min:6',
            'confirmar_senha' => 'required|same:senha', // Garante que as senhas conferem
        ], [
            'email.unique'         => 'Este e-mail já está cadastrado em nossa plataforma.',
            'senha.min'            => 'A senha deve conter no mínimo 6 caracteres.',
            'confirmar_senha.same' => 'As senhas digitadas não conferem.'
        ]);

        $data = [
            'nome'     => trim($request->nome),
            'email'    => $request->email,
            'senha'    => Hash::make($request->senha),
            'telefone' => trim($request->telefone),
            'role'     => 'usuario',
            'ativo'    => 1,
        ];

        if ($request->filled('pais')) {
            $data['pais'] = trim($request->pais);
        }

        if ($request->filled('cidade')) {
            $data['cidade'] = trim($request->cidade);
        }

        if (Schema::hasColumn('usuarios', 'data_criacao')) {
            $data['data_criacao'] = now();
        }

        $user = User::create($data);

        // Flash Message de sucesso para a View saber que deu certo
        return redirect('/login')->with('sucesso', 'Conta criada com sucesso!');
    }

    // Processamento do Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}