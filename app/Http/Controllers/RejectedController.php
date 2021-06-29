<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RejectedRepository;


class RejectedController extends Controller
{
    protected $rejectedRepository;

    public function __construct(RejectedRepository $rejectedRepository)
    {
        $this->rejectedRepository = $rejectedRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->rejectedRepository->getAll($input);
        } else {
            return view('rejected.index');

        }
    }
}
