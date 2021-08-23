Vue.component('step2-component', {
	template: '#step2',
	props: ['estimated-value-step2', 'listPrice', 'completedData'],
	data() {
		return {}
	},
	methods: {
		goNext( notSure = false ) {
			this.$emit('update-not-sure', notSure);
			this.$emit('go-next');
		},
		updateEstimatedValue( val ) {
			this.$emit('update-estimated-value', val);
		},
		updateListPrice(val) {
			this.$emit('update-list-price', val);
			this.$emit('update-packages-prices');
		},
	},
	computed: {
		listPriceLocal() {
			if (Number.isInteger(parseInt(this.listPrice))) {
				return app.numberSeparators(parseInt(this.listPrice));
			}	 
			return null;
		},
	}
})