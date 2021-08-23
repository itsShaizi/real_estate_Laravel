<script type="text/x-template" id="step3">
	<div class="step-3 flex flex-col h-full">

        <div class="flex flex-col items-center sm:mb-10 sm:mt-10">
            <div class="mb-2">
                <h2 class="text-white font-bold">Now, the fun stuff:</h2>
            </div> 
            <div class="mb-4">
                <h2 class="text-white font-bold">1. Your marketing package</h2>
            </div>
        </div> 

        <div class="packages-max-width flex-1 flex overflow-x-auto lg:overflow-hidden sm:mx-auto sm:justify-around">
            
                <div class="item flex flex-col min-w-75 mx-5 text-xs font-item sm:w-1/4" 
                    v-for="(package, index) in packages" :key="index">
                    <div class="flex-1 item-text bg-white p-8 pt-16 rounded-3xl flex flex-col sm:px-14">
                        <div class="mb-10">
                            <h3 class="font-bold">{{ package.title }}</h3>
                        </div> 
                        <div class="item-description flex-1 flex flex-col xl:leading-loose" v-html="package.description"></div>      
                    </div>
                    <div class="item-price flex flex-col justify-center items-center mt-7 text-center text-white opacity-70 
                        sm:my-10 sm:text-3xl sm:opacity-100 sm:font-light xl:leading-normal">
                        <div>from ${{ priceFrom(package) }}</div>
                        <div v-if="package.payment[1].type"> or pay at closing </div>
                        <div v-else> <br /></div>
                    </div>
                    <div class="item-btn mt-4 mx-auto w-full sm:mt-0">
                        <div class="cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center">
                            <button 
                                class="hover:bg-transparent w-full px-14 py-3 rounded-full sm:px-20 sm:py-5 sm:text-3xl"
                                @click="goNext(index)">
                                Get started</button>
                        </div>
                    </div>
                </div>

        </div>

    </div><!--/.step3 -->	
</script>