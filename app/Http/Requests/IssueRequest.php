<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Role;
use Auth;

class IssueRequest extends Request
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
            'name' => 'required|string|alpha_spaces|max:255',
            'vulnerability' => 'required|exists:vulnerabilities,id',
            'severity' => 'required|exists:severities,id',
            'url' => 'required|url',
            'param' => 'required|string|alpha_spaces',
            'description' => 'required|string',
            'recommendation' => 'required|string'
        ];
    }
}
