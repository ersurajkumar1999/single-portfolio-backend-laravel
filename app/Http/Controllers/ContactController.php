<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    protected $userId;

    // Constructor
    public function __construct()
    {
        // Initialize any property
        $this->userId = 1;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $contacts = Contact::where('user_id', $this->userId)->get();

            return DataTables::of($contacts)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<span class="' . ($row->is_closed ? 'text-danger' : 'text-success') . '">' . ($row->is_closed ? 'Closed' : 'Active') . '</span>';
                })
                ->addColumn('updated_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('d-m-Y h:i A');
                })
                ->addColumn('closed_date', function ($row) {
                    $date = $row->closed_date ? Carbon::parse($row->closed_date)->format('d-m-Y h:i A') : 'N/A';
                    return $date;
                })
                ->addColumn('action', function ($row) {
                    $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                    $btn = '<a href="javascript:void(0)" onclick="editItem(' . $rowJson . ')"><i class="edit-icon bx bxs-edit-alt"></i></a>
                            <a href="javascript:void(0)" onclick="deleteItem(' . $rowJson . ')"><i class="delete-icon bx bxs-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'updated_at', 'closed_date', 'action'])
                ->make(true);
        }

        $about = About::with('items')->where('user_id', $this->userId)->first();

        return view('contacts.index', compact('about'));
    }
}
