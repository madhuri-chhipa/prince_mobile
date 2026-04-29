<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OfferController extends Controller
{
    /**
     * Only Authenticated users for "admin" guard 
     * are allowed.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:admin');
        checkPermission($this, 118);
    }

   public function index(Request $request)
    {
        if($request->ajax()) {
            $records = Banner::select('id','name', 'title','image', 'status')->where('type', 2)->get();

            return DataTables::of($records)
            ->addColumn('status', function($row) {
                $status = ($row->status == 1)? 'checked': '';
                return $statusBtn = '<input class="tgl_checkbox tgl-ios" 
                data-id="'.$row->id.'" 
                id="cb_'.$row->id.'"
                type="checkbox" '.$status.'><label for="cb_'.$row->id.'"></label>';  
            })
            ->addColumn('action', function($row) {
                return $action_btn = '<a href="'.url('admin/offer/'.$row->id.'/edit').'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                    <button data-id="'.$row->id.'" class="btn btn-sm btn-danger delete_record"><i class="fa fa-trash"></i> Delete</button>'; 
            }) 
            ->editColumn('image', function($row) {
                return '<img src="'.asset($row->image).'" class="image logosmallimg">';
            })
            ->removeColumn('id') 
            ->rawColumns(['status','image','action'])->make(true);
        }
        $title = "Offers";
        return view('admin.offer.index', compact('title'));
    }

    public function create()
    {
        $title = "Add Offers";    
        return view('admin.offer.add', compact('title'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:100|unique:banners,name',
            'title' => 'required',
            'sort_order' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]); 
        $data = new Banner;
        $data->name = $request->name;
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $data->slug = $slug;
        $data->type = 2;
        $data->title = $request->title;
        $data->sort_order = $request->sort_order;
        $data->status = 1;
        $offer_image = '';
        if($file = $request->file('image')) {
            $destinationPath    = UPLOADFILES.'offers/'; 
            $uploadImage        = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $uploadImage);
            $offer_image = $destinationPath.$uploadImage;
        }
        $data->image = $offer_image;
        $data->save(); 

        $request->session()->flash('success','Offer Added Successfully!!'); 
        return redirect( url('admin/offer'));
    }

    public function edit(Request $request, $id)
    {
        $title = "Edit Offers";   
        $data = Banner::where('id', $id)->first();
        if(!empty($data)){
            return view('admin.offer.edit', compact('title','data'));
        }else{
            $title = "404 Error Page";
            $message = '<i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found!!';
            return view('admin.error', compact('title','message'));
        }
    }

    public function update(Request $request, $id)
    { 
        $validate = $request->validate([
         'name' => "required|max:100|unique:banners,name,$id",
         'title' => 'required',
         'sort_order' => 'required',
         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = Banner::where('id', $id)->first();
        if($data) {
            $data->name = $request->name;
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
            $data->slug = $slug;
            $data->title = $request->title;
            $data->sort_order = $request->sort_order;

            $offer_image = $data->image;
            if($file = $request->file('image')) {
                $destinationPath    = UPLOADFILES.'offers/';
                if(!empty($request->old_image)){  
                    delete_file($request->old_image);
                } 
                $uploadImage = time().'.'.$file->getClientOriginalExtension();
                $file->move($destinationPath, $uploadImage);
                $offer_image = $destinationPath.$uploadImage;
            }
            $data->image = $offer_image;
            $data->save();

            $request->session()->flash('success','Offer Update Successfully!!');
            return redirect(url('admin/offer'));
        }else {
            $request->session()->flash('error','Offer Does Not Exist!!');
            return redirect(url('admin/offer'));
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Banner::where('id', $id)->delete();              
        }else{
            return 0;
        }
    }

    public function change_status(Request $request)
    {
        if ($request->ajax()) {
            $data = Banner::where('id', $request->id)->first();
            $data->status = $data->status==1?0:1;
            $data->save();
        }
    }


}
