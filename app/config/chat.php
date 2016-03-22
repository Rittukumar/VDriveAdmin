<?php


/**
 * User table
 *
 * This table should contain the username and password fields specified below. It can contain any other fields, such as "first_name"
 */
 
/**
 * User identifier field
 *
 * This field will usually be "id" or "user_id" but you could use something like "username"
 */
 
 /**
 * Username field
 *
 * This field can be named what ever you like, an example would be "email"
 */
 
 /**
 * Password field
 */
 
 return
    [
    'authentication' => ['user_table' => 'users',
							  'identifier_field' => 'id',
							  'username_field' => 'username',
							  'email_field' => 'email',
							  'password_field' => 'password'
						]
    
];
