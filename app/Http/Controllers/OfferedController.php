<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OfferedRepository;

class OfferedController extends Controller
{
    protected $offeredRepository;

    public function __construct(OfferedRepository $offeredRepository)
    {
        $this->offeredRepository = $offeredRepository;
    }


    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->offeredRepository->getAll($input);
        } else {
            return view('final_round.offered_list');
        }
        
    }

    public function destroy($id)
    {
        $this->offeredRepository->deleteSpecific($id);
         $notification = array(
             'message' => 'Offered Candidate Deleted successfully',
             'alert-type' => 'success'
         );
         return redirect()->action('FinalRoundController@index')
             ->with($notification);
    }
}
