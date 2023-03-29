<?php

namespace App\Http\Requests;

use App\Author;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAuthorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('author_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:authors,id',
        ];
    }
}
