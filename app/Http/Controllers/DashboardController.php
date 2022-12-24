<?php

namespace App\Http\Controllers;

use App\Traits\GoogleClient;
use App\Traits\InformAdmin;
use App\User;
use Illuminate\Http\Request;
use Google_Service_Drive;
use Revolution\Google\Sheets\Facades\Sheets;

class DashboardController extends Controller
{
    use GoogleClient,
    InformAdmin;

    public function index()
    {
        try {
            $service = new Google_Service_Drive($this->googleApi());
            $results = $service->files->listFiles([
                'pageSize' => 10,
                'fields' => 'nextPageToken, files(id)',
                'q' => '"' . auth()->user()->folder_id . '" in parents and trashed = false'
            ]);
            if (count($results->getFiles()) == 0) {
                auth()->user()->update(['folder_id' => $this->createFileOrFolder(
                        auth()->user()->name,
                        'application/vnd.google-apps.folder',
                        '',
                        auth()->user()->email
                    ) ?? '']);
                $user = User::find(auth()->user()->id);
                auth()->login($user);
                $this->createFileOrFolder(
                    auth()->user()->name,
                    'application/vnd.google-apps.spreadsheet',
                    auth()->user()->folder_id,
                    auth()->user()->email,
                    [],
                    false,
                    true
                ) ?? '';
            }
        } catch(\Google\Service\Exception | \Exception $e){
            auth()->user()->update(['folder_id' => $this->createFileOrFolder(
                    auth()->user()->name,
                    'application/vnd.google-apps.folder',
                    '',
                    auth()->user()->email
                ) ?? '']);
            $user = User::find(auth()->user()->id);
            auth()->login($user);
            $this->createFileOrFolder(
                auth()->user()->name,
                'application/vnd.google-apps.spreadsheet',
                auth()->user()->folder_id,
                auth()->user()->email,
                [],
                false,
                true
            ) ?? '';
        }

        try {
            $service = new Google_Service_Drive($this->googleApi());
            $results = $service->files->listFiles([
                'pageSize' => 10,
                'fields' => 'nextPageToken, files(id)',
                'q' => '"' . auth()->user()->song_folder_id . '" in parents and trashed = false'
            ]);
            if (count($results->getFiles()) == 0) {
                auth()->user()->update(['song_folder_id' => $this->createFileOrFolder(
                    'Song Assets',
                    'application/vnd.google-apps.folder',
                    auth()->user()->folder_id,
                    auth()->user()->email,
                    [],
                    false,
                    true
                ) ?? '']);
                $user = User::find(auth()->user()->id);
                auth()->login($user);
            }
        } catch(\Google\Service\Exception | \Exception $e){
            auth()->user()->update(['song_folder_id' => $this->createFileOrFolder(
                'Song Assets',
                'application/vnd.google-apps.folder',
                auth()->user()->folder_id,
                auth()->user()->email,
                [],
                false,
                true
            ) ?? '']);
            $user = User::find(auth()->user()->id);
            auth()->login($user);
        }

        try{
            if(empty(auth()->user()->sheet_id)) {
                auth()->user()->update(['sheet_id' => $this->createFileOrFolder(
                    auth()->user()->name,
                    'application/vnd.google-apps.spreadsheet',
                    auth()->user()->folder_id,
                    auth()->user()->email,
                    [],
                    false,
                    true
                ) ?? '']);
                $user = User::find(auth()->user()->id);
                auth()->login($user);
                $tokenPath = storage_path('token.json');
                $accessToken = json_decode(file_get_contents($tokenPath), true);
                Sheets::setAccessToken($accessToken)->spreadsheet(auth()->user()->sheet_id);

                $lists = Sheets::sheetList();
                $rand = rand(100000, 999999);
                Sheets::addSheet($rand);
                foreach ($lists as $list) {
                    Sheets::deleteSheet($list);
                }
                Sheets::addSheet('Splits');
                Sheets::deleteSheet($rand);
            } else {
                $tokenPath = storage_path('token.json');
                $accessToken = json_decode(file_get_contents($tokenPath), true);
                $result = Sheets::setAccessToken($accessToken)->spreadsheet(auth()->user()->sheet_id)->sheet('')->all();
                //printf("%d ranges retrieved.", count($result->getValueRanges()));
                //return $result;
            }
        } catch(\Google\Service\Exception | \Exception $e) {
            auth()->user()->update(['sheet_id' => $this->createFileOrFolder(
                auth()->user()->name,
                'application/vnd.google-apps.spreadsheet',
                auth()->user()->folder_id,
                auth()->user()->email,
                [],
                false,
                true
            ) ?? '']);
            $user = User::find(auth()->user()->id);
            auth()->login($user);
            $tokenPath = storage_path('token.json');
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            Sheets::setAccessToken($accessToken)->spreadsheet(auth()->user()->sheet_id);

            $lists = Sheets::sheetList();
            $rand = rand(100000, 999999);
            Sheets::addSheet($rand);
            foreach ($lists as $list) {
                Sheets::deleteSheet($list);
            }
            Sheets::addSheet('Splits');
            Sheets::deleteSheet($rand);
        }
    	return view('dashboard');
    }

    public function thanks()
    {
        return view('thank-you');
    }
}
