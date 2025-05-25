<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Nieuwe FAQ Vraag') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('admin.faq.questions.index') }}" class="text-purple-400 hover:text-purple-300">
                            &larr; Terug naar vragen
                        </a>
                    </div>
                    
                    <h1 class="text-2xl font-bold mb-6">Nieuwe FAQ Vraag</h1>
                    
                    @if($categories->isEmpty())
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded">
                            <p class="font-medium">Geen categorieën beschikbaar</p>
                            <p class="text-sm">Je moet eerst een categorie aanmaken voordat je een vraag kunt toevoegen.</p>
                            <a href="{{ route('admin.faq.categories.create') }}" class="inline-block mt-2 px-3 py-1 bg-yellow-600 hover:bg-yellow-700 text-white rounded text-sm">
                                Categorie aanmaken
                            </a>
                        </div>
                    @else
                        <form action="{{ route('admin.faq.questions.store') }}" method="POST">
                            @csrf

                            <div class="mb-6">
                                <label for="faq_category_id" class="block text-sm font-medium text-gray-300">Categorie</label>
                                <select name="faq_category_id" id="faq_category_id" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>
                                    <option value="">Selecteer een categorie</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('faq_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('faq_category_id')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="question" class="block text-sm font-medium text-gray-300">Vraag</label>
                                <input type="text" name="question" id="question" value="{{ old('question') }}" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required placeholder="Bijvoorbeeld: Hoe installeer ik het spel?">
                                @error('question')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="answer" class="block text-sm font-medium text-gray-300">Antwoord</label>
                                <textarea name="answer" id="answer" rows="8" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required placeholder="Geef hier een uitgebreid antwoord op de vraag...">{{ old('answer') }}</textarea>
                                @error('answer')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700">
                                    Vraag opslaan
                                </button>
                                <a href="{{ route('admin.faq.questions.index') }}" class="px-4 py-2 bg-slate-600 hover:bg-slate-500 rounded-md font-semibold text-white shadow-sm">
                                    Annuleren
                                </a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>