@php
    use Illuminate\Support\Carbon
@endphp


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $opportunity->title }}
        </h2>
    </x-slot>
    <main class="mt-6">

        <div class="flex justify-center p-6">
            <div class="bg-white p-6 rounded-lg shadow-md w-full lg:w-1/2">
                @if ($opportunity)
                    <h2 class="text-xl font-semibold">{{ $opportunity->title }}</h2>
                    <p class="text-gray-600">{{ $opportunity->typeContract }}</p>
                    <p class="text-gray-600">Date début: {{ Carbon::parse($opportunity->start)->format('d/m/Y') }}</p>

                    {{-- Afficher la date de fin seulement si elle n'est pas null --}}
                    @if ($opportunity->end)
                        <p class="text-gray-600">Date de fin: {{ Carbon::parse($opportunity->end)->format('d/m/Y') }}</p>
                    @endif

                    <p class="text-gray-600">Employeur: {{ $opportunity->user->name }}</p>
                    <p class="mt-4">{{ $opportunity->description }}</p>
                    <span class="block mt-4 text-sm text-gray-400">Date de création: {{ $opportunity->created_at }}</span>
                    <hr class="my-6">
                @else
                    <p class="text-red-500">Article introuvable</p>
                @endif


                {{-- BUTTONS SUPPRIMER MODIFIER --}}
                <div class="mt-6">
                    @auth
                        @if ($opportunity->user_id == auth()->id())
                            <a href="{{ route('opportunities.edit', $opportunity->id) }}" >
                                <x-primary-button class="mt-3">
                                    {{ __('Modifier') }}
                                </x-primary-button>
                            </a>
                            <form action="{{ route('opportunities.destroy', $opportunity->id) }}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <x-danger-button class="mt-3">
                                    {{ __('Supprimer') }}
                                </x-danger-button>
                            </form>
                        @endif
                    @endauth
                        @guest
                            <a href="mailto:{{ $opportunity->user->email }}" target="_blank">
                                <x-primary-button class="mt-3">
                                    {{ __('Postuler') }}
                                </x-primary-button>
                            </a>
                        @endguest
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
