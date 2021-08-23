Vue.component('step6b-component', {
	template: '#step6b',
	props: ['propertyDescription'],
	data() {
		return {}
	},
	methods: {
		onFileSelected(event) {
			console.log(event)
		},
		updatePropertyDescription(val) {
			this.$emit('update-property-description', val);
		}
	}
})