<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingInquiry;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookingInquiryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:admin');
        checkPermission($this, 111);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BookingInquiry::select('booking_inquiry.id', 'booking_inquiry.name', 'booking_inquiry.created_at', 'booking_inquiry.email', 'booking_inquiry.mobile', 'products.name as product_name')
                ->leftJoin('products', "products.id", "=", "booking_inquiry.product_id")
                ->orderBy('booking_inquiry.id','DESC');

            return Datatables::of($data)
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row['created_at']));
                })
                ->addColumn('action', function ($row) {
                    return $action_btn = '<button onClick="callModal(' . $row->id . ')" class="btn btn-sm btn-secondary" title="View"><i class="fas fa-eye"></i></button>&nbsp;
                <button data-id="' . $row->id . '" class="btn btn-sm btn-danger delete_record"  title="Delete"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

       
        $title = "Product Inquires";
        return view('admin.booking_inquires.index', compact('title'));
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $content = BookingInquiry::select('booking_inquiry.*','products.name as product_name')
                ->leftJoin('products', "products.id", "=", "booking_inquiry.product_id")
                ->where('booking_inquiry.id', $id)->first();
            
            $cdata = 'Booking Inquiry';
            $data = '<ul class="list-group">
                     
                        <li class="list-group-item">
                            <strong>Name : </strong>
                            <span class="text-break text-justify">' . $content->name . '</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Product Name : </strong>
                            <span class="text-break text-justify">' . $content->product_name . '</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Email-Address : </strong>
                            <span class="text-break text-justify">' . $content->email . '</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Mobile Number : </strong>
                            <span class="text-break text-justify">' . $content->mobile . '</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Message : </strong>
                            <span class="text-break text-justify">' . $content->message . '</span>
                        </li>
            
                    </ul>';

            return $data;
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = BookingInquiry::where('id', $id)->delete();
            return 1;
        } else {
            return 0;
        }
    }
}
