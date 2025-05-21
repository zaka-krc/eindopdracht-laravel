<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">Welkom bij GameHub!</h1>
                    <p class="mb-6 text-gray-300">Je bron voor gaming nieuws en community.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-slate-800 p-4 rounded-lg">
                            <h3 class="font-semibold text-lg mb-2">Laatste Nieuws</h3>
                            <p class="text-gray-300 mb-4">Blijf op de hoogte van de nieuwste game releases en updates.</p>
                            <a href="#" class="text-purple-400 hover:text-purple-300">Bekijk nieuws →</a>
                        </div>
                        
                        <div class="bg-slate-800 p-4 rounded-lg">
                            <h3 class="font-semibold text-lg mb-2">Gaming FAQ</h3>
                            <p class="text-gray-300 mb-4">Antwoorden op veelgestelde vragen over games en hardware.</p>
                            <a href="#" class="text-purple-400 hover:text-purple-300">Bekijk FAQ →</a>
                        </div>
                        
                        <div class="bg-slate-800 p-4 rounded-lg">
                            <h3 class="font-semibold text-lg mb-2">Contact</h3>
                            <p class="text-gray-300 mb-4">Vragen of feedback? Neem contact met ons op!</p>
                            <a href="#" class="text-purple-400 hover:text-purple-300">Contact →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>