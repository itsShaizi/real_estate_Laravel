Vue.component('step4-component', {
	template: '#step4',
	props: ['selectedPackage', 'savedFormData', 'isDesktop'],
	data() {
		return {
			selectedPayment: []
		}
	},
	computed: {
		payFlatFee() {
			return this.savedFormData.listPrice > 1000000 ? app.numberSeparators(this.selectedPackage.upgradePrice) : app.numberSeparators(this.selectedPackage.price)
		},
		isNonExclAgent() {
			 return this.savedFormData.userType == 'agent' && this.savedFormData.agentType == 'nonexclusive';
		}
	},
	methods: {
		goNext(selectedPaymentId) {
			this.selectedPayment = this.selectedPackage.payment[selectedPaymentId];
			this.$emit('go-next');
			this.$emit('selected-payment', this.selectedPayment, selectedPaymentId);
		},
	},
	mounted() {
	}
})