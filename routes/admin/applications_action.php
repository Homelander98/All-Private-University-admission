<?php


allow_only_method('POST');


if (!is_admin()) {
    flash('danger', 'Only admins can access this page.');
    redirect('/');
}

$id = (int) $_POST['id'];

$status = (int) $_POST['status'];


if (!$id) {
    fatal_server_error('No id provided', 'The id must be provided in the POST request');
}

$db = db();
$application = $db->select(['id'])->from('applications')->where('id', '=', $id)->execute()->fetch();


if (!$application) {
    fatal_server_error('No such application', 'The provided application wasn\'t found.', 404);
}

$db->update(['status' => $status])->table('applications')->where('id', '=', $id)->execute();


flash('success', 'Application status changed successfully');
redirect_back();
