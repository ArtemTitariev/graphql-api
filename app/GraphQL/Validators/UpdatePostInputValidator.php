<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

final class UpdatePostInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title'   => ['nullable', 'string', 'min:3', 'required_without_all:content'],
            'content' => ['nullable', 'string', 'min:3', 'required_without_all:title'],
        ];
    }
}
