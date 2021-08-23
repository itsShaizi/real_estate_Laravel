<script type="text/x-template" id="step6b">
	<div class="step6b flex-1 flex flex-col sm:justify-center">
        <div class="sm:mb-20">
            <h2 class="text-white text-center p-10 font-bold">Let's make your property stand out</h2>
        </div>

        <div class="flex-1 flex justify-center items-center sm:flex-none">
            <div class="w-full sm:text-center">
                <textarea 
                    class="w-full h-40 text-center bg-transparent text-2xl text-white placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40
                            sm:border sm:border-opacity-25 sm:border-white sm:h-96 sm:rounded-3xl sm:w-1/2"
                    placeholder="Your property's description..." 
                    :value="propertyDescription" 
                    @input="updatePropertyDescription($event.target.value)"></textarea>
            </div>
        </div>

    </div><!--/.step6 -->  
</script>