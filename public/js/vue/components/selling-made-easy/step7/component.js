Vue.component('step7-component', {
	template: '#step7',
	props: ['savedFormData', 'userName', 'userPhone', 'userEmail', 'phoneCode', 'countries', 'selectedCountry'],
	data() {
		return {
			countriesPhoneCode: [],
			countryPhoneName: 'US', //default
			// openForm: false,
			pendingDataSend: false,
			uploadingData: 0,
			codeInput: null,
			fileNames: '',
			hiveSmsCodeForm: false,
			formDataFiles: new FormData(), // for Uploading Images
			formDataEmail: new FormData(), // for Email
			formDataPhone: new FormData(), // for Email
			formDataCode: new FormData(), // for Email
			formDataLog: new FormData(), // for Email
			logId: null
		}
	},
	mounted() {
		axios.get('/marketplace/get_countries_phone_code')
            .then(response => {
                this.countriesPhoneCode = response.data;
        });
	},
	computed: {
		enableSend() {
			if (this.savedFormData.providePropertyLink || this.savedFormData.discussPropertyFirst) {
				if (this.userName && this.userEmail && this.userPhone) {
					return true;
				}
				return false;
			} else {
				if (this.userName && this.userEmail && this.userPhone && ! this.pendingDataSend) {
					return true;
				}
				return false;
			}
		}
	},
	methods: {
		submitCode(code) {
			// this.codeInput = code;
			// console.log(this.codeInput + ' - ' + code);
			if (this.codeInput) {
				this.hiveSmsCodeForm = false;
				this.pendingDataSend = true;
				this.uploadingData = 10;

				this.formDataCode.append('phone_code', this.codeInput);
				axios.post('/marketplace/check_code', this.formDataCode )
					.then(response_c => {
						// console.log(response_c.data);
						// logMessages['response_cData'] = response_c.data;
						if (response_c.data.code_status === "success") {

							this.uploadingData = 20;
							// SEND THE DATA UPON SUCCESS
							this.sendData();
							// END SUBMIT FORM

						} else {
							// console.log(response_c.data.code_status);
							this.$toastr.w('There was a problem with your request!');
						}
					});
				} else {
					this.$toastr.w('You should enter the code you received in order to proceed!');
				}
				// console.log('Dont continue....');
		},
		sendData() {
			// 3 Scenarios to send Email:
            // 1. when user has property link - check on the first IF
	        // 2. discuss property first
	        // 3. when user completes the property proces - scheck on the first IF
			
			var formImgValidate = new FormData();
			this.uploadingData = 30;

			this.savedFormData.propertyImagesFiles.forEach(file => {
				this.formDataFiles.append('images[]', file, file.name);
				formImgValidate.append('images[]', file, file.name);
				this.fileNames = this.fileNames + ' ' + file.name;
				console.log('send Data() -> foreach: ' + file.name);
			});

			axios.post('/marketplace/validate_uploaded_images', formImgValidate)
				.then(response_img => {
					console.log('Validate Img():' + response_img.data);
					if (response_img.data.status == 'error') {
						this.$toastr.e('Please upload only images! Error: ' + response_img.data.text);

						this.formDataLog.append('data', this.getDate() + ': ERROR IMG UPLOAD' + response_img.data.text);
						this.updateLog(this.logId);

						return false;
					} else {
						this.$toastr.s('Sending data to be processed...');
						this.uploadingData = 40;
						this.createListing();
					}
			});
		},
		createListing() {
			// INSERT LISTING INTO THE DB
			axios.post('/marketplace/create_listing', this.formDataEmail)
				.then(response_l => {
					// console.log(response_l.data);
					this.$toastr.s('Please wait...');
					this.uploadingData = 50;
					this.formDataFiles.append('listing_id', response_l.data);
					this.formDataEmail.append('listing_id', response_l.data);
					// UPLOAD IMAGES
					console.log('Uploading Images...');
					
					this.formDataLog.append('data', this.getDate() + ': ListingID-> ' + response_l.data + ' #Attempting to upload Images...' + this.fileNames + ' # ' );
					this.updateLog(this.logId);

					this.formDataFiles.forEach(file => {
						console.log(file);
					});

					this.uploadImages();
				});
		},
		uploadImages() {
			axios.post('/marketplace/upload', this.formDataFiles)
				.then(response_u => {
					this.$toastr.s('Almost there...');
					//console.log('Images Uploaded! Sending Email...');
					console.log(response_u.data);
					this.uploadingData = 80;
					this.formDataLog.append('data', this.getDate() + ': Images Uploaded! Attempting Send Email...');
					this.updateLog(this.logId);
					response_u.data.file_names.forEach(file => {
						this.formDataEmail.append('images[]', file);
					});
					
					this.sendEmail();
				});
		},
		sendEmail() {
			// SEND EMAIL TO USER/STAFF
			axios.post('/marketplace/send_email', this.formDataEmail )
				.then(response_s => {
					// this.$toastr.s('Email successfully sent!');
					//console.log(response_s.data + 'Email sent!');
					this.$toastr.s('Thank you for your patience! The process is completed.');

					this.formDataLog.append('data', this.getDate() + ': Email Sent!');
					this.updateLog(this.logId);

					this.uploadingData = 100;
					this.pendingDataSend = false;
					this.$emit('go-next');
				});
		},
		goNext() {
			// After upload of images and response received, submit to send email
			for (const [key, value] of Object.entries(this.savedFormData)) {
            	if (key == 'propertyImagesFiles' || key == 'propertyImages') continue;
	            // console.log(`${key}: ${value}`);
	            if (key == 'country') {
	            	// The listing displays the country in the Backend using shortName
	            	this.formDataEmail.append('country', this.countries[this.selectedCountry].ShortName);
	                this.formDataPhone.append('country', this.countries[this.selectedCountry].ShortName);
	            } else {
	                this.formDataEmail.append(key, JSON.stringify(value));
	                this.formDataPhone.append(key, JSON.stringify(value));
	            }
            }
            
            this.formDataEmail.append('email', this.userEmail);
            this.formDataEmail.append('phoneCode', this.phoneCode);
            this.formDataEmail.append('phoneCodeCountry', this.countryPhoneName);
            this.formDataPhone.append('phoneCode', this.phoneCode);
            this.formDataPhone.append('phoneCodeCountry', this.countryPhoneName);

            this.saveLog();
            this.$toastr.s('Please Wait...');

            // USE SMS VALIDATION ONLY WHEN USER WANTS TO "Add the property details"
            if (this.savedFormData.providePropertyLink || this.savedFormData.discussPropertyFirst) {
				axios.post('/marketplace/send_email', this.formDataEmail )
							.then(response_link => {
								this.$toastr.s('Email successfully sent!');
								// console.log(response_link.data);
							});
				this.$emit('go-next');
			} else {
	            // FIRST CHECK IF THE PHONE NUMBER IS VALID AND SEND A CODE BY SMS
	            axios.post('/marketplace/check_phone', this.formDataPhone )
					.then(response_p => {
						// console.log(response_p.data);
						if (response_p.data.phone_status) {
							if (response_p.data.code_status) {
								// Activate the SMS Check
								this.hiveSmsCodeForm = true;
							} else {
								this.$toastr.e('The Code is invalid!');
							}
						} else {
							this.$toastr.e('Your Phone number is invalid!');
						}
				});
			} // END IF
		},
		saveLog() {
			// SAVE To History LOG all DATA if Phone Validation AND/OR Email Sending FAILS
			axios.post('/marketplace/save_log', this.formDataEmail )
				.then(response_log => {
					this.logId = response_log.data.logId;
					console.log(response_log);
			});
		},
		updateLog(id) {
			axios.post('/marketplace/update_log/' + id, this.formDataLog )
				.then(response_log => {
					console.log(response_log.data);
			});
		},
		getDate() {
			var d = new Date();
			return d.toLocaleString();
		},
		updatePhoneCode(event) {
			phoneCode = event.target.value;
      		this.countryPhoneName = event.target.options[event.target.options.selectedIndex].text;

			this.$emit('update-phone-code', phoneCode);
		}, 
		updateName(val) {
			this.$emit('update-name', val);
		},
		updatePhone(val) {
			this.$emit('update-phone', val);
		},
		updateEmail(val) {
			this.$emit('update-email', val);
		}
	}
})
