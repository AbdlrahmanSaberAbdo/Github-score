<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
class GithubUserController extends Controller
{
    public function getUserScore($username) {
        // get data from api
        $user_infos = Http::get('https://api.github.com/users/'.$username.'/events/public');
        $user_infos = $user_infos->json();
        $score = 0; 

        // loop throw user info
        foreach($user_infos as $user_info) {
            if($user_info['type'] === "PushEvent") // PushEvent case
                $score+=10;
            else if($user_info['type'] === "PullRequestEvent") // pullRequestEvent case
                $score+=5;
            else if($user_info['type'] === "IssueCommentEvent") // IssueCommentEvent case
                $score+=4;
            else // other event case
                $score+=1;
        }

        if($score == 0)
            return 'No events founded !';
            
        return $score;
    }
}
