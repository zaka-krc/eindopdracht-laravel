<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $newsItem->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="w-full max-h-96 object-cover rounded-lg">
                    </div>

                    <div class="mb-4 text-gray-600">
                        Gepubliceerd op: {{ \Carbon\Carbon::parse($newsItem->publication_date)->format('d-m-Y') }}
                    </div>

                    <div class="prose max-w-none">
                        {{ $newsItem->content }}
                    </div>

                    <div class="mt-6 flex gap-2">
                        <a href="{{ route('news.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Terug naar overzicht
                        </a>

                        @auth
                            @if (auth()->user()->is_admin)
                                <a href="{{ route('news.edit', $newsItem) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Bewerken
                                </a>

                                <form action="{{ route('news.destroy', $newsItem) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Weet je zeker dat je dit nieuwsitem wilt verwijderen?')">
                                        Verwijderen
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>