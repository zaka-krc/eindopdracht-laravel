<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Nieuw nieuwsbericht') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('news.index') }}" class="text-purple-400 hover:text-purple-300">
                            &larr; Terug naar nieuws
                        </a>
                    </div>
                    
                    <h1 class="text-2xl font-bold mb-6">Nieuw nieuwsbericht</h1>
                    
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-300">Titel</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>
                            @error('title')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="publication_date" class="block text-sm font-medium text-gray-300">Publicatiedatum</label>
                            <input type="date" name="publication_date" id="publication_date" value="{{ old('publication_date', date('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>
                            @error('publication_date')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-300">Afbeelding</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700" required>
                            <p class="text-gray-400 text-sm mt-1">Toegestane formaten: JPEG, PNG, JPG, GIF. Max 2MB.</p>
                            @error('image')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-300">Inhoud</label>
                            <textarea name="content" id="content" rows="10" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700">
                                Nieuwsbericht opslaan
                            </button>
                            <a href="{{ route('news.index') }}" class="px-4 py-2 bg-slate-600 hover:bg-slate-500 rounded-md font-semibold text-white shadow-sm">
                                Annuleren
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>