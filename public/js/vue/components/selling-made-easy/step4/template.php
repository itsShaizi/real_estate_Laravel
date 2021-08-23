<script type="text/x-template" id="step4">
	<div class="flex flex-col h-full">
        <div class="text-center mb-4 sm:mt-10">
            <div>
                <h2 class="text-white font-bold">2. Select your payment plan</h2>
            </div>
            <div v-if="!isDesktop" class="w-4/5 mt-10 py-5 border-t border-b mx-auto">
                <h2 class="text-white font-bold">{{ selectedPackage.title }}</h2>
            </div>
        </div> 
        
        <div class="packages-max-width flex-1 flex overflow-x-auto sm:items-center sm:mx-auto"> 

            <div v-if="isDesktop" class="item flex flex-col min-w-75 mx-5 text-xs font-item sm:w-1/4 sm:h-3/4">
                <div class="flex-1 item-text bg-white p-8 pt-16 rounded-3xl flex flex-col sm:px-14">
                    <div class="mb-10">
                        <h3 class="font-bold">{{ selectedPackage.title }}</h3>
                    </div>
                    <div class="item-description flex-1 flex flex-col xl:leading-loose" 
                        v-html="selectedPackage.description"></div>                         
                </div>
            </div>

            
            <div v-if="selectedPackage.payment[0].type" class="item flex flex-col min-w-75 mr-10 pl-10 pt-10 text-xs font-item 
                sm:w-1/4 sm:pt-0 sm:h-3/4">
                <h2 class="text-white font-bold text-2xl ml-10 mb-5 sm:text-3xl">Pay now:</h2> 
                <div class="flex-1 flex flex-col bg-white mb-10 p-10 rounded-3xl 
                    sm:bg-transparent sm:text-white sm:text-2xl">
                    <div class="h-1/4 mb-5">
                        <p class="font-bold">Pay up-front flat fee:<br />
                            <span class="font-light">${{ payFlatFee }}</span>
                        </p>
                    </div>
                    <div class="content">
                        <p>Simple as that. When your property sells, you won't owe RealtyHive a single dime!</p>
                    </div>
                </div>
                <div class="cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center">
                    <button @click="goNext(0)" class="hover:bg-transparent w-full px-14 py-3 rounded-full sm:px-20 sm:py-5">Select</button>
                </div>
            </div>

            <div v-if="selectedPackage.payment[1].type && !isNonExclAgent" class="item flex flex-col min-w-75 mr-10 pl-10 pt-10 text-xs font-item 
                sm:w-1/4 sm:pt-0 sm:h-3/4 sm:border-l-4 sm:border-double">
                <h2 class="text-white font-bold text-2xl ml-10 mb-5 sm:text-3xl">Pay later:</h2> 
                <div class="flex-1 flex flex-col bg-white mb-10 p-10 rounded-3xl sm:bg-transparent sm:text-white sm:text-2xl">
                    <div class="h-1/4 mb-5">
                        <p class="font-bold">Pay at closing for any<br />
                        buyer ({{ selectedPackage.payment[1].amount }})</p>
                    </div>
                    <div class="content">
                        <p>This is a standard agreement. In the event your property sells to any buyer, this will be the estimate fee you pay to RealtyHive, based on the final purchase price.</p>
                    </div>
                </div>
                <div class="cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center">
                    <button @click="goNext(1)" class="hover:bg-transparent w-full px-14 py-3 rounded-full sm:px-20 sm:py-5">Select</button>
                </div>
            </div>

            <div class="item flex flex-col min-w-75 mr-10 pl-10 pt-10 text-xs font-item 
                sm:w-1/4 sm:pt-0 sm:h-3/4 sm:border-l"
                v-if="selectedPackage.payment[2].type && isNonExclAgent">
                <h2 class="text-white font-bold text-2xl ml-10 mb-5 p-4"></h2>
                <div class="flex-1 flex flex-col bg-white mb-10 p-10 rounded-3xl sm:bg-transparent sm:text-white sm:text-2xl">
                    <div class="h-1/4 mb-5">
                        <p class="font-bold">Pay at closing only if RealtyHive produces a buyer ({{ selectedPackage.payment[2].amount }})</p>
                    </div>
                    <div class="content">
                        <p>With this type of agreement, in the event your property sells, you will only pay this fee if RealtyHive produces the buyer, based on the final purchase price.</p>
                    </div>
                </div>
                <div class="cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center">
                    <button @click="goNext(2)" class="hover:bg-transparent w-full px-14 py-3 rounded-full sm:px-20 sm:py-5">Select</button>
                </div>
            </div>

        </div><!--/ Selected-plan -->

    </div><!--/.step4 -->  	
</script>