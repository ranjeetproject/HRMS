<?php


namespace App\Repositories;

use App\TeamMember;
use App\Designation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;



class DesignationRepository
{
    public function getAll()
    {
        $data = Designation::orderBy('created_at', 'DESC')->get([
            'id', 'designation_name'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="' . action('DesignationController@edit', $row->id) . '" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="' . action('DesignationController@destroy', $row->id) . '" accept-charset="UTF-8" style="display: inline-block;"
                onsubmit="return confirm(\'Are you sure want to delete this row?\');"><input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="' . csrf_token() . '">
                        <button class="btn btn-danger" type="submit" title="Delete" data-toggle="tooltip" data-placement="top"><i class="fas fa-trash"></i></button>
                        </form> ';

                return $html;
            })
            ->setRowId('id')
            ->rawColumns(['action'])
            ->make(true);

    }

    public function insert($inputData)
    {
        $row = Designation::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function viewEdit($id)
    {
        $row = Designation::find($id);
        return $row;
    }

    public function updateSave($inputData, $id)
    {
        $row = Designation::find($id);
        if ($row) {
            $row->update($inputData);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function deleteSpecific($id)
    {
        if ($id > 0) {
            $row = Designation::find($id);
            if ($row) {
                $row->delete();
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        } else {
            return ['success' => false];
        }
    }

}