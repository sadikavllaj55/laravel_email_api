<?php

namespace App\Http\Controllers;

use App\Mail\LatestPostsMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return new JsonResponse(array_values($this->api->posts()));
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        $post_list = $this->api->posts();

        return new JsonResponse($post_list[$id]);
    }

    public function latestMail(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);
        } catch (ValidationException $e) {
            return new JsonResponse($e->errors(), $e->status);
        }
        $recipient = $request->query('email');

        $latest = $this->api->latestPostsPerUser();
        $message = Mail::to($recipient)->send(new LatestPostsMail($latest));

        if ($message !== null) {
            return new JsonResponse(['message' => 'An email was sent with the latest posts']);
        } else {
            return new JsonResponse(['message' => 'Email could not be sent', 400]);
        }
    }
}
