<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Welkom bij GameHub!</h1>
                    <p class="mb-4">Je ultieme bron voor gaming nieuws, reviews en community.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-blue-50 p-4 rounded-lg shadow">
                            <h3 class="font-semibold text-lg mb-2">Laatste Nieuws</h3>
                            <p>Blijf op de hoogte van de nieuwste game releases, updates en e-sports evenementen.</p>
                            <a href="{{ route('news.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">Bekijk nieuws →</a>
                        </div>
                        
                        <div class="bg-purple-50 p-4 rounded-lg shadow">
                            <h3 class="font-semibold text-lg mb-2">Gaming FAQ</h3>
                            <p>Antwoorden op veelgestelde vragen over games, hardware en meer.</p>
                            <a href="{{ route('faq.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">Bekijk FAQ →</a>
                        </div>
                        
                        <div class="bg-green-50 p-4 rounded-lg shadow">
                            <h3 class="font-semibold text-lg mb-2">Contact</h3>
                            <p>Vragen, suggesties of feedback? Neem contact met ons op!</p>
                            <a href="{{ route('contact.show') }}" class="text-blue-600 hover:underline mt-2 inline-block">Contact →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>