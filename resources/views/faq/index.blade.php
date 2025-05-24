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
                    <h1 class="text-2xl font-bold mb-6">Veelgestelde Vragen</h1>
                    
                    @if($categories->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-300 text-lg">Er zijn nog geen FAQ categorieën beschikbaar.</p>
                        </div>
                    @else
                        <div class="space-y-8">
                            @foreach($categories as $category)
                                <div class="bg-slate-800 rounded-lg p-6">
                                    <h3 class="text-xl font-semibold mb-4 text-purple-300 border-b border-purple-500/30 pb-2">{{ $category->name }}</h3>
                                    
                                    @if($category->questions->isEmpty())
                                        <p class="text-gray-400 italic">Er zijn nog geen vragen in deze categorie.</p>
                                    @else
                                        <div class="space-y-4">
                                            @foreach($category->questions as $question)
                                                <div class="border border-slate-600 rounded-lg p-4 hover:border-purple-500/50 transition-colors">
                                                    <h4 class="font-medium mb-2 text-gray-100">{{ $question->question }}</h4>
                                                    <p class="text-gray-300 leading-relaxed">{{ $question->answer }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @auth
                        @if(auth()->user()->is_admin)
                            <div class="mt-8 flex flex-wrap gap-4 pt-6 border-t border-slate-600">
                                <a href="{{ route('admin.faq.categories.index') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700">
                                    Categorieën beheren
                                </a>
                                <a href="{{ route('admin.faq.questions.index') }}" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-slate-700">
                                    Vragen beheren
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>