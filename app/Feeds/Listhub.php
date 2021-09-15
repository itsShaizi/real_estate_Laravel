<?php

namespace App\Feeds;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Testing\MimeType;

use App\Models\Listing;
use App\Models\Image;
use App\Models\Video;
use App\Models\Phone;
use App\Models\Country;
use App\Models\State;
use App\Models\FeedListing;
use App\Models\User;
use App\Models\ListingSource;
use App\Models\ListingUser;
use App\Models\Business;

use Illuminate\Support\Facades\Storage;

use Img;

class Listhub {

    protected $token;

    public function __construct()
    {
        $this->authenticate();
    }

    public function tst() {
        echo 'it works!';
        exit();
    }

    public function import($feed_id) {

        $listings = $this->get_listings(10); //record limit ie: 1. change back to no parameter after testing

        foreach($listings as $i => $incoming_listing) {

            $raw_data = json_encode($incoming_listing);

            $listing_feed_id = $this->get_fingerprint_id($incoming_listing);

            $feed_listing_array = array(
                'listing_feed_id' => 'listhub-'.$listing_feed_id,
                'feed_id' => $feed_id,
                'mls_name' => $incoming_listing['SourceSystemName'],
                'mls_number' => $incoming_listing['ListingKey'],
                'mls_id' => $incoming_listing['SourceSystemID'],
                'provider_name' => $incoming_listing['SourceSystemName'],
                'raw_data' => $raw_data,
                'md5' => md5($raw_data),
            );

            $feed_listing = FeedListing::where('listing_feed_id', 'listhub-'.$listing_feed_id)->where('feed_id', $feed_id)->first();
            if(!$feed_listing) {
                $feed_listing = FeedListing::create($feed_listing_array);
                $listing = new Listing;
            } elseif($feed_listing->md5 !== $feed_listing_array['md5']) {
                $feed_listing->raw_data = $raw_data;
                $feed_listing->md5 = md5($raw_data);
                $feed_listing->save();
                $listing = Listing::where('listing_feed_id', 'listhub-'.$listing_feed_id)->first();
                if(!$listing) {
                    $listing = new Listing;
                }
            } else {
                echo "Nothing to update, we move on... \n";
                continue;
            }

            $this->parse($listing, $incoming_listing);
            $listing->listing_feed_id = 'listhub-'.$listing_feed_id;

            if($listing->seller_type !== 'rh_syndication') {
                echo "Not RH Syndication, moving on...\n";
                continue;
            }

            if($listing->property_type === 'rental') {
                echo "Skiping this Rental listing...\n";
                continue;
            }

            // Disable sync with algolia at this point because we don't have images yet
            Listing::withoutSyncingToSearch(function () use ($listing) {
                $listing->save();
            });

            $this->save_media($listing, $incoming_listing['Media']);

            $this->save_contacts($listing, $incoming_listing);

            $this->save_sources($listing, $incoming_listing);

            echo "Added/Updated Listing: $listing->id - Slug: $listing->slug \n";

        }

        /*
        echo "-----> Deleting No longed feeded Listings --->\n";

        $CurrentListingFeedIDs = $this->db->query("SELECT ListingFeedID FROM Listing_Parsed WHERE DeleteDate IS NULL AND ListHub IS NOT NULL")->result_array();
        foreach($CurrentListingFeedIDs as $ix => $ListingFeedID) {
            if(!in_array($ListingFeedID['ListingFeedID'], $incomingListingIDs)) {
                $this->db->query("UPDATE Listing_Raw SET DeleteDate = NOW() WHERE ListingFeedID = ?", array($ListingFeedID['ListingFeedID']));
                $this->db->query("UPDATE Listing_Parsed SET DeleteDate = NOW() WHERE ListingFeedID = ?", array($ListingFeedID['ListingFeedID']));
                if($this->db->affected_rows() > 0) echo " > ".$ListingFeedID['ListingFeedID']." marked as Deleted\n";
            }
        }

        echo " => Total Deleted: ".count($CurrentListingFeedIDs)."\n";

        echo "-----> Checking FeedStatus and FeedType status --->\n";

        $sql = "SELECT FeedStatus, FeedType, ProviderName FROM Listing_Parsed WHERE DeleteDate IS NULL AND FeedType IS NOT NULL AND FeedStatus IS NOT NULL GROUP BY FeedStatus, FeedType, ProviderName";
        $CurrentStatusType = $this->db->query($sql)->result_array();
        foreach($CurrentStatusType as $k => $row) {
            $sql = "UPDATE Listing_Parsed SET FeedStatus = ?, FeedType = ? WHERE ProviderName = ?";
            $this->db->query($sql, array($row['FeedStatus'], $row['FeedType'], $row['ProviderName']));
            echo ".";
        }

        echo "\n######################################################################\n";
        echo "######### FINISHED SYNC BATCH " . date("Y-m-d H:i:s") . " ##########\n";
        echo "######################################################################\n\n\n";
        return TRUE;
        */

        return TRUE;

    }

    protected function authenticate() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.listhub.com/oauth2/token",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=".env('LISTHUB_API_KEY')."&client_secret=".env('LISTHUB_API_SECRET'),
          CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Content-Length: 129",
            "Content-Type: application/x-www-form-urlencoded",
            "Host: api.listhub.com",
            "User-Agent: PostmanRuntime/7.20.1",
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        $resp = json_decode($response);

        curl_close($curl);

        if ($err) {
            //echo "cURL Error #:" . $err;
            die('Bad Authentication');
        } else {
            $this->token = $resp->access_token;
        }
    }

    protected function get_listings($limit = '') {

        if(!empty($limit)) {
            $limit = '&limit='.$limit;
        }

        $listings = array();
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://replication.listhub.com/query?StandardStatus%20eq%20%27Active%27'.$limit,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Authorization: Bearer $this->token",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Content-Type: application/json",
            "Host: replication.listhub.com",
            "User-Agent: PostmanRuntime/7.20.1",
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $response = preg_replace('/}\n|}\r/', '},', $response);
        $response = rtrim($response, ',');
        $response = '['.$response.']';
        $resp = json_decode($response, TRUE);

        $err = curl_error($curl);

        foreach($resp as $resp_row) {
            $listings[] = $resp_row['Property'];
        }

        curl_close($curl);

        if ($err) {
            return FALSE;
            //echo "cURL Error #:" . $err;
        } else {
            return $listings;
        }
    }

    public function parse(&$listing, $listing_in) {

        $num = 0;
        $listing_out = array();

        $listing->address = isset($listing_in['UnparsedAddress']) ? ucwords(strtolower(trim($listing_in['UnparsedAddress']))) : null;
        $listing->address .= isset($listing_in['UnitNumber']) ? " ".trim($listing_in['UnitNumber']) : '';
        $listing->city = trim($listing_in['PostalCity']);
        $listing->state_id = State::where('iso2', trim(@$listing_in['StateOrProvince']))->first()->id;
        $listing->zip = isset($listing_in['PostalCode']) ? trim($listing_in['PostalCode']) : null;
        $listing->country_id = Country::where('iso2', trim($listing_in['Country']))->first()->id;
        $listing->slug = preg_replace('/\s/', '-', preg_replace('/\.\-\,\#\'\"/', '', $listing->address.' '.$listing->city.' '.$listing->zip));
        $listing->list_price = trim($listing_in['ListPrice']);
        $listing->property_type = $this->map_type($listing_in['PropertyType']);
        $listing->property_types = $this->map_type($listing_in['PropertyType'], $listing_in['PropertySubType']);
        $listing->property_types = serialize($listing->property_types);
        $listing->listing_source = trim($listing_in['CustomFields']['ListingURL']);
        $listing->feed_lead_routing_email = trim($listing_in['CustomFields']['LeadRoutingEmail']);
        $listing->beds = isset($listing_in['BedroomsTotal']) ? trim($listing_in['BedroomsTotal']) : null;
        $listing->status = $this->map_status(preg_replace('/\s/', '', trim($listing_in['StandardStatus'])));

        $listing->description = preg_replace("/\r?\n|\r/", '', trim($listing_in['PublicRemarks']));
        $listing->mls_name = trim(@$listing_in['SourceSystemName']);
        $listing->provider_name = trim($listing_in['SourceSystemName']);
        $listing->feed_source = 'ListHub';
        $listing->property_size = isset($listing_in['LivingArea']) ? trim($listing_in['LivingArea']) : null;
        $listing->lot_size = isset($listing_in['LotSizeAcres']) ? trim($listing_in['LotSizeAcres']) : null;
        $listing->year_built = isset($listing_in['YearBuilt']) ? trim($listing_in['YearBuilt']) : null;
        $listing->baths = isset($listing_in['BathroomsFull']) ? trim($listing_in['BathroomsFull']) : null;
        $listing->half_baths = isset($listing_in['BathroomsHalf']) ? trim($listing_in['BathroomsHalf']) : null;

        $listing->provider_state = trim(@$listing_in['CustomFields']['ListBrokerageStateOrProvince']);
        $listing->latitude = isset($listing_in['Latitude']) ? trim($listing_in['Latitude']) : null;
        $listing->longitude = isset($listing_in['Longitude']) ? trim($listing_in['Longitude']) : null;
        $listing->directions = isset($listing_in['Directions']) ? trim($listing_in['Directions']) : null;
        $listing->county = isset($listing_in['CountyOrParish']) ? trim($listing_in['CountyOrParish']) : null;
        $listing->listing_date = isset($listing_in['ListingContractDate']) ? trim($listing_in['ListingContractDate']) : null;
        $listing->feed_mod_timestamp = date("Y-m-d H:i:s",strtotime(trim($listing_in['ModificationTimestamp'])));
        $listing->feed_disclaimer = isset($listing_in['Disclaimer']) ? trim($listing_in['Disclaimer']) : null;
        $listing->listhub_listing_key = trim($listing_in['ListingKey']);
        $listing->seller_type = 'rh_syndication';
        $listing->listing_type = 'traditional';
        $listing->listhub = 'Y';

    }

    public function map_type($input_type, $input_subtype = array()) {

        $input_type = preg_replace('/\s/', '', $input_type);
        $input_subtype = preg_replace('/\s/', '', $input_subtype);
        $output_subtypes = array();

        if(empty($input_subtype)) {
            $types = array(
                "BusinessOpportunity" => 'commercial',
                "CommercialLease" => 'rental',
                "CommercialSale" => 'commercial',
                "Farm" => 'land',
                "Land" => 'land',
                "ManufacturedInPark" => 'residential',
                "Residential" => 'residential',
                "ResidentialIncome" => 'residential',
                "ResidentialLease" => 'rental',
                "ResidentialCommonInterest" => 'residential',
                "ResidentialMultiFamily" => 'multi_family',
                "Other" => 'commercial'
            );
            return $types[trim($input_type)];
        } else {
            if($input_type === 'BusinessOpportunity') {
                $output_subtypes[] = 'investment';
                $output_subtypes[] = 'turn_key';
            }
            if($input_type === 'ManufacturedInPark') {
                $output_subtypes[] = 'manufactured';
            }
            if($input_type === 'ResidentialIncome') {
                $output_subtypes[] = 'investment';
            }
            if($input_type === 'ResidentialMultiFamily') {
                $output_subtypes[] = 'residential';
            }
            if($input_type === 'Other') {
                $output_subtypes[] = 'other';
            }
            $sub_types = array(
                "Apartment" => 'apartment',
                "BoatSlip" => 'boatslips',
                "Cabin" => 'home',
                "Condominium" => 'condo',
                "DeededParking" => 'other',
                "Duplex" => 'duplex',
                "Farm" => 'farm',
                "ManufacturedHome" => 'manufactured_home',
                "ManufacturedOnLand" => 'manufactured_home',
                "MobileHome" => 'mobile_home',
                "OwnYourOwn" => 'other',
                "Quadruplex" => 'fourplex',
                "Ranch" => 'home',
                "SingleFamilyAttached" => 'single_family',
                "SingleFamilyResidence" => 'single_family',
                "StockCooperative" => 'other',
                "Timeshare" => 'other',
                "Townhouse" => 'townhouse',
                "Triplex" => 'triplex',
                "Agriculture" => 'agricultural',
                "Business" => 'turn_key',
                "HotelMotel" => 'hospitality',
                "Industrial" => 'industrial',
                "MixedUse" => 'mixed_use',
                "MultiFamily" => 'multi_family',
                "Office" => 'office',
                "Other" => 'other',
                "Retail" => 'retail',
                "UnimprovedLand" => 'land',
                "Warehouse" => 'warehouse'
            );
            if($input_subtype === 'ManufacturedOnLand') {
                $output_subtypes[] = 'land';
            }
            $output_subtypes[] = $sub_types[trim($input_subtype)];
            return $output_subtypes;

        }
    }

    public function map_status($status) {

        $ret = NULL;
        $status = strtolower(trim($status));
        $res = DB::table('feed_property_status_maps')->where('input_status', $status)->first();
        if(!$res) return false;
        else return ucwords($res->status);

    }

    public function clean($Listing) {
        $Listing_clean = array();
        foreach ($Listing as $col => $value) {
            if(isset($value)) {
                $Listing_clean[$col] = $value;
            }
        }
        return $Listing_clean;
    }

    public function get_fingerprint_id($listing_in) {
        $address = ucwords(strtolower(trim(@$listing_in['UnparsedAddress'])));
        $address .= isset($listing_in['UnitNumber']) ? " ".trim($listing_in['UnitNumber']) : '';
        $address = strtolower($address);
        $patterns = array(  '/((^|\s)ave(\s|\.)|(^|\s)avenue(\s|\.))/',
                            '/((^|\s)st(\s|\.)|(^|\s)street(\s|\.))/',
                            '/((^|\s)blvd(\s|\.)|(^|\s)boulevard(\s|\.))/',
                            '/((^|\s)cir(\s|\.)|(^|\s)circle(\s|\.))/',
                            '/((^|\s)ct(\s|\.)|(^|\s)court(\s|\.))/',
                            '/((^|\s)ln(\s|\.)|(^|\s)lane(\s|\.))/',
                            '/((^|\s)fwy(\s|\.)|(^|\s)freeway(\s|\.))/',
                            '/((^|\s)pky(\s|\.)|(^|\s)parkway(\s|\.))/',
                            '/((^|\s)rd(\s|\.)|(^|\s)road(\s|\.))/',
                            '/((^|\s)expy(\s|\.)|(^|\s)expressway(\s|\.))/',
                            '/((^|\s)sq(\s|\.)|(^|\s)square(\s|\.))/',
                            '/((^|\s)tpke(\s|\.)|(^|\s)turnpike(\s|\.))/',
                            '/((^|\s)n(\s|\.)|(^|\s)north(\s|\.))/',
                            '/((^|\s)e(\s|\.)|(^|\s)east(\s|\.))/',
                            '/((^|\s)s(\s|\.)|(^|\s)south(\s|\.))/',
                            '/((^|\s)w(\s|\.)|(^|\s)west(\s|\.))/',
                            '/((^|\s)ne(\s|\.)|(^|\s)northeast(\s|\.))/',
                            '/((^|\s)se(\s|\.)|(^|\s)southeast(\s|\.))/',
                            '/((^|\s)sw(\s|\.)|(^|\s)southwest(\s|\.))/',
                            '/((^|\s)nw(\s|\.)|(^|\s)northwest(\s|\.))/'
                    );
        $replacements = array('ave', 'st', 'blvd', 'cir', 'ct', 'ln', 'fwy', 'pky', 'rd', 'expy', 'sq', 'tpke', 'n', 'e', 's', 'w', 'ne', 'se', 'sw', 'nw');

        $address = preg_replace($patterns, $replacements, $address);
        $address .= $address . strtolower(trim($listing_in['PostalCity']));
        $address .= $address . trim($listing_in['PostalCode']);
        $address .= $address . State::where('iso2', trim(@$listing_in['StateOrProvince']))->first()->id;
        $address .= $address . Country::where('iso2', trim($listing_in['Country']))->first()->id;
        $address = preg_replace('/[^a-z0-9]/', '', $address);
        return md5($address);
    }

    protected function save_media(&$listing, $listing_media) {
        foreach($listing_media as $k => $media) {
            if($media['MediaCategory'] === 'Photo') {

                $name = $media['MediaKey'];
                $dir = Storage::disk('local')->getAdapter()->getPathPrefix();
                $file = $dir.'public/listings/images/'.$listing->id.'/original/'.$name;
                $thumb = $dir.'public/listings/images/'.$listing->id.'/thumb/'.$name;
                $image = Image::where('ref_id', $listing->id)
                            ->where('ref_type', 'App\Models\Listing')
                            ->where('title', $name)->first();

                if(!$image) {

                    if(! Storage::disk('local')->exists('public/listings/images/'.$listing->id)) {
                        Storage::disk('local')->makeDirectory('public/listings/images/'.$listing->id);
                    }
                    if(! Storage::disk('local')->exists('public/listings/images/'.$listing->id.'/original/')) {
                        Storage::disk('local')->makeDirectory('public/listings/images/'.$listing->id.'/original/');
                    }
                    if(! Storage::disk('local')->exists('public/listings/images/'.$listing->id.'/thumb/')) {
                        Storage::disk('local')->makeDirectory('public/listings/images/'.$listing->id.'/thumb/');
                    }

                    $contents = file_get_contents($media['MediaURL']);
                    $imgFile = Img::make($contents);

                    $imgFile->save($file);

                    $imgFile->resize(null, 150, function ($constraint) {
		                $constraint->aspectRatio();
		            })->save($thumb);

                    //Storage::disk('local')->put($file, $contents);
                    $type = mime_content_type($file);
                    $extension = MimeType::search($type);
                    [$width, $height] = getimagesize($file);

                    $image = new Image;
                    $image->title = $name;
                    $image->ext = $extension;
                    $image->type = $type;
                    $image->sort_order = $k;
                    $image->width = $width;
                    $image->height = $height;

                    $listing->images()->save($image);

                }
            }
            if($media['MediaCategory'] === 'VirtualTour') {
                $listing->virtual_tour_link = trim($media['MediaURL']);
                $listing->save();
            }
            if($media['MediaCategory'] === 'Video') {
                $video = Video::where('video_url', trim($media['MediaURL']))
                            ->where('ref_id', $listing->id)
                            ->where('ref_type', 'App\Models\Listing');
                if(!$video) {
                    $video = new Video;
                    $video->video_url = trim($media['MediaURL']);
                    $listing->videos()->save($video);
                }
            }
        }

    }

    protected function save_contacts(&$listing, $listing_in) {
        $user = User::where('email', trim($listing_in['ListAgentEmail']))->first();
        if(!$user) {
            $user = new User;
            $user->first_name = trim($listing_in['ListAgentFirstName']);
            $user->last_name = trim($listing_in['ListAgentLastName']);
            $user->email = trim($listing_in['ListAgentEmail']);
            $user->password = sha1(date('Y-m-d h:m:s'));
            $user->role_id = 5;
            $user->active = 0;
            $user->is_contact = 1;
            $user->save();

            $listing_user = new ListingUser;
            $listing_user->listing_id = $listing->id;
            $listing_user->user_id = $user->id;
            $listing_user->group_id = 6;
            $listing_user->save();

        }

        $listing_user = ListingUser::where('listing_id', $listing->id)
                            ->where('user_id', $user->id)
                            ->where('group_id', 6)->first();
        if(!$listing_user) {
            $listing_user = new ListingUser;
            $listing_user->listing_id = $listing->id;
            $listing_user->user_id = $user->id;
            $listing_user->group_id = 6;
            $listing_user->save();
        }

        if(!empty($listing_in['ListAgentPreferredPhone']) || !empty($listing_in['ListAgentOfficePhone'])) {
            $phone_code = Country::where('iso2', $listing_in['Country'])->first()->phonecode;

            foreach([$listing_in['ListAgentPreferredPhone'], $listing_in['ListAgentOfficePhone']] as $in_phone) {
                if(!empty($in_phone)) {
                    $phone = Phone::where('number', $in_phone)
                                    ->where('ref_id', $user->id)
                                    ->where('ref_type', 'App\Models\User')->first();
                    if(!$phone) {
                        $phone = new Phone;
                        $phone->number = $in_phone;
                        $phone->country_code = $listing_in['Country'];
                        $phone->country_code_num = $phone_code;
                        $phone->main = 1;
                        $phone->phone_type = 'work';
                        $user->phones()->save($phone);
                    }
                }
            }
        }

        //save business:

        /*
        $business = Business::where('name', $listing_in['ListOfficeName'])
                              ->where('address', $listing_in['ListOfficeAddress1'])
                              ->first();

        if(!$business) {
            $business = new Business;
            $business->name = $listing_in['ListOfficeName'];
            $business->address = $listing_in['ListOfficeAddress1'];
            $business->external_link
        }
        */

        /*

        $business = Business::where('name', $listing_in['ListOfficeName'])
                        ->where('
            $listing->Contacts['Agent']['Phone'] = trim($listing_in['ListAgentPreferredPhone']);
            $listing->Contacts['Agent']['Phone2'] = trim($listing_in['ListAgentOfficePhone']);
            $listing->Contacts['Agent']['Email'] = trim($listing_in['ListAgentEmail']);
            $listing->Contacts['Office']['BrokerID'] = @$listing_in['CustomFields']['ListOfficeBrokerMlsId'];
            $listing->Contacts['Office']['FirmName'] = trim(@$listing_in['ListOfficeName']);
            $listing->Contacts['Office']['FirmPhoneNumber'] = trim(@$listing_in['ListOfficePhone']);
            $listing->Contacts['Office']['FirmAddress'] = ucwords(strtolower(trim(@$listing_in['CustomFields']['ListOfficeAddress1']))).' ';
            $listing->Contacts['Office']['FirmAddress'] .= ucwords(strtolower(trim(@$listing_in['CustomFields']['ListOfficeAddress2'])));
            $listing->Contacts['Office']['FirmAddress'] = trim(@$listing->Contacts['Office']['FirmAddress']);
            $listing->Contacts['Office']['FirmCity'] = trim(@$listing_in['CustomFields']['ListOfficeCity']);
            $listing->Contacts['Office']['FirmState'] = trim(@$listing_in['CustomFields']['ListOfficeStateOrProvince']);
            $listing->Contacts['Office']['FirmZip'] = trim(@$listing_in['CustomFields']['ListOfficePostalCode']);
            $listing->Contacts['Office']['FirmCountry'] = trim(@$listing_in['CustomFields']['ListOfficeCountry']);
*/
    }

    protected function save_sources(&$listing, $listing_in) {
        $listing_source = ListingSource::where('listing_id', $listing->id)
                            ->where('source_type', 'mls')
                            ->where('mls_name', $listing_in['SourceSystemName'])
                            ->where('source_val', $listing_in['SourceSystemID'])
                            ->first();
        if(!$listing_source) {
            $listing_source = new ListingSource;
            $listing_source->listing_id = $listing->id;
            $listing_source->source_type = 'mls';
            $listing_source->mls_name = $listing_in['SourceSystemName'];
            $listing_source->source_val = $listing_in['SourceSystemID'];

            $listing->sources()->save($listing_source);

        }
    }

}
