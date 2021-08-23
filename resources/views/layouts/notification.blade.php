<div x-ref="noti%d" x-data="{ open: true }" x-show="open" x-transition:enter="transition transform duration-600" x-transition:enter-start="opacity-0 scale-40" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"><div class="bg-blue-50 bg-opacity-90 border-t-4 border-yellow-300 rounded-b text-teal-900 px-4 py-3 shadow-md mt-4"><div class="flex justify-between"><div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"></path></svg></div><div><p class="font-bold text-gray-600 pt-1">A New Bid was submitted</p><p class="text-sm">Someone made an offer of <b>%s USD</b> for this Listing.</p></div><a class="cursor-pointer" @click="$refs.noti%d.remove()">x</a></div></div></div>