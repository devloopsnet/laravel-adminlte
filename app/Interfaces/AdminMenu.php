<?php


namespace App\Interfaces;

/**
 * Interface AdminMenu
 *
 * @package App\Interfaces
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
interface AdminMenu
{

    /**
     * Return Controller Admin Menu
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public static function getMenu(): array;

}
