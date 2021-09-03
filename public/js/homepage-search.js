    var full = window.location.host;
    var parts = full.split('.');
    var sub = parts[0];
    var index_name = '';
    if(sub !== 'www' && sub !== 'realtyhive') {
        index_name = 'rh-rewrite';
    } else {
        index_name = 'listings';
    }

    var search = document.getElementById('home-search');
    search.addEventListener('keyup', function(e) {
        query = search.value;
        if (e.which == 13) {
            var url = '/search/' + query; 
            window.location = url;
        }

    });

    var client = algoliasearch('0UHNAUUZ8H', 'ea596a8ff8d8b5d34099cccb75e3b69d');
    var index = client.initIndex(index_name);
    autocomplete('#home-search', { hint: false }, [
        {
            source: autocomplete.sources.hits(index, { hitsPerPage: 5 }),
            displayKey: 'title',
            debug: true,
            templates: {
                suggestion: function(suggestion) {
                    //console.log(suggestion);
                    return '<div class="flex justify-between">' +
                                '<div class="flex">' +
                                '   <img src="' + suggestion.image_link + '" onerror="this.src=\'/images/resources/no-image-yellow.jpg\'" class="w-20 h-20 pr-2"></img>' +
                                '   <div class="flex-col"><strong class="mr-2">' + suggestion._highlightResult.title.value + '</strong>' +
                                '   <p>' + suggestion._highlightResult.sub_title.value + '</p></div>' +
                                '</div>' +
                                '<div class="flex justify-center md:justify-left">' +
                                '    <div class="font-bold text-xl md:text-2xl text-realty">' + suggestion.list_price_formatted + '</div>' +
                                '    <div class="self-start font-bold text-realty text-sm">' + suggestion.list_price_unit + '</div>' +
                                '</div>' +
                            '</div>';
                },
                footer: function(suggestion) {
                    suggestion.slug = 'search=' + query;
                    return '<div class="flex justify-around py-4 aa-suggestion">' +
                                '<div class="flex">' +
                                '   <strong>Search for term: </strong>' +
                                '</div>' +
                                '<div class="flex justify-center md:justify-left">' +
                                '    <div class="font-bold text-xl md:text-2xl text-realty">' + query + '</div>' +
                                '</div>' +
                            '</div>';                 
                }
            }
        }
    ]).on('autocomplete:selected', function(event, suggestion, dataset) {
        if(suggestion) {
            window.location = '/listing/' + suggestion.slug;
        } else {
            window.location = '/search/' + query; 
        }
    });
