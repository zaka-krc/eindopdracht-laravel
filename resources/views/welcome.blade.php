<x-guest-layout>
    <div class="py-12 bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-6 text-white">Welkom bij <span class="text-purple-400">GameHub</span></h1>
            <p class="text-xl text-gray-300 mb-10 max-w-3xl mx-auto">Je bron voor gaming nieuws en community.</p>
            
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <a href="{{ route('login') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg">
                    Log in
                </a>
                <a href="{{ route('register') }}" class="bg-slate-700 hover:bg-slate-600 border border-purple-500 text-white font-semibold py-2 px-6 rounded-lg">
                    Registreer
                </a>
            </div>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-slate-700 rounded-lg p-6 shadow">
                    <h3 class="text-lg font-semibold mb-2 text-white">Laatste Nieuws</h3>
                    <p class="text-gray-300 mb-4">Blijf op de hoogte van de nieuwste game releases en updates.</p>
                    <a href="#" class="text-purple-400 hover:text-purple-300 font-medium">Bekijk nieuws →</a>
                </div>
                
                <div class="bg-slate-700 rounded-lg p-6 shadow">
                    <h3 class="text-lg font-semibold mb-2 text-white">Gaming FAQ</h3>
                    <p class="text-gray-300 mb-4">Antwoorden op veelgestelde vragen over games en hardware.</p>
                    <a href="#" class="text-purple-400 hover:text-purple-300 font-medium">Bekijk FAQ →</a>
                </div>
                
                <div class="bg-slate-700 rounded-lg p-6 shadow">
                    <h3 class="text-lg font-semibold mb-2 text-white">Contact</h3>
                    <p class="text-gray-300 mb-4">Vragen of feedback? Neem contact met ons op!</p>
                    <a href="#" class="text-purple-400 hover:text-purple-300 font-medium">Contact →</a>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="bg-slate-700 text-center py-4 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-gray-300">© {{ date('Y') }} GameHub. Alle rechten voorbehouden.</p>
        </div>
    </footer>
</x-guest-layout>