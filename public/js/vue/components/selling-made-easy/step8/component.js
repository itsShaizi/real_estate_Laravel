Vue.component('step8-component', {
	template: '#step8',
	data() {
		return {}
	},
	methods: {
		goNext() {
			this.$emit('go-next');
		},
	}
})