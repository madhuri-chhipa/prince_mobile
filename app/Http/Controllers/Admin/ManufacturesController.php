<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manufacture; 
use Yajra\DataTables\Facades\DataTables;


class ManufacturesController extends Controller
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
        checkPermission($this, 119);
    }


    public function index(Request $request)
    {
        if($request->ajax()) {
            $records = Manufacture::select('id','name','image', 'status')->where([['deleted_at', NULL]])->get();

            return Datatables::of($records)
            ->addColumn('status', function($row) {
                $status = ($row->status == 1)? 'checked': '';
                return $statusBtn = '<input class="tgl_checkbox tgl-ios" 
                data-id="'.$row->id.'" 
                id="cb_'.$row->id.'"
                type="checkbox" '.$status.'><label for="cb_'.$row->id.'"></label>';  
            })
            ->addColumn('action', function($row) {
                return $action_btn = '<a href="'.url('admin/manufactures/'.$row->id.'/edit').'" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                <button data-id="'.$row->id.'" class="btn btn-sm btn-danger delete_record"><i class="fa fa-trash"></i> Delete</button>'; 
            }) 
            ->editColumn('image', function($row) {
                return '<img src="'.asset($row->image).'" class="image logosmallimg">';
            })
            ->removeColumn('id') 
            ->rawColumns(['status','image','action'])->make(true);
        }
        $title = "Manufactures";
        return view('admin.manufactures.index', compact('title'));
    }


    public function create()
    {
        $title = "Add Manufacture";  
        return view('admin.manufactures.add', compact('title'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
             'name' => 'required|max:150|unique:manufactures,name',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]); 

        $data = new Manufacture;
        $data->name = $request->name;
        $manufacture_image =$data->image;
        if($file = $request->file('image')) {
            $destinationPath    = UPLOADFILES.'manufactures/';
            if(!empty($request->old_image)){  
                delete_file($destinationPath.$request->old_image);
            } 
            $uploadImage        = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $uploadImage);
            $manufacture_image = $destinationPath.$uploadImage;
        }
        $data->image = $manufacture_image; 
        $data->save();


        $request->session()->flash('success','Manufacture Added Successfully!!'); 
        return redirect( url('admin/manufactures'));
    }



    public function edit(Request $request, $id)
    {
        $title = "Edit Manufacture";   
        $data = Manufacture::where('id', $id)->first();
        if(!empty($data)){
            return view('admin.manufactures.edit', compact('title','data'));
        }else{
            $title = "404 Error Page";
            $message = '<i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found!!';
            return view('admin.error', compact('title','message'));
        }
    }

    public function update(Request $request, $id)
    { 
        $validate = $request->validate([
         'name' => "required|max:150",
         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = Manufacture::where('id', $id)->first();
        if ($data) {
            $data->name = $request->name;

            $manufacture_image =$data->image;
            if($file = $request->file('image')) {
                $destinationPath    = UPLOADFILES.'manufactures/';
                if(!empty($request->old_image)){  
                    delete_file($request->old_image);
                } 
                $uploadImage        = time().'.'.$file->getClientOriginalExtension();
                $file->move($destinationPath, $uploadImage);
                $manufacture_image = $destinationPath.$uploadImage;
            }
            $data->image = $manufacture_image;
            
            $data->save();

            $request->session()->flash('success','Manufacture Update Successfully!!');
            return redirect(url('admin/manufactures'));
        }else {
            $request->session()->flash('error','Manufacture Does Not Exist!!');
            return redirect(url('admin/manufactures'));
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Manufacture::where('id', $id)->delete();              
        }else{
            return 0;
        }
    }

    public function change_status(Request $request)
    {
        if ($request->ajax()) {
            $data = Manufacture::where('id', $request->id)->first();
            $data->status = $data->status==1?0:1;
            $data->save();
        }
    }
}
