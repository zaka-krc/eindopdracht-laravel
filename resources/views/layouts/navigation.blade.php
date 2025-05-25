<nav x-data="{ open: false }" class="bg-slate-800 border-b border-purple-500/30">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::check() ? route('dashboard') : route('welcome') }}" class="flex items-center">
                        <span class="text-purple-400 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
                            </svg>
                        </span>
                        <span class="font-bold text-xl uppercase tracking-wider text-gray-100">GameHub</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-200 hover:text-purple-300 border-purple-400">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endauth
                    
                    <x-nav-link :href="route('news.index')" :active="request()->routeIs('news.*')" class="text-gray-200 hover:text-purple-300 border-purple-400">
                        {{ __('Nieuws') }}
                    </x-nav-link>
                    <x-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.*')" class="text-gray-200 hover:text-purple-300 border-purple-400">
                        {{ __('FAQ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact.show')" :active="request()->routeIs('contact.*')" class="text-gray-200 hover:text-purple-300 border-purple-400">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown or Login Links -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-200 bg-slate-800 hover:text-purple-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->display_name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.public.show', Auth::user())" class="text-gray-100 hover:bg-slate-700">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ __('Mijn Profiel') }}
                                </div>
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-100 hover:bg-slate-700">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ __('Instellingen') }}
                                </div>
                            </x-dropdown-link>

                            @if(Auth::user()->is_admin)
                                <div class="border-t border-slate-600 my-1"></div>
                                <x-dropdown-link :href="route('admin.users.index')" class="text-gray-100 hover:bg-slate-700">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                        </svg>
                                        {{ __('Gebruikersbeheer') }}
                                    </div>
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-slate-600 my-1"></div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();" 
                                        class="text-gray-100 hover:bg-slate-700">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        {{ __('Uitloggen') }}
                                    </div>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Login/Register links voor guests -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-200 hover:text-purple-300 px-3 py-2 rounded-md text-sm font-medium">
                            Log in
                        </a>
                        <a href="{{ route('register') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded-md text-sm font-medium">
                            Registreer
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-purple-300 hover:bg-slate-700 focus:outline-none focus:bg-slate-700 focus:text-purple-300 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-200 hover:text-purple-300 hover:bg-slate-700">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endauth
            
            <x-responsive-nav-link :href="route('news.index')" :active="request()->routeIs('news.*')" class="text-gray-200 hover:text-purple-300 hover:bg-slate-700">
                {{ __('Nieuws') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('faq.index')" :active="request()->routeIs('faq.*')" class="text-gray-200 hover:text-purple-300 hover:bg-slate-700">
                {{ __('FAQ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact.show')" :active="request()->routeIs('contact.*')" class="text-gray-200 hover:text-purple-300 hover:bg-slate-700">
                {{ __('Contact') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-slate-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-100">{{ Auth::user()->display_name }}</div>
                    <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.public.show', Auth::user())" class="text-gray-200 hover:text-purple-300 hover:bg-slate-700">
                        {{ __('Mijn Profiel') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-200 hover:text-purple-300 hover:bg-slate-700">
                        {{ __('Instellingen') }}
                    </x-responsive-nav-link>

                    @if(Auth::user()->is_admin)
                        <x-responsive-nav-link :href="route('admin.users.index')" class="text-gray-200 hover:text-purple-300 hover:bg-slate-700">
                            {{ __('Gebruikersbeheer') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" class="text-gray-200 hover:text-purple-300 hover:bg-slate-700"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Uitloggen') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <!-- Login/Register voor mobile guests -->
            <div class="pt-4 pb-1 border-t border-slate-600">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')" class="text-gray-200 hover:text-purple-300 hover:bg-slate-700">
                        {{ __('Log in') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="text-gray-200 hover:text-purple-300 hover:bg-slate-700">
                        {{ __('Registreer') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>