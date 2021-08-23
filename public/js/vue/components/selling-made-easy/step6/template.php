<script type="text/x-template" id="step6">
	<div class="step6 flex-1 flex flex-col overflow-x-auto mb-10">

        <div class="mb-5 step6-paragraph sm:mb-20 sm:mt-20">
            <h2 class="text-white text-center font-bold">Tell us about your property</h2>
        </div>

        <div class="flex-1 flex flex-col">
            <div class="py-5 px-5">
                <div>
                    <p class="pb-5 text-2xl text-center text-white sm:font-bold sm:text-3xl sm:text-left">
                        How long has your property been on the market?
                    </p>
                </div>
                <div class="sm:flex sm:my-10">
                    <div class="cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center sm:mr-10 sm:text-3xl">
                        <button class="w-full p-3 rounded-full sm:px-20 sm:py-5 hover:text-blue-500"
                                v-on:click="daysOnMarket(89)" :class="{'bg-white text-blue-500': days == 89}">
                            0-89 days</button>
                    </div>
                    <div class="cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center sm:mr-10 sm:text-3xl">
                        <button class="w-full p-3 rounded-full sm:px-20 sm:py-5 hover:text-blue-500"
                                v-on:click="daysOnMarket(179)" :class="{'bg-white text-blue-500': days == 179}">
                            90-179 days</button>
                    </div>
                    <div class="cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center sm:text-3xl">
                        <button class="w-full p-3 rounded-full sm:px-20 sm:py-5 hover:text-blue-500" 
                                v-on:click="daysOnMarket(180)" :class="{'bg-white text-blue-500': days == 180}">
                            180+ days</button>
                    </div>
                </div>
            </div>
            <div class="border-opacity-40 border-t border-white flex-1 py-5 sm:flex sm:justify-between sm:py-10">
                <div class="text-2xl pb-5 sm:w-1/2 sm:text-3xl">
                    <div class="mb-5 px-10 sm:mb-10 sm:mt-5">
                        <p class="font-bold mb-5 text-center text-white sm:mb-20 sm:text-3xl sm:text-left">Type the address</p>
                        <input class="min-w-full bg-transparent text-white pl-2 placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40"
                            type="text" id="address" :value="address" autocomplete="off" placeholder="Property Address or Title" />
                    </div>
                    <div class="flex flex-col h-20 justify-between mb-5 px-10 sm:flex-row sm:justify-start">
                        <select class="bg-transparent text-white sm:w-1/3 sm:mr-10" 
                            autocomplete="off" @change="updateSelectedCountry($event.target.value)">
                            <option 
                                v-for="(countryItem, index) in countries"
                                :value="index"
                                :selected="countrySelected(countryItem)">
                                {{ countryItem.Name }}
                            </option>
                        </select>
                        <select class="bg-transparent text-white sm:w-1/3 sm:mr-10" 
                            autocomplete="off" @change="updateSelectedState($event.target.value)">
                            <option
                                v-for="(stateItem, index) in states"
                                :value="index"
                                :selected="stateSelected(stateItem)">
                                {{ stateItem.Name }}
                            </option>
                        </select>
                    </div>
                    <div class="flex flex-col h-20 justify-between mb-5 px-10 sm:flex-row sm:justify-start">
                        <input class="pl-1 bg-transparent text-white placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40"
                            autocomplete="off" type="text" :value="city" @input="updateCity($event.target.value)" placeholder="City..." />
                        <input class="pl-1 bg-transparent text-white placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40"
                            autocomplete="off" type="text" :value="zip" @input="updateZip($event.target.value)" placeholder="Zip..." />
                    </div>
                </div>
                <div class="border-opacity-40 border-t border-white h-full pt-5 sm:border-opacity-0 sm:w-1/2">
                    <div class="h-full sm:h-4/6">
                        <p class="font-bold mb-5 text-2xl text-center text-white sm:text-left">or use the map to pin your property </p>
                        <div id="map" class="h-full mb-10 rounded-3xl sm:mb-0"></div>
                    </div>
                </div>
            </div>
        </div>

    </div><!--/.step6 -->  
</script>