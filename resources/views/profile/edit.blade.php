<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Profiel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Gecombineerd Formulier voor alle profiel velden -->
            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                
                <!-- Account Informatie Sectie (van update-profile-information-form) -->
                <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg mb-6">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-100">
                                    {{ __('Profile Information') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-300">
                                    {{ __("Update your account's profile information and email address.") }}
                                </p>
                            </header>

                            <div class="mt-6 space-y-6">
                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                        <div>
                                            <p class="text-sm mt-2 text-gray-300">
                                                {{ __('Your email address is unverified.') }}

                                                <button form="send-verification" class="underline text-sm text-gray-400 hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                                    {{ __('Click here to re-send the verification email.') }}
                                                </button>
                                            </p>

                                            @if (session('status') === 'verification-link-sent')
                                                <p class="mt-2 font-medium text-sm text-green-400">
                                                    {{ __('A new verification link has been sent to your email address.') }}
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <!-- Publiek Profiel Sectie -->
                <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg mb-6">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-100">
                                    {{ __('Publiek Profiel Informatie') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-300">
                                    {{ __("Update je publieke profielinformatie die zichtbaar is voor andere gebruikers.") }}
                                </p>
                            </header>

                            <div class="mt-6 space-y-6">
                                <div>
                                    <x-input-label for="username" :value="__('Gebruikersnaam')" />
                                    <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('username')" />
                                </div>

                                <div>
                                    <x-input-label for="game_interests" :value="__('Game Interesses')" />
                                    <p class="text-sm text-gray-400 mb-3">Selecteer de game categorieën waarin je geïnteresseerd bent</p>
                                    
                                    @php
                                        $gameInterests = \App\Models\GameInterest::all();
                                        $userInterestIds = $user->gameInterests->pluck('id')->toArray();
                                    @endphp
                                    
                                    @if($gameInterests->count() > 0)
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            @foreach($gameInterests as $interest)
                                                <label class="flex items-center p-3 bg-slate-800 rounded-lg cursor-pointer hover:bg-slate-600 transition-colors">
                                                    <input type="checkbox" 
                                                        name="game_interests[]" 
                                                        value="{{ $interest->id }}"
                                                        {{ in_array($interest->id, $userInterestIds) ? 'checked' : '' }}
                                                        class="rounded border-gray-600 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                                    <div class="ml-3 flex items-center">
                                                        <div class="w-3 h-3 rounded-full mr-2" style="background-color: {{ $interest->color }}"></div>
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-100">{{ $interest->name }}</div>
                                                            @if($interest->description)
                                                                <div class="text-xs text-gray-400">{{ $interest->description }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-4 bg-slate-800 rounded-lg">
                                            <p class="text-gray-400">Er zijn nog geen game categorieën beschikbaar.</p>
                                            @if(auth()->user()->is_admin)
                                                <a href="{{ route('admin.game-interests.index') }}" class="text-purple-400 hover:text-purple-300 text-sm">
                                                    Voeg categorieën toe →
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <x-input-error class="mt-2" :messages="$errors->get('game_interests')" />
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
                            </div>
                        </section>
                    </div>
                </div>

                <!-- Enkele Save Button voor alles -->
                <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg mb-6">
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Alle Wijzigingen Opslaan') }}</x-primary-button>

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
                </div>
            </form>

            <!-- Email Verificatie Formulier (verborgen) -->
            <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="hidden">
                @csrf
            </form>

            <!-- Wachtwoord wijzigen sectie blijft apart -->
            <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Account verwijderen sectie blijft apart -->
            <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>