<?php

/**
 * @param string $variable
 * @return array|string
 */
function getConfigGoogleSheet(string $variable = '') {
    if ($variable === 'token') {
        return [
            "access_token" => file_get_contents(__DIR__.'/../resources/accessToken.txt'),
            "token_type" => "Bearer",
            "expires_in"=> 3600,
            "refresh_token" => file_get_contents(__DIR__.'/../resources/refreshToken.txt'),
        ];
    } else {
        return [
            'web' => [
                "client_id" =>  file_get_contents(__DIR__.'/../resources/clientId.txt'),
                "project_id" =>  file_get_contents(__DIR__.'/../resources/projectId.txt'),
                "auth_uri"  =>  "https://accounts.google.com/o/oauth2/auth",
                "token_uri" =>  "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" =>  "https://www.googleapis.com/oauth2/v1/certs",
                "client_secret" => file_get_contents(__DIR__.'/../resources/clientSecret.txt'),
                "redirect_uris" => [
                    "http://localhost:8080",
                ],
            ]
        ];
    }
}
