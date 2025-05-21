<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('FAQ Vraag Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('faq.questions.update', $question) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="faq_category_id" class="block text-sm font-medium text-gray-700">Categorie</label>
                            <select name="faq_category_id" id="faq_category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">Selecteer een categorie</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('faq_category_id', $question->faq_category_id) == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('faq_category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="question" class="block text-sm font-medium text-gray-700">Vraag</label>
                            <input type="text" name="question" id="question" value="{{ old('question', $question->question) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('question')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="answer" class="block text-sm font-medium text-gray-700">Antwoord</label>
                            <textarea name="answer" id="answer" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('answer', $question->answer) }}</textarea>
                            @error('answer')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Wijzigingen opslaan
                            </button>
                            <a href="{{ route('faq.questions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Annuleren
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>