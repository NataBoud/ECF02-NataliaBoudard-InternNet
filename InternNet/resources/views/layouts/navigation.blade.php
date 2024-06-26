<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="text-indigo-900 text-xl font-black">

                            {{ __('InternNet') }}

                    </x-nav-link>

                    @if (Route::has('login'))

                        @auth
                        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">

                            {{ __('Voir le profile') }}

                        </x-nav-link>


                        <x-nav-link :href="route('opportunities.create')" :active="request()->routeIs('opportunities.create')">

                            {{ __('Publier une offre') }}

                        </x-nav-link>

                        <x-nav-link :href="route('opportunities.offers')" :active="request()->routeIs('opportunities.offers')">

                                {{ __('Mes offres') }}

                        </x-nav-link>
{{--                        @if(Auth::check() && Auth::user() instanceof \App\Models\Admin)--}}
{{--                            <p>ADMIN TEST</p>--}}
{{--                        @endif--}}

                        @endauth




                        @guest
{{--                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">--}}
{{--                            {{ __('Log in') }}--}}
{{--                        </x-nav-link>--}}

                        @if (Route::has('register'))
{{--                            <x-nav-link :href="route('register')" :active="request()->routeIs('register')">--}}
{{--                                {{ __('Register') }}--}}
{{--                            </x-nav-link>--}}
                        @endif
                        @endguest

                    @endif
                </div>

            </div>

            <!-- Settings Dropdown -->

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @guest
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                {{ __('Se connecter') }}
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        @else
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        @endguest
                    </x-slot>
                    <!-- Dropdown Content -->
                    <x-slot name="content">
                        @guest
                            <x-dropdown-link :href="route('login')">
                                {{ __('Log in') }}
                            </x-dropdown-link>
                            @if (Route::has('register'))
                                <x-dropdown-link :href="route('register')">
                                    {{ __('Register') }}
                                </x-dropdown-link>
                            @endif
                        @else
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @endguest
{{--                        @guest--}}
{{--                            <p>Admin</p>--}}
{{--                            <x-dropdown-link :href="route('login')">--}}
{{--                                {{ __('Log in') }}--}}
{{--                            </x-dropdown-link>--}}
{{--                            @if (Route::has('admin.register'))--}}
{{--                                <x-dropdown-link :href="route('admin.register')">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </x-dropdown-link>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <x-dropdown-link :href="route('profile.edit')">--}}
{{--                                {{ __('Profile') }}--}}
{{--                            </x-dropdown-link>--}}
{{--                            <!-- Authentication -->--}}
{{--                            <form method="POST" action="{{ route('logout') }}">--}}
{{--                                @csrf--}}
{{--                                <x-dropdown-link :href="route('logout')"--}}
{{--                                                 onclick="event.preventDefault();--}}
{{--                                                this.closest('form').submit();">--}}
{{--                                    {{ __('Log Out') }}--}}
{{--                                </x-dropdown-link>--}}
{{--                            </form>--}}
{{--                        @endguest--}}
                    </x-slot>
                </x-dropdown>
            </div>




            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
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

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @guest
                    <div class="font-medium text-base text-gray-800">{{ __('Se connecter') }}</div>
                @else
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endguest
            </div>

            <div class="mt-3 space-y-1">
                @guest
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Log in') }}
                    </x-responsive-nav-link>

                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    @endif
                @else
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @endguest
            </div>
        </div>
    </div>

</nav>
