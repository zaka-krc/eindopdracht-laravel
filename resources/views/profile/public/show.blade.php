<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Profiel van') }} {{ $user->username ?: $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Profielfoto -->
                        <div class="flex-shrink-0 w-full md:w-1/4 mb-6 md:mb-0">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->username ?: $user->name }}" class="w-48 h-48 object-cover rounded-lg mx-auto md:mx-0">
                            @else
                                <div class="w-48 h-48 bg-slate-600 flex items-center justify-center rounded-lg text-slate-400 mx-auto md:mx-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Profielinformatie -->
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold mb-4">{{ $user->username ?: $user->name }}</h1>
                            
                            <div class="mb-6">
                                @if($user->is_admin)
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        Admin
                                    </span>
                                @endif
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Over {{ $user->username ?: $user->name }}</h3>
                                @if($user->about_me)
                                    <p class="text-gray-300 whitespace-pre-line">{{ $user->about_me }}</p>
                                @else
                                    <p class="text-gray-400 italic">Deze gebruiker heeft nog geen beschrijving toegevoegd.</p>
                                @endif
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Gegevens</h3>
                                <p class="text-gray-300">
                                    <span class="text-gray-400">Lid sinds:</span> {{ $user->created_at->format('d-m-Y') }}
                                </p>
                                
                                @if($user->birthday)
                                    <p class="text-gray-300">
                                        <span class="text-gray-400">Verjaardag:</span> {{ \Carbon\Carbon::parse($user->birthday)->format('d-m-Y') }}
                                    </p>
                                @endif
                            </div>
                            
                            @if(Auth::check() && Auth::id() === $user->id)
                                <div class="mt-8">
                                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm">
                                        Profiel bewerken
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>