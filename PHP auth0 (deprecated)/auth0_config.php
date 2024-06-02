<?php
// auth0_config.php

return [
    'domain' => 'your-auth0-domain',
    'client_id' => 'your-client-id',
    'client_secret' => 'your-client-secret',
    'redirect_uri' => 'http://localhost/callback.php',
    'audience' => 'https://your-auth0-api-audience',
    'scope' => 'openid profile email',
];
?>
