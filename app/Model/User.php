<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('Notification', 'NotificationManager.Model');

class User extends AppModel{
	
	public $name = "User";
	public $useTable = "users";
	
	public 	$validate = array(
			'email' => array(
					'required' => array(
							'rule' => array("notEmpty"),
							'message' => "Email is required."
					),
					'isUnique' => array(
							'rule' => 'isUnique',
							'message' => 'Email in use, verify.'
					)
			),
			'firstname' => array(
					'required' => array(
							'rule' => array("notEmpty"),
							'message' => "First Name is required"
					)
			),
			'lastname' => array(
					'required' => array(
							'rule' => array("notEmpty"),
							'message' => "Lastname is required."
					)
			),
			'password' => array(
					'required' => array(
							'rule' => array("notEmpty"),
							'message' => "Password is required"
					)
			)
	);

	public $hasMany = array(
	    'Notification' => array(
	        'foreignKey' => 'object_id',
	        'conditions' => array(
	            'Notification.model' => 'User'
	        )
	    )
	);
	
	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}
	
	/*function identicalFieldValues($field=array(), $compare_field=null) {
		foreach( $field as $key => $value ):
			$v1 = $value;
			$v2 = $this->data[$this->name][ $compare_field ];
			if($v1 !== $v2):
				return false;
			else:
				continue;
			endif;
		endforeach;
		return true;
	}*/

	//public function notify(){
	public function afterSave($created, $options = array()) {
		$notification = array(
        'model' => 'User', // name of the object model
        'object_id' => $this->id, // id of the object
        'property' => 'email', // property of the object that will be used to notify (ex. email, phone, cell)
        'type' => 'EMAIL', // Type of notification, can be EMAIL, PUSH, or SMS
        'data' => json_encode(array(
            'settings' => 'default', // email settings
            'subject' => 'Welcome!', // email subject
            'template' => 'welcome', // email template
            'emailFormat' => 'html', // email format
            'viewVars' => array( // email vars
                'first_name' => 'Code',
                'last_name' => 'Challenge',
                'email' => 'keyner.peru@gmail.com'
            	)
        	))
    	);

	    try {
	        $NotificationModel = new Notification();
	        $NotificationModel->create();
	        $NotificationModel->save($notification);  
	    } catch (Exception $e) {
	        // failure catch
	    }
	    //return true;
	}
	
}