<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Contact berichten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Contact berichten</h1>
                        <div class="text-sm text-gray-300">
                            Totaal: {{ $messages->count() }} berichten
                            @if($messages->where('is_read', false)->count() > 0)
                                <span class="ml-2 px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">
                                    {{ $messages->where('is_read', false)->count() }} ongelezen
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($messages->isEmpty())
                        <div class="text-center py-8">
                            <div class="mb-4">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2M4 13h2m0 0V9a2 2 0 012-2h2m2 2v4" />
                                </svg>
                            </div>
                            <p class="text-gray-300 text-lg">Nog geen contact berichten ontvangen.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-600">
                                <thead class="bg-slate-800">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Afzender</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Onderwerp</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Datum</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Acties</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-slate-800 divide-y divide-gray-600">
                                    @foreach($messages as $message)
                                        <tr class="{{ !$message->is_read ? 'bg-slate-750' : '' }}">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if(!$message->is_read)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Nieuw
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        Gelezen
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-100">{{ $message->name }}</div>
                                                <div class="text-sm text-gray-300">{{ $message->email }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-100 {{ !$message->is_read ? 'font-semibold' : '' }}">
                                                    {{ Str::limit($message->subject, 50) }}
                                                </div>
                                                <div class="text-sm text-gray-300">
                                                    {{ Str::limit($message->message, 80) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                                {{ $message->created_at->format('d-m-Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                {{-- GEFIXT: Nu met $message->id in plaats van $message --}}
                                                <a href="{{ route('admin.contact.view', $message->id) }}" 
                                                   class="text-purple-400 hover:text-purple-300 mr-3">
                                                    {{ !$message->is_read ? 'Lezen' : 'Bekijken' }}
                                                </a>
                                                
                                                <form action="{{ route('admin.contact.destroy', $message->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-400 hover:text-red-300"
                                                            onclick="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?')">
                                                        Verwijderen
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>