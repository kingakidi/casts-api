<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return Category::all();
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //
        // $validated = $request->validate([
        //     'title'=> "required|unique:category, category_title"
        // ]); 


        $categoryTitleCheck  = Category::where('category_title', $request->title)->get(); 

        if ($request->title) {
            if (count($categoryTitleCheck) > 0) {
                return "Category already exist";
            }else{
                $category = new Category; 
    
                $category->category_title = strtolower($request->title);
    
                if($category->save()){
                    $message = "Category Added Successfully";

                    return $message;
                }; 
            }
        }else{
            return "Category title is required";
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

        
        return Category::find($id);
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
      
            $validated = $request->validate(['category_title'=> "required"]);

            $category = Category::find($id);

             if($category !== NULL){
                // $category->category_title = strtolower($request->title);

                $category->update($request->all());

                return $category;
             }else{
                 return "Category not found";
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
        $category = Category::find($id);
 
        if ($category) {
          
            $category->delete();

            return $category;
        }else{
            return "Data No Exist";
        }
        

        
    }
}
