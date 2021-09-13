<div class="{{$class ?? ''}}">
    <nav class="flex items-center justify-between mx-auto p-5 text-white md:py-10 md:w-full">
        <div class="md:w-1/3 w-2/3">
            <logo>
                <a href="{{ $blog_domain?route('sd-blogs'):route('/') }}">
                    <img src="https://www.realtyhive.com/images/template/RealtyHive_Horizontal_white_flat-01.png" class="md:w-52 w-full">
                </a>
            </logo>
        </div>

        <div class="hidden nav-menu md:flex md:items-center md:justify-between md:w-full">
            <x-dropdown align="top">
                <x-slot name="trigger">Buy</x-slot>
                <x-slot name="content">
                    <div class="border-l ml-4 text-xs">
                        <x-dropdown-link href="#1">Residential</x-dropdown-link>
                        <x-dropdown-link href="#2">Commercial</x-dropdown-link>
                        <x-dropdown-link href="#3">Vacant Land</x-dropdown-link>
                        <x-dropdown-link href="#4">International</x-dropdown-link>
                    </div>
                    <x-dropdown-link href="#4">Map Search</x-dropdown-link>
                    <x-dropdown-link href="/agents-brokers/represent-a-buyer/">Representing a buyer</x-dropdown-link>
                </x-slot>
            </x-dropdown>

            <x-dropdown align="top">
                <x-slot name="trigger">Sell</x-slot>
                <x-slot name="content">
                    <div class="border-l ml-4 text-xs">
                        <x-dropdown-link href="#1">Residential/Land</x-dropdown-link>
                        <x-dropdown-link href="#2">Commercial</x-dropdown-link>
                    </div>
                    <x-dropdown-link href="#3">Financial Institutions</x-dropdown-link>
                    <x-dropdown-link href="#4">Agent & Brokers</x-dropdown-link>
                    <x-dropdown-link href="/sell/seller-bidding-policy/">Selling Bidding Policy</x-dropdown-link>
                </x-slot>
            </x-dropdown>

            <x-dropdown align="top">
                <x-slot name="trigger">
                    About
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link href="/corporate/team/">Team</x-dropdown-link>
                    <x-dropdown-link href="/corporate/licensing">Licensing</x-dropdown-link>
                    <x-dropdown-link href="/corporate/contact-us">Contact Us</x-dropdown-link>
                    <x-dropdown-link href="#4">The Buzz</x-dropdown-link>
                </x-slot>
            </x-dropdown>

            <div x-data="{id: 1}">
                <x-menu-btn @click="$dispatch('open-alert', {id})" class="bg-yellow-300 text-black">Add my property</x-menu-btn>
            </div>
            <div x-data="{id: 2}">
                <x-menu-btn-link href="/login" class="text-white hover:text-yellow-400 hover:border-yellow-400">Get Cashback</x-menu-btn-link>
            </div>
            @guest
            <div x-data="{id: 3, loggedIn: false}" @logged-in.document="loggedIn = true">
                <div x-show="loggedIn == false">
                    <x-menu-btn-link href="/login" class="text-white hover:text-yellow-400 hover:border-yellow-400">Login / Register</x-menu-btn-link>
                </div>
                <div x-show="loggedIn" style="display: none;">
                    <form action="/logout" method="POST">
                    @csrf
                        <button type="submit" class="border font-light px-4 py-2 rounded-md text-base tracking-widest uppercase text-white hover:text-yellow-400 hover:border-yellow-400">Logout</button>
                    </form>
                </div>
            </div>
            @endguest
            @auth
            <div>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="border font-light px-4 py-2 rounded-md text-base tracking-widest uppercase text-white hover:text-yellow-400 hover:border-yellow-400">Logout</button>
                </form>
            </div>
            @endauth
        </div>


        <!-- Mobile Navigation -->
        <div class="-mr-2 flex items-center sm:hidden" x-data="{open: false}">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="bg-opacity-40 bg-white h-12 rounded text-yellow-400 w-12" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div x-show="open">
                <div class="absolute bg-white fixed h-full left-0 mt-14 mx-auto text-blue-400 font-bold text-center w-full">
                    <x-mobile-dropdown align="top">
                        <x-slot name="trigger">
                            Buy
                            <span class="ml-1 font-bold fa fa-angle-down"></span>
                        </x-slot>
                        <x-slot name="content">
                            <div class="border-l ml-4 text-xs">
                                <x-dropdown-link href="#1">Residential</x-dropdown-link>
                                <x-dropdown-link href="#2">Commercial</x-dropdown-link>
                                <x-dropdown-link href="#3">Vacant Land</x-dropdown-link>
                                <x-dropdown-link href="#4">International</x-dropdown-link>
                            </div>
                            <x-dropdown-link href="#4">Map Search</x-dropdown-link>
                            <x-dropdown-link href="#4">Representing a buyer</x-dropdown-link>
                        </x-slot>
                    </x-mobile-dropdown>
                    <x-mobile-dropdown align="top">
                        <x-slot name="trigger">
                            Sell
                            <span class="ml-1 font-bold fa fa-angle-down"></span>
                        </x-slot>
                        <x-slot name="content">
                            <div class="border-l ml-4 text-xs">
                                <x-dropdown-link href="#1">Residential/Land</x-dropdown-link>
                                <x-dropdown-link href="#2">Commercial</x-dropdown-link>
                            </div>
                            <x-dropdown-link href="#3">Financial Institutions</x-dropdown-link>
                            <x-dropdown-link href="#4">Agent & Brokers</x-dropdown-link>
                            <x-dropdown-link href="#4">Selling Bidding Policy</x-dropdown-link>
                        </x-slot>
                    </x-mobile-dropdown>
                    <x-mobile-dropdown align="top">
                        <x-slot name="trigger">
                            About
                            <span class="ml-1 font-bold fa fa-angle-down"></span>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link href="#1">Team</x-dropdown-link>
                            <x-dropdown-link href="#2">Licensing</x-dropdown-link>
                            <x-dropdown-link href="#3">Contact Us</x-dropdown-link>
                            <x-dropdown-link href="#4">The Buzz</x-dropdown-link>
                        </x-slot>
                    </x-mobile-dropdown>

                    <x-mobile-dropdown align="top">
                        <x-slot name="trigger">
                            <x-menu-btn class="bg-yellow-300 text-black">
                                Add my property
                            </x-menu-btn>
                        </x-slot>
                    </x-mobile-dropdown>
                    <x-mobile-dropdown align="top">
                        <x-slot name="trigger">
                            <x-menu-btn class="bg-realty text-white">
                                Get Cashback
                            </x-menu-btn>
                        </x-slot>
                    </x-mobile-dropdown>
                    <x-mobile-dropdown align="top">
                        <x-slot name="trigger">
                            <x-menu-btn class="bg-realty text-white hover:text-yellow-400 hover:border-yellow-400">
                                Login / Register
                            </x-menu-btn>
                        </x-slot>
                    </x-mobile-dropdown>

                </div>
            </div>

        </div>
    </nav>
</div>
