<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Publiek profiel bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('profile.public.show', $user) }}" class="text-purple-400 hover:text-purple-300">
                            &larr; Terug naar mijn publieke profiel
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Profiel informatie formulier -->
                        <div>
                            <h1 class="text-2xl font-bold mb-6">Publiek profiel bewerken</h1>
                            <p class="text-gray-300 mb-6">
                                Hier kun je je publieke profiel bewerken dat zichtbaar is voor andere gebruikers. 
                                Voor accountinstellingen zoals e-mail en wachtwoord, ga naar 
                                <a href="{{ route('profile.edit') }}" class="text-purple-400 hover:text-purple-300 underline">Profielinstellingen</a>.
                            </p>
                            
                            <form action="{{ route('profile.public.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                
                                <div class="space-y-6">
                                    <div>
                                        <label for="username" class="block text-sm font-medium text-gray-300">Gebruikersnaam</label>
                                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>
                                        @error('username')
                                            <span class="text-red-400 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="birthday" class="block text-sm font-medium text-gray-300">Verjaardag</label>
                                        <input type="date" name="birthday" id="birthday" value="{{ old('birthday', optional($user->birthday)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                                        @error('birthday')
                                            <span class="text-red-400 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="about_me" class="block text-sm font-medium text-gray-300">Over mij</label>
                                        <textarea name="about_me" id="about_me" rows="6" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" placeholder="Vertel iets over jezelf...">{{ old('about_me', $user->about_me) }}</textarea>
                                        @error('about_me')
                                            <span class="text-red-400 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="profile_photo" class="block text-sm font-medium text-gray-300">Profielfoto</label>
                                        <input type="file" name="profile_photo" id="profile_photo" class="mt-1 block w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700">
                                        <p class="text-gray-400 text-sm mt-1">Toegestane formaten: JPEG, PNG, JPG, GIF. Max 2MB.</p>
                                        @error('profile_photo')
                                            <span class="text-red-400 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="pt-4">
                                        <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700 transition-colors">
                                            Wijzigingen opslaan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Huidige profiel preview -->
                        <div>
                            <h2 class="text-xl font-bold mb-6">Huidige profielfoto</h2>
                            
                            <div class="bg-slate-800 rounded-lg p-6">
                                @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="w-48 h-48 object-cover rounded-lg mx-auto">
                                @else
                                    <div class="w-48 h-48 bg-slate-600 flex items-center justify-center rounded-lg text-slate-400 mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="mt-6 text-center">
                                    <h3 class="text-lg font-semibold">{{ $user->username ?: $user->name }}</h3>
                                    @if($user->about_me)
                                        <p class="text-gray-300 mt-2 text-sm">{{ Str::limit($user->about_me, 100) }}</p>
                                    @endif
                                    @if($user->birthday)
                                        <p class="text-gray-400 mt-2 text-sm">
                                            Verjaardag: {{ \Carbon\Carbon::parse($user->birthday)->format('d-m-Y') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <a href="{{ route('profile.public.show', $user) }}" class="block w-full px-4 py-2 bg-slate-600 hover:bg-slate-500 rounded-md font-semibold text-white text-center shadow-sm transition-colors">
                                    Bekijk hoe anderen mijn profiel zien
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>