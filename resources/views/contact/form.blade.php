<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Contact') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Neem contact met ons op</h1>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Stuur ons een bericht</h2>
                            <p class="text-gray-300 mb-6">
                                Heb je vragen, suggesties of feedback? We horen graag van je! Vul het formulier in en we nemen zo snel mogelijk contact met je op.
                            </p>

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Naam</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                               class="w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" 
                                               required>
                                        @error('name')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">E-mailadres</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                                               class="w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" 
                                               required>
                                        @error('email')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="subject" class="block text-sm font-medium text-gray-300 mb-2">Onderwerp</label>
                                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" 
                                           class="w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" 
                                           required>
                                    @error('subject')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-6">
                                    <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Bericht</label>
                                    <textarea name="message" id="message" rows="6" 
                                              class="w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" 
                                              placeholder="Vertel ons wat je op je hart hebt..."
                                              required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <button type="submit" 
                                        class="w-full px-4 py-3 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700 transition-colors">
                                    Bericht verzenden
                                </button>
                            </form>
                        </div>
                        
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Andere manieren om contact op te nemen</h2>
                            
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium">E-mail</h3>
                                        <p class="text-gray-300">admin@ehb.be</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium">Responstijd</h3>
                                        <p class="text-gray-300">We proberen binnen 24 uur te reageren</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium">Veel gestelde vragen</h3>
                                        <p class="text-gray-300">
                                            Bekijk eerst onze 
                                            <a href="{{ route('faq.index') }}" class="text-purple-400 hover:text-purple-300 underline">FAQ pagina</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>