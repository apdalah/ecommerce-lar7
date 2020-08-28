@extends('layouts.dashboard')

@section('title')
    @lang('msgs.add') @lang('msgs.category')
@endsection

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">@lang('msgs.home') </a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.main-categories.index')}}">@lang('msgs.main_categories')</a></li>
                    <li class="breadcrumb-item active">@lang('msgs.create') @lang('msgs.category')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Basic form layout section start -->
    <section id="basic-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('msgs.create') @lang('msgs.category')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a data-action="collapse"><i class="ft-minus"></i></a>
                                </li>
                                <li>
                                    <a data-action="reload"><i class="ft-rotate-cw"></i></a>
                                </li>
                                <li>
                                    <a data-action="expand"><i class="ft-maximize"></i></a>
                                </li>
                                <li>
                                    <a data-action="close"><i class="ft-x"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @include('_includes.Dashboard._alerts')
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" action="{{ route('admin.main-categories.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-home"></i> @lang('msgs.main_categories') </h4>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">@lang('msgs.image') @lang('msgs.the_category')</label>
                                                <label for="projectinput1"> </label>
                                                <input type="file"  id="image" class="form-control" name="image" />
                                                @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    
                                @if(active_languages()->count() > 0)
                                    @foreach(active_languages() as $index => $lang)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> @lang('msgs.insert') @lang('msgs.name') @lang('msgs.' . $lang->abbr) </label>
                                                <input type="text" value='{{ old("category.$index.name") }}' id="name" class="form-control" placeholder="@lang('msgs.insert') @lang('msgs.category') @lang('msgs.' . $lang->abbr)" name="category[{{ $index }}][name]" />
                                                @error("category.$index.name")
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> @lang('msgs.tags') </label>
                                                <input type="text" value='{{ old("category.$index.tags") }}' id="" class="form-control" placeholder="@lang('msgs.insert') @lang('msgs.save')" name="category[{{ $index }}][tags]" />
                                                @error("category.$index.tags")
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mt-1">
                                                <input type="checkbox" name="category[{{ $index }}][status]" id="" class="switchery" data-color="success" checked />
                                                <label for="switcheryColor4" class="card-title ml-1">@lang('msgs.status') </label>
                                            </div>
                                        </div>
                                        
                                        <!-- sending translation language automatically -->
                                        <input type="hidden" name="category[{{$index}}][translation_lang]" value="{{$lang->abbr}}">

                                    </div>
                                </div>

                                <hr>
                                @endforeach
                            @endif

                                <div class="form-actions">
                                    <button type="button" class="btn btn-warning mr-1" onclick="history.back();"><i class="ft-x"></i> @lang('msgs.retreat')</button>
                                    <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> @lang('msgs.save')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic form layout section end -->
</div>

@endsection