<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Role;
use Auth;

class ReportRequest extends Request
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
            'version' => 'required|regex:/^[0-9\.]+$/',
            'project' => 'required|exists:projects,id',
            'domain' => 'required|url',
            'description' => 'required|string',
            'submission' => 'required|date'
        ];
    }
}
