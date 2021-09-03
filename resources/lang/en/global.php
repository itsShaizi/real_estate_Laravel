<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'listing' => [
        'listing_type' => [
            'traditional' => 'Traditional',
            'auction' => 'Auction',
            'auction_managed' => 'Auction - Managed',
            'sheriff_sale' => 'Sheriff Sale'
        ],
        'property_type' => [
            'commercial' => 'Commercial',
            'residential' => 'Residential',
            'mixed_use' => 'Mixed Use',
            'multi_family'  => 'Multi-Family',
            'land'  => 'Land',
            'international' => 'International',
        ],
        'status' => [
            'bpo' => 'BPO',
            'watch_list' => 'Watch List',
            'sheriff_sale' => 'Sheriff Sale',
            'watch_list_confirmation' => 'Watch List Confirmation',
            'pre_listing' => 'Pre-Listing',
            'listed_active' => 'Listed / Active',
            'pending_offer_still_showing' => 'Pending Offer (still showing)',
            'pending_offer_not_showing' => 'Pending Offer (not showing)',
            'pending_offer_record_only' => 'Pending Offer (record only)',
            'accepted_offer' => 'Accepted Offer',
            'fell_thru' => 'Fell Thru',
            'sold_closed' => 'Sold / Closed',
            'expired' => 'Expired',
            'hold' => 'Hold',
        ],
        'seller_type'  => [
            'bank' => 'Bank',
            'rh_syndication' => 'RH Syndication',
            'marketing_matters' => 'Marketing Matters',
            'time_limited_event' => 'Time-Limited Event',
            'internal' => 'Internal Listing',
            'rh_non_member_max' => 'RH Non-Member (Max)',
            'potential_upgrade' => 'Potential Upgrade MM',
            'flat_fee_monthly' => 'RealtyHive Flat-Fee Monthly',
            'potential_upgrade_tle' => 'Potential Upgrade TLE',
            'development' => 'Development',
        ],
        'lockbox_type' => [
            'electronic' => 'Electronic',
            'combination' => 'Combination',
            'none' => 'None'
        ],
        'closing_status' => [
            'pending_showing' => 'Pending (showing)',
            'pending_not_showing' => 'Pending (not showing)',
            'closed' => 'Closed',
            'fell_thru' => 'Fell Thru',
        ],
        'sources' => [
            'third_party' => '3rd Party Site',
            'mls' => 'MLS',
            'other' => 'Other Source'
        ],
        'offer_outcome' => [
            'accepted' => 'Accepted',
            'counter_offer' => 'Counter-Offer',
            'denied' => 'Denied',
            'dead' => 'Dead'
        ],
        'license_type' => [
            'real_estate_agent' => 'Real Estate Agent',
            'broker' => 'Broker',
            'auctioneer' => 'Auctioneer'
        ],
    ],
    'meassure_unit' => [
        'acre'          => 'ac',
        'square_feet'   => 'ft²',
        'square_meter'  => 'm²',
        'hectare'       => 'ha',
    ],
    'zip_type' => [
        'military' => 'Military',
        'po_box_only' => 'PO Box Only',
        'standard' => 'Standard',
        'unique' => 'Unique',
        'intl' => 'International'
    ],
    'companies' => [
        'type' => [
            'mortgage_firm' => 'Mortgage Firm',
            'real_estate_agency' => 'Real Estate Agency',
            'title_company' => 'Title Company',
            'developer' => 'Developer',
            'investment_firm' => 'Investment Firm',
            'other' => 'Other',
            'property_management' => 'Property Management',
            'inspector' => 'Inspector',
            'appraiser' => 'Appraiser',
            'contractor' => 'Contractor',
            'construction_company' => 'Construction Company',
            'consulting_firm' => 'Consulting Firm',
            'bank' => 'Bank',
            'government_agency' => 'Government Agency',
            'law_firm' => 'Law Firm',
            'service_provider' => 'Service Provider',

        ],
    ],
    'phones' => [
        'phone_type' => [
            'home' => 'Home',
            'work' => 'Work',
            'cell' => 'Cell',
        ],
    ],
    'emails' => [
        'email_type' => [
            'primary' => 'Primary',
            'home' => 'Home',
            'work' => 'Work',
        ],
    ],
    'addresses' => [
        'address_type' => [
            'home' => 'Home',
            'work' => 'Work',
            'other' => 'Other',
        ],
    ],
    'licenses' => [
        'license_type' => [
            'real_estate_agent' => 'Real Estate Agent',
            'broker' => 'Broker',
            'auctioneer' => 'Auctioneer'
        ],
    ],
    'blog' => [
        'blogs' => 'Blogs',
        'create' => 'Create a blog',
        'title' => 'Title',
        'content' => 'Content',
        'cover_photo' => 'Cover Photo',
        ],
    'tag' => [
        'tags' => 'Tags',
        ],
    'message' => [
        'saved' => 'Data has been saved successfully',
        'updated' => 'Data has been updated successfully',
        'deleted' => 'Data has been deleted',
        'create' => 'Create',
        'edit' => 'Edit',
        'delete' => 'Delete',
        ]


];
