<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Profiel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg">
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
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>