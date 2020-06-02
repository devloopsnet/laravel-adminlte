<?php

namespace App\Http\Requests;

use App\Models\Shopper;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\MessageBag;

/**
 * Class BaseApiRequest
 *
 * @package App\Http\Requests
 * @date 2019-06-20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class BaseApiRequest extends FormRequest {

  /**
   * Override failedValidation to prevent default behaviour
   *
   * @param Validator $validator
   *
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  protected function failedValidation(Validator $validator): void {
  }

  /**
   * Get Validation instance
   *
   * @return Validator
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function getValidatorInstance(): Validator {
    return parent::getValidatorInstance();
  }

  /**
   * Return if request validation failed or not
   *
   * @return array
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function failed(): array {
    return $this->getValidatorInstance()->failed();
  }

  /**
   * Return validation errors
   *
   * @return \Illuminate\Support\MessageBag
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function errors(): MessageBag {
    return $this->getValidatorInstance()->errors();
  }

  /**
   * Get user form request
   *
   * @return User
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function getUser(): User {
    return $this->user('api-user');
  }

  /**
   * Get shopper from request
   *
   * @return \App\Models\Shopper
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function getShopper(): Shopper {
    return $this->user('api-shopper');
  }

}
