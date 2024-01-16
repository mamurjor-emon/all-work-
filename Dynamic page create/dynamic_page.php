web.php =>
 //----------------- Pages ------------------//
Route::get('{page_name}', [PageController::class, 'pageName'])
    ->name('frontend.page.index');

controller => 
 public function pageName($page_name)
    {
        $page = Page::where('slug', '=', $page_name)->where('status', 1)->firstOrFail();

        // breadcrumb
        $breadcrumb = [$page->name=>''];
        // view share data
        $this->setPageTitle($page->name,$page->meta_title,$page->meta_description);
        return view('frontend.pages.page.page', compact('page','breadcrumb'));

    }
	
	
	
view => 
@extends('layouts.frontend')
{{-- title  --}}
@section('title', $metaTitle)
@section('meta_description', $metaDesc)

{{-- internal css --}}
@push('styles')

@endpush


@section('contents')

{{-- breadcrumb --}}
<x-breadcrumb :breadcrumb="$breadcrumb"/>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

{{-- internal js --}}
@push('scripts')

@endpush


call to blade file => 
 <a href="{{ route('frontend.page.index', 'available-driving-test-booking-notification') }}"