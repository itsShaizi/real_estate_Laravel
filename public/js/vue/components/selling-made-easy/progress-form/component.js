Vue.component('progress-form-component', {
	template: '#progress-form',
	props: ['step', 'step4', 'step6', 'completedData', 'isDesktop'],
	data() {
		return {
			steps: [1,2,3,4,5,6,7,8]
		}
	},
	computed: {
		checkStep()
  		{
  			console.log(this.step + 'Progress');
  			if (this.step == 0 || this.step == 2 || this.step == 3 || 
  				this.step4 == 1 || this.step == 5 || 
  				this.step6 == 7 || this.step6 == 8 || this.step > 6)
  				return false;
  			return true;
  		},
  		step6Final() {
  			if (this.step6 == 7)
  				return true;
  			return false;
  		}
	},
	methods: {
		goNext() {
			if( this.completedData )
				this.$emit('go-next');
		},
	}
})