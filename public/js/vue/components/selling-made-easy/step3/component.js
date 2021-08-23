Vue.component('step3-component', {
	template: '#step3',
	props: ['packages', 'savedFormData'],
	data() {
		return {
			selectedPackage: []
		}
	},
	computed: {
		
	},
	methods: {
		priceFrom(package) {
			return this.savedFormData.listPrice > 1000000 ? app.numberSeparators(package.upgradePrice) : app.numberSeparators(package.price);
		},
		goNext(packageIndex) {
			this.selectedPackage = this.packages[packageIndex];
			this.$emit('go-next');
			this.$emit('selected-package', this.selectedPackage)
		},
		nonexclusive(packageIndex) {
			// Agent Non Exclusive 
			// 1. Residential + Multi-family & US (exclude Time-Limited Event)
			// 2. Residential + Multi-family & INTERNATIONAL (exclude Local, Regional, Time-Limited Event)
			// 3. Land + Commercial & ANYWHERE (exclude Time-Limited Event)
			if (this.savedFormData.agentType == "nonexclusive" && this.savedFormData.propertyUs == "yes") {
				return true;
			}
			return false;
		}
	},
	mounted() {
		// $('#inline-popups').magnificPopup({
  //         delegate: 'a',
  //         removalDelay: 100, //delay removal by X to allow out-animation
  //         callbacks: {
  //           beforeOpen: function() {
  //              this.st.mainClass = this.st.el.attr('data-effect');
  //           }
  //         },
  //         midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
  //       });
	}
})