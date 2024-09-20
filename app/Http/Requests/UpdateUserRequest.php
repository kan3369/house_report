<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        return [
            // app/Http/Requests/ProfileUpdateRequest.phpからnameとemailはコピーして一部追加
            'name' => 'required|string|max:255',
            // 自分以外のemailと重複しない(unique:テーブル,カラム,除外対象のidの値,除外対象のidのカラム名)
            'email' => 'required|string|lowercase|email|max:255|unique:users,NULL,' . request()->route()->user->id . ',id',
            // passwordは変更しない場合もあるのでrequiredは不要
            'password' => 'confirmed',
            'is_admin' => 'sometimes|boolean',
        ];
    }
}
