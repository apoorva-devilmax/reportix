<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Role;
use Auth;

class ScreenshotRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user() && (Auth::user()->hasRole([Role::ADMIN, Role::REPORTER]) );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required|string',
            'screen' => 'sometimes|required|file|image|max:1024',
        ];
    }
}
