Vue.component('step6f-component', {
	template: '#step6f',
	props: ['packages', 'selectedPackage', 'selectedPayment', 
	'noThanksEvents', 'listPrice', 'propertyTypeSelected', 'isDesktop'],
	data() {
		return {
			changePaymentNow: true
		}
	},
	computed: {
		totalInvestment() {
			return this.setTotalInvestment();
		},
		paymentBasedSum() {
			// if propertyType = Commercial OR Land - anywhere
			if (this.propertyTypeSelected == 1 || this.propertyTypeSelected == 3) {
				if (this.selectedPayment.type == 'now') {
					return '$995';
				}
				return 0.5; // this is %
			} else {
				if (this.selectedPayment.type == 'now') {
					return '$500';
				}
				return 0.25; // this is %
			}
		},
		totalPercent() {
			return this.setTotalPercent();
		},
		payUpfrontFee() {
			return this.formatNumber(this.getListPrice());
		},
		paymentIsNowAndLaterExists() {
			if (this.selectedPackage.payment[0].type == 'now' && this.selectedPackage.payment[1].type == 'later')
				return true;
			return false;
		},
		closingUpgrade() {
			return this.selectedPackage.payment[1].amount;
		}
	},
	methods: {
		changePaymentType() { // change to 'LATER' if exists or change back to 'NOW'
			if (this.changePaymentNow) {
				this.changePaymentNow = false;
				this.$emit('change-payment-at-end', this.selectedPackage.payment[1], 1);
				this.setTotalInvestment();
			} else {
				this.changePaymentNow = true;
				this.$emit('change-payment-at-end', this.selectedPackage.payment[0], 0);
				this.setTotalPercent();
			}
		},
		setTotalInvestment() {
			if ( ! this.noThanksEvents && this.selectedPackage.tle3Events ) {
				// if propertyType = Commercial OR Land - anywhere
				if (this.propertyTypeSelected == 1 || this.propertyTypeSelected == 3) {
					this.plusEvents = 995;
				} else {
					this.plusEvents = 500;
				}
			} else {
				this.plusEvents = 0;
			}
			totalInv = this.formatNumber(this.getListPrice() + this.plusEvents);
			console.log('Setting Total $$: ' + totalInv);
			console.log(this.selectedPayment.type);
			this.$emit('set-total-investment', totalInv);
			return totalInv;
		}, 
		setTotalPercent() {
			amount = this.selectedPayment.amount.replace('%', '');
			amount = parseFloat(amount);
			if ( ! this.noThanksEvents && this.selectedPackage.tle3Events ) {
				totalPer = this.paymentBasedSum + amount;
			} else {
				totalPer = amount;
			}
			console.log('Setting Total Per: ' + totalPer);
			console.log(this.selectedPayment.type);
			this.$emit('set-total-investment', totalPer);
			return totalPer;
		},
		formatNumber(number) {
			return new Intl.NumberFormat().format(parseInt(number));
		},
		getListPrice() {
			if (this.listPrice > 1000000) {
				return this.selectedPackage.upgradePrice;
			} 
			return this.selectedPackage.price;
		},
		goToStepEdit( step ) {
			// also set to the parent method the stepEdit variable to TRUE
			this.$emit('go-to-step', step);
		},
		goNext() {
			this.$emit('go-next');
		},
	}
})