<?php

namespace App\Http\Controllers;

use App\SocialLink;
use App\Traits\GoogleClient;
use App\Traits\InformAdmin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialLinkController extends Controller
{
    use InformAdmin,
        GoogleClient;

    final public function index(): View
    {
    	$socialLinks = auth()->user()->socialLinks;
    	return view('social-links', compact('socialLinks'));
    }

    final public function save(Request $request): RedirectResponse
    {
    	$arr = array_filter($request->only((new SocialLink())->getFillable()));
    	if (empty($arr)) {
    	    return redirect()->route('social-links');
        }
    	if (auth()->user()->socialLinks) {
		    auth()->user()->socialLinks()->update($arr);
            $subject = 'Updated Social Links';
            $heading = auth()->user()->name . ' updated social links';
	    } else {
		    auth()->user()->socialLinks()->create($arr);
            $subject = 'Added Social Links';
            $heading = auth()->user()->name . ' added social links';
	    }

        $this->userActivity($subject, $heading, [], null);

        $pdf = \PDF::setOptions(['defaultFont' => 'sans-serif'])
            ->loadView('emails.social-links', ['socialLinks' => auth()->user()->socialLinks()->first()])
            ->stream('test.pdf');

        $this->createFileOrFolder(
            'Social Links',
            '',
            auth()->user()->folder_id,
            '',
            [
                'data' => $pdf,
                'mimeType' => 'application/pdf',
                'uploadType' => 'resumable'
            ],
            false,
            true
        );

    	return redirect()->route('thank-you');
    }

}
