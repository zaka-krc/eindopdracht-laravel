<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Nieuws') }}
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
                        <h1 class="text-2xl font-bold">Gaming Nieuws</h1>
                        @auth
                            @if (auth()->user()->is_admin)
                                <a href="{{ route('admin.news.create') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700">
                                    Nieuw bericht toevoegen
                                </a>
                            @endif
                        @endauth
                    </div>

                    @if ($newsItems->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-300 text-lg">Er zijn nog geen nieuwsberichten beschikbaar.</p>
                            @can('create', App\Models\NewsItem::class)
                                <a href="{{ route('admin.news.create') }}" class="inline-block mt-4 px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white">
                                    Voeg het eerste nieuws toe
                                </a>
                            @endcan
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($newsItems as $newsItem)
                                <article class="bg-slate-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow border border-slate-600 hover:border-purple-500/50">
                                    @if($newsItem->image)
                                        <img src="{{ asset('storage/' . $newsItem->image) }}" 
                                             alt="{{ $newsItem->title }}" 
                                             class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-purple-600 to-purple-800 flex items-center justify-center">
                                            <span class="text-white text-lg font-semibold">GameHub</span>
                                        </div>
                                    @endif
                                    
                                    <div class="p-4">
                                        <h3 class="text-xl font-semibold mb-2 text-gray-100">{{ $newsItem->title }}</h3>
                                        <p class="text-purple-300 mb-4 text-sm">{{ $newsItem->formatted_date }}</p>
                                        <div class="mb-4 text-gray-300">
                                            {{ $newsItem->excerpt }}
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <a href="{{ route('news.show', $newsItem) }}" class="inline-block px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-md text-sm font-medium transition-colors">
                                                Lees meer →
                                            </a>
                                            @if($newsItem->user)
                                                <a href="{{ route('profile.public.show', $newsItem->user) }}" class="text-xs text-gray-400 hover:text-purple-400 transition-colors">
                                                    Door {{ $newsItem->user->display_name }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>