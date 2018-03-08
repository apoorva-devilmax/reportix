<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Role;
use Auth;

class ProjectRequest extends Request
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
            'name' => 'required|string|alpha_spaces|max:255',
            'code' => 'sometimes|required|alpha|max:255|unique:projects,code',
            'domain' => 'required|url',
            'description' => 'required|string',
        ];
    }
}
