<script type="text/x-template" id="step6a">
    <div class="step6a flex-1 flex flex-col overflow-x-auto mb-10">
        <div class="mb-10 step6-paragraph sm:mb-36 sm:mt-10">
            <h2 class="text-white text-center font-bold">Tell us about your property</h2>
        </div> 

        <div class="flex flex-col h-full sm:flex-row sm:items-center sm:justify-center">

                <div v-if="isDesktop" class="sm:flex sm:flex-col sm:items-end sm:items-start sm:text-center">
                    <div class="rh-text-blue sm:bg-white sm:font-bold sm:p-6 sm:rounded-3xl sm:uppercase sm:w-80">
                        <img :src="propertyImage">
                        <div>{{ propertyName }}</div>
                    </div>
                </div>

                <div v-if="!isDesktop" class="w-4/5 py-5 border-t border-b mx-auto text-center">
                    <h2 class="text-white font-bold">{{ propertyName }}</h2>
                </div>

                <div class="flex-1 flex flex-col items-center mt-5 px-10 sm:flex-none sm:items-start" :class="anemitiesClass">
                    <div class="flex justify-center items-center py-2" v-for="(anemity, index) in anemities">
                        <div class="mr-5">
                            <img :src="anemity.img">
                        </div>
                        <div class="w-1/2">
                            <input class="bg-transparent text-2xl text-white placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40 sm:text-3xl" 
                                type="text"
                                v-model="anemity.value" 
                                @input="saveAnemityVal(index, $event.target.value)" 
                                :placeholder="anemity.title">
                        </div>
                    </div>
                </div>
            </div>

    </div><!--/.step6 --> 
</script>