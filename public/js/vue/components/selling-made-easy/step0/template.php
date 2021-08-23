<script type="text/x-template" id="step0">
	<div class="step-0 flex flex-col h-full">

		<div class="flex flex-col items-center justify-center content-center h-4/5">

			<div>
				<div>
					<h1 class="text-3xl text-white mt-10 mb-10 text-center sm:text-5xl sm:mb-20">
						I'm a...
					</h1>
				</div>
				<div class="flex justify-between">
					<div class="cursor-pointer rounded-full border border-white text-white font-bold px-14 py-3 mr-10 text-2xl 
							sm:mr-20 sm:px-20 sm:py-5 sm:text-3xl" 
						@click="updateUserType('seller')"
						:class="{'bg-white text-blue-500': userType=='seller'}">
						Seller</div>
					<div class="cursor-pointer rounded-full border border-white text-white font-bold px-14 py-3 text-2xl 
							sm:px-20 sm:py-5 sm:text-3xl" 	
						@click="updateUserType('agent')"
						:class="{'bg-white text-blue-500': userType=='agent'}">
						Agent</div>
				</div>
			</div>

			<div v-if="userType=='agent'" class="mt-20">
				<div>
					<h2 class="text-2xl text-white mt-10 mb-10 text-center sm:text-5xl sm:mb-20">
						What type of agreement do you have?
					</h2>
				</div>
				<div class="flex justify-between">
					<div class="cursor-pointer rounded-full border border-white text-white font-bold px-12 py-3 mr-10 text-xl 
							sm:mr-20 sm:px-20 sm:py-5 sm:text-3xl"
						@click="updateAgentType('exclusive')"
						:class="{'bg-white text-blue-500': agentType=='exclusive'}">
						Exclusive</div>
					<div class="cursor-pointer rounded-full border border-white text-white font-bold px-12 py-3 text-xl 
							sm:px-20 sm:py-5 sm:text-3xl"
						@click="updateAgentType('nonexclusive')"
						:class="{'bg-white text-blue-500': agentType=='nonexclusive'}">
						Non-Exclusive</div>
				</div>
			</div>

		</div>

	</div><!--/ step0 -->
</script>