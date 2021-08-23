<x-backend.section title="General Info">
    <div>
        <div class="md:flex md:justify-between text-sm">
            <div>
                <x-label>Seller Type</x-label>
                <x-select name="seller_type"> 
                    @foreach ( __('global.listing.seller_type') as $val => $name )
                        <option value="{{ $val }}">{{ $name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div>
                <div>
                    <input type="checkbox" class="form-checkbox rounded" name="for_development">
                    <span class="ml-2">For Development</span>
                </div>
                <div>
                    <input type="checkbox" class="form-checkbox rounded" name="remove_cashifyd">
                    <span class="ml-2">Remove Cashifyd</span>
                </div>
            </div>
        </div>
        <hr class="my-4"/>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <x-label>
                    RealtyHive Rep <span class="fas fa-exclamation-circle"></span>
                </x-label>
                <x-input name="realtyhive_rep"/>
            </div>
            <div>
                <x-label>
                    RealtyHive Liaison <span class="fas fa-exclamation-circle"></span>
                </x-label>
                <x-input name="realtyhive_liaison"/>
            </div>
            <div>
                <x-label>
                    Real Estate Agent <span class="fas fa-exclamation-circle"></span>
                </x-label>
                <x-input name="realestate_agent"/>
            </div>
            <div>
                <x-label>
                    Listing Type *
                </x-label>
                <x-select name="listing_type">
                    @foreach ( __('global.listing.listing_type') as $val => $name )
                        <option value="{{ $val }}">{{ $name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div>
                <x-label>Property Type *</x-label>
                <x-select name="property_type">
                    @foreach ( __('global.listing.property_type') as $val => $name )
                        <option value="{{ $val }}">{{ $name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div>
                <!-- Multiple Select -->
                <x-label>Additional Property Types *</x-label>
                <x-input name="additional_property_types"/>
            </div>
        </div>
    </div>
</x-backend.section>

<x-backend.section title="Property Address" class="grid gap-4">
    <div>
        <x-label>Listing Title</x-label>
        <x-input name="listing_title"/>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <x-label>Address</x-label>
            <x-input name="address"/>
        </div>
        <div>
            <x-label>Slug (Url used to access listing)</x-label>
            <x-input name="slug"/>
        </div>
    </div>
    <div class="grid md:grid-cols-3 gap-4">
        <div>
            <x-label>City *</x-label>
            <x-input name="city"/>
        </div>
        <div>
            <x-label>State *</x-label>
            <x-input name="state"/>
        </div>
        <div>
            <x-label>Zip *</x-label>
            <x-input name="zip"/>
        </div>
        <div>
            <x-label>Country *</x-label>
            <x-input name="country"/>
        </div>
        <div>
            <x-label>County</x-label>
            <x-input name="county"/>
        </div>
        <div>
            <x-label>Municipality</x-label>
            <x-input name="municipality"/>
        </div>
    </div>
    <hr class="my-4"/>
    <div class="grid md:grid-cols-3 gap-4">
        <div>
            <x-label>Enter Latitude & Longitude Manually?</x-label>
            <div class="flex space-x-4">
                <div>
                    <input type="radio" class="form-radio" name="lat_long" value="no" checked="checked" /> No
                </div>
                <div>
                    <input type="radio" class="form-radio" name="lat_long" value="yes" /> Yes
                </div>
            </div>
        </div>
        <div>
            <x-label>Latitude</x-label>
            <x-input name="latitude"/>
        </div>
        <div>
            <x-label>Longitude</x-label>
            <x-input name="longitude"/>
        </div>
    </div>
</x-backend.section>

<x-backend.section title="Property Attributes" class="grid gap-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <x-label>Parcel Number</x-label>
            <x-input name="parcel_number"/>
        </div>
        <div>
            <x-label>Year Built</x-label>
            <x-input name="year_built"/>
        </div>
        <div>
            <x-label>Lot Size</x-label>
            <x-input name="lot_size"/>
        </div>
        <div>
            <x-label>Units</x-label>
            <x-input name="units"/>
        </div>
        <div>
            <x-label>Beds</x-label>
            <x-input name="beds"/>
        </div>
        <div>
            <x-label>Full Baths</x-label>
            <x-input name="full_baths"/>
        </div>
        <div>
            <x-label>Half Baths</x-label>
            <x-input name="half_baths"/>
        </div>
        <div>
            <x-label>Square Feet</x-label>
            <x-input name="square_feet"/>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-label>Description *</x-label>
            <textarea id="editor1" name="description"></textarea>
        </div>
        <div>
            <x-label>Directions</x-label>
            <textarea id="editor2" name="directions"></textarea>
        </div>
        <div>
            <x-label>Terms and Conditions</x-label>
            <textarea id="editor3" name="terms"></textarea>
        </div>
        <div>
            <x-label>Local Economy</x-label>
            <textarea id="editor4" name="local_economy"></textarea>
        </div>
    </div>
</x-backend.section>
<x-backend.section title="Property SEO / Advertising">
    <div>
        <x-label>Ad Description</x-label>
        <x-input name="ad_description"/>
    </div>
</x-backend.section>