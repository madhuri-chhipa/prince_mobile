<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:admin');
        checkPermission($this, 117);
    }


    public function index(Request $request)
    {
        if($request->ajax()) {
            $records = News::select('id','title', 'short_description','image', 'status')->where([['deleted_at', NULL]])->get();

            return DataTables::of($records)
            ->addColumn('status', function($row) {
                $status = ($row->status == 1)? 'checked': '';
                return $statusBtn = '<input class="tgl_checkbox tgl-ios" 
                data-id="'.$row->id.'" 
                id="cb_'.$row->id.'"
                type="checkbox" '.$status.'><label for="cb_'.$row->id.'"></label>';  
            })
            ->addColumn('action', function($row) {
                return $action_btn = '<a href="'.url('admin/news/'.$row->id.'/edit').'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                <button data-id="'.$row->id.'" class="btn btn-sm btn-danger delete_record"><i class="fa fa-trash"></i> Delete</button>'; 
            }) 
            ->editColumn('image', function($row) {
                return '<img src="'.asset($row->image).'" class="image logosmallimg">';
            })
            ->removeColumn('id') 
            ->rawColumns(['status','image','action'])->make(true);
        }
        $title = "news";
        return view('admin.news.index', compact('title'));
    }
    public function create()
    {
        $title = "Add News";  
        return view('admin.news.add', compact('title'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'  => 'required|max:250',
            'short_description'  => 'required|max:250',
            'date' => 'required|date',
            'description'  => 'required',
            'sort_order'  => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = new News;
        $data->title = $request->title;
        $data->short_description = $request->short_description;
        $data->date = $request->date;
        $data->description = $request->description;
        $data->sort_order = $request->sort_order;
        $news_image =$data->image;
        if($file = $request->file('image')) {
            $destinationPath    = UPLOADFILES.'news/';
            if(!empty($request->old_image)){  
                delete_file($destinationPath.$request->old_image);
            } 
            $uploadImage        = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $uploadImage);
            $news_image = $destinationPath.$uploadImage;
        }
        $data->image = $news_image; 
        $data->save();

        $request->session()->flash('success','news Added Successfully!!'); 
        return redirect( url('admin/news'));
    }



    public function edit(Request $request, $id)
    {
        $title = "Edit News";   
        $data = News::where('id', $id)->first();
        if(!empty($data)){
            return view('admin.news.edit', compact('title','data'));
        }else{
            $title = "404 Error Page";
            $message = '<i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found!!';
            return view('admin.error', compact('title','message'));
        }
    }

    public function update(Request $request, $id)
    { 
        $validate = $request->validate([
            'title'  => 'required|max:250',
            'short_description'  => 'required|max:250',
            'date'      => 'required|date',
            'description'  => 'required',
            'sort_order'  => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = News::where('id', $id)->first();
        if ($data) {
            $data->title = $request->title;
            $data->short_description = $request->short_description;
            $data->date = $request->date;
            $data->description = $request->description;
            $data->sort_order = $request->sort_order;
            $news_image =$data->image;
            if($file = $request->file('image')) {
                $destinationPath    = UPLOADFILES.'news/';
                if(!empty($request->old_image)){  
                    delete_file($request->old_image);
                } 
                $uploadImage        = time().'.'.$file->getClientOriginalExtension();
                $file->move($destinationPath, $uploadImage);
                $news_image = $destinationPath.$uploadImage;
            }
            $data->image = $news_image;
            
            $data->save();

            $request->session()->flash('success','new Update Successfully!!');
            return redirect(url('admin/news'));
        }else {
            $request->session()->flash('error','new Does Not Exist!!');
            return redirect(url('admin/news'));
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = News::where('id', $id)->delete();              
        }else{
            return 0;
        }
    }

    public function change_status(Request $request)
    {
        if ($request->ajax()) {
            $data = News::where('id', $request->id)->first();
            $data->status = $data->status==1?0:1;
            $data->save();
        }
    }
}
