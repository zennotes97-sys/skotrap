@extends('layouts.app')

@section('title', 'Log de Atividades')

@section('content')
<div class="container mx-auto py-6 px-6 min-h-screen">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Log de Atividades</h1>
            <p class="text-sm text-zinc-500 mt-2">Monitore as ações importantes que acontecem na sua plataforma.</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 text-center">
        <div class="mx-auto w-16 h-16 flex items-center justify-center bg-orange-100 rounded-full mb-4">
            <i class="fas fa-file-alt text-3xl text-orange-500"></i>
        </div>
        <h2 class="text-xl font-semibold text-zinc-800">Página em Construção</h2>
        <p class="text-zinc-500 mt-2 max-w-md mx-auto">
            Para implementar um log de atividades, seria necessário criar uma tabela no banco de dados para registrar eventos como:
        </p>
        <ul class="text-sm text-zinc-500 list-disc list-inside inline-block text-left mt-3">
            <li>Criação de novos usuários</li>
            <li>Login de administradores</li>
            <li>Criação ou exclusão de produtos</li>
            <li>Alteração de status de pedidos</li>
        </ul>
    </div>
</div>
@endsection