<?php

namespace App\Http\Controllers;

use App\Repositories\DesignationRepository;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    protected $designationRepository;

    public function __construct(DesignationRepository $designationRepository)
    {
        $this->designationRepository = $designationRepository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if ($request->ajax()) {
            return $this->designationRepository->getAll($input);
        } else {
            return view('designation.index');

        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'designation_name' => 'required',
        ]);
        $input = $request->all();
        $data = $this->designationRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Designation name is successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->action('DesignationController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $designation = $this->designationRepository->viewEdit($id);
        return view('designation.edit', compact('designation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'designation_name' => 'required',
        ]);
        $input = $request->all();
        $data = $this->designationRepository->updateSave($input,$id);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Designation name is successfully Update!',
                'alert-type' => 'success'
            );
            return redirect()->action('DesignationController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $this->designationRepository->deleteSpecific($id);
        $notification = array(
            'message' => 'Designation name Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->action('DesignationController@index')
            ->with($notification);
    }


}
