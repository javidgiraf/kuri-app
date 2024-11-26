<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->request->get('id');
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'referrel_code' => 'required|unique:customers,referrel_code,' . $id . ',user_id',
            'mobile' => 'required|unique:customers,mobile,' . $id . ',user_id',
            //'password' => 'required',
            'aadhar_number' => 'required|numeric|unique:customers,aadhar_number,' . $id . ',user_id',
            'address' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'district_id' => 'required',
            'pincode' => 'required|numeric',
            'nominee_name' => 'required',
            'nominee_relationship' => 'required',
            'nominee_phone' => 'required',
        ];
    }
}
