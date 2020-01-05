<?php

namespace App\Http\Requests;

use App\Rules\PasswordLength;
use Illuminate\Foundation\Http\FormRequest;

class MemberRegisterRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'member'){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mail_address' => 'required|email',
            'password' => ['required', 'alpha_dash', new PasswordLength],
            'nickname' => 'required',
            'age' => 'required|integer|min:8|max:150',
            'sex' => 'required|in:1,2',
            'area' => 'required|integer|between:1,7',
            'prefecture' => 'required|integer|between:1,47',
        ];
    }

    public function messages()
    {
        return [
            'mail_address.required' => 'ログインIDは必須です。',
            'mail_address.email' => 'ログインIDは正しいメールアドレスを入力して下さい。',
            'password.required' => 'パスワードは必須です。',
            'password.alpha_dash' => 'パスワードに使える文字は英数字および-,_のみです。',
            'nickname.required' => 'お相手に表示するためのニックネームは必須です。',
            'age.required' => '年齢は必須です。',
            'age.integer' => '年齢は必須です。',
            'age.min' => '7歳以下はご利用できません。',
            'age.max' => '151際以上はご利用できません。',
            'sex.required' => '性別は必須です。',
            'sex.in' => '不正な入力です。',
            'area.required' => 'エリアの入力は必須です。',
            'area.integer' => '不正な入力です。',
            'area.between' => '不正な入力です。',
            'prefecture.required' => '都道府県の入力は必須です。',
            'prefecture.integer' => '不正な入力です。',
            'prefecture.between' => '不正な入力です。',
        ];
    }


}
