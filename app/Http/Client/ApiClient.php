<?php

namespace App\Http\Client;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    public function latestPostsPerUser()
    {
        $response_users = Http::get('https://jsonplaceholder.typicode.com/users');
        $all_users = $response_users->json();

        $response_posts = Http::get('https://jsonplaceholder.typicode.com/posts');
        $all_posts = $response_posts->json();

        foreach ($all_users as &$user){
            $i = 0;
            if (!array_key_exists('posts', $user)) {
                $user['posts'] = [];
            }
            $user['posts'] = [];
            foreach ($all_posts as $post)
            {
                if ($i == 3) {
                    break;
                }

                if ($user['id'] == $post['userId'])
                {
                    $user['posts'][] = $post;
                    $i++;
                }
            }
        }

        return $all_users;
    }
}
