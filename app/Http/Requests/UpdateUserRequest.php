<?php namespace Fantasee\Http\Requests;

use Fantasee\Http\Requests\Request;

class UpdateUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email' => ['required', 'unique:users,email,' . $this->id],
			'password' => ['confirmed'],
			'password_confirmation' => ['required_with:password', 'same:password'],
		];
	}

}
