<script type="text/x-template" id="step4a">

    <div class="step4a flex flex-col h-full relative overflow-y-auto">

        <div class="text-center mb-5 sm:mt-10">
            <h2 class="text-white font-bold">3. Your upgrade options</h2>
            <div v-if="!isDesktop" class="w-4/5 mt-10 py-5 border-t border-b mx-auto">
                <h2 class="text-white font-bold">{{ selectedPackage.title }}</h2>
            </div>
        </div> 

        <div class="packages-max-width flex-1 flex flex-col overflow-x-auto relative sm:pt-40 sm:mx-auto sm:flex-row">
            
            <div class="item flex flex-col min-w-75 mx-5 text-xs font-item sm:w-1/4 sm:h-3/4">
                <div v-if="isDesktop" class="flex-1 item-text bg-white p-8 pt-16 rounded-3xl flex flex-col sm:px-14">
                    <div class="mb-10">
                        <h3>{{ selectedPackage.title }}</h3>
                    </div>
                    <div class="item-description flex-1 flex flex-col xl:leading-loose" 
                            v-html="selectedPackage.description">
                    </div>               
                </div>
            </div>

            <div class="px-10 py-5 flex justify-between text-white text-xl leading-relaxed items-center sm:absolute sm:bottom-24 sm:text-2xl" 
                v-if="selectedPayment.type == 'now'">
                <div class="sm:mr-20">
                    <p class="payment-type">
                        Pay up-front flat fee: <br /> 
                        <span class="font-slim">
                            ${{ payUpfrontFee }}
                        </span>
                    </p>
                </div>
                <div class="">
                    <img src="/images/selling-made-easy/checked.png">
                </div>
            </div>

            <div class="px-10 py-5 flex justify-between text-white text-xl leading-relaxed items-center sm:absolute sm:bottom-24 sm:text-2xl" 
                v-if="selectedPayment.type == 'later'">
                <div class="sm:mr-20"> 
                    <p class="payment-type">
                        Pay at closing for <br />
                        any buyer
                        <span class="font-slim">{{ selectedPayment.amount }}</span>
                    </p>
                </div>
                <div class="">
                    <img src="/images/selling-made-easy/checked.png">
                </div>
            </div>

            <div class="px-10 py-5 flex justify-between text-white text-xl leading-relaxed items-center sm:absolute sm:bottom-24 sm:text-2xl" 
                v-if="selectedPayment.type == 'closing'">
                <div class="">
                    <p class="payment-type">
                        Pay at closing only if <br /> Realtyhive produces <br /> a buyer
                        <span class="font-slim">{{ selectedPayment.amount }}</span>
                    </p>
                </div>
                <div class="">
                    <img src="/images/selling-made-easy/checked.png">
                </div>
            </div>
            
            <div v-if="isDesktop">
                <div class="absolute bottom-10 w-full text-center text-white font-bold text-3xl sm:text-left sm:pl-10 sm:text-5xl sm:-bottom-0" 
                    v-if="selectedPayment.type == 'now'">
                    <span>Total Investment:</span> 
                    <span> ${{ totalInvestment }} </span>
                </div>
                <div class="absolute bottom-10 w-full text-center text-white font-bold text-3xl sm:text-left sm:pl-10 sm:text-5xl sm:-bottom-0" 
                    v-if="selectedPayment.type != 'now'">
                    <span>Total Investment:</span> 
                    <span> {{ totalPercent }}% </span>
                </div>
            </div>

            <div class="flex-1 flex flex-col justify-start sm:ml-20">
                    
                    <div v-if="selectedPackage.upgradeTo.upgradeAvailable">

                        <div class="flex flex-col bg-white mb-10 px-10 py-5 rounded-3xl sm:bg-transparent sm:flex-row sm:border-b sm:rounded-none sm:mb-10 sm:px-0">
                            <div class="mb-8 mx-auto sm:w-1/2">
                                <p class="text-2xl text-center font-bold leading-relaxed sm:text-left sm:pr-20 sm:text-white sm:text-3xl sm:leading-normal">
                                    You can get 
                                    {{ selectedPackage.upgradeTo.upgradeMarketingExposure }} 
                                    more marketing exposure by upgrading to the Regional Program
                                </p>
                            </div>

                            <div class="right sm:w-1/2">
                                <div class="cursor-pointer rounded-full border border-blue-600 text-blue-500 font-bold text-2xl mb-5 uppercase text-center sm:bg-white sm:text-3xl">
                                    <button class="hover:bg-transparent w-full p-3 rounded-full sm:px-20 sm:py-5"
                                        @click="selectNewPackage(selectedPackage.upgradeTo.upgradePackageId)"
                                        v-text="selectedPackage.upgradeTo.upgradeText">
                                    </button>
                                </div>

                                <div class="text-center text-2xl sm:text-white" v-if="selectedPaymentIdLocal == 0">
                                    <span>from</span> 
                                    ${{ upgradeFrom() }}
                                </div>

                                <div class="text-center text-2xl sm:text-white" v-if="selectedPaymentIdLocal != 0">
                                    <!-- Here goes the extra text for the 'closing' to 'later' on Intl to TLE -->
                                    <span v-html="extraTextFromIntlToTLEDowngradePayment"></span>
                                    <!-- This is the amount $ or % -->
                                    {{ upgradeFromExtra() }}
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col bg-white mb-10 p-10 rounded-3xl sm:bg-transparent sm:px-0"
                            v-show="programSelection" 
                            v-if="selectedPaymentIsClosingOrTLE"> 
                            <div class="mb-5 sm:mb-20">
                                <p class="text-2xl font-bold text-center sm:text-left sm:text-white sm:text-3xl">
                                    Or just add a Time-Limited Event to create a sense of urgency
                                </p>
                                <a href="#" onclick="openModal(true, '#step4-popup')"><div class="info"></div></a>
                            </div>

                            <div class="flex justify-between sm:justify-start">
                                <div class="sm:text-white sm:mr-20">
                                    <p class="upgrade-details">3 events (6-month program)<br /> 
                                        <span>{{ paymentBasedSum }}</span>
                                    </p>    
                                </div>
                                <div class="checkmark-pos">
                                    <label class="container-checkbox">
                                        <input type="checkbox" 
                                            @click="noThanksForUpgrade"
                                            :checked="!noThanksEvents">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div><!--/ Upgrade Limited Time Events -->
                        
                        <div class="UpgradeFinalText notTimeEvents text-white px-10 pb-10" 
                            v-if="!selectedPackage.upgradeTo.upgradeLimitedTimeEvents">
                                {{ selectedPackage.upgradeTo.upgradeFinalText }}
                        </div>
                    </div>

                    <div class="UpgradeFinalText withTimeEvents text-white text-3xl px-10 py-16" 
                        v-if="!selectedPackage.upgradeTo.upgradeAvailable">
                            {{ selectedPackage.upgradeTo.upgradeFinalText }}
                    </div>

                    <div v-if="!isDesktop" class="mb-10">
                        <div class="text-center text-white font-bold text-3xl" v-if="selectedPayment.type == 'now'">
                            <span>Total Investment:</span> 
                            <span> ${{ totalInvestment }} </span>
                        </div>
                        <div class="text-center text-white font-bold text-3xl" v-if="selectedPayment.type != 'now'">
                            <span>Total Investment:</span> 
                            <span> {{ totalPercent }}% </span>
                        </div>
                    </div>

            </div>

        </div><!--/ Selected-plan -->

    </div><!--/.step4a -->  
</script>