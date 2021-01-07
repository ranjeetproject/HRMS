<?php


namespace App\Repositories;

use App\Skill;
use App\CandidateSkill;
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
                $html = ' <a href="' . action('SkillController@edit', $row->id) . '" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="' . action('SkillController@destroy', $row->id) . '" accept-charset="UTF-8" style="display: inline-block;"
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

    public function viewEdit($id)
    {
        $row = Skill::find($id);
        return $row;
    }
    public function updateSave($inputData, $id)
    {
        $row = Skill::find($id);
        if ($row) {
            $row->update($inputData);
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function deleteSpecific($id)
    {
        $check = CandidateSkill::where('skill_id','=',$id)->get();
        if(count($check)!= 0){
            return ['success' => false];
           
        }else{
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
}