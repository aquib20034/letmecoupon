<?php

namespace App\Http\Requests;

use App\WebsiteSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreWebsiteSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('website_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'site_javascript' => [
                'nullable',
            ],
            'site_html_tags' => [
                'nullable',
            ],
        ];
    }
}
