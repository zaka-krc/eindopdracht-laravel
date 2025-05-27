{{-- resources/views/components/single-comment.blade.php --}}
@props(['comment', 'newsItem', 'depth' => 0])

<div class="bg-slate-800 rounded-lg p-4 {{ $depth > 0 ? 'ml-8 border-l-2 border-purple-500/30' : '' }}">
    {{-- Comment Header --}}
    <div class="flex items-center justify-between mb-3">
        <div class="flex items-center space-x-3">
            @if($comment->user->profile_photo_url)
                <img src="{{ $comment->user->profile_photo_url }}" 
                     alt="{{ $comment->user->display_name }}" 
                     class="w-8 h-8 rounded-full object-cover">
            @else
                <div class="w-8 h-8 bg-slate-600 rounded-full flex items-center justify-center">
                    <span class="text-xs font-medium text-gray-300">
                        {{ substr($comment->user->display_name, 0, 1) }}
                    </span>
                </div>
            @endif
            
            <div>
                <a href="{{ route('profile.public.show', $comment->user) }}" 
                   class="text-purple-400 hover:text-purple-300 font-medium text-sm">
                    {{ $comment->user->display_name }}
                </a>
                <p class="text-xs text-gray-400">{{ $comment->formatted_date }}</p>
            </div>
        </div>

        {{-- Actions --}}
        @auth
            <div class="flex items-center space-x-2">
                {{-- Reply Button --}}
                <button onclick="toggleReplyForm('reply-{{ $comment->id }}')" 
                        class="text-sm text-purple-400 hover:text-purple-300">
                    Reageren
                </button>

                {{-- Edit/Delete for comment owner --}}
                @if(auth()->id() === $comment->user_id)
                    @if($comment->created_at->diffInMinutes(now()) <= 15)
                        <button onclick="toggleEditForm('edit-{{ $comment->id }}')" 
                                class="text-sm text-blue-400 hover:text-blue-300">
                            Bewerken
                        </button>
                    @endif
                    
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="text-sm text-red-400 hover:text-red-300"
                                onclick="return confirm('Comment verwijderen?')">
                            Verwijderen
                        </button>
                    </form>
                @endif

                {{-- Admin Delete --}}
                @if(auth()->user()->is_admin && auth()->id() !== $comment->user_id)
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="text-sm text-red-400 hover:text-red-300"
                                onclick="return confirm('Comment verwijderen als admin?')">
                            [Admin] Verwijderen
                        </button>
                    </form>
                @endif
            </div>
        @endauth
    </div>

    {{-- Comment Content --}}
    <div class="mb-4">
        <div id="content-{{ $comment->id }}">
            <p class="text-gray-300 leading-relaxed whitespace-pre-line">{{ $comment->content }}</p>
        </div>

        {{-- Edit Form (Hidden by default) --}}
        @if(auth()->check() && auth()->id() === $comment->user_id && $comment->created_at->diffInMinutes(now()) <= 15)
            <div id="edit-{{ $comment->id }}" class="hidden mt-4">
                <form action="{{ route('comments.update', $comment) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <textarea name="content" rows="3" 
                              class="w-full rounded-md border-gray-600 bg-slate-700 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"
                              required>{{ $comment->content }}</textarea>
                    <div class="flex justify-end space-x-2 mt-2">
                        <button type="button" onclick="toggleEditForm('edit-{{ $comment->id }}')" 
                                class="px-3 py-1 text-sm text-gray-400 hover:text-gray-300">
                            Annuleren
                        </button>
                        <button type="submit" 
                                class="px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded">
                            Opslaan
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    {{-- Reply Form (Hidden by default) --}}
    @auth
        <div id="reply-{{ $comment->id }}" class="hidden mb-4">
            <form action="{{ route('comments.store', $newsItem) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <div class="mb-2">
                    <textarea name="content" rows="2" 
                              class="w-full rounded-md border-gray-600 bg-slate-700 text-gray-100 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"
                              placeholder="Reageer op {{ $comment->user->display_name }}..."
                              required></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="toggleReplyForm('reply-{{ $comment->id }}')" 
                            class="px-3 py-1 text-sm text-gray-400 hover:text-gray-300">
                        Annuleren
                    </button>
                    <button type="submit" 
                            class="px-3 py-1 text-sm bg-purple-600 hover:bg-purple-700 text-white rounded">
                        Reageren
                    </button>
                </div>
            </form>
        </div>
    @endauth

    {{-- Nested Replies --}}
    @if($comment->replies->count() > 0 && $depth < 3)
        <div class="mt-4 space-y-3">
            @foreach($comment->replies as $reply)
                <x-single-comment :comment="$reply" :newsItem="$newsItem" :depth="$depth + 1" />
            @endforeach
        </div>
    @endif
</div>

@once
    @push('scripts')
    <script>
        function toggleReplyForm(id) {
            const form = document.getElementById(id);
            form.classList.toggle('hidden');
            if (!form.classList.contains('hidden')) {
                form.querySelector('textarea').focus();
            }
        }

        function toggleEditForm(id) {
            const form = document.getElementById(id);
            const content = document.getElementById('content-' + id.replace('edit-', ''));
            form.classList.toggle('hidden');
            content.classList.toggle('hidden');
            if (!form.classList.contains('hidden')) {
                form.querySelector('textarea').focus();
            }
        }
    </script>
    @endpush
@endonce