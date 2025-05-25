<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('FAQ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold mb-2">Veelgestelde Vragen</h1>
                        <p class="text-gray-300">Vind snel antwoorden op je gaming vragen</p>
                    </div>
                    
                    @if($categories->isEmpty())
                        <div class="text-center py-12">
                            <div class="mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Nog geen FAQ's beschikbaar</h3>
                            <p class="text-gray-300 mb-6">Er zijn nog geen FAQ categorieën beschikbaar. Check later terug!</p>
                            
                            @auth
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('admin.faq.categories.create') }}" class="inline-block px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white">
                                        Eerste categorie aanmaken
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($categories as $category)
                                <div class="bg-slate-800 rounded-lg overflow-hidden">
                                    <div class="p-6 border-b border-slate-600">
                                        <h3 class="text-xl font-semibold text-purple-300 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                            {{ $category->name }}
                                        </h3>
                                    </div>
                                    
                                    @if($category->questions->isEmpty())
                                        <div class="p-6">
                                            <p class="text-gray-400 italic text-center py-4">Er zijn nog geen vragen in deze categorie.</p>
                                        </div>
                                    @else
                                        <div class="divide-y divide-slate-600">
                                            @foreach($category->questions as $question)
                                                <details class="group">
                                                    <summary class="p-4 cursor-pointer hover:bg-slate-700 transition-colors flex items-center justify-between">
                                                        <h4 class="font-medium text-gray-100 pr-4">{{ $question->question }}</h4>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400 transform group-open:rotate-180 transition-transform flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </summary>
                                                    <div class="px-4 pb-4 pt-2 bg-slate-900/50">
                                                        <div class="prose prose-sm max-w-none">
                                                            <p class="text-gray-300 leading-relaxed whitespace-pre-line">{{ $question->answer }}</p>
                                                        </div>
                                                    </div>
                                                </details>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @auth
                        @if(auth()->user()->is_admin)
                            <div class="mt-8 bg-slate-800 rounded-lg p-6">
                                <h3 class="text-lg font-semibold mb-4 text-purple-300">Admin Tools</h3>
                                <div class="flex flex-wrap gap-4">
                                    <a href="{{ route('admin.faq.categories.index') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700 transition-colors">
                                        Categorieën beheren
                                    </a>
                                    <a href="{{ route('admin.faq.questions.index') }}" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-slate-700 transition-colors">
                                        Vragen beheren
                                    </a>
                                    @if($categories->isNotEmpty())
                                        <a href="{{ route('admin.faq.questions.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-slate-700 transition-colors">
                                            Nieuwe vraag toevoegen
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
            
            <!-- Footer -->
            <div class="mt-8 text-center">
                <div class="bg-slate-700 rounded-lg p-6">
                    <p class="text-gray-300 mb-4">Kon je niet vinden wat je zocht?</p>
                    <a href="{{ route('contact.show') }}" class="inline-block px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white transition-colors">
                        Neem contact met ons op
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>