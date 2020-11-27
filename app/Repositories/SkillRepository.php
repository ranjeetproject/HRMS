<?php


namespace App\Repositories;

use App\Skill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class SkillRepository
{


    public function getAll()
    {
        $data = Skill::orderBy('created_at', 'DESC')->get([
            'id', 'skill_name'
        ]);
        
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<form method="POST" action="' . action('SkillController@destroy', $row->id) . '" accept-charset="UTF-8" style="display: inline-block;"
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
        $row = Skill::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function deleteSpecific($id)
    {
        if ($id > 0) {
            $row = Skill::find($id);
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