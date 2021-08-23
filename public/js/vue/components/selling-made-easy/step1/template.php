<script type="text/x-template" id="step1">
	<div class="step-1 h-full flex flex-col justify-around sm:justify-center">

		<div class="flex flex-col items-center sm:mb-40">
			<div class="text-center mb-5 sm:mb-20">
				<h2 class="text-white leading-normal sm:font-bold">
					Is your property located in the United States?
				</h2>
			</div>
			<div class="flex justify-center">
				<div class="cursor-pointer rounded-full border border-white text-white font-bold px-14 py-3 mr-10 text-2xl uppercase
							sm:mr-20 sm:px-20 sm:py-5 sm:text-3xl" 
					@click="updatePropertyUs('yes')"
					:class="{'bg-white text-blue-500': propertyUsBtn=='yes'}">YES</div>
				<div class="cursor-pointer rounded-full border border-white text-white font-bold px-14 py-3 text-2xl uppercase
							sm:mr-20 sm:px-20 sm:py-5 sm:text-3xl" 
					@click="updatePropertyUs('no')"
					:class="{'bg-white text-blue-500': propertyUsBtn=='no'}">NO</div>
			</div>
		</div>
		
		<div class="flex flex-col items-center">
			<h2 class="text-white mt-5 mb-10 sm:mb-20 sm:font-bold">What's your property type?</h2>	
			<div class="flex flex-wrap justify-around mb-5 container-max-width">
				<div class="w-52 h-52 p-6 flex flex-col justify-around bg-white rounded-3xl mb-5 items-center sm:w-80 sm:h-80 sm:mx-5" 
					v-for="(property, id) in propertyTypes" :key="id"
					@click="selectProperty(id)"
					:class="{'bg-white bg-opacity-50': property.inactive}">
					<img :src="image(id)">
					<div class="text-blue-500 text-center font-bold uppercase tracking-wider text-lg sm:text-3xl">{{ property.propName }}</div>
				</div>
			</div>
		</div>

	</div><!--/ step1 -->
</script>