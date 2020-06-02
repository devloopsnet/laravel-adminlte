<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers
 * @date 2019-06-24
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class ApiController extends Controller
{

    /**
     * Return user from api binding
     *
     * @return User
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getUser(): ?User
    {
        return auth('api-user')->user();
    }

    /**
     * Return driver from api binding
     *
     * @return Driver
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getDriver(): ?Driver
    {
        return auth('api-driver')->user();
    }
}
