<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\BannerSlider;
use App\Models\Category;
use App\Models\PickupLocation;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers\Api
 * @date 2019-06-24
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class HomeController extends ApiController
{

    /**
     * Handle api request to return home page contents
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function homeScreen(): array
    {
        $Banners = BannerSlider::all();
        $Categories = Category::root()->get();

        return [
            'status' => 1,
            'banners' => $Banners,
            'categories' => $Categories,
        ];
    }

    /**
     * Handle api request to return predefined pick up locations
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function pickupLocations(): array
    {
        $pickupLocations = PickupLocation::all();

        return [
            'status' => 1,
            'pickup_locations' => $pickupLocations,
        ];
    }

    /**
     * Handle api request to return application settings
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function applicationSettings(): array
    {
        if ($this->getUser() !== NULL) {
            $this->getUser()->locale = request()->header('locale', 'en');
            $this->getUser()->save();
        }
        if ($this->getDriver() !== NULL) {
            $this->getDriver()->locale = request()->header('locale', 'en');
            $this->getDriver()->save();
        }

        return [
            'status' => 1,
            'settings' => [
                'minimum_order_weight' => Setting::get('minimum_order_weight', 1.0),
                'cash_out_threshold' => Setting::get('cash_out_threshold', 1.0),
                'support_email' => Setting::get('support_email'),
                'mobile_phone' => Setting::get('mobile_phone'),
                'land_line' => Setting::get('land_line'),
                'twitter_account' => Setting::get('twitter_account'),
                'facebook_account' => Setting::get('facebook_account'),
                'instagram_account' => Setting::get('instagram_account'),
                'privacy_policy' => Storage::url(Setting::get('privacy_policy')),
                'terms_conditions' => Storage::url(Setting::get('terms_conditions')),
                'address' => Setting::get('address', ''),
                'brief' => Setting::get('brief', ''),
                'faq' => Setting::get('faq', ''),
            ],
        ];
    }

}
