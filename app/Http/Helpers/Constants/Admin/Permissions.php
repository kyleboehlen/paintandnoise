<?php

namespace App\Http\Helpers\Constants\Admin;

class Permissions
{
    // Admin Users Tool
    const CREATE_ADMIN = 1;
    const GRANT_PERMISSIONS = 2;
    const RESET_PASSWORD = 3;
    const DELETE_ADMIN = 4;
    const VIEW_ADMIN = 5;

    // Reported Posts Tool
    const VIEW_REPORTED_POSTS = 6;
    const RESOLVE_REPORTED_POSTS = 7;

    // Posters Tool
    const VIEW_POSTERS = 8;
    const VIEW_POSTERS_REQUESTS = 9;
    const RESOLVE_POSTERS_REQUESTS = 10;

    // Stats Tool
    const VIEW_APP_STATS = 11;

    // FAQ Tool
    const MANAGE_FAQS = 12;
}