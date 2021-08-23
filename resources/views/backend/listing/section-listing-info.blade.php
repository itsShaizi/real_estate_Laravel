<x-backend.section title="Listing Info">
    <div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <x-label>Listing Status *</x-label>
                <x-select name="listing_status"> 
                    @foreach ( __('global.listing.status') as $val => $name )
                        <option value="{{ $val }}">{{ $name }}</option>
                    @endforeach
                </x-select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
            <div>
                <x-label>List Price</x-label>
                <x-input icon="dollar" name="list_price"/>
            </div>
            <div>
                <x-label>Reserve Price</x-label>
                <x-input icon="dollar" name="reserve_price"/>
            </div>
            <div>
                <x-label>Opening Bid</x-label>
                <x-input icon="dollar" name="opening_bid"/>
            </div>
            <div>
                <x-label>Minimal Bid Increment</x-label>
                <x-input icon="dollar" name="min_bid_increment"/>
            </div>
        </div>
        <hr class="my-4"/>
        <div class="grid md:grid-cols-2 gap-4 mt-4 items-end">
            <div>
                <!-- Take the version from the Vue FORM regarding the condos -->
                <x-label>Listing Condos</x-label>
                <x-select name="listing_type">
                    <option>Select Condo Type</option>
                    @for ($i = 1; $i < 7; $i++)
                        <option value="{{ $i }}">{{ $i }} Bedroom{{ $i == 1 ? '' : 's' }}</option>
                    @endfor
                </x-select>
            </div>
            <div>
                <x-input icon="dollar" name="add_price"/>
            </div>
        </div>
        <hr class="my-4"/>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <x-label>Listing Date</x-label>
                <x-input icon="calendar" iconPosition="right" name="listing_date"/>
            </div>
            <div>
                <x-label>Listing Expiration Date</x-label>
                <x-input icon="calendar" iconPosition="right" name="listing_expiration_date"/>
            </div>
            <div>
                <x-label>Days On Market</x-label>
                <x-input name="days_on_market"/>
            </div>
            <div>
                <x-label>Commission Percent</x-label>
                <x-input icon="percent" iconPosition="right" name="commision_percent"/>
            </div>
            <div>
                <x-label>Lot Number</x-label>
                <x-input name="lot_number"/>
            </div>
            <div>
                <x-label>Buyer's Fee</x-label>
                <x-input name="buyer_fee"/>
            </div>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <x-label>Sale Number</x-label>
                <x-input name="sale_number"/>
            </div>
        </div>
        <hr class="my-4"/>
        <div class="grid md:grid-cols-2 gap-4 mt-4 items-end">
            <div>
                <x-label>Additional Listing Sources</x-label>
                <x-select name="additional_listing_sources">
                    <option>Select Source Type</option>
                    @foreach ( __('global.listing.sources') as $val => $name )
                        <option value="{{ $val }}">{{ $name }}</option>
                    @endforeach
                </x-select>
            </div>
            <div>
                <x-input name="input_source_type"/>
            </div>
        </div>
    </div>
</x-backend.section>

<x-backend.section title="Closing Information" class="grid gap-4">
    <div>
        <x-label>Side Representing</x-label>
        <div class="flex space-x-4">
            <div>
                <input type="radio" class="form-radio" name="side_representing" value="buyer" checked="checked" /> Buyer
            </div>
            <div>
                <input type="radio" class="form-radio" name="side_representing" value="seller" /> Seller
            </div>
            <div>
                <input type="radio" class="form-radio" name="side_representing" value="buyer_seller" /> Buyer & Seller
            </div>
        </div>
    </div>
    <div class="grid grip-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-label>Purchase Price</x-label>
            <x-input icon="dollar" name="purchase_price"/>
        </div>
        <div>
            <x-label>Close Date</x-label>
            <x-input icon="calendar" iconPosition="right" name="close_date"/>
        </div>
        <div>
            <x-label>Close Acceptance Date</x-label>
            <x-input icon="calendar" iconPosition="right" name="close_acceptance_date"/>
        </div>
        <div>
            <x-label>Close Possession Date</x-label>
            <x-input icon="calendar" iconPosition="right" name="close_possession_date"/>
        </div>
        <div>
            <x-label>File No.</x-label>
            <x-input name="file_no"/>
        </div>
    </div>
</x-backend.section>

<x-backend.section title="Development Terms">
    <div>
        <x-label>Development Terms *</x-label>
        <textarea id="editor5" name="development_terms"></textarea>
    </div>
</x-backend.section>