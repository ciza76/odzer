<?php

namespace Model;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Photo class
 */
class Photo
{
	
	use Model;

	protected $table = 'photos';
	protected $primaryKey = 'id';
	protected $loginUniqueColumn = 'id';

	protected $allowedColumns = [

		'user_id',
		'title',
		'image',
		'image1',
		'image2',
		'image3',
		'date_created',
		'date_updated',
	];

	/*****************************
	 * 	rules include:
		required
		alpha
		email
		numeric
		unique
		symbol
		longer_than_8_chars
		alpha_numeric_symbol
		alpha_numeric
		alpha_symbol
	 * 
	 ****************************/
	protected $onInsertValidationRules = [

		'title' => [
			'alpha_numeric_symbol',
			'required',
		]
	];

	protected $onUpdateValidationRules = [

		'title' => [
			'alpha_numeric_symbol',
			'required',
		]
	];

}