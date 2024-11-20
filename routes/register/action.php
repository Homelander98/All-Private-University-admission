<?php


use Green\Library\FormValidator;

// Only allow post requests

allow_only_method('POST');


$validator = new FormValidator($_POST);

$validator->rules([
    'email' => ['required', 'email', function ($field, $value) {
        $db = db();

        $exists = $db->select(['id'])
        ->from('users')
        ->where('email', '=', $value)
        ->execute()
        ->fetch();

        if ($exists) {
            $this->addError($field, "Email already exists");
        }
    }],
    'name' => ['required', 'maxlength:100'],
    'password' => ['required', 'minlength:6'],
    'gender' => ['required', 'either:0,1']
]);


if (!$validator->validate()) {
    $validator->saveOldData(['password']);
    flash('danger', $validator->getErrorsText());
    redirect_back();
}

$data = $validator->getValidatedData();

$time = time();

// Hash the password
$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
$data['created_at'] = $time;
$data['updated_at'] = $time;
$data['role'] = 3;


$db = db();
$id = $db->insert(array_keys($data))->into('users')->values(array_values($data))->execute();


$_SESSION['user_id'] = $id;
flash('success', 'Account created successfully!');
redirect('/');
