<?php

namespace App\Http\Permissions;

class Admin
{
    const CREATE_ADMINS = [1];
    const GRANT_ADMIN_PERMISSIONS = [2];
    const RESET_ADMIN_PASSWORDS = [3];
    const DELETE_ADMINS = [4];
    const VIEW_ADMINS = [5];
    const ADMIN_USER_TOOL_PERMISSIONS = [1, 2, 3, 4, 5];
    const VIEW_REPORTED_POSTS = [6];
    const RESOLVE_REPORTED_POSTS = [7];
    const VIEW_POSTERS = [8];
    const VIEW_POSTER_REQUESTS = [9];
    const RESOLVE_POSTER_REQUESTS = [10];
    const VIEW_APP_STATS = [11];
}