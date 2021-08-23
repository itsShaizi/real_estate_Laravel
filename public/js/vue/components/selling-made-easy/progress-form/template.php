<script type="text/x-template" id="progress-form">
<div>
	<div class="flex flex-col items-end">
		<div v-show="checkStep" class="w-full sm:w-72">
			<div class="cursor-pointer rounded-full border border-white text-white font-bold px-14 py-3 text-2xl uppercase text-center
						sm:px-22 sm:py-5 sm:text-3xl"
				:disabled="!completedData"
				:class="{'opacity-50': !completedData}"
				@click="goNext()">Next</div>
		</div>

		<div v-if="isDesktop && step6Final" class="step6-final">
			<button class="bg-white text-blue-500 w-full px-14 py-3 rounded-full sm:px-20 sm:py-5" @click="goNext()">Looks good, let's do this!</button>
		</div>
	</div>

	<div class="absolute z-40 w-full left-0 top-0 mt-14 px-36 
				sm:relative sm:w-96 sm:mx-auto sm:px-1" 
				v-if="step > 0">
		<div class="flex justify-around">
	        <div class="h-4 w-4 bg-white rounded-full"
	        	v-for="index in steps"
	        	:class="{'border-2 border-blue-600 border-opacity-50 bg-opacity-100': step == index, 'bg-opacity-50': step != index}">
	        </div>
	    </div>
	</div>

</div>


</script>