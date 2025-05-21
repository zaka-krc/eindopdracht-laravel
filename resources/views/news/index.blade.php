<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuws') }}
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
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($newsItems as $newsItem)
                            <div class="bg-white rounded-lg overflow-hidden shadow">
                                <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold mb-2">{{ $newsItem->title }}</h3>
                                    <p class="text-gray-600 mb-4">{{ \Carbon\Carbon::parse($newsItem->publication_date)->format('d-m-Y') }}</p>
                                    <div class="mb-4">
                                        {{ Str::limit($newsItem->content, 100) }}
                                    </div>
                                    <a href="{{ route('news.show', $newsItem) }}" class="text-blue-500 hover:underline">Lees meer</a>
                                </div>
                            </div>
                        @endforeach

                        @if ($newsItems->isEmpty())
                            <p>Er zijn nog geen nieuwsberichten beschikbaar.</p>
                        @endif
                    </div>

                    @auth
                        @if (auth()->user()->is_admin)
                            <div class="mt-6">
                                <a href="{{ route('news.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Nieuw bericht toevoegen
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>