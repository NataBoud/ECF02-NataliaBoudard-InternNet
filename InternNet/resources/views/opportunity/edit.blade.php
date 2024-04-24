<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier') }}
        </h2>
    </x-slot>
    <main class="mt-6">

        <div class="flex justify-center p-6">
            <div class="bg-white p-6 rounded-lg shadow-md w-full lg:w-1/2">
                <div class="form">
                    <form action="{{ route('opportunities.update', $opportunity->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Titre:</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ $opportunity->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="description" rows="5" required>{{ $opportunity->description }}</textarea>
                        </div>

                        <div class="button-group">
                            <button type="submit" id="form-button">Mettre à jour</button>
                            <a href="{{ route('opportunities.show', $opportunity->id) }}">
                                <button type="button" id="btn-cancel">Annuler</button>
                            </a>
                        </div>
                    </form>
            </div>
        </div>


    </main>
</x-app-layout>
