<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Welkom bij GameHub') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="text-center mb-8">
                        <h1 class="text-4xl font-bold mb-6">Welkom bij <span class="text-purple-400">GameHub</span></h1>
                        <p class="text-xl text-gray-300 mb-10 max-w-3xl mx-auto">Je bron voor gaming nieuws en community.</p>
                        
                        <div class="flex flex-wrap justify-center gap-4 mb-8">
                            <a href="{{ route('login') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg">
                                Log in
                            </a>
                            <a href="{{ route('register') }}" class="bg-slate-600 hover:bg-slate-500 border border-purple-500 text-white font-semibold py-2 px-6 rounded-lg">
                                Registreer
                            </a>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-slate-800 p-4 rounded-lg">
                            <h3 class="font-semibold text-lg mb-2">Laatste Nieuws</h3>
                            <p class="text-gray-300 mb-4">Blijf op de hoogte van de nieuwste game releases en updates.</p>
                            <a href="{{ route('news.index') }}" class="text-purple-400 hover:text-purple-300">Bekijk nieuws →</a>
                        </div>
                        
                        <div class="bg-slate-800 p-4 rounded-lg">
                            <h3 class="font-semibold text-lg mb-2">Gaming FAQ</h3>
                            <p class="text-gray-300 mb-4">Antwoorden op veelgestelde vragen over games en hardware.</p>
                            <a href="{{ route('faq.index') }}" class="text-purple-400 hover:text-purple-300">Bekijk FAQ →</a>
                        </div>
                        
                        <div class="bg-slate-800 p-4 rounded-lg">
                            <h3 class="font-semibold text-lg mb-2">Contact</h3>
                            <p class="text-gray-300 mb-4">Vragen or feedback? Neem contact met ons op!</p>
                            <a href="{{ route('contact.show') }}" class="text-purple-400 hover:text-purple-300">Contact →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>