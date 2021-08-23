<script type="text/x-template" id="step6f">
	<div class="step6f overflow-y-auto flex flex-col h-full">

        <div class="step6-paragraph mb-5 sm:mt-10">
            <h2 class="text-white text-center font-bold">Your Program in Review</h2>
        </div>

        <div class="flex-1 text-xl sm:flex sm:items-center sm:justify-between sm:mx-auto sm:w-2/3"> 

            <div @click="goToStepEdit(4)"
                class="mx-auto mb-10 mt-5 edit bg-contain sm:absolute"></div>
            <div class="mx-auto w-3/4 flex-1 item-text bg-white p-8 pt-16 rounded-3xl flex flex-col sm:flex-none sm:h-2/3 sm:w-1/3 sm:leading-loose">
                <div class="mb-10">
                    <h3 class="font-bold">{{ selectedPackage.title }}</h3>
                </div> 
                <div class="mb-10 item-description flex-1 flex flex-col" v-html="selectedPackage.description"></div>                      
            </div>

            <div class="mt-10 text-white sm:ml-32 sm:w-full">
                    <div class="flex flex-col items-center justify-center sm:items-start sm:leading-loose sm:relative sm:text-2xl">

                        
                        <div v-if="selectedPayment.type == 'now'" class="text-center sm:text-left">
                            <p class="font-bold">Pay up-front flat fee: </p> 
                            <p>${{ payUpfrontFee }}</p>
                        </div>

                        <div v-if="selectedPayment.type == 'later'" class="text-center sm:text-left" >
                            <p class="font-bold">Pay at closing for any buyer </p> 
                            <p>{{ selectedPayment.amount }}</p>
                        </div>

                        <div v-if="selectedPayment.type == 'closing'" class="text-center sm:text-left">
                            <p class="font-bold">
                                Pay at closing only if Realtyhive produces a buyer </p>
                            <p>{{ selectedPayment.amount }}</p>
                        </div>

                        <div v-show="!noThanksEvents" class="w-4/5 mt-10 pb-5 border-b text-center sm:text-left">
                            <p class="font-bold">3 events (6-month program)<br /> 
                                <p>
                                    {{ paymentBasedSum }}
                                    <span v-if="selectedPayment.type != 'now'">%</span>
                                </p>
                            </p>
                        </div>

                        <div v-if="selectedPayment.type == 'now'" 
                            class="mt-10 mb-10 text-3xl font-bold text-center sm:flex sm:justify-between sm:text-5xl sm:text-left">
                            <p>Total Investment<span class="invisible sm:visible">:&nbsp;</span></p> 
                            <p> ${{ totalInvestment }} </p>
                        </div>

                        <div v-if="selectedPayment.type != 'now'" 
                            class="mt-10 mb-10 text-3xl font-bold text-center sm:flex sm:justify-between sm:text-5xl sm:text-left">
                            <p>Total Investment<span class="invisible sm:visible">:&nbsp;</span></p> 
                            <p> {{ totalPercent }}% </p>
                        </div>

                        <div class="w-full cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center sm:invisible">
                            <button @click="goNext()"
                                class="bg-white text-blue-500 w-full px-14 py-3 rounded-full sm:px-20 sm:py-5">
                                Looks good, let's do this!</button>
                        </div>

                        <div class="w-full text-center" 
                            v-show="paymentIsNowAndLaterExists" 
                            v-if="selectedPayment.type=='now'">
                            <div class="w-full cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center">
                                <button @click="changePaymentType"
                                    class="hover:bg-transparent w-full px-14 py-3 rounded-full sm:px-20 sm:py-5">I want to pay at closing instead</button> 
                            </div>
                            <p>{{ closingUpgrade }} of final sale price</p>
                        </div>

                        <div class="w-full text-center" 
                            v-if="selectedPayment.type=='later'">
                            <div class="w-full cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center">
                                <button @click="changePaymentType"
                                    class="hover:bg-transparent w-full px-14 py-3 rounded-full sm:px-20 sm:py-5">I want to pay up-front flat fee instead</button>
                            </div>
                            <p>Pay up-front flat fee: ${{ payUpfrontFee }}</p>
                        </div>

                        <div v-if="isDesktop"
                            @click="goToStepEdit(4)" 
                            class="col-sm-2 edit sm:absolute sm:bg-contain sm:right-0 sm:top-0"></div>
                    </div>
            </div>

        </div><!--/ Selected-plan -->

    </div><!--/.step6f -->  
</script>