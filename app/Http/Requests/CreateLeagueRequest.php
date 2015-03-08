<?php namespace Fantasee\Http\Requests;

use Fantasee\Http\Requests\Request;

class CreateLeagueRequest extends Request {

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
			'league_id' => ['required', 'unique:leagues,league_id']
		];
	}

}
