<?php

allow_only_method('POST');

unset($_SESSION['user_id']);

session_regenerate_id();

flash('info', 'Logged out successfully');
redirect('/');
