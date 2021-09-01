<x-backend.section title="Listing Info">
    <div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <x-label>List Price *</x-label>
                <x-input icon="dollar" name="list_price" value="{{ old('list_price', $listing->list_price ?? '') }}" />
                <x-input-error for="list_price" />
            </div>
            <div>
                <x-label>Reserve Price</x-label>
                <x-input icon="dollar" name="reserve_price" value="{{ old('reserve_price', $listing->reserve_price ?? '') }}" />
                <x-input-error for="reserve_price" />
            </div>
            <div>
                <x-label>Opening Bid</x-label>
                <x-input icon="dollar" name="opening_bid" value="{{ old('opening_bid', $listing->opening_bid ?? '') }}" />
                <x-input-error for="opening_bid" />
            </div>
            <div>
                <x-label>Minimal Bid Increment</x-label>
                <x-input icon="dollar" name="min_bid_increment" value="{{ old('min_bid_increment', $listing->min_bid_increment ?? '') }}" />
                <x-input-error for="min_bid_increment" />
            </div>
        </div>
        <hr class="my-4" />
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <x-label>Listing Date</x-label>
                <x-date-picker icon="calendar" iconPosition="right" name="listing_date" value="{{ old('listing_date', $listing->listing_date ?? '') }}" />
                <x-input-error for="listing_date" />
            </div>
            <div>
                <x-label>Listing Expiration Date</x-label>
                <x-date-picker icon="calendar" iconPosition="right" name="listing_expiration_date" value="{{ old('listing_expiration_date', $listing->listing_expiration_date ?? '') }}" />
                <x-input-error for="listing_expiration_date" />
            </div>
            <div>
                <x-label>Days On Market</x-label>
                <x-input name="days_on_market" value="{{ old('days_on_market', $listing->days_on_market ?? '') }}" />
                <x-input-error for=days_on_market"seller_type" />
            </div>
            <div>
                <x-label>Commission Percent</x-label>
                <x-input icon="percent" iconPosition="right" name="commission_percent" value="{{ old('commission_percent', $listing->commission_percent ?? '') }}" />
                <x-input-error for="commission_percent" />
            </div>
            <div>
                <x-label>Lot Number</x-label>
                <x-input name="lot_number" value="{{ old('lot_number', $listing->lot_number ?? '') }}" />
                <x-input-error for="lot_number" />
            </div>
            <div>
                <x-label>Buyer's Fee</x-label>
                <x-input name="buyer_fee" value="{{ old('buyer_fee', $listing->buyer_fee ?? '') }}" />
                <x-input-error for="buyer_fee" />
            </div>
            <div>
                <x-label>Sale Number</x-label>
                <x-input name="sale_number" value="{{ old('sale_number', $listing->sale_number ?? '') }}" />
                <x-input-error for="sale_number" />
            </div>
        </div>
    </div>
</x-backend.section>

<x-backend.section title="Closing Information" class="grid gap-4">
    <div class="grid grip-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-label>Purchase Price</x-label>
            <x-input icon="dollar" name="purchase_price" value="{{ old('purchase_price', $listing->purchase_price ?? '') }}" />
            <x-input-error for="purchase_price" />
        </div>
        <div>
            <x-label>Close Date</x-label>
            <x-date-picker icon="calendar" iconPosition="right" name="close_date" value="{{ old('close_date', $listing->close_date ?? '') }}" />
            <x-input-error for="close_date" />
        </div>
        <div>
            <x-label>Close Acceptance Date</x-label>
            <x-date-picker icon="calendar" iconPosition="right" name="close_acceptance_date" value="{{ old('close_acceptance_date', $listing->close_acceptance_date ?? '') }}" />
            <x-input-error for="close_acceptance_date" />
        </div>
    </div>
</x-backend.section>
