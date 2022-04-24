<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Exception;

class CommentController extends Controller
{
    public function __construct(protected UserService $service) {}

}
