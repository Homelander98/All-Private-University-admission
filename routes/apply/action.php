<?php

use Green\Library\FormValidator;

// Check if the user is logged in
if (!is_logged()) {
    flash('warning', 'Please login first to apply.');
    redirect('login');
}


$unis = implode(',', array_keys(get_universities()));

$depts = implode(',', array_keys(get_departments()));




// Form Validator
$validator = new FormValidator($_POST);

$validator->rules([
    'name' => ['required', 'maxlength:255'],
    'fathers_name' => ['required', 'maxlength:255'],
    'mothers_name' => ['required', 'maxlength:255'],
    'nationality' => ['required', 'maxlength:100'],
    'phone' => ['required'],
    'email' => ['required', 'email'],
    'present_address' => ['required', 'maxlength:1000'],
    'permanent_address' => ['required', 'maxlength:1000'],
    'university' => ['required', "either:{$unis}"],
    'department' => ['required', "either:{$depts}"],
    'id_card' => ['file', 'filesize:10', 'extensions:png,jpg,jpeg,webp,bmp,gif'],
    'birth_certificate' => ['file', 'filesize:10', 'extensions:png,jpg,jpeg,webp,bmp,gif'],
    'ssc_marksheet' => ['file', 'filesize:10', 'extensions:png,jpg,jpeg,webp,bmp,gif'],
    'hsc_marksheet' => ['file', 'filesize:10', 'extensions:png,jpg,jpeg,webp,bmp,gif'],
]);


// Validate the form input
if (!$validator->validate()) {
    flash('danger', $validator->getErrorsText());

    $validator->saveOldData();
    redirect_back();
}



$application = $validator->getValidatedData();

$attachments = $validator->getValidatedFiles();


foreach ($attachments as $key => $file) {
    $application[$key] = upload_attachment($file);
}

$application['user_id'] = get_logged_user()['id'];

$application['created_at'] = time();
$application['updated_at'] = time();


$db = db();


$id = $db->insert(array_keys($application))->into('applications')->values(array_values($application))->execute();

flash('success', 'Application submitted successfully!');
redirect('/dashboard');
