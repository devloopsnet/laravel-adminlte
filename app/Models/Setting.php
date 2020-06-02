<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Class Setting
 *
 * @property int id
 * @property int admin_id
 * @property string key
 * @property mixed value
 * @method static Builder|self byKey($key)
 *
 * @package App\Models
 * @date 2019-07-13
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Setting extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['key', 'value', 'admin_id'];

    /**
     * @var array
     */
    protected $casts = [
        'value' => 'unserialize',
    ];


    /**
     * Get setting by key
     *
     * @param string $key
     * @param null $default
     * @return mixed
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public static function get(string $key, $default = NULL)
    {
        if (in_array($key, ['brief', 'address', 'faq'], true) && App::getLocale() === 'ar') {
            $key .= '_ar';
        }

        return Cache::rememberForever($key, static function () use ($key, $default) {
            /**
             * @var $setting Setting
             */
            $setting = Setting::byKey($key)->first();
            return $setting === NULL ? $default : $setting->value;
        });
    }

    /**
     * Update or insert new setting
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public static function set(string $key, $value): bool
    {
        Cache::forget($key);
        return self::query()->updateOrCreate(
                [
                    'key' => $key,
                ],
                [
                    'key' => $key,
                    'value' => serialize($value),
                    'admin_id' => admin()->id,
                ]) !== NULL;
    }

    /**
     * value attribute mutator
     *
     * @param $value
     * @return mixed
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function getValueAttribute($value)
    {
        return unserialize($value, ['allowed_classes' => false]);
    }

    /**
     * Define byKey() scope
     *
     * @param Builder $builder
     * @param $key
     * @return Builder
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function scopeByKey(Builder $builder, $key): Builder
    {
        return $builder->where('key', '=', $key);
    }

}
