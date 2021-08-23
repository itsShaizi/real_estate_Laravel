Vue.component('step6a-component', {
	template: '#step6a',
	props: ['propertyTypeSelected', 'propertyTypes', 'isDesktop'], //Data sent through main instance from Step1->propertyTypes[]
	data() {
		return { }
	},
	methods: {
		saveAnemityVal( index, value) {
			this.$emit('save-anemity-val', index, value);
		}
	},
	computed: {
		propertyImage() {
			if (Number.isInteger(this.propertyTypeSelected)) {
				select = this.propertyTypeSelected;
			} else { select = 0; }
			return this.propertyTypes[select].propImage;
		},
		propertyName() {
			if (Number.isInteger(this.propertyTypeSelected)) {
				select = this.propertyTypeSelected;
			} else { select = 0; }
			return this.propertyTypes[select].propName;
		},
		anemities() {
			if (Number.isInteger(this.propertyTypeSelected)) {
				select = this.propertyTypeSelected;
			} else { select = 0; }
			return this.propertyTypes[select].anemities;
		},
		anemitiesClass() {
			if (Number.isInteger(this.propertyTypeSelected)) {
				select = this.propertyTypeSelected;
			} else { select = 0; }
			return this.propertyTypes[select].anemitiesClass;
		}
	}
})