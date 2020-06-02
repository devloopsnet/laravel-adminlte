<?php

namespace App\Observers;

use App\Models\User;

/**
 * Class UserObserver
 *
 * @package App\Observers
 * @date 2019-08-09
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UserObserver
{
    /**
     * Handle the user "deleted" event.
     *
     * @param User $user
     * @return void
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function deleted(User $user): void
    {

    }

    /**
     * Handle the user "restored" event.
     *
     * @param User $user
     * @return void
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function restored(User $user): void
    {

    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param User $user
     * @return void
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function forceDeleted(User $user): void
    {

    }
}
