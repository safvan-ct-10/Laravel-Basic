<?php

use App\Models\User;

function userNotifications() {
    $new_users = [];
    $new_users = User::where('is_open', '0')->get();
    return $new_users;
}
