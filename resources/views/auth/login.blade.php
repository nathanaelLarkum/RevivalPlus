<nav x-data="{ open: false }" class="bg-c3 dark:bg-d3 border-b border-gray-200 dark:border-d5" id="main-navigation-bar">
    <!-- Primary Navigation Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" id="main-logo-link">
                        <x-authentication-card-logo />
                    </a>
                </div>
            </div>

            <!-- Hamburger Menu Button -->
            <div class="flex items-center">
                <button @click="open = ! open" id="hamburger-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-c5 dark:text-d5 hover:text-c4 dark:hover:text-d4 hover:bg-ch3 dark:hover:bg-dh3 focus:outline-none focus:bg-ch3 dark:focus:bg-dh3 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Full Screen Menu Modal -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black bg-opacity-80" {{-- Increased opacity for better focus --}}
         @click="open = false"
         x-cloak>
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         x-cloak>
        {{-- UPDATE: Changed rounding to rounded-xl for a softer, more modern look --}}
        <div @click.away="open = false" class="relative bg-c3 dark:bg-d3 rounded-xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto p-8 md:p-12" id="nav-modal-content">
            <!-- Close Button -->
            <button @click="open = false" class="absolute top-4 right-4 text-c5 hover:text-c1 dark:text-d5 dark:hover:text-d1 transition" id="nav-modal-close-button">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                <!-- Left Column: Discover -->
                <div class="md:border-r md:border-gray-200 md:dark:border-d5 md:pr-8">
                    <h2 class="text-3xl font-bold text-c4 dark:text-d4 mb-6" id="nav-modal-discover-title">Discover</h2>
                    <div class="grid grid-cols-2 gap-6" id="nav-modal-discover-grid">
                        <!-- Card: Local Church -->
                        <a href="#" class="group">
                            <img src="https://placehold.co/300x200/2e5d4b/ffffff?text=Local+Church" alt="A local church building" class="rounded-xl shadow-md group-hover:shadow-xl transition-shadow transform group-hover:scale-105">
                            <h4 class="mt-3 font-semibold text-c4 dark:text-d4 group-hover:text-c1 dark:group-hover:text-d1 transition-colors">Local Church</h4>
                        </a>
                        <!-- Card: Meeting Places -->
                        <a href="#" class="group">
                             <img src="https://placehold.co/300x200/384D48/ffffff?text=Meeting+Places" alt="People meeting together" class="rounded-xl shadow-md group-hover:shadow-xl transition-shadow transform group-hover:scale-105">
                            <h4 class="mt-3 font-semibold text-c4 dark:text-d4 group-hover:text-c1 dark:group-hover:text-d1 transition-colors">Meeting Places</h4>
                        </a>
                        <!-- Card: Events -->
                        <a href="#" class="group">
                             <img src="https://placehold.co/300x200/9E9E9E/ffffff?text=Events" alt="A calendar with an event marked" class="rounded-xl shadow-md group-hover:shadow-xl transition-shadow transform group-hover:scale-105">
                            <h4 class="mt-3 font-semibold text-c4 dark:text-d4 group-hover:text-c1 dark:group-hover:text-d1 transition-colors">Events</h4>
                        </a>
                        <!-- Card: Program -->
                        <a href="#" class="group">
                             <img src="https://placehold.co/300x200/2F2F2F/ffffff?text=Program" alt="A booklet outlining a program" class="rounded-xl shadow-md group-hover:shadow-xl transition-shadow transform group-hover:scale-105">
                            <h4 class="mt-3 font-semibold text-c4 dark:text-d4 group-hover:text-c1 dark:group-hover:text-d1 transition-colors">Program</h4>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Learn More -->
                <div class="flex flex-col">
                    <h2 class="text-3xl font-bold text-c4 dark:text-d4 mb-6" id="nav-modal-learn-more-title">Learn More</h2>
                    <div class="space-y-4 flex-grow" id="nav-modal-learn-more-links">
                        {{-- UPDATE: New styles for better contrast and a more polished look. New, more professional emojis. --}}
                        <a href="#" class="flex items-center p-4 bg-gray-100 dark:bg-dh3 hover:bg-ch3 dark:hover:bg-d5 rounded-xl transition group">
                            <span class="text-2xl mr-4">🌟</span>
                            <div>
                                <h4 class="font-bold text-c4 dark:text-d4 group-hover:text-c1 dark:group-hover:text-d1">About Us</h4>
                                <p class="text-sm text-c5 dark:text-d5">Our mission and values.</p>
                            </div>
                        </a>
                         <a href="#" class="flex items-center p-4 bg-gray-100 dark:bg-dh3 hover:bg-ch3 dark:hover:bg-d5 rounded-xl transition group">
                            <span class="text-2xl mr-4">🙌</span>
                            <div>
                                <h4 class="font-bold text-c4 dark:text-d4 group-hover:text-c1 dark:group-hover:text-d1">Join Us</h4>
                                <p class="text-sm text-c5 dark:text-d5">Find your place in our community.</p>
                            </div>
                        </a>
                         <a href="#" class="flex items-center p-4 bg-gray-100 dark:bg-dh3 hover:bg-ch3 dark:hover:bg-d5 rounded-xl transition group">
                            <span class="text-2xl mr-4">🎯</span>
                            <div>
                                <h4 class="font-bold text-c4 dark:text-d4 group-hover:text-c1 dark:group-hover:text-d1">Our Campaigns</h4>
                                <p class="text-sm text-c5 dark:text-d5">See how we're making a difference.</p>
                            </div>
                        </a>
                    </div>
                    <a href="#" class="w-full mt-8 text-center px-6 py-4 bg-c1 hover:bg-ch1 dark:bg-d1 dark:hover:bg-dh1 text-c3 text-lg font-bold rounded-full transition transform hover:scale-105" id="nav-modal-donate-button">
                        <span class="mr-2">❤️</span> Donate
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

