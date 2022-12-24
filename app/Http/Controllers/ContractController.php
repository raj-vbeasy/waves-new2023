<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Traits\GoogleClient;
use App\Traits\InformAdmin;
use App\Traits\SigToSvg;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContractController extends Controller
{
    use InformAdmin,
        GoogleClient,
        SigToSvg;

	/**
	 * Display a listing of the resource.
	 *
	 * @return View
	 */
    final public function index()
    {
    	$contract = auth()->user()->contract;
	    return view('contract.update', compact('contract'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    final public function save(Request $request): RedirectResponse
    {
    	if (auth()->user()->contract) {
		    auth()->user()->contract->update(array_filter($request->only((new Contract())->getFillable())));
            $subject = 'Updated Contract';
            $heading = auth()->user()->name . ' updated contract details';
	    } else {
		    auth()->user()->contract()->create(array_filter($request->only((new Contract())->getFillable())));
            $subject = 'Added Contract';
            $heading = auth()->user()->name . ' added contract details';
	    }

    	$this->userActivity($subject, $heading, [], $this->createLink('folders', auth()->user()->folder_id));

        $contract = auth()->user()->contract()->first();
        $this->setData($contract->sign);
        $er = \PDF::setOptions(['defaultFont' => 'sans-serif'])
            ->loadView('emails.contract', ['signature' => $this->getImage(), 'contract' => $contract])
            ->stream('test.pdf');

        $file = $this->createFileOrFolder(
            'Contract',
            '',
            auth()->user()->folder_id,
            '',
            [
                'data' => $er,
                'mimeType' => 'application/pdf',
                'uploadType' => 'resumable'
            ],
            false,
            true
        );
        return redirect('songs/create');
    }
}
