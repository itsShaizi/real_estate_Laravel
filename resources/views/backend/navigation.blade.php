<div class="md:flex flex-col md:flex-row md:min-h-screen w-full md:w-auto">
    <div class="md:flex flex-col md:flex-row md:min-h-screen">
        <div @click.away="open = false" class="flex flex-col w-full md:w-64 text-white bg-gradient-to-r from-realty-dark to-realty-light flex-shrink-0" x-data="{ open: false }">

            <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
              <a href="/" class="text-lg  tracking-widest text-white uppercase rounded-lg  focus:outline-none focus:shadow-outline"><img src="/images/resources/RealtyHive_Horizontal_white_flat-01.png" class="w-full"></a>
              <button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                  <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                  <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
              </button>
            </div>

            <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">

                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm  text-left bg-transparent rounded-lg md:block hover:text-white focus:text-white hover:bg-realty-dark focus:bg-realty-dark focus:outline-none focus:shadow-outline transform hover:translate-x-2 transition-transform ease-in duration-200">
                        <span class="fas fa-home mr-2"></span><span> Real Estate</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <div x-show.transition="open" class="right-0 w-full mt-2 origin-top-right rounded-md shadow-inner">
                        <div class="px-2 py-2 bg-blue-300 rounded-md shadow-inner">
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/projects">Projects</a>
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/listings">Listings</a>
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/auctions">Auctions</a>
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/companies">Companies</a>
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/feeds">Feeds</a>
                        </div>
                    </div>
                </div>

                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm  text-left bg-transparent rounded-lg md:block hover:text-white focus:text-white hover:bg-realty-dark focus:bg-realty-dark focus:outline-none focus:shadow-outline transform hover:translate-x-1 transition-transform ease-in duration-200">
                        <span class="fas fa-users mr-2"></span><span> Users</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <div x-show.transition="open" class="right-0 w-full mt-2 origin-top-right rounded-md shadow-inner">
                        <div class="px-2 py-2 bg-blue-300 rounded-md shadow-inner">
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="{{ route('bk-users') }}">Users</a>
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/roles">Roles</a>
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/permissions">Permissions</a>
                        </div>
                    </div>
                </div>

                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm  text-left bg-transparent rounded-lg md:block hover:text-white focus:text-white hover:bg-realty-dark focus:bg-realty-dark focus:outline-none focus:shadow-outline transform hover:translate-x-1 transition-transform ease-in duration-200">
                        <span class="fas fa-shopping-cart mr-2"></span><span> Programs</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <div x-show.transition="open" class="right-0 w-full mt-2 origin-top-right rounded-md shadow-inner">
                        <div class="px-2 py-2 bg-blue-300 rounded-md shadow-inner">
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/projects">Admin Programs</a>
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/listings">Subscriptions</a>
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/auctions">Payments</a>
                        </div>
                    </div>
                </div>

                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm  text-left bg-transparent rounded-lg md:block hover:text-white focus:text-white hover:bg-realty-dark focus:bg-realty-dark focus:outline-none focus:shadow-outline transform hover:translate-x-1 transition-transform ease-in duration-200">
                        <span class="fas fa-blog mr-2"></span><span> Blog</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <div x-show.transition="open" class="right-0 w-full mt-2 origin-top-right rounded-md shadow-inner">
                        <div class="px-2 py-2 bg-blue-300 rounded-md shadow-inner">
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/projects">Posts</a>
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/listings">Tags</a>
                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 hover:text-white focus:text-white hover:bg-realty transform hover:translate-x-1 transition-transform ease-in duration-200" href="/agent-room/auctions">Comments</a>
                        </div>
                    </div>
                </div>

                <a class="block px-4 py-2 mt-2 text-sm text-white bg-transparent rounded-lg hover:text-white focus:text-white hover:bg-realty-dark focus:bg-realty-dark focus:outline-none focus:shadow-outline transform hover:translate-x-1 transition-transform ease-in duration-200" href="#"><span class="fas fa-money-check-alt mr-2"></span> Offers</a>

                <a class="block px-4 py-2 mt-2 text-sm text-white bg-transparent rounded-lg hover:text-white focus:text-white hover:bg-realty-dark focus:bg-realty-dark focus:outline-none focus:shadow-outline transform hover:translate-x-1 transition-transform ease-in duration-200" href="#"><span class="fas fa-inbox mr-2"></span> Form Submissions</a>

                <a class="block px-4 py-2 mt-2 text-sm text-white bg-realty-dark rounded-lg hover:text-white focus:text-white hover:bg-realty-dark focus:bg-realty-dark focus:outline-none focus:shadow-outline transform hover:translate-x-1 transition-transform ease-in duration-200" href="#"><span class="fas fa-border-all mr-2"></span> Templates</a>

            </nav>
        </div>
    </div>
</div>
