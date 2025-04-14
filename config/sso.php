<?php
return [
  'client_id' => env('OAUTH2_CLIENT_ID', 'VpUTzadVVbdznKYRGTWEGTtzO'),
  'client_secret' => env('OAUTH2_CLIENT_SECRET', 'Qp4halfxicZnkVlnXIyJItuEsNXXTB'),
  'redirect_uri' => env('OAUTH2_REDIRECT_URI', 'http://localhost:8080/login/callback'),
  'scope' => env('OAUTH2_SCOPE'),
  'apps_url' => env('SSO_APPS_URL', 'http://sso.itera.ac.id/'),
];

?>
