<!DOCTYPE html>
<html lang="it-IT">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
      <img src="{{ asset('assets/media/logos/logo-light.png') }}">
      <br>

      {!! $data['body'] !!}
      <br><br>
      {!! __('messages.email_signature') !!}

  </body>
</html>
