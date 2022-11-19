@component('mail::message')
Latest posts.
@foreach($users as $user)
@component('mail::panel')
<p><strong>{{ $user['name'] }}</strong> has written</p>
<ul>
@foreach($user['posts'] as $post)
    <li>{{ $post['title'] }}</li>
@endforeach
</ul>
@endcomponent
@endforeach
Thanks,<br>
{{ config('app.name') }}
@endcomponent
