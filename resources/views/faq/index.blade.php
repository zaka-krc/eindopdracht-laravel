<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('FAQ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($categories->isEmpty())
                        <p>Er zijn nog geen FAQ categorieën beschikbaar.</p>
                    @else
                        <div class="space-y-8">
                            @foreach($categories as $category)
                                <div>
                                    <h3 class="text-lg font-semibold mb-4">{{ $category->name }}</h3>
                                    
                                    @if($category->questions->isEmpty())
                                        <p class="text-gray-500">Er zijn nog geen vragen in deze categorie.</p>
                                    @else
                                        <div class="space-y-4">
                                            @foreach($category->questions as $question)
                                                <div class="border rounded-lg p-4">
                                                    <h4 class="font-medium mb-2">{{ $question->question }}</h4>
                                                    <p class="text-gray-600">{{ $question->answer }}</p>
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
                            <div class="mt-8 flex gap-4">
                                <a href="{{ route('faq.categories.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Categorieën beheren
                                </a>
                                <a href="{{ route('faq.questions.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
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