<?php

namespace App\Http\Requests;

use App\Author;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAuthorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('author_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'first_name'    => [
                'required',
            ],
            'last_name'   => [
                'required',
            ],
            'short_description'   => [
                'required',
            ]
        ];
    }
}
