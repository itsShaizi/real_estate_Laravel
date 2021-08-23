<script type="text/x-template" id="step5">
	<div class="step5 h-full">

        <div class="h-3/5 flex flex-col justify-end sm:h-full sm:justify-center">
            <h2 class="text-center text-white font-bold mb-36">How would you like to add your property?</h2>
            <div class="flex flex-col">
                    <div class="cursor-pointer rounded-full border border-white text-white text-2xl mb-5 uppercase text-center sm:w-min sm:mx-auto sm:mb-10 sm:text-3xl">
                        <button class="hover:bg-transparent w-full px-14 py-3 rounded-full sm:px-20 sm:py-5 sm:whitespace-nowrap"
                            v-on:click="skipTo(6)">I have a link on my property</button>
                    </div>
                    <div class="cursor-pointer rounded-full border border-white text-white text-2xl mb-5 uppercase text-center sm:w-min sm:mx-auto sm:mb-10 sm:text-3xl">
                        <button class="hover:bg-transparent w-full px-14 py-3 rounded-full sm:px-20 sm:py-5 sm:whitespace-nowrap"
                            v-on:click="goNext()">I'd like to add my property now</button>
                    </div>
                    <div class="cursor-pointer rounded-full border border-white text-white text-2xl mb-5 uppercase text-center sm:w-min sm:mx-auto sm:mb-10 sm:text-3xl">
                        <button class="hover:bg-transparent w-full px-14 py-3 rounded-full sm:px-20 sm:py-5 sm:whitespace-nowrap"
                            v-on:click="skipTo(7)">I'd like to discuss my property <span v-if="isDesktop">first</span></button>
                    </div>
            </div>
        </div>

    </div><!--/ step5 -->
</script>