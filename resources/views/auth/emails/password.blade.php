Clique no link abaixo para resetar sua senha:

<br><br>

<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">
    {{ $link }}
</a>
