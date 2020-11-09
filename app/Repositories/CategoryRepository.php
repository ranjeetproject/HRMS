<?php


namespace App\Repositories;


use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class CategoryRepository
{

    public function getAll()
    {
        $data = Category::orderBy('created_at', 'DESC')->get([
            'id', 'cname'
        ]);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $html = '<a href="' . action('CategoryController@show', $row->id) . '" data-toggle="tooltip"
                data-placement="top" title="View" class="btn btn-info">
                <i class="fas fa-eye"></i></a>
                <a href="' . action('CategoryController@edit', $row->id) . '" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="' . action('CategoryController@destroy', [$row->id]) . '" accept-charset="UTF-8" style="display: inline-block;"
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
        $row = Category::create($inputData);
        if ($row && $row->id > 0) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function view($id)
    {
        $row = Category::find($id);
        return $row;
    }

    public function viewEdit($id)
    {
        $row = Category::find($id);
        return $row;
    }

    public function updateSave($inputData, $id)
    {
        $row = Category::find($id);
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
            $row = Category::find($id);
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