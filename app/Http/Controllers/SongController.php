<?php

namespace App\Http\Controllers;

use App\Song;
use App\Traits\GoogleClient;
use App\Traits\InformAdmin;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SongController extends Controller
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
    	$songs = auth()->user()->songs;
        return view('songs.index', compact('songs'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return View
	 */
    final public function create(): View
    {
    	$nextSongNum = auth()->user()->songs->count() + 1;
    	$songs = auth()->user()->songs;
        return view('songs.create', compact('nextSongNum', 'songs'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return RedirectResponse
	 * @throws Exception
	 */
    final public function store(Request $request): RedirectResponse
    {
    	$addedSongs = auth()->user()->songs->pluck('name')->toArray();
    	$newSongs = [];
    	if ($songs = array_filter($request->get('songs'))) {
    		$arr = [];
    		foreach ($songs as $song) {
    			if (!in_array($song, $addedSongs) && !(in_array($song, $newSongs))) {
				    $arr[] = [
					    'name' => $song,
					    // 'folder_id' => $this->createFileOrFolder(
						//     $song,
						//     'application/vnd.google-apps.folder',
						//     auth()->user()->folder_id
					    // )
				    ];
				    $newSongs[] = $song;
			    }
		    }

    		auth()->user()->songs()->createMany($arr);

            $this->userActivity(
                'Added songs',
                auth()->user()->name . ' added ' . count($songs) . ' song' . (count($songs) > 1 ? 's' : ''),
                $songs,
                $this->createLink('folders', auth()->user()->folder_id)
            );
	    }

    	return redirect()->route('songs.create');
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Song $song
	 * @return View
	 */
    final public function edit(Song $song): View
    {
        return view('songs.edit', compact('song'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param Song $song
	 * @return RedirectResponse
	 * @throws Exception
	 */
    final public function update(Request $request, Song $song): RedirectResponse
    {
    	if ($name = $request->get('song')) {
		    $this->updateFileOrFolder($song->folder_id, $name);
		    $song->update(['name' => $name]);
	    }
        return redirect()->route('songs.index');
    }
}
