Vue.component('step6e-component', {
	template: '#step6e',
	props: ['images', 'files', 'country', 'state', 'city', 'zip', 'noThanksEvents', 'selectedPackage',
			'address', 'propertyTypes', 'propertyTypeSelected', 'propertyDescription', 'listPrice', 'suggestedPrice', 'isDesktop'],
	data() {
		return { }
	},
	computed: {
		listPriceLocal() {
			if( this.listPrice ) {
				return new Intl.NumberFormat().format(parseInt(this.listPrice));
			}	 
			return null;
		},
		suggestedPriceLocal() {
			if ( ((this.selectedPackage.title == 'Local' || this.selectedPackage.title == 'Regional') && ! this.noThanksEvents ) ||
				this.selectedPackage.title == 'Time-Limited Events' ) {
				if( this.suggestedPrice ) {
					return new Intl.NumberFormat().format(parseInt(this.suggestedPrice));
				}	 
			}
			return null;	
		},
		anemities() {
			if (Number.isInteger(this.propertyTypeSelected)) {
				select = this.propertyTypeSelected;
			} else { select = 0; }
			return this.propertyTypes[select].anemities;
		},
	},
	methods: {
		goToStep6Edit( step6 ) {
			// also set to the parent method the stepEdit variable to TRUE
			this.$emit('go-to-sub-step6', step6);
		}
	}
})