{{-- resources/emails/password.blade.php --}}
パスワードをリセットするためにリンクをクリックしてください。 {{ url('password/reset/'.$token) }}