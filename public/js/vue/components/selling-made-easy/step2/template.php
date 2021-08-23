<script type="text/x-template" id="step2">
    <div class="step-2 flex flex-col h-full">

        <div class="h-full flex flex-col justify-between items-center container-max-width
                    sm:flex-row sm:flex-wrap sm:justify-center sm:place-content-center sm:mx-auto sm:items-start">
    
            <div class="w-3/4 mt-10 sm:mb-40 sm:w-full">
                <h2 class="text-white text-center sm:font-bold">What is your estimated property value?</h2>
            </div> 
            <div class="flex justify-around text-white text-2xl sm:w-1/2 sm:justify-center sm:pl-20">
                <div class="mr-10 sm:text-4xl">$(USD)</div> 
                <div class="">
                    <input class="w-40 placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40 bg-transparent sm:text-4xl sm:w-60"
                        type="text" 
                        placeholder="x,xxx,xxx"
                        :value="listPriceLocal"
                        @input="updateListPrice($event.target.value)">
                </div>
            </div>
            <div class="w-full flex flex-col sm:w-1/2 sm:pr-40">
                <div class="cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center
                        sm:text-3xl sm:w-1/3 sm:self-end sm:mb-20"
                        :class="{'opacity-50': !completedData}">
                    <button class="hover:bg-transparent w-full px-14 py-3 rounded-full sm:px-1 sm:py-5" 
                        :disabled="!completedData"
                        @click="goNext()">Next</button>
                </div>
                <div class="cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center
                        sm:text-3xl sm:w-3/5 sm:self-end">
                    <button class="hover:bg-transparent w-full px-14 py-3 rounded-full sm:px-1 sm:py-5"
                        @click="goNext()">I'm not sure</button>
                </div>
            </div>

        </div>
    </div>

<!-- 	<div class="step2">

        <div class="step2-paragraph">
            <h1>What is your estimated property value?</h1>
            <div class="step2-section">
                <div class="left-section">
                    <div class="col-xs-5 col-sm-3 dollar">$(USD)</div>
                    <div class="col-xs-5 col-sm-9 row">
                        <input :value="listPriceLocal"
                            v-on:input="updateListPrice($event.target.value)"
                            class="step2-answer" 
                            type="text" 
                            placeholder="x,xxx,xxx">
                    </div>
                </div>
                <div class="right-section">
                    <button 
                        :disabled="!completedData"
                        :class="{'btn-disabled': !completedData}"
                        v-on:click="goNext()">Next</button> <br />
                    <button v-on:click="goNext(true)" class="not-sure-btn">I'm not sure</button>
                </div>
            </div>
        </div>

    </div> --><!--/ step2 -->
</script>