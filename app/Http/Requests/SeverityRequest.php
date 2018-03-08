<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Role;
use Auth;

class SeverityRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user() && Auth::user()->hasRole([Role::ADMIN]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'level' => 'required|string|alpha|max:255',
            'color_code' => 'required|string|max:10|regex:/#([a-f0-9]{3}){1,2}\b/i',
            'description' => 'required|string',
        ];
    }
}
