<?php


namespace App\Traits;


use Spatie\MediaLibrary\Models\Media;

/**
 * Trait HasAvatarTrait
 *
 * @property string avatar_url
 * @property Media  avatar
 *
 * @package App\Traits
 * @date 2019-06-20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
trait HasAvatarTrait {

	/**
	 * Define avatar attribute
	 *
	 * @return Media|null
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function getAvatarAttribute(): ?Media {
		return $this->getFirstMedia( 'avatar' );
	}

	/**
	 * Define avatar_url attribute
	 *
	 * @return Media|null
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function getAvatarUrlAttribute(): string {
		return $this->avatar !== null ? $this->avatar->getFullUrl() : 'https://cdn.imgbin.com/3/1/2/imgbin-united-states-computer-icons-desktop-free-high-quality-person-icon-default-profile-2aZui7ZnCtjpD6FkTi5Cz55r4.jpg';
	}

}