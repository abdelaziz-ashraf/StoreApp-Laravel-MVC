<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'))
            ->with('success', 'Category Created Successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        return view('dashboard.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $request->merge([
            'slug'=> Str::slug($request->name)
        ]);

        $data = $request->except('image');
        $new_image_path = $this->uploadImage($request);;
        if($new_image_path){
            $data['image'] = $new_image_path;
        }

        $category = Category::create($data);

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Created Successfully');
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
    public function edit(Category $category)
    {
        $parents = Category::where('id', '<>', $category->id)
            ->where(function ($query) use($category) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $category->id);
            })->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        if($request->name) {
            $request->merge([
                'slug'=> Str::slug($request->name)
            ]);
        }

        $data = $request->except('image');
        $new_image_path = $this->uploadImage($request);;
        if($new_image_path){
            $data['image'] = $new_image_path;
        }

        $old_image = $category->image;
        if($old_image && $new_image_path) {
            Storage::disk('public')->delete($old_image);
        }

        $category->update($data);
        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        if($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Deleted Successfully');
    }

    protected function uploadImage(Request $request) {
        if(!$request->hasFile('image')){
            return;
        }

        $image = $request->image;
        $path = $image->store('uploads', 'public');
        return $path;

    }
}
