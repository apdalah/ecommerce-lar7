<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Http\Requests\Dashboard\MainCategoryRequest;
use DB;

class MainCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $default_language = default_language(); // helper function
        $main_categories = MainCategory::withDefaultLang($default_language)->selection()->paginate(PAGINATION_COUNT);
        // $main_categories = MainCategory::selection()->paginate(PAGINATION_COUNT);
        return view('Dashboard.main-categories.index', compact('main_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.main-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoryRequest $request)
    {
        try
        {
            // get all arrays of categories
            $all_categories = collect($request->category);

            //extract the category with defaul language
            $filter = $all_categories->filter(function($value, $key){
                return $value['translation_lang'] == default_language();
            });

            $locale_category = array_values($filter->all())[0];

            $filepath = "";
            if($request->has('image'))
            {
                // uploadImage is a helper function to upload image to a specific path
                $filepath = uploadImage('mainCategories', $request->image);
            }

            $status = isset($locale_category['status']) ? 1 : 0;

            //starting with first insertion code
            DB::beginTransaction();

                // insert default category with the default language
                // get the id of the insertion row to use it later
                $locale_category_id = MainCategory::insertGetId([
                    'translation_lang' => $locale_category['translation_lang'],
                    'translation_of' => 0,
                    'name' => $locale_category['name'],
                    'tags' => $locale_category['tags'],
                    'status' => $status,
                    'image' => $filepath,
                ]);
                
                //get all category except the default one
                $all_remain_categories = $all_categories->filter(function($value, $key){
                    return $value['translation_lang'] != default_language();
                });
                
                // checking then insertion
                // all category will be related to the default category throug "translation_of" column
                if(isset($all_remain_categories) && $all_remain_categories->count())
                {   
                    $storage_remain_categories = [];
                    foreach($all_remain_categories as $category)
                    {
                        $status = isset($category['status']) ? 1 : 0;
                        $storage_remain_categories[] = [
                            'translation_lang' => $category['translation_lang'],
                            'translation_of' => $locale_category_id,
                            'name' => $category['name'],
                            'tags' => $category['tags'],
                            'status' => $status,
                            'image' => $filepath,
                        ];
                    }
                    MainCategory::insert($storage_remain_categories);
                }

            // end of insertion code
            DB::commit();
                
            return redirect()->route('admin.main-categories.index')->with(['success' => 'تم حفظ البيانات بنجاح']);

        }catch(\Exception $ex)
        {
            // in exception case -> rollback all insertion code (don't save anything in database)
            DB::rollback();
            return redirect()->route('admin.main-categories.index')->with(['error' => 'حدث خطأ أثناء عملية الحفظ يرجى المحاوله مرة اخرى']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($mainCategory_id)
    {
        $mainCategory = MainCategory::selection()->find($mainCategory_id);
        if(!$mainCategory)
        {
            return redirect()->route('admin.main-categories.index')->with(['error' => 'هذا القسم غير موجود']);

        }
        return view('Dashboard.main-categories.edit', compact('mainCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainCategory $mainCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainCategory $mainCategory)
    {
        //
    }
}
