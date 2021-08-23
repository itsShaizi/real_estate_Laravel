Vue.component('step6d-component', {
	template: '#step6d',
	props: ['listPrice', 'suggestedPrice', 'noThanksEvents', 'daysOnMarket', 'selectedPackage'],
	data() {
		return {}
	},
	methods: {
		updateListPrice(val) {
			this.$emit('update-list-price', val);
		},
		updateSuggestedPrice(val) {
			this.$emit('update-suggested-price', val);
		}
	},
	computed: {
		listPriceLocal() {
			if (Number.isInteger(parseInt(this.listPrice))) {
				return app.numberSeparators(parseInt(this.listPrice));
			}	 
			return null;
		},

		// Suggested Price will only be visible and available as readonly under the following conditions:
		// 1. The iser must select Local or Regional program but with 3 events marked, meaning noThanksFor3Events = false
		// 2. The user must have selected TLE program
		// 		Suggested opening bid determination = % of list price (example list price: $295,000)
		// • If the property has been on the market 0-89 days > 94% of list price => VALUE AKA 89
		// • If the property has been on the market 90-179 days > 90% of list => VALUE AKA 179
		// • If the property has been on the market 180+ days > 78% of list => VALUE AKA 180
		suggestedPriceLocal() {
			suggPrc = parseInt(this.listPrice);
			// if Local Or Regional & noThanksEvents = false OR // if TLE
			if ( ((this.selectedPackage.title == 'Local' || this.selectedPackage.title == 'Regional') && ! this.noThanksEvents ) ||
				this.selectedPackage.title == 'Time-Limited Events' ) {
				
				if (Number.isInteger(suggPrc)) {
					// if (this.daysOnMarket == 89) {
					// 	suggPrc = this.listPrice / 100 * 94;
					// } else if (this.daysOnMarket == 179) {
					// 	suggPrc = this.listPrice / 100 * 90;
					// } else {
					// 	suggPrc = this.listPrice / 100 * 78;
					// }
					suggPrc = this.listPrice / 100 * 80; // Change by Amanda to 80% - universal
					suggPrc = Math.round(suggPrc);
					this.$emit('update-suggested-price', suggPrc);
					return app.numberSeparators(suggPrc);
				}
			}	 
			return null;	
		},
	},
	mounted() {
		// $(".price").inputmask({"mask": "$99,999,999"});
		// $(".price2").inputmask({"mask": "$99,999,999"});
	}
})