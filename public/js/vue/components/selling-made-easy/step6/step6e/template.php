<script type="text/x-template" id="step6e">
	<div class="step6e flex flex-col h-full">

        <div class="step6-paragraph mb-5 sm:mt-10">
            <h2 class="text-white text-center font-bold">Your Property in Review</h2>
        </div>

        <div class="flex flex-1 flex-col-reverse justify-around overflow-y-auto py-5 step6-section sm:flex-row sm:justify-center">
            
                <div class="mt-5 sm:mt-0 sm:flex-1 sm:p-10">
                    <div v-if="isDesktop" class="img-big sm:h-1/2 sm:relative">
                        <div class="sm:h-full sm:w-full">
                            <div class="sm:bg-center sm:bg-cover sm:bg-local sm:h-full" :style="{ backgroundImage: 'url(' + images[0] + ')' }"></div>
                        </div>
                        <div class="edit bg-contain sm:bottom-10 sm:right-10 sm:absolute" @click="goToStep6Edit(4)"></div>
                    </div>
                    <div v-if="!isDesktop" 
                        @click="goToStep6Edit(4)" 
                        class="mx-auto mb-5 edit bg-contain"></div>
                    <div class="images-preview flex flex-wrap justify-center overflow-auto h-56 sm:justify-start sm:mt-5">
                        <div 
                            class="img-wrapper" 
                            v-for="(image, index) in images" 
                            v-if="(isDesktop && index != 0) || !isDesktop"
                            :key="index">
                            <img :src="image" :alt="`Image uploader ${index}`">
                        </div>
                    </div>
                </div>
                
                <div class="sm:flex sm:flex-1 sm:flex-col sm:justify-between sm:p-10 sm:text-3xl">

                    <div class="relative sm:leading-loose text-white">
                        <div class="">
                            <p class="font-bold">Address/Title</p>
                            <p>{{ address }}</p>
                            <p>{{ city }}, {{ state }}, {{ zip }}</p>
                            <p>{{ country }}</p>
                        </div>
                        <div @click="goToStep6Edit(1)" 
                            class="absolute top-0 right-0 edit bg-contain"></div>
                    </div>

                    <div class="mt-10 relative sm:leading-loose text-white">
                        <div class="">
                            <p>
                                <span class="font-bold">List Price:</span> ${{ listPriceLocal }}
                            </p>
                            <p v-if="suggestedPriceLocal != null">
                                <span class="font-bold">Suggested Opening Bid:</span> 
                                ${{ suggestedPriceLocal }}
                            </p>
                        </div>
                        <div @click="goToStep6Edit(5)" 
                            class="absolute top-0 right-0 edit bg-contain"></div>
                    </div>

                    <div class="mt-10 amenities relative">
                        <div class="flex flex-wrap sm:flex-nowrap sm:flex-row text-white">
                            <div v-for="(anemity, index) in anemities" 
                                class="flex justify-start items-center w-1/2 mb-5">
                                <div class="mr-5">
                                    <img v-if="anemity.value" :src="anemity.img" class="h-14 sm:h-24"> 
                                </div>
                                <div>
                                    {{ anemity.value }}
                                </div>
                            </div>
                        </div>
                        <div @click="goToStep6Edit(2)" 
                            class="absolute top-0 right-0 edit bg-contain"></div>
                    </div>

                    <div class="mt-5 text-white relative">
                        <div class="">
                            <p>Type: {{ propertyTypes[propertyTypeSelected].propName }}</p>
                        </div>
                        <!-- <div class="col-sm-2 edit" @click="goToStep6Edit(3)"></div> -->
                    </div>

                    <div class="mt-5 text-white relative">
                        <div class="">
                            <p class="desc-scroll">
                                <span class="font-bold">Description: </span>
                                {{ propertyDescription }}
                            </p>
                        </div>
                        <div @click="goToStep6Edit(3)" 
                            class="absolute top-0 right-0 edit bg-contain"></div>
                    </div>
                </div>

        </div>
    </div><!--/.step6e -->  
</script>
