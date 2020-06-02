<?php


namespace App\Traits;


use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

/**
 * Trait TranslatableTitleTrait
 *
 * @property string title_en
 * @property string title_ar
 * @property string body_en
 * @property string body_ar
 *
 * @package App\Traits
 * @date 2019-06-24
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
trait TranslatableTitleTrait
{

    use HasTranslations;

    /**
     * @var array
     */
    public $translatable = ['title', 'description', 'body'];


    /**
     * Define description_en attribute
     *
     * @return string
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getBodyEnAttribute(): string
    {
        return $this->translations['body']['en'] ?? '';
    }

    /**
     * Define description_ar attribute
     *
     * @return string
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getBodyArAttribute(): string
    {
        return $this->translations['body']['ar'] ?? '';
    }

    /**
     * Description attribute mutator
     *
     * @param $description
     * @return string
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getBodyAttribute($description): string
    {
        if (App::getLocale() === 'ar') {
            return $this->body_ar;
        }
        return $this->body_en;
    }

    /**
     * Define description_en attribute
     *
     * @return string
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getDescriptionEnAttribute(): string
    {
        return $this->translations['description']['en'] ?? '';
    }

    /**
     * Define description_ar attribute
     *
     * @return string
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getDescriptionArAttribute(): string
    {
        return $this->translations['description']['ar'] ?? '';
    }

    /**
     * Description attribute mutator
     *
     * @param $description
     * @return string
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getDescriptionAttribute($description): string
    {
        if (App::getLocale() === 'ar') {
            return $this->description_ar;
        }
        return $this->description_en;
    }

    /**
     * Define title_ar attribute
     *
     * @return string
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getTitleArAttribute(): ?string
    {
        return $this->translations['title']['ar'] ?? '';
    }

    /**
     * Define title_en attribute
     *
     * @return string
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getTitleEnAttribute(): ?string
    {
        return $this->translations['title']['en'] ?? '';
    }

    /**
     * Title attribute mutator
     *
     * @param $title
     * @return string
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getTitleAttribute($title): string
    {
        if (App::getLocale() === 'ar') {
            return $this->title_ar;
        }
        return $this->title_en;
    }


}