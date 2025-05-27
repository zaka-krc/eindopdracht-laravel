{{-- resources/views/components/comments.blade.php --}}
@props(['newsItem'])

<div class="mt-8">
    <div class="border-t border-slate-600 pt-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-100">
                Comments ({{ $newsItem->total_comments }})
            </h3>
            
            @auth
                @if(auth()->user()->is_admin && $newsItem->comments()->count() > 0)
                    <form action="{{ route('admin.comments.bulk-delete', $newsItem) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="text-sm text-red-400 hover:text-red-300"
                                onclick="return confirm('Alle comments verwijderen?')">
                            Alle comments verwijderen
                        </button>
                    </form>
                @endif
            @endauth
        </div>

        @if (session('comment_success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('comment_success') }}
            </div>
        @endif

        @auth
            {{-- Comment Form --}}
            <div class="mb-8 bg-slate-800 rounded-lg p-4">
                <form action="{{ route('comments.store', $newsItem) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-300 mb-2">
                            Plaats een comment als {{ auth()->user()->display_name }}
                        </label>
                        <textarea name="content" id="content" rows="3" 
                                  class="w-full rounded-md border-gray-600 bg-slate-700 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"
                                  placeholder="Wat denk je van dit nieuws?"
                                  required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm transition-colors">
                            Comment plaatsen
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="mb-8 bg-slate-800 rounded-lg p-4 text-center">
                <p class="text-gray-300 mb-4">Log in om een comment te plaatsen</p>
                <a href="{{ route('login') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white">
                    Inloggen
                </a>
            </div>
        @endauth

        {{-- Comments List --}}
        @if($newsItem->topLevelComments->count() > 0)
            <div class="space-y-4">
                @foreach($newsItem->topLevelComments as $comment)
                    <x-single-comment :comment="$comment" :newsItem="$newsItem" />
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-400">
                <p>Nog geen comments. Wees de eerste!</p>
            </div>
        @endif
    </div>
</div>