<script type="text/x-template" id="step6glink">
	<div class="step2">

        <div class="step2-paragraph">
            <h1>What is the link to your property?</h1>
            <div class="step2-section">
                <div class="left-section">
                    <input 
                        :value="propertyLink"
                        v-on:input="updatePropertyLink($event.target.value)"
                        class="step2-answer" 
                        type="text" 
                        placeholder="Paste the link here...">
                </div>
                <div class="right-section">
                    <button 
                        :disabled="! linkNotNull"
                        :class="{'btn-disabled': ! linkNotNull}"
                        v-on:click="goNext()">Next</button>
                </div>
            </div>
        </div>

    </div><!--/ step2 -->
</script>