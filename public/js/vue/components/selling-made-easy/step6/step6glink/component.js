Vue.component('step6g-component', {
	template: '#step6glink',
	props: ['propertyLink'],
	data() {
		return {}
	},
	computed: {
		linkNotNull() {
			if ( this.propertyLink != null )
				if (this.propertyLink.length > 0)
					return true;
			return false;
		}
	},
	methods: {
		goNext() {
			this.$emit('go-next');
		},
		updatePropertyLink(val) {
			this.$emit('update-property-link', val);
		}
	}
})