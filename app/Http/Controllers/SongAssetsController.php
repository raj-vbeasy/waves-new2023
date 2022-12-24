<?php

namespace App\Http\Controllers;

use App\Song;
use App\SongAssets;
use App\User;
use App\Traits\GoogleClient;
use App\Traits\InformAdmin;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Google_Service_Drive;

class SongAssetsController extends Controller
{
	use GoogleClient,
        InformAdmin;

	/**
	 * Display a listing of the resource.
	 *
	 * @return View
	 */
    final public function index(): View
    {
    	$songs = auth()->user()->songs()->with('assets')->has('assets')->get();
        return view('songs.assets.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
	    $songs = auth()->user()->songs()->with('assets')->get();
	    return view('songs.assets.create', compact('songs'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return RedirectResponse
	 * @throws Exception
	 */
    final public function store(Request $request): JsonResponse
    {
    	if ($songId = $request->get('song_id')) {
    		$song = Song::find($songId);
    		if ($song) {
				try {
					$service = new Google_Service_Drive($this->googleApi());
					$results = $service->files->listFiles([
						'pageSize' => 10,
						'fields' => 'nextPageToken, files(id)',
						'q' => '"' . auth()->user->song_folder_id . '" in parents and trashed = false'
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
    			$insertArr = [];
    			if ($file = $request->file('full_track')) {
    				$insertArr['full_track'] = $this->createFileOrFolder(
    					$song->name.' - Full Track - ' . $file->getClientOriginalName(),
					    '',
					    auth()->user()->song_folder_id,
					    '',
					    [
						    'data' => file_get_contents($file->getRealPath()),
						    'mimeType' => $file->getMimeType(),
						    'uploadType' => 'resumable'
					    ]
				    );
			    }

			    if ($file = $request->file('instrumental')) {
				    $insertArr['instrumental'] = $this->createFileOrFolder(
					    $song->name.' - Instrumental - ' . $file->getClientOriginalName(),
					    '',
					    auth()->user()->song_folder_id,
					    '',
					    [
						    'data' => file_get_contents($file->getRealPath()),
						    'mimeType' => $file->getMimeType(),
						    'uploadType' => 'resumable'
					    ]
				    );
			    }

			    if ($file = $request->file('clean')) {
				    $insertArr['clean'] = $this->createFileOrFolder(
					    $song->name.' - Clean - ' . $file->getClientOriginalName(),
					    '',
					    auth()->user()->song_folder_id,
					    '',
					    [
						    'data' => file_get_contents($file->getRealPath()),
						    'mimeType' => $file->getMimeType(),
						    'uploadType' => 'resumable'
					    ]
				    );
			    }

			    if ($file = $request->file('steam')) {
				    $insertArr['steam'] = $this->createFileOrFolder(
					    $song->name.' - Steam - ' . $file->getClientOriginalName(),
					    '',
					    auth()->user()->song_folder_id,
					    '',
					    [
						    'data' => file_get_contents($file->getRealPath()),
						    'mimeType' => $file->getMimeType(),
						    'uploadType' => 'resumable'
					    ]
				    );
			    }

			    $song->assets()->create($insertArr);

                $this->userActivity(
                    'Added song assets',
                    auth()->user()->name . ' added assets for song "' . $song->name . '"',
                    array_map([$this, 'formatKey'], array_keys($insertArr)),
                    $this->createLink('folders', auth()->user()->song_folder_id)
                );
		    }
	    }

	    return response()->json(['status' => true]);
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 * @return Application|Factory|RedirectResponse|Response|View
	 */
    final public function edit($id)
    {
    	if ($assets = SongAssets::find($id)) {
		    return view('songs.assets.edit', compact('assets'));
	    }

    	return redirect()->back();
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param int $id
	 * @return RedirectResponse
	 * @throws Exception
	 */
    public function update(Request $request, $id): JsonResponse
    {
        set_time_limit(300000);
	    if ($asset = SongAssets::find($id)) {
			$songId = $asset->song->id;
            $song = Song::find($songId);
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
	    	$updateArr = [];
			if ($file = $request->file('full_track')) {
				$updateArr['full_track'] = $this->createFileOrFolder(
					$song->name.' - Full Track - ' . $file->getClientOriginalName(),
					'',
					auth()->user()->song_folder_id,
					'',
					[
						'data' => file_get_contents($file->getRealPath()),
						'mimeType' => $file->getMimeType(),
						'uploadType' => 'resumable'
					]
				);
				if (!empty($asset->full_track)) {
					try {
						$this->deleteFileOrFolder($asset->full_track);
					} catch(\Google\Service\Exception | \Exception $e){}
				}
			}

			if ($file = $request->file('instrumental')) {
				$updateArr['instrumental'] = $this->createFileOrFolder(
					$song->name.' - Instrumental - ' . $file->getClientOriginalName(),
					'',
					auth()->user()->song_folder_id,
					'',
					[
						'data' => file_get_contents($file->getRealPath()),
						'mimeType' => $file->getMimeType(),
						'uploadType' => 'resumable'
					]
				);
				if (!empty($asset->instrumental)) {
					try {
						$this->deleteFileOrFolder($asset->instrumental);
					} catch(\Google\Service\Exception | \Exception $e){}
				}
			}

			if ($file = $request->file('clean')) {
				$updateArr['clean'] = $this->createFileOrFolder(
					$song->name.' - Clean - ' . $file->getClientOriginalName(),
					'',
					auth()->user()->song_folder_id,
					'',
					[
						'data' => file_get_contents($file->getRealPath()),
						'mimeType' => $file->getMimeType(),
						'uploadType' => 'resumable'
					]
				);
				if (!empty($asset->clean)) {
					try {
						$this->deleteFileOrFolder($asset->clean);
					} catch(\Google\Service\Exception | \Exception $e){}
				}
			}

			if ($file = $request->file('steam')) {
				$updateArr['steam'] = $this->createFileOrFolder(
					$song->name.' - Steam - ' . $file->getClientOriginalName(),
					'',
					auth()->user()->song_folder_id,
					'',
					[
						'data' => file_get_contents($file->getRealPath()),
						'mimeType' => $file->getMimeType(),
						'uploadType' => 'resumable'
					]
				);

				if (!empty($asset->steam)) {
					try {
						$this->deleteFileOrFolder($asset->steam);
					} catch(\Google\Service\Exception | \Exception $e){}
				}
			}

			$asset->update($updateArr);

            $this->userActivity(
                'Updated song assets',
                auth()->user()->name . ' updated assets for song "' . $asset->song->name . '"',
                array_map([$this, 'formatKey'], array_keys($updateArr)),
                $this->createLink('folders', auth()->user()->song_folder_id)
            );
	    }

	    return response()->json(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    private function formatKey($str)
    {
        return ucwords(str_ireplace('_', ' ', $str));
    }
}
