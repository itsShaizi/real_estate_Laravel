<script type="text/x-template" id="step7">
	<div class="step7 flex flex-col justify-between h-full">

        <div class="step7-paragraph px-10 sm:mt-20">
            <h2 class="text-white text-center font-bold">How can we get in touch with you?</h2>
        </div>

        <div class="h-2/5 flex flex-col justify-around sm:items-start sm:mx-auto sm:w-1/2">
            <div class="text-center sm:px-10 sm:text-left sm:w-full">
                <input 
                :value="userName"
                class="bg-transparent text-3xl text-white placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40 text-center w-full sm:text-left" 
                type="text" 
                v-on:input="updateName($event.target.value)"
                placeholder="Your name...">
            </div>
            <div class="px-10 flex justify-center">
                <select @change="updatePhoneCode($event)"
                    class="bg-transparent text-3xl text-white placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40">
                    <option 
                        v-for="(countryPhoneCode, countryName) in countriesPhoneCode"
                        :value="countryPhoneCode">
                        {{ countryName }}
                    </option>
                </select>
                <input type="text" class="bg-transparent text-3xl text-white placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40 w-20" :value="phoneCode" readonly="true" />
                <input 
                    :value="userPhone"
                	class="bg-transparent text-3xl text-white placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40"
                	type="text" 
                    v-on:input="updatePhone($event.target.value)"
                	placeholder="Your mobile number...">
                <input type="hidden" id="CountryCode" name="CountryCode" >
                <input type="hidden" id="CountryCodeNum" name="CountryCodeNum">
            </div>
            <div class="text-center sm:px-10 sm:text-left sm:w-full">
                <input 
                    :value="userEmail"
                    class="bg-transparent text-3xl text-white placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40 text-center w-full sm:text-left"
                    type="text" 
                    v-on:input="updateEmail($event.target.value)"
                    placeholder="Your email...">
            </div>
        </div>
        <div class="w-full flex flex-col items-center sm:items-end sm:mb-20 sm:mx-auto sm:w-1/2">
            <div class="w-full cursor-pointer rounded-full border border-white text-white font-bold text-2xl mb-5 uppercase text-center sm:w-80">
                <button class="bg-white text-blue-500 w-full px-14 py-3 rounded-full sm:px-20 sm:py-5"
                    v-on:click="goNext()" 
                    :disabled="!enableSend || hiveSmsCodeForm"
                    :class="{'btn-disabled': !enableSend || hiveSmsCodeForm}">Send</button>
                    
            </div>
            <div class="uploading-data text-white" v-if="uploadingData > 0">Uploading Data: {{ uploadingData }}%</div>
        </div>

        <div class="smsCodeLayer" v-if="hiveSmsCodeForm">
            <div class="flex flex-col h-full justify-center text-center">
                <h3 class="smsCodeHeaderTxt">We just sent you a code via sms. <br /> Please enter the code.</h3>
                <input class="white-input text-center" v-model="codeInput"><br />
                <button class="w-1/2 bg-white text-blue-500 px-14 py-3 rounded-full mx-auto mb-5 sm:w-1/4" @click="submitCode(codeInput)">OK</button>
                <button class="w-1/2 bg-blue-500 text-white px-14 py-3 rounded-full mx-auto mb-5 sm:w-1/4" @click="hiveSmsCodeForm = false">Cancel</button>
            </div>
        </div>

    </div>

</script>