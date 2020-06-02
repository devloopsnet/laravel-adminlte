<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\MessageBag;

/**
 * Class BaseAdminRequest
 *
 * @package App\Http\Requests
 * @date 2019-06-24
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class BaseAdminRequest extends FormRequest {

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
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function authorize(): bool {
    try {
      return $this->getAdmin()->hasPermissionTo($this->route()->action['permission']) || $this->getAdmin()->hasRole('super-admin');
    } catch (\Exception $exception) {
      return FALSE;
    }
  }

  /**
   * Return logged in Admin
   *
   * @return Admin
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function getAdmin(): Admin {
    return $this->user('admin');
  }

}
