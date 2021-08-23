Vue.component('step1-component', {
	template: '#step1',
	props: ['propertyTypes', 'propertyUs'],
	data() {
		return {
			selectedProperty: null,
			propertyUsVal: null
		}
	},
	methods: {
		updatePropertyUs(val) {
			this.propertyUsVal = val;
			this.$emit('update-property-us', val);
		},
		selectProperty(propertyId) {
			this.selectedProperty = propertyId;
			for( i = this.propertyTypes.length - 1; i >= 0; i-- )
			{
				if (this.selectedProperty == i) {
					this.$emit('update-property-type-inactive', i, false);
					// this.propertyTypes[i].inactive = false;
				}
				else {
					this.$emit('update-property-type-inactive', i, true);
					// this.propertyTypes[i].inactive = true;
				}
			}
			this.$emit('property-type-selected', propertyId);
		},
		image(id) {
			return this.propertyTypes[id].propImage;
		}
	},
	computed: {
		propertyUsBtn() {
			if( this.propertyUs ) {
				return this.propertyUs;
			}
			return this.propertyUsVal;
		}
	}
})