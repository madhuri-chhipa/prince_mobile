<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
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
        checkPermission($this, 115);
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $records = Service::select('id', 'name', 'icon', 'price', 'short_description', 'status', 'is_featured')->where([['deleted_at', NULL]])->get();

            return Datatables::of($records)
                ->addColumn('status', function ($row) {
                    $status = ($row->status == 1) ? 'checked' : '';
                    return $statusBtn = '<input class="tgl_checkbox tgl-ios" 
                data-id="' . $row->id . '" 
                id="cb_' . $row->id . '"
                type="checkbox" ' . $status . '><label for="cb_' . $row->id . '"></label>';
                })
                ->addColumn('is_featured', function ($row) {
                    $is_featured = ($row->is_featured == 1) ? 'checked' : '';
                    return $is_featuredBtn = '
                    <div class="form-check form-switch">
                        <input class="form-check-input feature" type="checkbox" data-id="' . $row->id . '" 
                        id="cb_' . $row->id . '" ' . $is_featured . '>
                        <label class="form-check-label" for="cb_' . $row->id . '"></label>
                    </div>';
                })
                ->addColumn('action', function ($row) {
                    return $action_btn = '<a href="' . url('admin/services/' . $row->id . '/edit') . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                <button data-id="' . $row->id . '" class="btn btn-sm btn-danger delete_record"><i class="fa fa-trash"></i> Delete</button>';
                })
                ->editColumn('icon', function ($row) {
                    return '<img src="' . asset($row->icon) . '" class="image logosmallimg">';
                })
                ->removeColumn('id')
                ->rawColumns(['status', 'is_featured', 'icon', 'action'])->make(true);
        }
        $title = "services";
        return view('admin.services.index', compact('title'));
    }


    public function create()
    {
        $title = "Add Service";
        return view('admin.services.add', compact('title'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => "required|max:250|unique:services,name",
            'slug'  => 'nullable|max:150',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price'  => 'required|max:100|',
            'brochure' => 'required|image|mimes:gif,png,jpg,jpeg,text,rtf,doc,pdf|max:1024',
            'short_description' => 'required|max:150',
            'description' => 'required',
            'meta_title'  => 'required|max:100|',
            'meta_keyword'  => 'required|max:100|',
            'meta_description'  => 'required',
            'sort_order' => 'required|max:11',
        ]);

        $data = new Service;
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $data->name = $request->name;
        $data->slug = $slug;
        $data->price = $request->price;
        $data->short_description = $request->short_description;
        $data->description = $request->description;
        $data->meta_title = $request->meta_title;
        $data->meta_keyword = $request->meta_keyword;
        $data->meta_description = $request->meta_description;
        $data->sort_order = $request->sort_order;
        $service_image = $data->image;
        if ($file = $request->file('image')) {
            $destinationPath    = UPLOADFILES . 'services/';
            if (!empty($request->old_image)) {
                delete_file($destinationPath . $request->old_image);
            }
            $uploadImage        = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $uploadImage);
            $service_image = $destinationPath . $uploadImage;
        }
        $data->image = $service_image;

        $icon = $data->icon;
        if ($file = $request->file('icon')) {
            $destinationPath    = UPLOADFILES . 'services/icons/';
            if (!empty($request->old_icon_image)) {
                delete_file($destinationPath . $request->old_icon_image);
            }
            $uploadImage        = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $uploadImage);
            $icon = $destinationPath . $uploadImage;
        }
        $data->icon = $icon;

        $brochure = $data->brochure;
        if ($file = $request->file('brochure')) {
            $destinationPath    = UPLOADFILES . 'services/brochure/';
            if (!empty($request->old_brochure_image)) {
                delete_file($destinationPath . $request->old_brochure_image);
            }
            $uploadImage        = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $uploadImage);
            $brochure = $destinationPath . $uploadImage;
        }
        $data->brochure = $brochure;
        $data->save();

        $request->session()->flash('success', 'service Added Successfully!!');
        return redirect(url('admin/services'));
    }

    public function edit(Request $request, $id)
    {
        $title = "Edit service";
        $data = Service::where('id', $id)->first();
        if (!empty($data)) {
            return view('admin.services.edit', compact('title', 'data'));
        } else {
            $title = "404 Error Page";
            $message = '<i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found!!';
            return view('admin.error', compact('title', 'message'));
        }
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => "required|max:250",
            'slug'  => 'nullable|max:150',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price'  => 'required|max:100|',
            'brochure' => 'nullable|image|mimes:gif,png,jpg,jpeg,text,rtf,doc,pdf|max:1024',
            'short_description' => 'required|max:150',
            'description' => 'required',
            'meta_title'  => 'required|max:100|',
            'meta_keyword'  => 'required|max:100|',
            'meta_description'  => 'required',
            'sort_order' => 'required|max:11',
        ]);

        $data = Service::where('id', $id)->first();
        if ($data) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
            $data->name = $request->name;
            $data->slug = $slug;
            $data->price = $request->price;
            $data->short_description = $request->short_description;
            $data->description = $request->description;
            $data->meta_title = $request->meta_title;
            $data->meta_keyword = $request->meta_keyword;
            $data->meta_description = $request->meta_description;
            $data->sort_order = $request->sort_order;
            $service_image = $data->image;
            if ($file = $request->file('image')) {
                $destinationPath    = UPLOADFILES . 'services/';
                if (!empty($request->old_image)) {
                    delete_file($request->old_image);
                }
                $uploadImage        = time() . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $uploadImage);
                $service_image = $destinationPath . $uploadImage;
            }
            $data->image = $service_image;

            $icon = $data->icon;
            if ($file = $request->file('icon')) {
                $destinationPath    = UPLOADFILES . 'services/icons/';
                if (!empty($request->old_icon_image)) {
                    delete_file($request->old_icon_image);
                }
                $uploadImage        = time() . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $uploadImage);
                $icon = $destinationPath . $uploadImage;
            }
            $data->icon = $icon;

            $brochure = $data->brochure;
            if ($file = $request->file('brochure')) {
                $destinationPath    = UPLOADFILES . 'services/brochure/';
                if (!empty($request->old_brochure_image)) {
                    delete_file($request->old_brochure_image);
                }
                $uploadImage        = time() . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $uploadImage);
                $brochure = $destinationPath . $uploadImage;
            }
            $data->brochure = $brochure;
            $data->save();

            $request->session()->flash('success', 'service Update Successfully!!');
            return redirect(url('admin/services'));
        } else {
            $request->session()->flash('error', 'service Does Not Exist!!');
            return redirect(url('admin/services'));
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Service::where('id', $id)->delete();
        } else {
            return 0;
        }
    }

    public function change_status(Request $request)
    {
        if ($request->ajax()) {
            $data = Service::where('id', $request->id)->first();
            $data->status = $data->status == 1 ? 0 : 1;
            $data->save();
        }
    }
    public function change_feature(Request $request)
    {
        if ($request->ajax()) {
            $data = Service::where('id', $request->id)->first();
            $data->is_featured = $data->is_featured == 1 ? 0 : 1;
            $data->save();
        }
    }
}
