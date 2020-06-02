<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\MessageBag;

/**
 * Class BaseCompanyRequest
 *
 * @package App\Http\Requests\Company
 * @date 12/15/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class BaseCompanyRequest extends FormRequest {

    /**
     * Override failedValidation to prevent default behaviour
     *
     * @param Validator $validator
     *
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    protected function failedValidation( Validator $validator ): void {
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
}
