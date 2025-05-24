<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('FAQ Vraag Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('faq.questions.index') }}" class="text-purple-400 hover:text-purple-300">
                            &larr; Terug naar vragen
                        </a>
                    </div>
                    
                    <h1 class="text-2xl font-bold mb-6">FAQ Vraag bewerken</h1>
                    
                    <form action="{{ route('faq.questions.update', $question) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="faq_category_id" class="block text-sm font-medium text-gray-300">Categorie</label>
                            <select name="faq_category_id" id="faq_category_id" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>
                                <option value="">Selecteer een categorie</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('faq_category_id', $question->faq_category_id) == $category->id) ? 'selected' : '' }}>
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
                            <input type="text" name="question" id="question" value="{{ old('question', $question->question) }}" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>
                            @error('question')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="answer" class="block text-sm font-medium text-gray-300">Antwoord</label>
                            <textarea name="answer" id="answer" rows="6" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>{{ old('answer', $question->answer) }}</textarea>
                            @error('answer')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700">
                                Wijzigingen opslaan
                            </button>
                            <a href="{{ route('faq.questions.index') }}" class="px-4 py-2 bg-slate-600 hover:bg-slate-500 rounded-md font-semibold text-white shadow-sm">
                                Annuleren
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>