@extends('layouts.app')

@section('title', 'Contato')

@section('content')
<div class="bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center gap-4">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-600 shadow-sm">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6" aria-hidden="true">
                    <path d="M4 7.5A2.5 2.5 0 0 1 6.5 5h11A2.5 2.5 0 0 1 20 7.5v9A2.5 2.5 0 0 1 17.5 19h-11A2.5 2.5 0 0 1 4 16.5v-9Z"/>
                    <path d="m5 7 7 5 7-5"/>
                </svg>
            </span>
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-orange-600">Suporte</p>
                <h1 class="text-3xl font-extrabold tracking-tight text-slate-950">Entre em contacto</h1>
            </div>
        </div>

        <div class="grid gap-8 xl:grid-cols-[0.9fr_1.3fr]">
            <aside class="space-y-4">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5" aria-hidden="true">
                                <path d="M7 4.5h10a2 2 0 0 1 2 2V17a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6.5a2 2 0 0 1 2-2Z"/>
                                <path d="M8 8h8M8 12h8M8 16h5"/>
                            </svg>
                        </span>
                        <h2 class="text-lg font-bold text-slate-900">Detalhes</h2>
                    </div>

                    <div class="space-y-4 text-sm text-slate-600">
                        <div class="flex items-start gap-3">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="mt-0.5 h-4 w-4 text-orange-500" aria-hidden="true">
                                <path d="M5 6.5A2.5 2.5 0 0 1 7.5 4h1.8l1.2 3.4-1.1 1.1a13.8 13.8 0 0 0 7.3 7.3l1.1-1.1L20 14.7v1.8A2.5 2.5 0 0 1 17.5 19H16c-6.8 0-12-5.2-12-12v-1.5Z"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-slate-900">Telefone</p>
                                <a href="tel:+258873182096" class="hover:text-orange-600">+258 87 318 2096</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="mt-0.5 h-4 w-4 text-orange-500" aria-hidden="true">
                                <path d="M4 7.5A2.5 2.5 0 0 1 6.5 5h11A2.5 2.5 0 0 1 20 7.5v9A2.5 2.5 0 0 1 17.5 19h-11A2.5 2.5 0 0 1 4 16.5v-9Z"/>
                                <path d="m5 7 7 5 7-5"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-slate-900">Email</p>
                                <a href="mailto:contacto@skotrap.com" class="hover:text-orange-600">contacto@skotrap.com</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="mt-0.5 h-4 w-4 text-orange-500" aria-hidden="true">
                                <circle cx="12" cy="12" r="8"/>
                                <path d="M12 8v4l2.5 2.5"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-slate-900">Horário</p>
                                <p>Segunda a Sábado</p>
                                <p>08:00 – 18:00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-orange-200 bg-orange-50 p-5 shadow-sm">
                    <p class="text-sm font-semibold text-orange-700">Precisa de ajuda rápida?</p>
                    <p class="mt-2 text-sm text-orange-800/80">Pode enviar uma mensagem diretamente e a nossa equipa responderá em até 24 horas.</p>
                </div>
            </aside>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="mb-6 flex items-center gap-3">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5" aria-hidden="true">
                            <path d="M7.5 18.5 4 20V7.5A2.5 2.5 0 0 1 6.5 5h11A2.5 2.5 0 0 1 20 7.5v7A2.5 2.5 0 0 1 17.5 17H7.5Z"/>
                            <path d="M8 9h8M8 12h6"/>
                        </svg>
                    </span>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Enviar mensagem</h2>
                        <p class="text-sm text-slate-500">Preencha os campos abaixo.</p>
                    </div>
                </div>

                <form action="{{ route('contato.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="nome" class="mb-2 block text-sm font-semibold text-slate-700">Nome</label>
                            <input id="nome" name="nome" type="text" value="{{ old('nome', $user->nome ?? '') }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-100" placeholder="O seu nome" />
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-100" placeholder="seu@email.com" />
                        </div>
                    </div>

                    <div>
                        <label for="assunto" class="mb-2 block text-sm font-semibold text-slate-700">Assunto</label>
                        <input id="assunto" name="assunto" type="text" value="{{ old('assunto') }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-100" placeholder="Ex.: Pedido, suporte ou dúvida" />
                    </div>

                    <div>
                        <label for="mensagem" class="mb-2 block text-sm font-semibold text-slate-700">Mensagem</label>
                        <textarea id="mensagem" name="mensagem" rows="6" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-100" placeholder="Descreva a sua dúvida ou pedido...">{{ old('mensagem') }}</textarea>
                    </div>

                    <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-orange-600 px-5 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-200">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4" aria-hidden="true">
                            <path d="M3 12.5V6.8A2.8 2.8 0 0 1 5.8 4h12.4A2.8 2.8 0 0 1 21 6.8v9.4A2.8 2.8 0 0 1 18.2 19H8.7L3 21.5v-9Z"/>
                            <path d="M7 9h10M7 13h6"/>
                        </svg>
                        Enviar mensagem
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
