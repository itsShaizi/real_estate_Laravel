Vue.component('step5-component', {
	template: '#step5',
	props: ['isDesktop'],
	data() {
		return {}
	},
	methods: {
		skipTo(stepNo) {
			if( stepNo == 7 ) {
				this.$emit('discuss-property-first', true);
				this.$emit('provide-property-link', false);
			} else {
				this.$emit('discuss-property-first', false);
				this.$emit('provide-property-link', true);
			}
			this.$emit('go-next', stepNo);
		},
		goNext() {
			this.$emit('discuss-property-first', false);
			this.$emit('provide-property-link', false);
			this.$emit('go-next');
		},
	}
})