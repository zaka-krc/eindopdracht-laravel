<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwsbericht bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('news.update', $newsItem) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $newsItem->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="publication_date" class="block text-sm font-medium text-gray-700">Publicatiedatum</label>
                            <input type="date" name="publication_date" id="publication_date" value="{{ old('publication_date', $newsItem->publication_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('publication_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Huidige afbeelding</label>
                            <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="mt-1 w-64 h-auto">
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Nieuwe afbeelding (optioneel)</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full">
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Inhoud</label>
                            <textarea name="content" id="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('content', $newsItem->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Wijzigingen opslaan
                            </button>
                            <a href="{{ route('news.show', $newsItem) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Annuleren
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>