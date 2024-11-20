<?php


use Green\Library\FormValidator;

// Only allow post requests

allow_only_method('POST');


$validator = new FormValidator($_POST);


$validator->rules([
    'email' => ['required', 'email'],
    'password' => ['required', 'minlength:6'],
]);


if (!$validator->validate()) {
    $validator->saveOldData(['password']);
    flash('danger', $validator->getErrorsText());
    redirect_back();
}


$data = $validator->getValidatedData();

$db = db();

$user = $db->select(['id', 'password'])->from('users')->where('email', '=', $data['email'])->execute()->fetch();

if (!$user) {
    $validator->saveOldData(['password']);
    flash('danger', 'No user found for the provided email');
    redirect_back();
}

if (!password_verify($data['password'], $user['password'])) {
    $validator->saveOldData(['password']);
    flash('danger', 'Invalid password provided.');
    redirect_back();
}

$_SESSION['user_id'] = $user['id'];
flash('success', 'Logged in successfully');
redirect('/');
