// define a mixin object
var myMixin = {
  created: function () {
    this.hello()
  },
  methods: {
    numberSeparators(num)
    {
        var num_parts = num.toString().split(".");
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return num_parts.join(".");
    },
    hello() {
      console.log('hello from mixin!')
    }
  }
}

app = new Vue({
    mixins: [myMixin],
  	el: '#form-app',
  	data: {
        formLive: false,
        oneMb: 1000000,
        listingPriceDefaultLimit: 1000000,
        isDesktop: !(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)),
        skippedStep: false,
        editStep: false,
        completedAnemitiesData: false,

        // Wouldn't it be a good idea to save all this information in the DB and be editable?
        // There's a lot of data involved and it will be kind of hard to understand the process
        // Ofcourse it would help to have a Map of this MODULE and it's implementation for future referrence...
        propertyTypes: [
            {
                propImage: '/images/selling-made-easy/step1/residential.png',
                propName: 'Residential',
                inactive: false,
                anemitiesClass: 'mt-50',
                anemities: [
                    {
                        img: '/images/selling-made-easy/step6/bed.png',
                        title: 'Bedrooms...*',
                        label: 'Beds',
                        value: null,
                        type: 'int',
                        mandatory: true
                    },
                    {
                        img: '/images/selling-made-easy/step6/bath.png',
                        title: 'Bathrooms...*',
                        label: 'Baths',
                        value: null,
                        type: 'int',
                        mandatory: true
                    },
                    {
                        img: '/images/selling-made-easy/step6/sqft.png',
                        title: 'Square feet...*',
                        label: 'SquareFeet',
                        value: null,
                        type: 'int',
                        mandatory: true
                    },
                    {
                        img: '/images/selling-made-easy/step6/lotsz.png',
                        title: 'Lot Size or Acres*',
                        label: 'LotSize',
                        value: null,
                        type: 'text',
                        mandatory: true
                    },
                    {
                        img: '/images/selling-made-easy/step6/yearblt.png',
                        title: 'Year built...',
                        label: 'YearBuilt',
                        value: null,
                        type: 'int',
                        mandatory: false
                    },
                ],
            },
            {
                propImage: '/images/selling-made-easy/step1/commercial.png',
                propName: 'Commercial',
                inactive: false,
                anemitiesClass: 'mt-110',
                anemities: [
                    {
                        img: '/images/selling-made-easy/step6/sqft.png',
                        title: 'Square feet...*',
                        label: 'SquareFeet',
                        value: null,
                        type: 'int',
                        mandatory: true
                    },
                    {
                        img: '/images/selling-made-easy/step6/lotsz.png',
                        title: 'Lot Size or Acres*',
                        label: 'LotSize',
                        value: null,
                        type: 'text',
                        mandatory: true
                    },
                    {
                        img: '/images/selling-made-easy/step6/yearblt.png',
                        title: 'Year built...',
                        label: 'YearBuilt',
                        value: null,
                        type: 'int',
                        mandatory: false
                    },
                ],
            },
            {
                propImage: '/images/selling-made-easy/step1/multifamily.png',
                propName: 'Multi-Family',
                inactive: false,
                anemitiesClass: '',
                anemities: [
                    {
                        img: '/images/selling-made-easy/step6/bed.png',
                        title: 'Bedrooms (Total) ...',
                        label: 'Beds',
                        value: null,
                        type: 'int',
                        mandatory: false
                    },
                    {
                        img: '/images/selling-made-easy/step6/bath.png',
                        title: 'Bathrooms (Total) ...',
                        label: 'Baths',
                        value: null,
                        type: 'int',
                        mandatory: false
                    },
                    {
                        img: '/images/selling-made-easy/step6/sqft.png',
                        title: 'Square feet...*',
                        label: 'SquareFeet',
                        value: null,
                        type: 'int',
                        mandatory: true
                    },
                    {
                        img: '/images/selling-made-easy/step6/lotsz.png',
                        title: 'Lot Size or Acres*',
                        label: 'LotSize',
                        value: null,
                        type: 'text',
                        mandatory: true
                    },
                    {
                        img: '/images/selling-made-easy/step6/unit.png',
                        title: 'Units...*',
                        label: 'Units',
                        value: null,
                        type: 'int',
                        mandatory: true
                    },
                    {
                        img: '/images/selling-made-easy/step6/yearblt.png',
                        title: 'Year built...',
                        label: 'YearBuilt',
                        value: null,
                        type: 'int',
                        mandatory: false
                    },
                ],
            },
            {
                propImage: '/images/selling-made-easy/step1/land.png',
                propName: 'Land',
                inactive: false,
                anemitiesClass: 'mt-200',
                anemities: [
                    {
                        img: '/images/selling-made-easy/step6/lotsz.png',
                        title: 'Lot Size or Acres*',
                        label: 'LotSize',
                        value: null,
                        type: 'text',
                        mandatory: true
                    }
                ],
            },
        ],

        // Change in Packages Selection: 11 Nov 2020
        // When (userType == Seller || (userType == Agent && agentType == Exclusive) )
        // then: don't show the 3rd packages.payment (Pay at closing if RH produces a buyer %) - this one is replaced with (NE fee - check below)
        // When (userType == Agent && agentType == nonExclusive)
        // then: show 3rd packages.payment as (Pay at closing non-exclusive fee %)
        packagesTitleDesc: [
            {
                title: 'Local',
                description:`
                    <div class="flex relative">
                        <div>3.5x increase in daily average views over normal real estate exposure</div>
                        <div class="absolute bottom-0 right-0">
                            <a href="#" onclick="openModal(true)">
                                <div class="mx-auto w-8 h-8 border border-gray-400 rounded-full justify-center content-center text-center font-bold text-gray-400 leading-none pt-1">
                                    i
                                </div>
                            </a>
                        </div>
                    </div>
                    <div><hr></div>
                    <div>Listed on RealtyHive.com</div>
                    <div><hr></div>
                    <div>Smart Digital Marketing</div>
                    <div><hr></div>
                    <div>Local area focus</div>
                `,
            },
            {
                title: 'Regional',
                description:`
                <div class="mb-5 flex relative">
                    <div>7x increase in daily average views over normal real estate exposure</div>
                    <div class="absolute bottom-0 right-0">
                        <a href="#" onclick="openModal(true)">
                            <div class="mx-auto w-8 h-8 border border-gray-400 rounded-full justify-center content-center text-center font-bold text-gray-400 leading-none pt-1">
                                i
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mb-5"><hr></div>
                <div class="mb-5">Social ad campaign</div>
                <div class="mb-5"><hr></div>
                <div class="mb-5">Regional focus</div>
                <div class="mb-5"><hr></div>
                <div class="mb-5 text-blue-700">+ everything in Local</div>`,
            },
            {
                title: 'International',
                description:`
                <div class="mb-5 flex relative">
                    <div>14x increase in daily average views over normal real estate exposure</div>
                    <div class="absolute bottom-0 right-0">
                        <a href="#" onclick="openModal(true)">
                            <div class="mx-auto w-8 h-8 border border-gray-400 rounded-full justify-center content-center text-center font-bold text-gray-400 leading-none pt-1">
                                i
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mb-5"><hr></div>
                <div class="mb-5">Organic social exposure</div>
                <div class="mb-5"><hr></div>
                <div class="mb-5">3rd party listing sites</div>
                <div class="mb-5"><hr></div>
                <div class="mb-5">International focus</div>
                <div class="mb-5"><hr></div>
                <div class="mb-5 text-blue-700">+ everything in Regional</div>`,
            },
            {
                title: 'Time-Limited Events',
                description:`
                <div class="mb-5 flex relative">
                    <div>28x increase in daily average views over normal real estate exposure</div>
                    <div class="absolute bottom-0 right-0">
                        <a href="#" onclick="openModal(true)">
                            <div class="mx-auto w-8 h-8 border border-gray-400 rounded-full justify-center content-center text-center font-bold text-gray-400 leading-none pt-1">
                                i
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mb-5"><hr></div>
                <div class="mb-5">Time-Limited Events create a sense of urgency and puts your property in a 
                    premier position to attract buyers from all over the globe.</div>
                <div class="mb-5"><hr></div>
                <div class="mb-5 text-blue-700">+ everything in International</div>`,
            }
        ],
        packagesSelection: [
            { // this array of packages is available only for US & residential & multi-family
                packages: [
                    {
                        price: 295,
                        totalInvestment: '$795',
                        tle3Events: true,
                        payment: [
                            { type: 'now', amount: 295 },
                            { type: 'later', amount: '0.25%' },
                            { type: 'closing', amount: '2%' }// Show only for (Agent NE) 
                        ],
                        upgradeTo: {
                            upgradePackageId: 1,
                            upgradeAvailable: true,
                            upgradeLimitedTimeEvents: true,
                            upgradeMarketingExposure: '7x',
                            upgradeText: 'Upgrade to Regional',
                            upgradeTypeTo: [ 
                                { type: 'now', amount: 395 },
                                { type: 'later', amount: '0.5%' },
                                { type: 'closing',amount: '2.5%'}// Show only for (Agent NE)
                            ], 
                            upgradeFinalText: ''
                        }
                    },
                    {
                        price: 395,
                        totalInvestment: '$895',
                        tle3Events: true,
                        payment: [
                            { type: 'now', amount: 395 },
                            { type: 'later', amount: '0.5%' },
                            { type: 'closing',amount: '2.5%'}// Show only for (Agent NE)
                        ],
                        upgradeTo: {
                            upgradePackageId: 2,
                            upgradeAvailable: true,
                            upgradeLimitedTimeEvents: true,
                            upgradeMarketingExposure: '14x',
                            upgradeText: 'Upgrade to International',
                            upgradeTypeTo: [ 
                                { type: 'now', amount: 795 },
                                { type: 'later', amount: '0.75%' },
                                { type: 'closing', amount: '3%'}// Show only for (Agent NE)
                            ],
                            upgradeFinalText: ''
                        }
                    },
                    {
                        price: 795,
                        totalInvestment: '$795',
                        tle3Events: false,
                        payment: [
                            { type: 'now', amount: 795 },
                            { type: 'later', amount: '0.75%' },
                            { type: 'closing', amount: '3%'}// Show only for (Agent NE)
                        ],
                        upgradeTo: {
                            upgradePackageId: 3,
                            upgradeAvailable: true,
                            upgradeLimitedTimeEvents: false,
                            upgradeMarketingExposure: '28x',
                            upgradeText: 'Upgrade to TLE',
                            upgradeTypeTo: [ 
                                { type: 'now', amount: 1295 },
                                { type: 'later', amount: '1%' },
                                { type: false, amount: false}
                            ],
                            upgradeFinalText: `
                                Upgrading to the TLE program will also include featuring your property in multiple 
                                Time-Limited Events - creating a massive sense of urgency and attracting buyers 
                                from all over the globe.
                            `
                        }
                    },
                    {
                        price: 1295,
                        totalInvestment: '$1,295',
                        tle3Events: false,
                        payment: [
                            { type: 'now', amount: 1295 },
                            { type: 'later', amount: '1%' },
                            { type: false, amount: false}
                        ],
                        upgradeTo: {
                            upgradePackageId: false,
                            upgradeAvailable: false,
                            upgradeLimitedTimeEvents: false,
                            upgradeMarketingExposure: '',
                            upgradeText: '',
                            upgradeTypeTo: [ 
                                { type: false, amount: false}
                            ],
                            upgradeFinalText: `
                                Upgrade to... oh, wait. This is the best program, 
                                you already have all the goodies included.
                            `
                        }
                    },
                ]
            },
            { // this array of packages is available only for NON-US & residential & multi-family
                packages: [
                    {
                        price: 295,
                        totalInvestment: '$795',
                        tle3Events: true,
                        payment: [
                            { type: 'now', amount: 295 },
                            { type: false, amount: false },
                            { type: false, amount: false }
                        ],
                        upgradeTo: {
                            upgradePackageId: 1,
                            upgradeAvailable: true,
                            upgradeLimitedTimeEvents: true,
                            upgradeMarketingExposure: '7x',
                            upgradeText: 'Upgrade to Regional',
                            upgradeTypeTo: [ 
                                { type: 'now', amount: 395 },
                                { type: false, amount: false },
                                { type: false, amount: false }
                            ], 
                            upgradeFinalText: ''
                        }
                    },
                    {
                        price: 395,
                        totalInvestment: '$895',
                        tle3Events: true,
                        payment: [
                            { type: 'now', amount: 395 },
                            { type: false, amount: false },
                            { type: false, amount: false}
                        ],
                        upgradeTo: {
                            upgradePackageId: 2,
                            upgradeAvailable: true,
                            upgradeLimitedTimeEvents: true,
                            upgradeMarketingExposure: '14x',
                            upgradeText: 'Upgrade to International',
                            upgradeTypeTo: [ 
                                { type: 'now', amount: 795 },
                                { type: 'later', amount: '0.75%' },// Show only for (Agent NE)
                                { type: 'closing', amount: '3%'}// Show only for (Agent NE)
                            ],
                            upgradeFinalText: ''
                        }
                    },
                    {
                        price: 795,
                        totalInvestment: '$795',
                        tle3Events: false,
                        payment: [
                            { type: 'now', amount: 795 },
                            { type: 'later', amount: '0.75%' },
                            { type: 'closing', amount: '3%'}
                        ],
                        upgradeTo: {
                            upgradePackageId: 3,
                            upgradeAvailable: true,
                            upgradeLimitedTimeEvents: false,
                            upgradeMarketingExposure: '28x',
                            upgradeText: 'Upgrade to TLE',
                            upgradeTypeTo: [ 
                                { type: 'now', amount: 1295 },
                                { type: 'later', amount: '1%' },
                                { type: false, amount: false}
                            ],
                            upgradeFinalText: `
                                Upgrading to the TLE program will also include featuring your property in multiple 
                                Time-Limited Events - creating a massive sense of urgency and attracting buyers 
                                from all over the globe.
                            `
                        }
                    },
                    {
                        price: 1295,
                        totalInvestment: '$1,295',
                        tle3Events: false,
                        payment: [
                            { type: 'now', amount: 1295 },
                            { type: 'later', amount: '1%' },
                            { type: false, amount: false}
                        ],
                        upgradeTo: {
                            upgradePackageId: false,
                            upgradeAvailable: false,
                            upgradeLimitedTimeEvents: false,
                            upgradeMarketingExposure: '',
                            upgradeText: '',
                            upgradeTypeTo: [ 
                                { type: false, amount: false}
                            ],
                            upgradeFinalText: `
                                Upgrade to... oh, wait. This is the best program, 
                                you already have all the goodies included.
                            `
                        }
                    },
                ]
            },
            { // this array of packages is available only for ANYWHERE & commercial & land
                packages: [
                    {
                        price: 995,
                        totalInvestment: '$---',
                        tle3Events: true,
                        payment: [
                            { type: 'now', amount: 995 },
                            { type: 'later', amount: '1%' },
                            { type: 'closing', amount: '3%' }// Show only for (Agent NE)
                        ],
                        upgradeTo: {
                            upgradePackageId: 1,
                            upgradeAvailable: true,
                            upgradeLimitedTimeEvents: true,
                            upgradeMarketingExposure: '7x',
                            upgradeText: 'Upgrade to Regional',
                            upgradeTypeTo: [ 
                                { type: 'now', amount: 1095 },
                                { type: 'later', amount: '1.25%' },
                                { type: 'closing', amount: '3.25%' }// Show only for (Agent NE)
                            ], 
                            upgradeFinalText: ''
                        }
                    },
                    {
                        price: 1095,
                        totalInvestment: '$---',
                        tle3Events: true,
                        payment: [
                            { type: 'now', amount: 1095 },
                            { type: 'later', amount: '1.25%' },
                            { type: 'closing', amount: '3.25%' }// Show only for (Agent NE)
                        ],
                        upgradeTo: {
                            upgradePackageId: 2,
                            upgradeAvailable: true,
                            upgradeLimitedTimeEvents: true,
                            upgradeMarketingExposure: '14x',
                            upgradeText: 'Upgrade to International',
                            upgradeTypeTo: [ 
                                { type: 'now', amount: 1495 },
                                { type: 'later', amount: '1.5%' },
                                { type: 'closing', amount: '3.5%'}// Show only for (Agent NE)
                            ],
                            upgradeFinalText: ''
                        }
                    },
                    {
                        price: 1495,
                        totalInvestment: '$---',
                        tle3Events: false,
                        payment: [
                            { type: 'now', amount: 1495 },
                            { type: 'later', amount: '1.5%' },
                            { type: 'closing', amount: '3.5%'}// Show only for (Agent NE)
                        ],
                        upgradeTo: {
                            upgradePackageId: 3,
                            upgradeAvailable: true,
                            upgradeLimitedTimeEvents: false,
                            upgradeMarketingExposure: '28x',
                            upgradeText: 'Upgrade to TLE',
                            upgradeTypeTo: [ 
                                { type: 'now', amount: 2490 },
                                { type: 'later', amount: '2%' },
                                { type: false, amount: false}
                            ],
                            upgradeFinalText: `
                                Upgrading to the TLE program will also include featuring your property in multiple 
                                Time-Limited Events - creating a massive sense of urgency and attracting buyers 
                                from all over the globe.
                            `
                        }
                    },
                    {
                        price: 2490,
                        totalInvestment: '$---',
                        tle3Events: false,
                        payment: [
                            { type: 'now', amount: 2490 },
                            { type: 'later', amount: '2%' },
                            { type: false, amount: false}
                        ],
                        upgradeTo: {
                            upgradePackageId: false,
                            upgradeAvailable: false,
                            upgradeLimitedTimeEvents: false,
                            upgradeMarketingExposure: '',
                            upgradeText: '',
                            upgradeTypeTo: [ 
                                { type: false, amount: false}
                            ],
                            upgradeFinalText: `
                                Upgrade to... oh, wait. This is the best program, 
                                you already have all the goodies included.
                            `
                        }
                    },
                ]
            }
        ],

        packagesForRegion: [], //default
        savedFormData: {
            userType: null,
            agentType: null,
            propertyUs: false,
            propertyTypeSelected: false,
            propertyType: null,
            estimatedValueStep2: null,
            notSure: false,
            selectedPackage: {
                    title: '',
                    description:``,
                    price: '',
                    payment: [],
                    upgradeTo: {
                        upgradeAvailable: true,
                        upgradeLimitedTimeEvents: true,
                        upgradeMarketingExposure: '',
                        upgradeText: '',
                        upgradeTypeTo: [ 
                            { type: false, amount: false }
                        ],
                        upgradeFinalText: ''
                    }
            },
            packagePrice: 0,
            // upgradeToPackagePrice: 0,
            selectedPayment: [],
            selectedPaymentId: 0, //To match the selection on Payment Type Upgrade
            daysOnMarket: null,
            // Put the followings in an array -> fullAddress
            address: '',
            coordonates: null,
            country: null,
            state: null,
            city: null,
            zip: null,
            //
            propertyLink: null,
            propertyDescription: '',
            propertyImages: [],
            propertyImagesFiles: [],
            propertyVideoUrl: null,
            listPrice: null,
            suggestedPrice: null,
            userName: null,
            userPhone: null,
            userEmail: null,
            phoneCode: 1,
            totalInvestment: 0,
            noThanksFor3Events: true,
            discussPropertyFirst: false,
            providePropertyLink: false,
        },
  		step: 0,
  		step4: 0,
  		step6: 0,
        noThanksFor3Events: true,
        countries: null,
        selectedCountry: 0,
        selectedState: 0,
        states: null
  	},
  	methods: {
        updateUserType(val) {
            this.savedFormData.userType = val;
            if (val == 'seller')
                this.stepUp();
        },
        updateAgentType(val) {
            this.savedFormData.agentType = val;
            this.stepUp();
        },
  		savePropertyUs(val) {
  			this.savedFormData.propertyUs = val;
  		},
        updatePackagesPrices() {
            if (this.savedFormData.listPrice > this.listingPriceDefaultLimit) {
                // console.log(this.packagesForRegion.packages.length);
                for (var i = this.packagesForRegion.packages.length - 1; i >= 0; i--) {
                    this.packagesForRegion.packages[i].upgradePrice = Math.round(this.savedFormData.listPrice / this.listingPriceDefaultLimit * this.packagesForRegion.packages[i].price);
                    this.packagesForRegion.packages[i].upgradeTo.upgradeTypeTo[0].upgradeAmount = Math.round(this.savedFormData.listPrice / this.listingPriceDefaultLimit * this.packagesForRegion.packages[i].upgradeTo.upgradeTypeTo[0].amount);
                // console.log('Calculating...');
                }
            } else {
                // reset
                // console.log('Here');
                this.packagesForRegion = [];
                this.packagesSelectedRegion(); // the values are reactive...
            }
        },
  		stepUp(stepNo = null) { // Refactor or find a better logic?
            // edit Step from Step 6f to Step 4 and when NEXT go back to Step 6f
            if (this.editStep) {
                this.step6 = 6;
                this.editStep = false;
            } else if (stepNo) {
                if (stepNo == 6) { // this is a skip to step6g PropertyLink
                    this.step6 = 8;
                }
                this.step = stepNo;
                this.skippedStep = true;
            } else {
                // Proceed as normal
      			if (this.step == 4) {
      				this.step4++;
      				if (this.step4 > 2) //substep 4
      					this.step++;
      			} else if (this.step == 6) { 
    	  			this.step6++;
    	  			if (this.step6 > 7) //substep 6
      					this.step++;
    	  		} else {
    		  		this.step += 1;
    		  		if (this.step == 4) this.step4++;
    		  		if (this.step == 6) this.step6++;
    		  	}
            }
  		},
  		stepDown() { // Refactor or find a better logic for the navigation between pages...
            this.editStep = false;
            if (this.step == 7 && this.skippedStep) {
                if (this.step6 > 8) { //get back from 7 to 6 when skipped to step6glink
                    this.step--;
                    this.step6 = 8;
                } else {
                    this.step = 5; //get back to Step 5: How would you like to add property
                    this.skippedStep = false;
                }
            } else if (this.step == 6 && this.skippedStep) {
                this.step = 5; //get back to Step 5: How would you like to add property
                this.step6 = 0;
                this.skippedStep = false;
            } else {
                // Proceed as normal
      			if (this.step == 4) {
      				this.step4 -= 1;
      				if (this.step4 < 1)
      					this.step -= 1;
      			} else if (this.step == 6) {
    	  			this.step6 -= 1;
    	  			if (this.step6 < 1)
      					this.step -= 1;
    	  		} else {
    		  		this.step -= 1;
    		  		if (this.step == 4) this.step4 -= 1;
    		  		if (this.step == 6) this.step6 -= 1;
    		  	}
            }
  		},
        goToStep6Edit(subStep6) {
            this.step6 = subStep6;
            this.editStep = true;
        },
        goToStepEdit(step) {
            this.step = step;
            this.step4 = 1;
            this.step6 = 0;
            // this.editStep = true;
        },
        packagesSelectedRegion() {
            if (this.savedFormData.propertyTypeSelected == 0 || this.savedFormData.propertyTypeSelected == 2)
            {
                if ( this.savedFormData.propertyUs == 'yes')
                    this.packagesForRegion = this.packagesSelection[0]; 
                else
                    this.packagesForRegion = this.packagesSelection[1];     
            } else { 
                this.packagesForRegion = this.packagesSelection[2]; 
            }
        },
  		updatePropertySelected(val) {
  			this.savedFormData.propertyTypeSelected = val;
            this.savedFormData.propertyType = this.propertyTypes[val];
            this.packagesSelectedRegion();
  		},
        updatePropertyTypeInactive(id, val) {
            this.propertyTypes[id].inactive = val;
        },
        updatePropertyUS(val) {
            this.savedFormData.propertyUs = val;
            this.packagesSelectedRegion();
        },
        updateNotSure(val) {
            this.savedFormData.notSure = val;
        },
        selectedPackage(package) {
            return this.savedFormData.selectedPackage = package;
        },
        updateEstimatedValue(val) {
            this.savedFormData.listPrice = val.replace(/$|,/gi, '');
        },
        changePaymentAtEnd(payment, paymentId) {
            // if (Number.isInteger(paymentId)) {
                this.savedFormData.selectedPaymentId = paymentId;
            // }
            return this.savedFormData.selectedPayment = payment;
        },
        selectedPayment(payment, paymentId) {
            if (Number.isInteger(paymentId)) {
                this.savedFormData.selectedPaymentId = paymentId;
            }
            this.updateNoThanksFor3Events(true);
            return this.savedFormData.selectedPayment = payment;
        },
        isNonExclAgent() {
             return this.savedFormData.userType == 'agent' && this.savedFormData.agentType == 'nonexclusive';
        },
        selectUpgradePackage(packageId) {
            this.savedFormData.selectedPackage = this.packagesForRegion.packages[packageId];

            // Also Upgrade the Payment that is related to the New Selected Package.
            currentPayment = this.savedFormData.selectedPayment;
            localPayment = this.packagesForRegion.packages[packageId].payment.filter( function(upgradePayment) {
                return upgradePayment.type == currentPayment.type
            }, currentPayment); // this returns Array and we need the Object inside
            console.log(localPayment);
            // Mandatory for Upgrading to Payment type 'closing' for TLE, because this upgrade doesn't actually exist so it will revert to type 'later'
            paymentId = null;
            if (localPayment[0]) {} 
            else if ( this.isNonExclAgent() ) {
                localPayment[0] = this.savedFormData.selectedPackage.payment[0];
                paymentId = 0;
            }
            else {
                localPayment[0] = this.savedFormData.selectedPackage.payment[1];
                paymentId = 1;
            }
            
            this.selectedPayment(localPayment[0], paymentId);
        },
        changeSelectedPaymentId(paymentId){
            this.savedFormData.selectedPaymentId = paymentId;
        },
        updateNoThanksFor3Events(val) {
            this.savedFormData.noThanksFor3Events = val;
            this.noThanksFor3Events = val;
        },
        updateDaysOnMarket(val) {
            this.savedFormData.daysOnMarket = val;
        },
        updateAddress(val) {
            console.log('Updating Address NOW: ' + val);
            this.savedFormData.address = val;
        },
        updateCoordonates(val) {
            this.savedFormData.coordonates = val;
        },
        updateCountry(val) {
            // also update this.selectedCountry to match values => this needs an ID
            this.matchSelectedCountryNameId(val);
            this.updateStatesList(val);
            this.savedFormData.country = val;
        },
        matchSelectedCountryNameId(countryName) {
            if (countryName) {
                for (const [key, value] of Object.entries(this.countries)) {
                    if (value.Name == countryName) this.selectedCountry = key;
                    // console.log(key + '-' + value.Name);
                }
            }
        },
        updateState(val) {
            this.savedFormData.state = val;
        },
        updateCity(val) {
            this.savedFormData.city = val;
        },
        updateZip(val) {
            this.savedFormData.zip = val;
        },
        updateProperty(val) {
            this.savedFormData.aboutProperty = val;
        },
        saveAnemityVal(index, val) {
            this.propertyTypes[this.savedFormData.propertyTypeSelected].anemities[index].value = val;
            this.completedAnemitiesData = this.setCompletedAnemitiesData();
        },
        updatePropertyDescription(val) {
            this.savedFormData.propertyDescription = val;
        },
        getCountryIdByName(name) {
            for (var i = this.countries.length - 1; i >= 0; i--) {
                if (this.countries[i].Name == name)
                    return i;
            }
            // by default USA
            return 0;
        },
        updateStatesList(country) {
            country_id = this.getCountryIdByName(country);
            axios.get('/marketplace/get_states', {params: {selectedCountry: this.countries[country_id].CountryID} })
                .then(response => {
                    this.states = response.data;
                    // if a state already exist, get the ID from this.states for this.selectedState
                    for (var i = this.states.length - 1; i >= 0; i--) {
                        if (this.states[i].Name == this.savedFormData.state)
                            this.selectedState = i;
                    }
            });
        },
        updateSelectedCountry(val) {
            this.selectedCountry = val;
            this.updateCountry(this.countries[this.selectedCountry].Name);
            axios.get('/marketplace/get_states', {params: {selectedCountry: this.countries[val].CountryID} })
                .then(response => {
                    this.states = response.data;
                    this.selectedState = 0; // reset State
                    if(this.states.length > 0) {
                        // this.updateState(this.states[this.selectedState].Name);
                    }
            });
        },
        updateSelectedState(val) {
            this.selectedState = val;
            this.updateState(this.states[this.selectedState].Name);
        },
        updatePropertyImages(files, images) {
                this.savedFormData.propertyImages = images;
                this.savedFormData.propertyImagesFiles = files;
        },
        updateVideoUrl(val) {
            this.savedFormData.propertyVideoUrl = val;
        },       
        uploadPropertyImages() {
            const formData = new FormData();
            this.savedFormData.propertyImagesFiles.forEach(file => {
                formData.append('this.savedFormData.propertyImages[]', file, file.name);
            });
            axios.post('/marketplace/upload', formData)
                .then(response => {
                    this.$toastr.s('Images uploaded successfully');
                    this.savedFormData.propertyImages = [];
                    this.savedFormData.propertyImagesFiles = [];
                });
        },
        updateListPrice(val) {
            this.savedFormData.listPrice = val.replace(/$|,/gi, '');
            this.updatePackagesPrices();
        },
        updateSuggestedPrice(val) {
            this.savedFormData.suggestedPrice = val;//.replace(/$|,/gi, '');
        },
        updatePropertyLink(val) {
            this.savedFormData.propertyLink = val;
        },
        updateUserName(val) {
            this.savedFormData.userName = val;
        },
        updateUserPhone(val) {
            this.savedFormData.userPhone = val;
        },
        updatePhoneCode(val) {
            this.savedFormData.phoneCode = val;
        },
        updateUserEmail(val) {
            this.savedFormData.userEmail = val;
        },

        setCompletedAnemitiesData() {
            var mandatoryFields = 0;
            var completedFields = 0;
            // check no of mandatory fields
            for (var i = this.propertyTypes[this.savedFormData.propertyTypeSelected].anemities.length - 1; i >= 0; i--) {
                var mandatory = this.propertyTypes[this.savedFormData.propertyTypeSelected].anemities[i].mandatory;
                if (mandatory) { mandatoryFields++; }
                // console.log("Mandatory Fields: " + mandatoryFields);
            }

            for (var i = this.propertyTypes[this.savedFormData.propertyTypeSelected].anemities.length - 1; i >= 0; i--) {
                var mandatory = this.propertyTypes[this.savedFormData.propertyTypeSelected].anemities[i].mandatory;
                var value = this.propertyTypes[this.savedFormData.propertyTypeSelected].anemities[i].value;
                var type = this.propertyTypes[this.savedFormData.propertyTypeSelected].anemities[i].type;

                // console.log('A. Mandatory: ' + mandatory + ' Value: ' + value + ' - ' + Number.isInteger(parseInt(value)));
                // all mandatory fields must be completed to proceed next
                // check if is number else set to null
                if (type == 'int' && ! Number.isInteger(parseInt(value))) {
                    this.propertyTypes[this.savedFormData.propertyTypeSelected].anemities[i].value = null;
                }
                if (mandatory && type == 'int' && Number.isInteger(parseInt(value))) {
                    completedFields ++;
                } else if(mandatory && type == 'text' && value) {
                    // this includes mandatory fields that are not integer, but Text type
                    completedFields ++;
                }
            }
            // console.log('B. MandatoryFields: ' + mandatoryFields + ' Completed: ' + completedFields);
            // console.log("Completed Fields: " + completedFields);
            return completedFields >= mandatoryFields;
        },
        setTotalInvestment(val) {
            this.savedFormData.totalInvestment = val;
        },
        discussPropertyFirst(val) {
            this.savedFormData.discussPropertyFirst = val;
        },
        providePropertyLink(val) {
            this.savedFormData.providePropertyLink = val;
        },
        updatePackagesSelectionTitleDesc() {
            for (var i = 0; this.packagesSelection.length > i; i++) {
                // Local
                this.packagesSelection[i].packages[0].title = this.packagesTitleDesc[0].title;
                this.packagesSelection[i].packages[0].description = this.packagesTitleDesc[0].description;
                
                // Regional
                this.packagesSelection[i].packages[1].title = this.packagesTitleDesc[1].title;
                this.packagesSelection[i].packages[1].description = this.packagesTitleDesc[1].description;
                
                // International
                this.packagesSelection[i].packages[2].title = this.packagesTitleDesc[2].title;
                this.packagesSelection[i].packages[2].description = this.packagesTitleDesc[2].description;
                
                // TLE
                this.packagesSelection[i].packages[3].title = this.packagesTitleDesc[3].title;
                this.packagesSelection[i].packages[3].description = this.packagesTitleDesc[3].description;
            }
        },

        // TEST
        setDescription(description) {
            this.description = description;
        },
        setPlace(place) {
            if (!place) return

            this.latLng = {
              lat: place.geometry.location.lat(),
              lng: place.geometry.location.lng(),
            };
        },
  	},
  	computed: {
        // isDesktop() {
        //     // device detection
        //     if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        //         return false;
        //     } else {
        //         return true;
        //     }
        // }, 
        packagePrice() {
            if (this.savedFormData.listPrice > this.listingPriceDefaultLimit) {
                return Math.round(this.savedFormData.listPrice / this.listingPriceDefaultLimit * this.savedFormData.selectedPackage.price);
            } 
            return this.savedFormData.selectedPackage.price;
        },
        totalFilesSize() {
            var totalSize = 0;
            this.savedFormData.propertyImagesFiles.forEach(file => {
                totalSize += file.size;
            });
            return (totalSize/this.oneMb).toPrecision(2);
        },
        completedData() {
            if (this.step == 1) {
                if (this.savedFormData.propertyUs && Number.isInteger(this.savedFormData.propertyTypeSelected)){
                    return true;
                } return false;
            } 

            if (this.step == 2) {
                if( this.savedFormData.listPrice ) {
                    return true;
                }
                return false;
            }

            // LOCATION & DAYS ON MARKET
            if (this.step6 == 1) {
                if( this.savedFormData.daysOnMarket && this.savedFormData.city && this.savedFormData.country && this.savedFormData.zip && this.savedFormData.address ) {
                    return true;
                }
                return false;
            }
            
            // ANEMITIES
            if (this.step6 == 2) {
                return this.completedAnemitiesData;
            }

            // DESCRIPTION
            if (this.step6 == 3) {
                if (this.savedFormData.propertyDescription.length > 10) {
                    return true;
                } 
                return false;
            }

            // IMAGES
            if (this.step6 == 4) {
                console.log('Image: ' + this.savedFormData.propertyImages.length + ' Total Files Size MB: ' + this.totalFilesSize);
                if (this.savedFormData.propertyImages.length > 0 && this.totalFilesSize <= 10)
                    return true;
                return false;
            }

            // LET'S TALK NUMBERS - listPrice must be numeric
            if (this.step6 == 5) {
                if (this.savedFormData.listPrice) 
                    return true;
                return false;
            }

            return true;
        }
  	},
  	mounted() {
        this.updatePackagesSelectionTitleDesc();

        // axios.get('/marketplace/get_countries').
        //     then(response => {
            // returning the data here allows the caller to get it through another .then(...)
            this.countries = []; //response.data;
            this.savedFormData.country = 'Bla bla 2';
            // this.savedFormData.country = this.countries[this.selectedCountry].Name;
            // return response.data;
        // });

        // axios.get('/marketplace/get_states', {params: {selectedCountry: 230} })
        //     .then(response => {
                this.states = []; //response.data;
                this.savedFormData.state = 'Bla bla';
                // this.savedFormData.state = this.states[this.selectedState].Name;
        // });

	    // Inject your class names for animation
	    this.$toastr.defaultClassNames = ["animated", "zoomInUp"];
	    // Change Toast Position
	    this.$toastr.defaultPosition = 'toast-top-center';
	    this.$toastr.defaultTimeout = 10000; // default timeout : 5000
        // Send message to browser screen
	    // this.$toastr.s(
	    //   "This Message From Toastr Plugin\n You can access this plugin : <font color='yellow'>this.$toastr</font>"
	    // );
	  }
});