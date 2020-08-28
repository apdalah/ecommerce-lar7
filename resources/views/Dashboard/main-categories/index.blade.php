@extends('layouts.dashboard')

@section('title')
@lang('msgs.main_categories')
@endsection

@section('content')



<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">@lang('msgs.main_categories')</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">@lang('msgs.home')</a></li>
                    <li class="breadcrumb-item active">@lang('msgs.main_categories')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('msgs.main_categories')</h4>
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
                        <div class="card-body card-dashboard">
                            <table class="table display nowrap table-striped table-bordered scroll-horizontal">
                                <thead>
                                    <tr>
                                        <th>@lang('msgs.image')</th>
                                        <th>@lang('msgs.name')</th>
                                        <th>@lang('msgs.language')</th>
                                        <th>@lang('msgs.tags')</th>
                                        <th>@lang('msgs.status')</th>
                                        <th>@lang('msgs.control')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @isset($main_categories)
                                    @foreach($main_categories as $category)
                                    <tr>
                                        <td><img src="{{ $category-> image }}" alt="@lang('msgs.category')" style="width:50px;height:50px;"></td>
                                        <td>{{ $category-> name }}</td>
                                        <td>{{ $category-> translation_lang }}</td>
                                        <td>{{ $category-> tags }}</td>
                                        <td>{{ $category-> getStatus() }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('admin.main-categories.edit', $category->id) }}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">@lang('msgs.edit')</a>
                                                <form action="{{ route('admin.main-categories.destroy', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" value="" onclick="" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1" data-toggle="modal" data-target="#rotateInUpRight">
                                                    @lang('msgs.delete')
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endisset
                                </tbody>
                            </table>
                            <div class="justify-content-center d-flex"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


                
@endsection