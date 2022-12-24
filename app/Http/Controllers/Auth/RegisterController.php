<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\GoogleClient;
use App\User;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, GoogleClient;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param array $data
	 * @return User
	 * @throws Exception
	 */
    protected function create(array $data)
    {
        $folder_id = $this->createFileOrFolder(
            $data['name'],
            'application/vnd.google-apps.folder',
            '',
            $data['email']
        ) ?? '';
        $this->createFileOrFolder(
            $data=['name'],
            'application/vnd.google-apps.spreadsheet',
            $folder_id,
            $data['email'],
            [],
            false,
            true
        ) ?? '';
        $song_folder_id = $this->createFileOrFolder(
            'Song Assets',
            'application/vnd.google-apps.folder',
            $folder_id,
            $data['email'],
            [],
            false,
            true
        ) ?? '';
        $sheet_id = $this->createFileOrFolder(
            auth()->user()->name,
            'application/vnd.google-apps.spreadsheet',
            $folder_id,
            $data['email'],
            [],
            false,
            true
        ) ?? '';

        $tokenPath = storage_path('token.json');
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        Sheets::setAccessToken($accessToken)->spreadsheet($sheet_id);

        $lists = Sheets::sheetList();
        $rand = rand(100000, 999999);
        Sheets::addSheet($rand);
        foreach ($lists as $list) {
            Sheets::deleteSheet($list);
        }
        Sheets::addSheet('Splits');
        Sheets::deleteSheet($rand);
    	return User::create(
		    [
                'name' => $data['name'],
			    'email' => $data['email'],
			    'password' => Hash::make($data['password']),
			    'folder_id' => $folder_id,
			    'song_folder_id' => $song_folder_id,
                'sheet_id' => $sheet_id,
		    ]
	    );
    }
}
