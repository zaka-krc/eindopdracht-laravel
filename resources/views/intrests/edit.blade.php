<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-700 p-6 rounded-lg">
                <h1 class="text-2xl font-bold text-white mb-6">Mijn Game Interesses</h1>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('interests.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        @foreach($allInterests as $interest)
                            <label class="flex items-center p-4 bg-slate-800 rounded-lg cursor-pointer hover:bg-slate-600 transition-colors">
                                <input type="checkbox" 
                                       name="game_interests[]" 
                                       value="{{ $interest->id }}"
                                       {{ in_array($interest->id, $userInterestIds) ? 'checked' : '' }}
                                       class="mr-3 rounded border-gray-600 text-purple-600">
                                <div class="flex items-center">
                                    <div class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $interest->color }}"></div>
                                    <div>
                                        <div class="text-white font-medium">{{ $interest->name }}</div>
                                        <div class="text-gray-400 text-sm">{{ $interest->description }}</div>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    
                    <button type="submit" class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold">
                        Interesses Opslaan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>