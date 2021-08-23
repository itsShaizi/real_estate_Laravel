Vue.component('step6c-component', {
	template: '#step6c',
	props: ['propertyVideoUrl', 'propertyImages', 'propertyImagesFiles'],
	data() {
		return {
			oneMb: 1000000,
			isDragging: false,
			dragCount: 0,
			files: this.propertyImagesFiles,
			images: this.propertyImages
		}
	},
	computed: {
		totalFilesSize() {
			var totalSize = 0;
			this.files.forEach(file => {
				totalSize += file.size;
			});
			return (totalSize/this.oneMb).toPrecision(2);
		},
	},
	methods: {
		updateVideoUrl(url) {
			this.$emit('update-video-url', url);
		},
		onInputChange(e) {
			console.log(e);
			const files = e.target.files;
			Array.from(files).forEach(file => this.validateImage(file));
		},
		onDragEnter(e) {
			e.preventDefault();
			this.dragCount++;
			this.isDragging = true;
		},
		onDragLeave(e) {
			e.preventDefault();
			this.dragCount--;
			if (this.dragCount <= 0)
				this.isDragging = false;
		},
		onDrop(e) {
			e.preventDefault();
			e.stopPropagation();
			// console.log(e);
			this.isDragging = false;
			const files = e.dataTransfer.files;
			
			Array.from(files).forEach(file => this.validateImage(file));
		},
		addImage(file) {
			console.log(file);
			this.files.push(file);
			
			const img = new Image(),
				reader = new FileReader();
			reader.onload = (e) => this.images.push(e.target.result);
			reader.readAsDataURL(file);

			if ( this.totalFilesSize >= 10 ) {
				this.$toastr.e( 'You have excceded the 10Mb limit for Images upload! Please remove some images in order to continue!');
			}

			this.$emit('update-property-images', this.files, this.images);
		},
		removeImage(id) {
			this.files.splice(id,1);
			this.images.splice(id,1);
			console.log(id);

			this.$emit('update-property-images', this.files, this.images);
		},	
		validateImage(file) {
			var formDataFile = new FormData();
			formDataFile.append('images[]', file, file.name);

			axios.post('/marketplace/validate_uploaded_images', formDataFile)
				.then(response_img => {
					console.log(response_img.data);
					if (response_img.data.status == 'error') {
						// this.$toastr.e('Please upload only images! Error: ' + response_img.data.text);
						this.$toastr.e( file.name + ' is not an image');
						return false;
					} else {
						console.log( file.name + ' Added to list');
						this.addImage(file);
						return true;
					}
			});
		},
		upload() {
			const formData = new FormData();
			this.files.forEach(file => {
				formData.append('images[]', file, file.name);
			});
			axios.post('/test/upload', formData)
				.then(response => {
					this.$toastr.s('Images uploaded successfully');
					this.images = [];
					this.files = [];
				});
		}
	}
})