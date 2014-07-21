<?php

class Creditcard extends AppModel{
	
	public $name = "Creditcard";
	public $useTable = "creditcards";
	
	public 	$validate = array(
			'cardnumber' => array(
					'required' => array(
							'rule' => array("notEmpty"),
							'message' => "Card Number es obligatorio."
					),
					'isUnique' => array(
							'rule' => 'isUnique',
							'message' => 'Card Number in use, verify.'
					)
			),
			'expirationdate_month' => array(
					'required' => array(
							'rule' => array("notEmpty"),
							'message' => "Expiration Month is required."
					)
			),
			'expirationdate_year' => array(
					'required' => array(
							'rule' => array("notEmpty"),
							'message' => "Expiration Year is required."
					)
			),
			'securitycode' => array(
					'required' => array(
							'rule' => array("notEmpty"),
							'message' => "Security Code is required."
					)
			)
	);
	
	public $belongsTo = array(
			'User' => array(
					'className' => 'User',
					'foreignKey' => 'user_id'
			)
	);
	
}