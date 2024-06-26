<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{route('admin.store')}}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <h1>Ajouter un type de contract</h1>
                        </div>
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Titre :</label>
                            <input type="text" name="title" id="title" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button type="submit">
                                {{ __('Ajouter') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Liste des contrats ajoutés -->
                    @if ($typeContrats->isNotEmpty())
                        <h2>Liste des contrats ajoutés :</h2>
                        <ul>
                            @foreach ($typeContrats as $typeContrat)
                                <li>{{ $typeContrat->title }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aucun contrat ajouté pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
