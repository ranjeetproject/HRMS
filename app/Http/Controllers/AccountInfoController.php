<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AccountInfoRepository;

class AccountInfoController extends Controller
{

    protected $accountInfoRepository;

    public function __construct(AccountInfoRepository $accountInfoRepository)
    {
        $this->accountInfoRepository = $accountInfoRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $input = $request->all();
        if ($request->ajax()) {
            return $this->accountInfoRepository->getAll($input);
        } else {
            return view('admin.account_info.index');
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->accountInfoRepository->fetchUser();
        return view('admin.account_info.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'payee_id'      => 'required',
            'user_id'    => 'required',
            'email'         => 'required',
            'designation'   => 'required',
            'join_date'     => 'required',
            'pan_no'           =>'required',
            'account_no'  =>'required',
            'gross_payout'  =>'required',
            'deduction_for_absent'           =>'required',
        ]);
        $input = $request->all();
        $data = $this->accountInfoRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Acccount is successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->action('AccountInfoController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
