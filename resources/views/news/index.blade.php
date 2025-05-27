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

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Gaming Nieuws</h1>
                        @auth
                            @if (auth()->user()->is_admin)
                                <a href="{{ route('admin.news.create') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700 transition-colors">
                                    Nieuw bericht toevoegen
                                </a>
                            @endif
                        @endauth
                    </div>

                    @if ($newsItems->isEmpty())
                        <div class="text-center py-8">
                            <div class="mb-4">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v1" />
                                </svg>
                            </div>
                            <p class="text-gray-300 text-lg">Er zijn nog geen nieuwsberichten beschikbaar.</p>
                            @auth
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('admin.news.create') }}" class="inline-block mt-4 px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white transition-colors">
                                        Voeg het eerste nieuws toe
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($newsItems as $newsItem)
                                <article class="bg-slate-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-600 hover:border-purple-500/50 hover:scale-105">
                                    @if($newsItem->image)
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $newsItem->image) }}" 
                                                 alt="{{ $newsItem->title }}" 
                                                 class="w-full h-48 object-cover"
                                                 onerror="this.parentElement.innerHTML='<div class=\'w-full h-48 bg-gradient-to-br from-purple-600 to-purple-800 flex items-center justify-center\'><span class=\'text-white text-lg font-semibold\'>GameHub</span></div>'">
                                        </div>
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-purple-600 to-purple-800 flex items-center justify-center">
                                            <span class="text-white text-lg font-semibold">GameHub</span>
                                        </div>
                                    @endif
                                    
                                    <div class="p-4">
                                        <h3 class="text-xl font-semibold mb-2 text-gray-100 line-clamp-2">{{ $newsItem->title }}</h3>
                                        <div class="flex items-center text-purple-300 mb-3 text-sm">
                                            <time datetime="{{ $newsItem->publication_date->toDateString() }}">
                                                {{ $newsItem->formatted_date }}
                                            </time>
                                            @if($newsItem->comments_count > 0)
                                                <span class="mx-2">•</span>
                                                <span>{{ $newsItem->comments_count }} comment{{ $newsItem->comments_count !== 1 ? 's' : '' }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4 text-gray-300 line-clamp-3">
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

                        {{-- Pagination als je dat later wilt toevoegen --}}
                        @if(method_exists($newsItems, 'links'))
                            <div class="mt-8">
                                {{ $newsItems->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>