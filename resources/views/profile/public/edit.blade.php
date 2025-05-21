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
                    <div class="mb-4">
                        <a href="{{ route('profile.public.show', $user) }}" class="text-purple-400 hover:text-purple-300">
                            &larr; Terug naar mijn publieke profiel
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h1 class="text-2xl font-bold mb-6">Publiek profiel bewerken</h1>
                            <p class="text-gray-300 mb-6">
                                Hier kun je je publieke profiel bewerken dat zichtbaar is voor andere gebruikers. 
                                Voor accountinstellingen zoals e-mail en wachtwoord, ga naar 
                                <a href="{{ route('profile.edit') }}" class="text-purple-400 hover:text-purple-300">Profielinstellingen</a>.
                            </p>
                            <!-- Bestaande profile.edit.blade.php - rond regel 30 na de "Update Profile Information" sectie -->

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-100">
            {{ __('Publiek Profiel Informatie') }}
        </h2>

        <p class="mt-1 text-sm text-gray-300">
            {{ __("Update je publieke profielinformatie die zichtbaar is voor andere gebruikers.") }}
        </p>
    </header>

    <form id="public-profile-form" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="username" :value="__('Gebruikersnaam')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="birthday" :value="__('Verjaardag')" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', optional($user->birthday)->format('Y-m-d'))" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div>
            <x-input-label for="about_me" :value="__('Over mij')" />
            <textarea id="about_me" name="about_me" rows="4" class="mt-1 block w-full border-gray-600 bg-slate-800 text-gray-100 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">{{ old('about_me', $user->about_me) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('about_me')" />
        </div>

        <div>
            <x-input-label for="profile_photo" :value="__('Profielfoto')" />
            
            @if($user->profile_photo)
                <div class="mt-2 mb-4">
                    <p class="text-sm text-gray-400 mb-2">Huidige profielfoto:</p>
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="h-32 w-32 object-cover rounded-lg">
                </div>
            @endif
            
            <input id="profile_photo" name="profile_photo" type="file" class="mt-1 block w-full text-gray-100" />
            <p class="mt-1 text-sm text-gray-400">
                {{ __('Toegestane formaten: JPEG, PNG, JPG, GIF. Maximaal 2MB.') }}
            </p>
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Opslaan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-300"
                >{{ __('Opgeslagen.') }}</p>
            @endif
        </div>
    </form>
</section>
                            
                            <form action="{{ route('profile.public.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-4">
                                    <label for="username" class="block text-sm font-medium text-gray-300">Gebruikersnaam</label>
                                    <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>
                                    @error('username')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="birthday" class="block text-sm font-medium text-gray-300">Verjaardag</label>
                                    <input type="date" name="birthday" id="birthday" value="{{ old('birthday', optional($user->birthday)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                                    @error('birthday')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="about_me" class="block text-sm font-medium text-gray-300">Over mij</label>
                                    <textarea name="about_me" id="about_me" rows="6" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">{{ old('about_me', $user->about_me) }}</textarea>
                                    @error('about_me')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mt-6">
                                    <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700">
                                        Wijzigingen opslaan
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <div>
                            <h2 class="text-xl font-bold mb-6">Profielfoto</h2>
                            
                            <div class="mb-6">
                                <p class="text-gray-300 mb-4">Huidige profielfoto:</p>
                                @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="h-48 w-48 object-cover rounded-lg">
                                @else
                                    <div class="h-48 w-48 bg-slate-600 flex items-center justify-center rounded-lg text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <form action="{{ route('profile.public.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-4">
                                    <label for="profile_photo" class="block text-sm font-medium text-gray-300">Nieuwe profielfoto uploaden</label>
                                    <input type="file" name="profile_photo" id="profile_photo" class="mt-1 block w-full text-gray-300" required>
                                    <p class="text-gray-400 text-sm mt-1">Toegestane formaten: JPEG, PNG, JPG, GIF. Max 2MB.</p>
                                    @error('profile_photo')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mt-6">
                                    <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700">
                                        Profielfoto uploaden
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>