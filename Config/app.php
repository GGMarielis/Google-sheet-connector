<?php

/**
 * @param string $variable
 * @return array|string
 */
function getConfigGoogleSheet(string $variable = '') {
    if ($variable === 'token') {
        return [
            "access_token" => getenv("GOOGLE_SHEETS_ACCESS_TOKEN"),
            "token_type" => "Bearer",
            "expires_in"=> 3600,
            "refresh_token" => getenv('GOOGLE_SHEETS_REFRESH_TOKEN'),
        ];
    } else {
        return [
            'web' => [
                "client_id" =>  getenv("GOOGLE_SHEETS_CLIENT_ID"),
                "project_id" =>  getenv("GOOGLE_SHEETS_PROJECT_ID"),
                "auth_uri"  =>  "https://accounts.google.com/o/oauth2/auth",
                "token_uri" =>  "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" =>  "https://www.googleapis.com/oauth2/v1/certs",
                "client_secret" =>  getenv("GOOGLE_SHEETS_CLIENT_SECRET"),
                "redirect_uris" => [
                    "http://localhost:8080",
                ],
            ]
        ];
    }
}
