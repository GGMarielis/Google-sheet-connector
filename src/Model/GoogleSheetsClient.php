<?php

require __DIR__ . '/../../vendor/autoload.php';
include __DIR__ . '/../../config/app.php';

class GoogleSheetsClient
{
    /**
     * GoogleApiClient getClient
     * Returns an authorized API client.
     * @return Google_Service_Sheets the authorized client object
     * @throws \Google_Exception
     */
    public static function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Sheets API PHP Quickstart');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);

        $client->setAuthConfig(__DIR__ . '/../../config/credentials.json');

        $client->setAccessType('offline');
        $accessToken = json_decode(file_get_contents(__DIR__ . '/../../config/token.json'), true);
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());

            $client->setAccessToken($client->getAccessToken());
        }

        return new Google_Service_Sheets($client);
    }

    /**
     * @param string $sheetId
     * @param string $sheetName
     * @param string $sheetRange
     * @return array
     * @throws \Google_Exception
     */
    public static function getSheetValues(string $sheetId, string $sheetName, string $sheetRange)
    {
        try {
            $googleClient = self::getClient();
        } catch (\Google_Exception $e) {
            return [];
        }
    
        $range = "$sheetName!$sheetRange";
        $response = $googleClient->spreadsheets_values->get($sheetId, $range);
        return $response->getValues();
    }
}
