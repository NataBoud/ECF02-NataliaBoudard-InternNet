<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rédiger une offre') }}
        </h2>
    </x-slot>
    <main class="mt-6">

        <div class="flex justify-center p-6">
            <div class="bg-white p-6 rounded-lg shadow-md w-full lg:w-1/2">
                <form method="POST" action="{{ route('opportunities.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mt-4">Titre de l'offre</label>
                        <input id="title" type="text" name="title" class="mt-1 p-2 w-full border rounded-md" placeholder="Entrez le titre de l'offre">
                    </div>

                    <div>
                        <label for="typeContract" class="block text-sm font-medium text-gray-700 mt-4">Type de contrat</label>
                        <select id="typeContract" name="typeContract" class="mt-1 p-2 w-full border rounded-md">
                            <option value="" disabled selected>Choisir le type de contrat</option>
                            <option value="CDD">CDD</option>
                            <option value="CDI">CDI</option>
                            <option value="Stage">Stage</option>
                            <option value="Alternance">Alternance</option>
                        </select>
                    </div>

                    <div>
                        <label for="start" class="block text-sm font-medium text-gray-700 mt-4">Début</label>
                        <input id="start" type="date" name="start" class="mt-1 p-2 w-full border rounded-md">
                    </div>

                    <div>
                        <label for="end" class="block text-sm font-medium text-gray-700 mt-4">Fin</label>
                        <input id="end" type="date" name="end" class="mt-1 p-2 w-full border rounded-md">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mt-4">Description</label>
                        <textarea id="description" name="description" class="mt-1 p-2 w-full border rounded-md h-32" placeholder="Entrez la description de l'offre"></textarea>
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-primary-button type="submit">
                            {{ __('Publier') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>
