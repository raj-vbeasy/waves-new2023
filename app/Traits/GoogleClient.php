<?php

namespace App\Traits;

use Exception;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_Drive_Permission;

trait GoogleClient
{
	/**
	 * @throws Exception
	 *
	 * @return Google_Client
	 */
	final public function googleApi()
	{
		$client = new Google_Client();
		$client->setApplicationName('Google Drive API');
		$client->setScopes(Google_Service_Drive::DRIVE);
		$client->setAuthConfig(storage_path('credentials.json'));
		$client->setAccessType('offline');
		$client->setPrompt('select_account consent');

		// Load previously authorized token from a file, if it exists.
		// The file token.json stores the user's access and refresh tokens, and is
		// created automatically when the authorization flow completes for the first
		// time.
		$tokenPath = storage_path('token.json');
		if (file_exists($tokenPath)) {
			$accessToken = json_decode(file_get_contents($tokenPath), true);
			$client->setAccessToken($accessToken);
		}

		// If there is no previous token or it's expired.
		if ($client->isAccessTokenExpired()) {
			// Refresh the token if possible, else fetch a new one.
			if ($client->getRefreshToken()) {
				$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
			} else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
			// Save the token to a file.
			if (!file_exists(dirname($tokenPath))) {
				mkdir(dirname($tokenPath), 0700, true);
			}
			file_put_contents($tokenPath, json_encode($client->getAccessToken()));
		}
		return $client;
	}

    /**
     * @param string $keyword
     * @param string $type
     * @param string $parentId
     * @param string $email
     * @param array $fileData
     * @param bool $duplicate
     * @param bool $removeDuplicate
     *
     * @throws Exception
     */
	final function createFileOrFolder(string $keyword, string $type, string $parentId = '', string $email = '', array $fileData = [], bool $duplicate = true, bool $removeDuplicate = false)
	{
		if (empty($parentId)) {
			$parentId = '1mfRUIWH5QokZIvQXUcjGyJp5Zi-0H7AT';//config('services.drive_id');
		}
		$service = new Google_Service_Drive($this->googleApi());
		$results = $service->files->listFiles(
			[
				'pageSize' => 10,
				'fields' => 'nextPageToken, files(id, name)',
				'q' => '"' . $parentId . '" in parents and name = "' . $keyword . '" and trashed = false'
			]
		);
		$total = count($results->getFiles());
		if ($total > 0) {
			if ($duplicate === false) {
				foreach ($results->getFiles() as $file) {
				    if ($removeDuplicate === true) {
						$this->deleteFileOrFolder($file->getId());
					} else {
                        return $file->getId();
                    }
				}
			}
			if ($removeDuplicate === false) {
                $keyword = $keyword . ' ' . ($total + 1);
            }
		}
		$metaData = new Google_Service_Drive_DriveFile();
		$metaData->setName($keyword);
		if (!empty($type)) {
			$metaData->setMimeType($type);
		}
		$metaData->setParents([$parentId]);

		if (!empty($email)) {
			$permission = new Google_Service_Drive_Permission();
			$permission->setType('user');
			$permission->setEmailAddress($email);
			$permission->setRole('reader');

			$metaData->setPermissions($permission);
		}

		$optParams = ['fields' => 'id'];
		if (!empty($fileData)) {
			$optParams = array_merge($optParams, $fileData);
		}
		$folder = $service->files->create($metaData, $optParams);
		return $folder->id;
	}

	/**
	 * @param string $fileId
	 * @param string $name
	 * @return bool
	 * @throws Exception
	 */
	final public function updateFileOrFolder(string $fileId, string $name): bool
	{
		$service = new Google_Service_Drive($this->googleApi());

		$metaData = new Google_Service_Drive_DriveFile();
		$metaData->setName($name);

		$service->files->update($fileId, $metaData);
		return true;
	}

	final public function deleteFileOrFolder(string $fileId): bool
	{
		$service = new Google_Service_Drive($this->googleApi());
		$service->files->delete($fileId);
		return true;
	}

	final public function createLink($type, $id)
    {
        return "https://drive.google.com/drive/u/2/{$type}/{$id}";
    }
}