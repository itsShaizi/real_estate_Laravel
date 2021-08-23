Vue.component('step0-component', {
	template: '#step0',
	props: ['userType', 'agentType', 'propertyUs', 'isDesktop'],
	data() {
		return {
			userTypeVal: null,
			agentTypeVal: null
		}
	},
	methods: {
		updateUserType(val) {
			this.userTypeVal = val;
			this.$emit('update-user-type', val);
		},
		updateAgentType(val) {
			this.agentTypeVal = val;
			this.$emit('update-agent-type', val);
		}
	},
	computed: {
		propertyUserType() {
			if( this.userType ) {
				return this.userType;
			}
			return this.userTypeVal;
		},
		propertyAgentType() {
			if( this.agentType ) {
				return this.agentType;
			}
			return this.agentTypeVal;
		}
	}
})