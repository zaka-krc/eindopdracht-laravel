<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ $newsItem->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="w-full max-h-96 object-cover rounded-lg">
                    </div>

                    <div class="mb-4">
                        <h1 class="text-3xl font-bold mb-4">{{ $newsItem->title }}</h1>
                        <div class="flex items-center text-sm text-purple-300 mb-6">
                            <span>Gepubliceerd op: {{ \Carbon\Carbon::parse($newsItem->publication_date)->format('d-m-Y') }}</span>
                            @if($newsItem->user)
                                <span class="mx-2">•</span>
                                <span>Door: {{ $newsItem->user->name }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="prose prose-lg max-w-none text-gray-300 leading-relaxed">
                        {{ $newsItem->content }}
                    </div>

                    <div class="mt-8 flex flex-wrap gap-4 pt-6 border-t border-slate-600">
                        <a href="{{ route('news.index') }}" class="px-4 py-2 bg-slate-600 hover:bg-slate-500 rounded-md font-semibold text-white shadow-sm">
                            ← Terug naar overzicht
                        </a>

                        @auth
                            @if (auth()->user()->is_admin)
                                <a href="{{ route('admin.news.edit', $newsItem) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md font-semibold text-white shadow-sm">
                                    Bewerken
                                </a>

                                <form action="{{ route('admin.news.destroy', $newsItem) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-md font-semibold text-white shadow-sm" onclick="return confirm('Weet je zeker dat je dit nieuwsitem wilt verwijderen?')">
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