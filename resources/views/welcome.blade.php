<x-guest-gaming>
    <div class="hero-section">
        <div class="container mx-auto px-4 py-16 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 text-white">Welkom bij <span class="animated-logo">GameHub</span></h1>
            <p class="text-xl text-gray-300 mb-10 max-w-3xl mx-auto">Je ultieme bron voor gaming nieuws, reviews en community. Blijf op de hoogte van de nieuwste releases, e-sports evenementen en hardware reviews.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('news.index') }}" class="bg-primary hover:bg-primary-hover text-white font-bold py-3 px-6 rounded-lg transition">
                    Bekijk Nieuws
                </a>
                <a href="{{ route('register') }}" class="bg-medium-dark border border-primary hover:bg-medium-dark/80 text-white font-bold py-3 px-6 rounded-lg transition">
                    Word Lid
                </a>
            </div>
        </div>
    </div>

    <div class="py-16 bg-medium-dark">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-white">Ontdek de wereld van gaming</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card p-6 game-feature">
                    <div class="text-accent mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Laatste Nieuws</h3>
                    <p class="text-gray-400 mb-4">Blijf op de hoogte van de nieuwste game releases, updates en e-sports evenementen.</p>
                    <a href="{{ route('news.index') }}" class="text-accent hover:text-primary font-semibold">Lees meer →</a>
                </div>
                
                <div class="card p-6 game-feature">
                    <div class="text-accent mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Gaming FAQ</h3>
                    <p class="text-gray-400 mb-4">Antwoorden op veelgestelde vragen over games, hardware en meer.</p>
                    <a href="{{ route('faq.index') }}" class="text-accent hover:text-primary font-semibold">Bekijk FAQ →</a>
                </div>
                
                <div class="card p-6 game-feature">
                    <div class="text-accent mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Contact</h3>
                    <p class="text-gray-400 mb-4">Vragen, suggesties of feedback? Neem contact met ons op!</p>
                    <a href="{{ route('contact.show') }}" class="text-accent hover:text-primary font-semibold">Contact →</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-gaming>