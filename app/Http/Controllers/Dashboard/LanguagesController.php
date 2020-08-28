<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Http\Requests\Dashboard\LanguageRequest;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::selection()->paginate(PAGINATION_COUNT);
        return view('Dashboard.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {   
        $status = isset($request->status) ? 1 : 0;
        try
        {
            Language::create(array_merge($request->except(['_token']), ['status' => $status]));
            return redirect()->route('admin.languages.index')->with(['success' => 'تم حفظ البيانات بنجاح']);
        }catch(\Exception $ex)
        {
            return redirect()->route('admin.languages.index')->with(['error' => 'حدث خطأ أثناء عملية الحفظو يرجى المحاوله مرة اخرى']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::selection()->find($id);
        if(! $language)
        {
            return redirect()->route('admin.languages.index')->with(['error' => 'هذه اللغه غير موجوده']);
        }
        return view('Dashboard.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, Language $language)
    {
        $status = isset($request->status) ? 1 : 0;
        try
        {
            $language->update(array_merge($request->except(['_token']), ['status' => $status]));
            return redirect()->route('admin.languages.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        }catch(\Exception $ex)
        {
            return redirect()->route('admin.languages.index')->with(['error' => 'حدث خطأ أثناء تحديث البيانات']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        try
        {
            $language->delete();
            return redirect()->route('admin.languages.index')->with(['success' => 'تم حذف البيانات بنجاح']);
        }catch(\Exception $ex)
        {
            return redirect()->route('admin.languages.index')->with(['error' => 'حدث خطأ أثناء حذف البيانات']);
        }
    }
}
