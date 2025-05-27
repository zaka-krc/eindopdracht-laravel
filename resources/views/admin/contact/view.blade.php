<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Contact bericht') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('admin.contact.index') }}" class="text-purple-400 hover:text-purple-300">
                            &larr; Terug naar contact berichten
                        </a>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center justify-between">
                            <h1 class="text-2xl font-bold">{{ $message->subject }}</h1>
                            @if(!$message->is_read)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    Net gelezen
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="bg-slate-800 rounded-lg p-6 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Van</h3>
                                <p class="mt-1 text-lg text-gray-100">{{ $message->name }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">E-mail</h3>
                                <p class="mt-1 text-lg text-gray-100">
                                    <a href="mailto:{{ $message->email }}" class="text-purple-400 hover:text-purple-300">
                                        {{ $message->email }}
                                    </a>
                                </p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Ontvangen</h3>
                                <p class="mt-1 text-lg text-gray-100">{{ $message->created_at->format('d-m-Y H:i') }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Status</h3>
                                <p class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Gelezen
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-3">Bericht</h3>
                            <div class="bg-slate-900 rounded-lg p-4">
                                <p class="text-gray-100 leading-relaxed whitespace-pre-line">{{ $message->message }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex space-x-3">
                            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
                               class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm">
                                Beantwoorden via e-mail
                            </a>
                        </div>

                        {{-- GEFIXT: Nu met $message->id in plaats van $message --}}
                        <form action="{{ route('admin.contact.destroy', $message->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-md font-semibold text-white shadow-sm"
                                    onclick="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?')">
                                Bericht verwijderen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>