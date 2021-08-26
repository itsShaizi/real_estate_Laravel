    var full = window.location.host;
    var parts = full.split('.');
    var sub = parts[0];
    // if(sub !== 'www' && sub !== 'realtyhive') {
        const indexName = 'rh-rewrite';
    // } else {
        // const indexName = 'listings';
    // }

    const number_format = num => String(num).replace(/(?<!\..*)(\d)(?=(?:\d{3})+(?:\.|$))/g, '$1,');

    const search = instantsearch({
      indexName,
      searchClient: algoliasearch('0UHNAUUZ8H', 'ea596a8ff8d8b5d34099cccb75e3b69d'),
      //routing: true,
      routing: {
        //router: instantsearch.routers.history(),
        stateMapping: {
            stateToRoute(uiState) {
                console.log('indexName', indexName);
                const indexUiState = uiState[indexName];
                console.log('uiState', indexUiState);
                return {
                    q: indexUiState.query,
                    state: indexUiState.menu && indexUiState.menu.state,
                    country: indexUiState.menu && indexUiState.menu.country,
                    property_type: indexUiState.menu && indexUiState.menu.property_type,
                    listing_type: indexUiState.menu && indexUiState.menu.listing_type,
                    beds: indexUiState.numericMenu && indexUiState.numericMenu.beds,
                    baths: indexUiState.numericMenu && indexUiState.numericMenu.baths,
                    price: indexUiState.range && indexUiState.range.list_price,
                    property_size: indexUiState.range && indexUiState.range.property_size,
                    lot_size: indexUiState.range && indexUiState.range.lot_size,
                    page: indexUiState.page,
                }
            },
            routeToState(routeState) {
                return {
                    [indexName]: {
                        query: routeState.q,
                        menu: {
                          state: routeState.state,
                          country: routeState.country,
                          property_type: routeState.type,
                          listing_type: routeState.listing_type,
                        },
                        numericMenu: {
                          beds: routeState.beds,
                          baths: routeState.baths,
                        },
                        range: {
                            list_price: routeState.price,
                            property_size: routeState.property_size,
                            lot_size: routeState.lot_size,
                        },
                        page: routeState.page,
                    },
                }
            },
        }
      }
    });


    search.addWidgets([
        instantsearch.widgets.searchBox({
            container: '#searchbox',
            placeholder: 'Enter an Address, City, State, Zip, MLS number or ID number',
            showReset: false,
            showSubmit: false,
            cssClasses: {
                input: [ 'text-black', 'px-5', 'py-2', 'rounded-full', 'w-full', 'border-2', 'border-blue-300', 'focus:border-blue-400', 'ring-transparent' ],
                form: 'px-8',
                resetIcon: [ 'w-5', 'h-5', 'text-blue-400', 'fill-current', 'text-teal-500' ]
            }
        }),
        instantsearch.widgets.hits({
            container: '#hits',
            templates: {
                item: document.getElementById('hits').innerHTML,
                empty: `<div class="border-l border-r border-t flex text-center mx-auto my-10 rounded-2xl shadow-xl w-4/5 p-10">
                            <p>We couldn't find any results matching your search criteria: <em class="bg-yellow-400">"{{query}}"</em>. Please update your search or check back later. We are adding new properties daily!<br />Or, check out some of our event properties, below!<br /></p>
                            <a href="/advanced-search/sortBy/"+index_name+"-ending-soonest/ListingType/Auction/"><button>Upcoming Auction Properties</button></a>
                        </div>`
            },
        }),
        instantsearch.widgets.pagination({
            container: '#pagination',
            cssClasses: {
                list: 'w-full',
                item: ['px-2', 'm-2', 'rounded-full', 'float-left'],
                selectedItem: ['bg-blue-rh' , 'text-white']
            },
        }),
        instantsearch.widgets.stats({
            container: '#stats',
        }),
        instantsearch.widgets.geoSearch({
            container: '#map',
            googleReference: window.google,
            enableRefineControl: true,
            mapOptions: {
                zoomControl: false,
            },
            customHTMLMarker: {
              createOption: function(hit) {
                return {
                  title: hit.title,
                };
              },
              events: {
                click({event, item, marker, map})
                {
                    var el = document.getElementById(item.objectID);
                    var headerOffset = 220;
                    var elementPosition = el.offsetTop;
                    if(elementPosition !== headerOffset) {
                        var offsetPosition = elementPosition - headerOffset;
                        document.getElementById('listings-list').scrollTo({
                             top: offsetPosition,
                             behavior: "smooth"
                        });
                    }

                    el.classList.add('border-blue-400', 'border-4');
                    setTimeout(function() {
                        el.classList.remove('border-blue-400', 'border-4');
                    }, 2000, el);

                    //console.log(item, marker);
                },
                mouseover({event, item, marker, map}) {
                    //console.log(item.title);
                }
              }
            },
            templates: {
                redo: '<button class="bg-blue-rh p-4">Redo search here</button>',
                reset: '<button class="bg-red-rh p-4">Clear the map refinement</button>',
                HTMLMarker: `<div x-data="{show: false}" id="marker-{{objectID}}">
                                <div class="w-72 absolute bg-white shadow-xl p-0 rounded-2xl -top-80 -left-30" x-show="show">
                                    <div class="w-24 h-20 bg-cover bg-no-repeat float-left rounded-l-2xl" style="background-image: url({{ image_link }});"></div>
                                    <div class="w-48 float-left pt-2 pl-2">
                                        <h><strong>{{ title }}</strong></h>
                                        <h3>{{ sub_title }}</h3>
                                        <h class="text-blue-400"><strong>$ {{ list_price_formatted }}</strong></h>
                                    </div>
                                    <svg class="absolute text-white h-2 w-20 left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0"/></svg>
                                </div>
                                <img src="/images/resources/marker-arrow-blue-small.png" class="cursor-pointer" @click="show = true" @click.away="show = false" @mouseover="show = true" @mouseout="show = false"></img>
                            </div>`,
            },
        }),

        instantsearch.widgets.rangeSlider({
            container: '#price-refinement',
            attribute: 'list_price',
            pips: false,
            step: 50000,
            tooltips: {
                format: function(rawValue) {
                    return '$' + number_format(rawValue);
                },
            },
        }),

        instantsearch.widgets.menuSelect({
            container: '#state-refinement',
            attribute: 'state',
        }),

        instantsearch.widgets.menuSelect({
            container: '#country-refinement',
            attribute: 'country',
        }),

        instantsearch.widgets.numericMenu({
            container: '#beds-refinement',
            attribute: 'beds',
            items: [
                {label: 'All'},
                {label: '1+ bedroom', start: 1},
                {label: '2+ bedrooms', start: 2},
                {label: '3+ bedrooms', start: 3},
                {label: '4+ bedrooms', start: 4},
                {label: '5+ bedrooms', start: 5},
            ],
            templates: {
                header: 'Bedrooms'
            }
        }),

        instantsearch.widgets.numericMenu({
            container: '#baths-refinement',
            attribute: 'baths',
            items: [
                {label: 'All'},
                {label: '1+ bathroom', start: 1},
                {label: '2+ bathrooms', start: 2},
                {label: '3+ bathrooms', start: 3},
                {label: '4+ bathrooms', start: 4},
                {label: '5+ bathrooms', start: 5}
            ],
            templates: {
                header: 'Bathrooms'
            }
        }),


        instantsearch.widgets.rangeSlider({
            container: '#lot-size-refinement',
            attribute: 'lot_size',
            pips: false,
            step: 100,
            tooltips: {
                format: function(rawValue) {
                    return number_format(rawValue) + 'acre';
                },
            },
        }),

        instantsearch.widgets.rangeSlider({
            container: '#property-size-refinement',
            attribute: 'property_size',
            pips: false,
            step: 100,
            tooltips: {
                format: function(rawValue) {
                    return number_format(rawValue) + 'acre';
                },
            },
        }),

        instantsearch.widgets.menuSelect({
            container: '#property-type-refinement',
            attribute: 'property_type',
            templates: {
                header: 'Property Type:'
            },
            searchForFacetValues: {
            placeholder: 'Property Type',
                templates: {
                  noResults: '<div class="sffv_no-results">No matching for this Property Type.</div>'
                }
            }
        }),

        instantsearch.widgets.menuSelect({
            container: '#listing-type-refinement',
            attribute: 'listing',
            templates: {
                header: 'Listing Type:'
            },
            searchForFacetValues: {
            placeholder: 'Listing Type',
                templates: {
                  noResults: '<div class="sffv_no-results">No matching for this Listing Type.</div>'
                }
            }
        }),

        instantsearch.widgets.clearRefinements({
            container: '#clear-filters',
        })


    ]);

    search.start();

    document.addEventListener("DOMContentLoaded", function(){
        const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
        const ais_map = document.querySelector('.ais-GeoSearch-map');
        ais_map.style.height = vh + 'px';
    });

    function showComponents() {
        return {
            map_on: true,
            filters_on: false,
            toogleMap() {
                this.map_on = ! this.map_on;
            },
            toggleFilters() {
                this.filters_on = ! this.filters_on;
            }

        }
    }
