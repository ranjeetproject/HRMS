<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
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
            return $this->categoryRepository->getAll($input);
        } else {
            return view('admin.category.index');
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'cname' => 'required',
        ]);
        $input = $request->all();
        $data = $this->categoryRepository->insert($input);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Category is successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->action('CategoryController@index')->with($notification);
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
        $category = $this->categoryRepository->view($id);
        return view('admin.category.show', compact('category'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->viewEdit($id);
        return view('admin.category.edit', compact('category'));
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
        $request->validate([
            'cname' => 'required',
        ]);
        $input = $request->all();
        $data = $this->categoryRepository->updateSave($input,$id);
        if ($data['success'] == true) {
            $notification = array(
                'message' => 'Category is successfully Update!',
                'alert-type' => 'success'
            );
            return redirect()->action('CategoryController@index')->with($notification);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->deleteSpecific($id);
        $notification = array(
            'message' => 'Category Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->action('CategoryController@index')
            ->with($notification);
    }
}
