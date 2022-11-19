<?php

namespace App\Http\Controllers;

use App\Http\Client\ApiClient;
use App\Mail\LatestPostsMail;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    public function latestMail()
    {
        $latest = $this->api->latestPostsPerUser();
        $message = Mail::to('user.name@example.com')->send(new LatestPostsMail($latest));
    }
}
