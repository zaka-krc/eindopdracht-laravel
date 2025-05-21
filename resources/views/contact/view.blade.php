<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Contactbericht bekijken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('contact.index') }}" class="text-purple-400 hover:text-purple-300">
                            &larr; Terug naar overzicht
                        </a>
                    </div>
                    
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold">{{ $message->subject }}</h1>
                        <p class="text-gray-400">
                            Van: {{ $message->name }} ({{ $message->email }})
                        </p>
                        <p class="text-gray-400">
                            Ontvangen op: {{ $message->created_at->format('d-m-Y H:i') }}
                        </p>
                    </div>
                    
                    <div class="bg-slate-800 p-6 rounded-lg mb-6">
                        <p class="whitespace-pre-line">{{ $message->message }}</p>
                    </div>
                    
                    <div class="flex space-x-4">
                        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-slate-700">
                            Beantwoorden per e-mail
                        </a>
                        <form action="{{ route('contact.destroy', $message) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-md font-semibold text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-slate-700" onclick="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?')">
                                Verwijderen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>