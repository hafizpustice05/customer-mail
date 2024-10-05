<?php

namespace App\Http\Controllers\Auth\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('auth.category.index', \compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('auth.category.create', \compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        // $fields = $request->validate([
        //     'categoryName' => ['required', 'unique:categories', 'max:60'],
        //     'description' => ['required']
        // ]);
        $validator = Validator::make($request->all(), [
            'categoryName' => ['required', 'unique:categories', 'max:60'],
            'description' => ['required']
        ]);
        if ($validator->fails()) {

            $validator->errors()->add(
                'createError',
                'Something is wrong with this field!'
            );
            return \redirect('admin/category?errorOccurred=true')->withErrors($validator)->withInput();
        }
        Category::create($validator->validate());
        return \redirect('admin/category');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //  dd($category->id);
        $validator = Validator::make($request->all(), [
            'categoryName' => ['required', 'unique:categories,categoryName,' . $category->id, 'max:60'],
            'description' => ['required']
        ]);
        if ($validator->fails()) {

            $validator->errors()->add(
                'updateError',
                'Something is wrong with this field!'
            );
            return \redirect()->back()->withErrors($validator)->withInput();
        }

        $category->categoryName = $request->categoryName;
        $category->description = $request->description;
        $category->save();


        return \redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // dd($request->ids);
        Category::whereIn('id', $request->ids)->delete();
        return redirect()->back();
    }
}
