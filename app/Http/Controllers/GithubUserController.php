<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class GithubUserController extends Controller
{
    //
    public function getUsers($username) {
        $response = Http::get('https://api.github.com/users/'.$username);
        return $response;
    }
}
