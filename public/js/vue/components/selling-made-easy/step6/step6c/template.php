<script type="text/x-template" id="step6c">
	<div class="step6c flex-1 flex flex-col">

        <div class="step6-paragraph mb-5 sm:mb-10 sm:mt-36">
            <h2 class="text-white text-center font-bold">Let's make your property <i>really</i> stand out</h2>
        </div>

        <div class="flex-1 flex flex-col-reverse justify-around items-center sm:flex-col sm:justify-center">
            <div class="sm:w-2/3 w-full">
                <div class="text-2xl text-center font-bold text-white uppercase mb-5">Upload your photos and videos</div>
                <div class="bg-opacity-20 bg-white pb-5 rounded-3xl sm:border-2 sm:border-dashed"
                    @dragenter="onDragEnter"
                    @dragleave="onDragLeave"
                    @dragover.prevent
                    @drop="onDrop"
                    :class="{ dragging: isDragging }">
                    
                    <div class="flex justify-between text-white p-5 sm:bg-blue-500 sm:bg-opacity-50 sm:rounded-t-3xl" v-show="images.length">
                        <label for="file" class="sm:border sm:p-5 sm:rounded-full sm:text-3xl sm:cursor-pointer">Select other files</label>
                        <!-- <button @click="upload">Upload</button> -->
                        <p class="sm:font-bold sm:text-3xl">Total: {{ totalFilesSize }} Mb</p>
                    </div>

                    <div v-show="!images.length" class="sm:flex sm:flex-col">
                        <div class="text-center">
                            <label for="file">
                                <i class="fa upload-cloud"></i>
                            </label>
                        </div>
                        <div class="text-center text-white text-xl sm:text-3xl">
                            <label for="file">
                                Choose files or drag here<br />
                                <span style="font-size: 14px">Size limit: 10MB</span>
                            </label>
                            <input class="opacity-0" type="file" id="file" @change="onInputChange" multiple>
                        </div>
                    </div>

                    <div class="flex flex-wrap h-96 justify-center overflow-auto sm:flex-none" v-show="images.length">
                        <div class="img-wrapper" v-for="(image, index) in images" :key="index">
                            <img :src="image" :alt="`Image uploader ${index}`">
                            <div class="ml-2 mb-2 text-2xl">
                                <span class="fa fa-trash-o trash" 
                                    @click="removeImage(index)">
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="video-link w-full sm:mt-10 sm:w-1/2">
                <input class="h-20 min-w-full bg-transparent text-2xl text-white pl-2 placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40 pac-target-input sm:text-center"
                    type="text" :value="propertyVideoUrl"
                    v-on:input="updateVideoUrl($event.target.value)"
                    placeholder="Add your property's video URL (YouTube, Vimeo, etc.)...">
            </div>

        </div>

    </div><!--/.step6 -->  
</script>