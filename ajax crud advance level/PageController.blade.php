<?php

namespace App\Http\Controllers\Super\Pages;

use App\Models\Pages;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Pages');
        $breadcrumb   = ['Dashboard' => ('super.dashboard'), 'Pages' => ''];
        return view('super.pages.pages.index', compact('breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Create New Pages');
        $breadcrumb = ['Dashboard' => ('super.dashboard'), 'Pages' => route('super.pages.index'), 'Create' => ''];
        return view('super.pages.pages.create', compact('breadcrumb'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $getData = Pages::latest();
            return DataTables::eloquent($getData)
                ->addIndexColumn()
                ->addColumn('feature_image', function ($data) {
                    return '<img src="' . asset($data->feature_image) . '" style="width: 120px height:100px" alt="">';
                })
                ->addColumn('slug',function($data){
                    return '<a href="http:/'.$data->slug.'" target="_blank" rel="noopener noreferrer">'.$data->slug.'</a>';
                })
                ->addColumn('status', function ($data) {
                    $status = $data->status == 1 ? 'checked' : '';
                    if ($status) {
                        return '<span class="badge badge-sm badge-success ">Published</span>';
                    } else {
                        return '
                        <span class="badge badge-sm badge-danger">Pending</span>
                    ';
                    }
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                    <div class="dropdown">
                        <button class=" dropdown-toggle" type="button" id="dropdownMenuOutlineButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v"></i> </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton2">
                            <a class="dropdown-item" href="' . route('super.pages.edit', $data->id) . '"><i class="fas fa-edit"></i> Edit</a>

                            <a class="dropdown-item delete_btn" data-id="' . $data->id . '" data-title="Do you want to delete record?" data-top_title="Confirm Delete" data-url="' . route('super.pages.delete') . '" data-message="Category deleted successfully." href="#"><i class="fas fa-trash-alt"></i> Delete</a>
                        </div>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['feature_image', 'action', 'status','slug'])
                ->make(true);
        }
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
            'feature_image' => ['required'],
        ]);
        $message = 'Page created successfully!';
        $feature_image = $this->imageUpload($request->feature_image, 'media/pages/', null, null);

        Pages::Create([
            'feature_image' => $feature_image,
            'status' => $request->status,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'content' => $request->content,
        ]);
        return back()->with('success', $message);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Pages::findOrFail($id);
        $this->setPageTitle('Pages Name Edit');
        $breadcrumb = ['Dashboard' => route('super.dashboard'), 'Pages' => route('super.pages.index'), 'Edit' => ''];
        return view('super.pages.pages.create', compact('breadcrumb', 'post'));
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
        if ($request->update_id) {
            $request->validate([
                'feature_image' => ['nullable'],
            ]);
        } else {
            $request->validate([
                'feature_image' => ['required'],
            ]);
        }

        if ($request->update_id) {
            if ($request->feature_image) {
                $feature_image = $this->imageUpdate($request->feature_image, 'media/pages/', null, null, $request->old_feature_image);
            } else {
                $feature_image = $request->old_feature_image;
            }
        }

        $post = Pages::findOrFail($id);

        $post->update([
            'feature_image' => $feature_image,
            'status'        => $request->status,
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'content'       => $request->content,
        ]);
        return redirect()->route('super.pages.index')->with('success', 'Pages updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $post = Pages::findOrFail($request->id)->delete();

            if ($post) {
                $output = ['status'=>'success', 'message'=> 'Pages Deleted Success.'];
            } else {
                $output = ['status'=>'error', 'message'=> 'Pages Deleted Failed.'];
            }
            return response()->json($output);
        }
    }
}
