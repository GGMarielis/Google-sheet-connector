<?php

include __DIR__ . '/../../config/app.php';

class GoogleSheetsClient
{
    /**
     * Config
     */
    const CONFIG_TYPE = 'token';
    const ACCESS_TYPE = 'offline';

    /**
     * GoogleApiClient getClient
     * Returns an authorized API client.
     * @return Google_Service_Sheets the authorized client object
     * @throws \Google_Exception
     */
    public static function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName(getAppName());
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);

        $client->setAuthConfig(__DIR__ . '/../../config/credentials.json');

        $client->setAccessType(self::ACCESS_TYPE);
        $accessToken = getConfigGoogleSheet(self::CONFIG_TYPE);

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
