<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Gebruiker bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('admin.users.index') }}" class="text-purple-400 hover:text-purple-300">
                            &larr; Terug naar gebruikersoverzicht
                        </a>
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold">{{ $user->display_name }} bewerken</h1>
                        @if($user->id === auth()->id())
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                                Dit is je eigen account
                            </span>
                        @endif
                    </div>
                    
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300">Naam</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-300">Gebruikersnaam</label>
                                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                                @error('username')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-300">E-mailadres</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-600 bg-slate-800 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50" required>
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Admin rechten sectie -->
                        @if($user->id !== auth()->id())
                            <div class="mt-6 p-4 bg-slate-800 rounded-lg">
                                <h3 class="text-lg font-semibold mb-3">Admin rechten</h3>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }} class="rounded border-gray-600 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-300">Deze gebruiker heeft admin rechten</span>
                                </label>
                                <p class="text-xs text-gray-400 mt-1">Admin kunnen alle gebruikers beheren en nieuws posten.</p>
                            </div>
                        @else
                            <!-- Voor eigen account: toon status maar laat niet wijzigen -->
                            <div class="mt-6 p-4 bg-slate-800 rounded-lg">
                                <h3 class="text-lg font-semibold mb-3">Admin status</h3>
                                <div class="flex items-center">
                                    @if($user->is_admin)
                                        <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                                            Je bent admin
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">
                                            Je bent gewone gebruiker
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-400 mt-1">Je kunt je eigen admin status niet wijzigen voor veiligheid.</p>
                                <!-- Hidden field om admin status te behouden -->
                                <input type="hidden" name="is_admin" value="{{ $user->is_admin ? '1' : '0' }}">
                            </div>
                        @endif
                        
                        <div class="mt-6 flex gap-3">
                            <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700">
                                Wijzigingen opslaan
                            </button>
                            
                            <a href="{{ route('profile.public.show', $user) }}" class="px-4 py-2 bg-slate-600 hover:bg-slate-500 rounded-md font-semibold text-white shadow-sm">
                                Bekijk publiek profiel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>