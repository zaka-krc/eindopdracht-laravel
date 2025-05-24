<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('FAQ Vragen Beheren') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">FAQ Vragen</h1>
                        <a href="{{ route('faq.questions.create') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700">
                            Nieuwe vraag toevoegen
                        </a>
                    </div>

                    @if($questions->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-300">Er zijn nog geen vragen.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-600">
                                <thead class="bg-slate-800">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Categorie</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Vraag</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Acties</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-slate-800 divide-y divide-gray-600">
                                    @foreach ($questions as $question)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $question->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $question->category->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-300 max-w-xs truncate">{{ $question->question }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('faq.questions.edit', $question) }}" class="text-blue-400 hover:text-blue-300 mr-3">Bewerken</a>
                                                <form action="{{ route('faq.questions.destroy', $question) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Weet je zeker dat je deze vraag wilt verwijderen?')">Verwijderen</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('faq.index') }}" class="text-purple-400 hover:text-purple-300">&larr; Terug naar FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>