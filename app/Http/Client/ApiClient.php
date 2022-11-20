<?php

namespace App\Http\Client;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class ApiClient
{
    public function latestPostsPerUser(): array
    {
        $response_users = Http::get('https://jsonplaceholder.typicode.com/users');
        $all_users = $response_users->json();

        $response_posts = Http::get('https://jsonplaceholder.typicode.com/posts');
        $all_posts = $response_posts->json();

        $result = [];

        foreach ($all_users as &$user){
            $user_model = User::fromArray($user);
            $i = 0;
            foreach ($all_posts as $p)
            {
                $post = new Post();
                $post->id = $p['id'];
                $post->title = $p['title'];
                $post->body = $p['body'];
                $post->author_id = $p['userId'];

                if ($i == 3) {
                    break;
                }

                if ($user_model->id == $post->author_id)
                {
                    $user_model->posts[] = $post;
                    $i++;
                }
            }

            $result[] = $user_model;
        }

        return $result;
    }

    public function users(): array {
        $response_users = Http::get('https://jsonplaceholder.typicode.com/users');
        $users = $response_users->json();

        $result = [];

        foreach ($users as $user) {
            $result[$user['id']] = User::fromArray($user);
        }

        return $result;
    }

    public function posts(): array {
        $response_posts = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = $response_posts->json();

        $result = [];

        foreach ($posts as $post) {
            $p = new Post();
            $p->id = $post['id'];
            $p->title = $post['title'];
            $p->body = $post['body'];
            $p->author_id = $post['userId'];
            $result[$p->id] = $p;
        }

        return $result;
    }
}
