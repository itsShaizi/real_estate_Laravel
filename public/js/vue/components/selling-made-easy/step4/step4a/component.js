Vue.component('step4a-component', {
	template: '#step4a',
	props: ['packages', 'selectedPackage', 'selectedPayment', 
			'selectedPaymentId', 'noThanksEvents', 'listPrice',
			'propertyTypeSelected', 'savedFormData', 'isDesktop'],
	data() {
		return { 
			// noThanks: this.noThanksEvents,
			plusEvents: 0
		}
	},
	methods: {
		isNonExclAgent() {
			 return this.savedFormData.userType == 'agent' && this.savedFormData.agentType == 'nonexclusive';
		},
		upgradeFrom() {
			return this.savedFormData.listPrice > 1000000 ? 
					app.numberSeparators(this.selectedPackage.upgradeTo.upgradeTypeTo[0].upgradeAmount) : 
					app.numberSeparators(this.selectedPackage.upgradeTo.upgradeTypeTo[0].amount);
		},
		upgradeFromExtra() {
			// This should return the Type of Payment to Upgrade for the current Selected Package
			// But if "closing" is not available (this is for NonExclusiveAgent), then it should show an option for the "now" type of payment to be selected

			return this.selectedPackage.upgradeTo.upgradeTypeTo[this.selectedPaymentId].amount ? 
					this.selectedPackage.upgradeTo.upgradeTypeTo[this.selectedPaymentId].amount : 
		            this.selectedPackage.upgradeTo.upgradeTypeTo[this.selectedPaymentId-1].amount;
		},
		goNext() {
			// this.noThanks = true;
			this.$emit('no-thanks-for-3-events', true);
			this.$emit('go-next');
		},
		noThanksForUpgrade() {
			if( this.noThanksEvents ) {
				// this.noThanks = false;
				this.$emit('no-thanks-for-3-events', false);
			} else {
				// this.noThanks = true;
				this.$emit('no-thanks-for-3-events', true);
			}
		},
		selectNewPackage(packageId) {
			if( this.isNonExclAgent() ) {
				if( ! this.selectedPackage.upgradeTo.upgradeTypeTo[this.selectedPaymentId].amount )
				{
					this.$emit('change-selected-payment-id', 0);
				}
			}
			this.$emit('select-upgrade-package', packageId);
		},
		formatNumber(number) {
			return app.numberSeparators(parseInt(number));
		},
		getListPrice() {
			if (this.listPrice > 1000000) {
				return Math.round(this.listPrice / 1000000 * this.selectedPackage.price);
			} 
			return this.selectedPackage.price;
		}
	},
	computed: {
		selectedPaymentIdLocal() {
			if( this.isNonExclAgent() ) {
				if( ! this.selectedPackage.upgradeTo.upgradeTypeTo[this.selectedPaymentId].amount )
				{
					return 0;
				}
			}
			return this.selectedPaymentId;
		},
		extraTextFromIntlToTLEDowngradePayment() {
			if ( ! this.selectedPackage.upgradeTo.upgradeTypeTo[this.selectedPaymentId].amount)
                return "Pay at closing for any <br /> buyer";
		},
		selectedPaymentIsClosingOrTLE() {
			if (! this.selectedPackage.upgradeTo.upgradeLimitedTimeEvents || this.selectedPayment.type == 'closing')
				return false; 
			return true;
		},
		totalInvestment() {
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
			this.$emit('set-total-investment', totalInv);
			return totalInv;
		},
		payUpfrontFee() {
			return this.formatNumber(this.getListPrice());
		},
		programSelection() {
			return true;
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
			amount = this.selectedPayment.amount.replace('%', '');
			amount = parseFloat(amount);
			if ( ! this.noThanksEvents && this.selectedPackage.tle3Events ) {
				totalPer = this.paymentBasedSum + amount;
			} else {
				totalPer = amount;
			}
			this.$emit('set-total-investment', totalPer);
			return totalPer;
		},
	},
	mounted() {
	}
})