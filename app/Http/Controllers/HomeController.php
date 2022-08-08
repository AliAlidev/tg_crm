<?php

namespace App\Http\Controllers;

use App\Imports\EnquriyCustomerImport;
use App\Imports\InventoryImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
// use Barryvdh\DomPDF\Facade\Pdf;
use PDF;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Data;
use App\Models\ge;
use App\Models\session as ModelsSession;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Khill\Lavacharts\Lavacharts;
use Illuminate\Support\Facades\DB;
// use File;
use Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Str;
use App\Models\booktable;
use App\Models\BookView;
use App\Models\Campaign;
use App\Models\Contracts;
use App\Models\DeadLeads;
use App\Models\DesignServices;
use App\Models\FollowUpLeads;
use App\Models\Inventory;
use App\Models\items;
use App\Models\LandingAgent;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Property;
use App\Models\QualifiedLeads;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\Supplier_Invoice;
use App\Models\User;
use App\Models\UserBook;
use App\Models\UserData;
use App\Models\UserDataComment;
use App\Models\WonLeads;
use Exception;
use Faker\Core\File as CoreFile;
use Hamcrest\Type\IsNumeric;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Util\Json;
use Yajra\DataTables\DataTables;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showbooksindex()
    {
        $userstatus = config('app.user_status');
        $campaignsources = Campaign::pluck('name');
        return view('admin.showbooks', ['userstatus' => $userstatus, 'campaignsources' => $campaignsources]);
    }


    public function createleadindex()
    {

        // if(Auth::user()->issuperAdmin()){
        //     return redirect()->route('create_super_Admin');
        // }else{
        return view('admin.createlead');
        // }
    }

    public function createnewlead(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'pphone' => 'required|regex:/^\+(?:[0-9] ?){8,13}[0-9]$/',
                'source' => 'required',
            ],
            [
                'name.required'  => 'The name field is required.',
                'email.required'  => 'The email field is required.',
                'source.required'  => 'The source field is required.',
                'pphone.required'  => 'The phone field is required.',
                'pphone.regex'  => 'Please enter valid phone number',
                'pphone.unique'  => 'This phone number is already in use',
            ]
        );

        $exist = Data::where('phone', $request->pphone)->where('source', $request->source)->count();
        if ($exist > 0) {
            return response()->json(['success' => false, 'message' => 'Phone number already exists in this source']);
        }

        // add to data
        $data = data::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' =>  $request->pphone,
            'source' => $request->source,
            'Project' => $request->source,
            'agents' => Auth::user()->name,
            'data_status' => 8,
            'previous_status' => 0,
            'is_campaign' => 1
        ]);

        // add data to leads pool
        $user = booktable::create([
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'campaign_name' => $data->source,
            'source' => $data->source,
            'project' => $data->Project,
            'data_id' => $data->id,
            'previous_state' => '0',
            'previous_state_id' => $data->id,
            'created_by' => Auth::user()->id,
        ]);

        if ($user != null)
            return response()->json(['success' => true, 'message' => 'Lead created successfully']);
        else
            return response()->json(['success' => false, 'message' => 'Error in creating new lead']);
    }

    public function leaderboardindex()
    {
        return view('admin.leaderboard');
    }

    public function listcontractsindex()
    {
        return view('admin.listcontracts');
    }

    public function listpropertiesindex()
    {
        $property_types = [
            'Apartment',
            'Villa',
            'Townhouse',
            'Penthouse',
            'Compound',
            'Duplex',
            'Full Floor',
            'Whole Building',
            'Bulk Rent Unit',
            'Bungalow',
            'Hotel & Hotel Aprtment',
            'Office Space',
            'Retail',
            'Warehouse',
            'Shop',
            'Show Room',
            'Whole Buildig',
            'Land',
            'Factory', 'Labor Camp', 'Staff Accommodation', 'Business Center', 'Co-Working Space', 'Farm'
        ];
        sort($property_types);

        return view('admin.listproperties', compact('property_types'));
    }

    public function listusersindex()
    {
        return view('admin.listusers');
    }

    public function listproperties(Request $request)
    {
        $property_type = $request->property_type;
        $properties = Property::latest();
        if ($property_type != null) {
            $properties = $properties->where('property_type', $property_type);
        }
        return DataTables::of($properties)
            ->make(true);
    }

    public function listContracts(Request $request)
    {
        $Contracts = Contracts::get();
        return DataTables::of($Contracts)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a class=" dawnloade btn-danger btn btn-sm" style="width:100px">Download pdf</a>' . "<a id='delete' class=' ml-1 btn-danger btn btn-sm'>Delete</a> ";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function deletecontracts(Request $request)
    {
        $Contracts = Contracts::find($request->id);
        if ($Contracts) {
            $Contracts->delete();
            return response()->json([
                'success' => true,
                'message' => 'Delete Contract Successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting contract'
            ]);
        }
    }

    public function listusers(Request $request)
    {
        $users = User::where('role_id', 'not like', '%1%')->orderBy('created_at', 'DESC')->get();
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('role', function ($row) {
                if ($row->role_id == '2')
                    return 'Consultant';
                else if ($row->role_id == '3')
                    return 'Agent';
                else if ($row->role_id == '2,3')
                    return 'Consultant Agent';
                else if ($row->role_id == '4')
                    return 'buyer';
                else if ($row->role_id == '5')
                    return 'accountant';
                else if ($row->role_id == '6')
                    return 'designer';
                else if ($row->role_id == '7')
                    return 'operation_manager';
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '<a class="delete btn btn-danger btn-sm">Delete</a>' . " ";
                $actionBtn .= '<a class="edit btn btn-info btn-sm">Edit</a>';
                return $actionBtn;
            })
            ->addColumn('image', function ($row) {
                if($row->image != null){
                $image="<img src='".asset($row->image)."' width=200 height=150/>";
                return $image;
                }
            })
            ->rawColumns(['action','image'])
            ->make(true);
    }

    public function updatecustomerindex($id)
    {
        $customer = booktable::where('id', $id)->first();
        return view('admin.updatecustomer', ['username' => $customer->name, 'userphone' => $customer->phone, 'useremail' => $customer->email, 'projectname' => $customer->project_name, 'notes' => $customer->notes, 'userid' => $id]);
    }

    public function updateuserindex($id)
    {
        $user = User::where('id', $id)->first();
        $roles=Role::where('name','!=','admin')->where('name','!=','consultant')->where('name','!=','buyer')->get();
        if ($user->role_id == 4) {
            return view('admin.updatebuyer', ['username' => $user->name, 'userphone' => $user->phone, 'useremail' => $user->email,'userid' => $id] );
        } else {
            return view('admin.updateuser', ['userrole' => $user->role_id, 'username' => $user->name, 'userphone' => $user->phone, 'useremail' => $user->email,'userimage' => $user->image, 'userposition' => $user->position, 'userlang' => $user->language, 'userid' => $id],compact('roles'));
        }
    }

    public function assignagentforlanding()
    {
        $agents = User::where('role_id', 'like', '%3%')->select('id', 'name')->get();
        $campaigns = Campaign::select('id', 'name')->get();
        return view('admin.assignagentforlandingpage', ['agents' => $agents, 'campaigns' => $campaigns]);
    }

    public function assignagenttolandpage(Request $request)
    {
        $request->validate([
            'landingname' => 'required',
            'agent' => 'required|exists:users,id'
        ]);
        try {
            $landingagent = LandingAgent::create([
                'landing_name' => $request->landingname,
                'user_id' => $request->agent
            ]);
            if ($landingagent)
                return response()->json(['success' => true, 'message' => 'Assign proccess completed successfully']);
            else
                return response()->json(['success' => false, 'message' => 'Error while assigning proccess']);
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function deletelanding(Request $request)
    {
        $request->validate(
            [
                'id' => 'required|exists:landing_agents,id'
            ]
        );
        $landingagent = LandingAgent::find($request->id);

        $res = $landingagent->delete();
        if ($res)
            return response()->json(['success' => true, 'message' => 'Landing agent has been deleted successfully']);
        else
            return response()->json(['success' => false, 'message' => 'Error hapen while delete landing agent']);
    }

    public function listassignedlandingagent()
    {
        $data = LandingAgent::all();
        $agents = User::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('agentname', function ($row) use ($agents) {
                $agentname = $agents->where('id', $row->user_id)->first();
                if ($agentname != null)
                    return  $agentname->email;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '<a class="delete btn btn-danger btn-sm">Delete</a>' . " ";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function updatecustomer(Request $request)
    {
        $request->validate([
            'userid' => 'required|exists:booktables,id',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
        ]);
        try {
            $customer = booktable::find($request->userid);
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            if ($request->projectname != null)
                $customer->project = $request->projectname;
            if ($request->notes != null)
                $customer->comment = $request->notes;
            $res = $customer->save();

            if ($res)
                return response()->json(['success' => true, 'message' => 'Customer updated successfully']);
            else
                return response()->json(['success' => false, 'message' => 'Error in updating customer data']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function updateuser(Request $request)
    {
        $roles = [];
        $roles['email'] = 'required|exists:users,email';
        $roles['name'] = 'required';
        $roles['language'] = 'required';
        $roles['role'] = 'required';
        if ($request->phone != null) {
            $roles['phone'] = 'regex:/^\+(?:[0-9] ?){8,14}[0-9]$/';
        }
        if ($request->password != null) {
            $roles['password'] = 'required_with:password_confirm|same:password_confirm';
        }

        $request->validate($roles);

        try {
            dd($request->all());
            if ($request->hasfile('image')){
                $imageName = rand(0, 10000) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('storage/users/'), $imageName);
            }
            $customer = User::where('email', $request->email)->first();
            $customer->name = $request->name;
            $customer->email = $request->email;
            if ($request->phone != null) {
                $customer->phone = $request->phone;
            }
            $customer->image = $request->hasfile('image') ? ('storage/users/' .  $imageName) : null;
            
            $customer->position= ($request->position) ? $request->position :null;
            $customer->language = $request->language;
            $customer->role_id = $request->role;
            if ($request->password != null) {
                $customer->password = Hash::make($request->password);
            }
            $customer->update();

            if ($customer)
                return response()->json(['success' => true, 'message' => 'Agent updated successfully']);
            else
                return response()->json(['success' => false, 'message' => 'Error in updating agent data']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function updatebuyer(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'name' => 'required'
        ]);
        try {
            $customer = User::where('email', $request->email)
                ->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email
                ]);
            if ($customer)
                return response()->json(['success' => true, 'message' => 'Buyer updated successfully']);
            else
                return response()->json(['success' => false, 'message' => 'Error in updating buyer data']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function deleteuser(Request $request)
    {
        $user = User::destroy($request->id);
        if ($user)
            return response()->json(['success' => true, 'message' => 'User has been deleted successfully']);
        else
            return response()->json(['success' => true, 'message' => 'Error while deleting user']);
    }

    public function deletecustomer(Request $request)
    {
        $booktable = booktable::find($request->id);
        UserDataComment::where('data_id', $booktable->data_id)->where('user_id', $booktable->created_by)->delete();
        UserData::where('data_id', $booktable->data_id)->where('user_id', $booktable->created_by)->delete();
        Data::destroy($booktable->data_id);
        $booktable->Delete();
        return response()->json(['success' => true, 'message' => 'Customer has been deleted successfully']);
    }

    public function deleteproperty(Request $request)
    {
        $property = Property::find($request->id);
        $havepayments = Payment::where('property', $property->name)->where('buyer_id', $property->buyer_id)->exists();
        if ($havepayments)
            return response()->json(['success' => false, 'message' => 'This property has payments you should remove payments first']);

        $res = $property->delete();
        if ($res)
            return response()->json(['success' => true, 'message' => 'Property has been deleted successfully']);
        else
            return response()->json(['success' => false, 'message' => 'Error hapen while delete property']);
    }

    public function downloadContracts(Request $request)
    {
        $Contracts = Contracts::find($request->id);

        if ($Contracts) {
            $day = ($Contracts->contract_date) ? Carbon::createFromFormat('m/d/Y', $Contracts->contract_date)->format('d \of F Y') : "N/A";

            $pdf = PDF::loadView('CONTPDF', compact('Contracts', 'day'));
            $pdf->save('Contract' . Auth::user()->id . '.pdf');
        } else {
            return response()->json(['success' => true, 'message' => 'Error while  download Contracts']);
        }
    }
    public function downloadInvoices(Request $request)
    {
        $invoice = Inventory::find($request->id);
        $items = items::where('invoices_id', $request->id)->get();

        if ($invoice) {
            $pdf = PDF::loadView('InvoicePDF', compact('invoice', 'items'));
            $pdf->save('Invoice' . Auth::user()->id . '.pdf');
        } else {
            return response()->json(['success' => true, 'message' => 'Error while  download invoice']);
        }
    }
    public function deleteInvoices(Request $request)
    {
        $invoice = Inventory::find($request->id);
        if ($invoice) {
            $invoice->delete();
            $items = items::where('invoices_id', $request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Delete Invoice Successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Error while  Deleting Invoice']);
        }
    }
    public function getcustomerpaymentsinfo(Request $request)
    {
        if (Auth::user()->isadmin()) {
            if ($request->propertyname == null) {
                $userpayments = Payment::where('buyer_id', $request->userid)->get();
                $totalpaymentscount = $userpayments->count();
                $totalpaymentsamount = $userpayments->sum('payment_amount');
                $totalpropertiescount = Property::where('buyer_id', $request->userid)->count();
            } else {
                $userpayments = Payment::where('buyer_id', $request->userid)->where('property', $request->propertyname)->get();
                $totalpaymentscount = $userpayments->count();
                $totalpaymentsamount = $userpayments->sum('payment_amount');
                $totalpropertiescount = Property::where('buyer_id', $request->userid)->where('name', $request->propertyname)->count();
            }
            return response()->json([
                'success' => true,
                'totalpaymentscount' => $totalpaymentscount,
                'totalpaymentsamount' => $totalpaymentsamount,
                'totalpropertiescount' => $totalpropertiescount
            ]);
        } else if (Auth::user()->iscustomer()) {
            if ($request->propertyname == null) {
                $userpayments = Payment::where('buyer_id', Auth::user()->id)->get();
                $totalpaymentscount = $userpayments->count();
                $totalpaymentsamount = $userpayments->sum('payment_amount');
                $totalpropertiescount = Property::where('buyer_id', Auth::user()->id)->count();
            } else {
                $userpayments = Payment::where('buyer_id', Auth::user()->id)->where('property', $request->propertyname)->get();
                $totalpaymentscount = $userpayments->count();
                $totalpaymentsamount = $userpayments->sum('payment_amount');
                $totalpropertiescount = Property::where('buyer_id', Auth::user()->id)->where('name', $request->propertyname)->count();
            }
            return response()->json([
                'success' => true,
                'totalpaymentscount' => $totalpaymentscount,
                'totalpaymentsamount' => $totalpaymentsamount,
                'totalpropertiescount' => $totalpropertiescount
            ]);
        }
    }

    public function getcustomerpropertiesinfo(Request $request)
    {
        $customerproperties = Property::where('buyer_id', $request->userid)->get();
        $totalpropertiescount = $customerproperties->count();
        $totalpropertiesamount = $customerproperties->sum('price');
        return response()->json([
            'success' => true,
            'totalpropertiescount' => $totalpropertiescount,
            'totalpropertiesamount' => $totalpropertiesamount
        ]);
    }

    // assign agent data
    public function assignagentdataindex()
    {
        // jsut for normal agent and aconsultant agent
        $users = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $address = Data::select('ADDRESS')->distinct()->get();
        $emirates = Data::select('EMIRATE')->distinct()->get();
        $residencecountries = Data::select('RESIDENCE_COUNTRY')->distinct()->get();
        $nationalities = Data::select('NATIONALITY')->distinct()->get();
        $datasources = Data::select('source')->distinct()->get();
        $areas = Data::select('AREA')->distinct()->get();
        return view('admin.assignagentdata', ['datasources' => $datasources, 'users' => $users, 'address' => $address, 'emirates' => $emirates, 'residencecountries' => $residencecountries, 'nationalities' => $nationalities, 'areas' => $areas]);
    }

    public function showcommenteddata()
    {
        $users = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $comments = UserData::select('comment')->distinct()->get();
        $emirates = Data::select('EMIRATE')->distinct()->get();
        $residencecountries = Data::select('RESIDENCE_COUNTRY')->distinct()->get();
        $userstatus = config('app.user_status');
        $datasource = $datasource = Data::select('source')->groupby('source')->get();
        return view('admin.showusercommenteddata', [
            'users' => $users,
            'comments' => $comments,
            'userstatus' => $userstatus,
            'emirates' => $emirates,
            'residences' => $residencecountries,
            'datasource' => $datasource
        ]);
    }

    public function createpropertyindex()
    {
        // $users = User::select('id', 'name')->where('role_id', '4')->get();
        $property_types = [
            'Apartment',
            'Villa',
            'Townhouse',
            'Penthouse',
            'Compound',
            'Duplex',
            'Full Floor',
            'Whole Building',
            'Bulk Rent Unit',
            'Bungalow',
            'Hotel & Hotel Aprtment',
            'Office Space',
            'Retail',
            'Warehouse',
            'Shop',
            'Show Room',
            'Whole Buildig',
            'Land',
            'Factory', 'Labor Camp', 'Staff Accommodation', 'Business Center', 'Co-Working Space', 'Farm'
        ];
        sort($property_types);
        return view('admin.createproperty', compact('property_types'));
    }

    public function createcontractsindex()
    {
        // $properties = Property::pluck("name");
        // $users = User::select("id", "name")->where('role_id', '4')->get();
        return view('admin.createcontracts');
    }

    public function createuserindex()
    {
        $roles=Role::where('name','!=','admin')->where('name','!=','consultant')->where('name','!=','buyer')->get();
        return view('admin.createuser',compact('roles'));
    }

    public function createbuyerindex()
    {
        return view('admin.createbuyer');
    }

    public function createnewinvoices(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->toArray(), [
            'client_name' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'country' => 'required',
            'date' => 'required',
            'note' => 'required',
            'description' => 'required',
            "serial_num" => "required|array",
            "serial_num.*" => "required",
            "quanttity" => "required|array",
            'quanttity.*' => 'required',
            "amount" => "required|array",
            'amount.*' => 'required',
            "description_item" => "required|array",
            'description_item.*' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'success' => false
            ]);
        }
        $invoice =  new Inventory;
        $invoice->client_name = $request->client_name;
        $invoice->address1 = $request->address1;
        $invoice->address2 = $request->address2;
        $invoice->country = $request->country;
        $invoice->date = $request->date;
        $invoice->LPONO = $request->LPONO;
        $invoice->note = $request->note;
        $invoice->description = $request->description;
        $invoice->save();
        for ($i = 0; $i < count($request->serial_num); $i++) {

            $items = new items;
            $items->invoices_id = $invoice->id;
            $items->serial_num = $request->serial_num[$i];
            $items->quanttity = $request->quanttity[$i];
            $items->amount = $request->amount[$i];
            $items->description_item = $request->description_item[$i];
            $items->save();
        }


        // $invoice->items()->createMany($items);
        if ($invoice != null)
            return response()->json(['success' => true, 'message' => 'invoice created successfully']);
        else
            return response()->json(['success' => false, 'message' => 'Error in creating new invoice']);
    }


    public function createcustomerindex()
    {
        return view('adminagent.createcustomer');
    }

    public function createnvoicesindex()
    {
        // developers
        // $developers = [
        //     "EMAAR", "DAMAC", "NAKHEEL", "DUBAI PROPERTIES", "MERAAS", "MEYDAN", "SOBHA", "DEYAAR", "OMNIYAT", "MAG",
        //     "Select Group", "The First Group", "Wasl Properties", "Dubai Investments Real Estate",
        //     "Binghatti Developers", "Azizi Developments", "Danube", "Ellington Properties", "Tilal Properties",
        //     "Al Futtaim Real Estate", "Majid al Futtaim Real Estate", "Diamond Developers", "Nshama",
        //     "Al Habtoor Group", "Bloom Properties", "Seven Tides International", "Cayan Group", "Al Barari",
        //     "Time Properties", "G&Co Properties"
        // ];
        // sort($developers);

        // dubai locations
        // $locations = [
        //     "Abu Hail",
        //     "Al Awir First",
        //     "Al Awir Second",
        //     "Al Bada",
        //     "Al Baraha",
        //     "Al Barsha First",
        //     "Al Barsha Second",
        //     "Al Barsha South First",
        //     "Al Barsha South Second",
        //     "Al Barsha South Third",
        //     "Al Barsha Third",
        //     "Al Buteen",
        //     "Al Dhagaya",
        //     "Al Garhoud",
        //     "Al Guoz Fourth",
        //     "Al Hamriya, Dubai",
        //     "Al Hamriya Port",
        //     "Al Hudaiba",
        //     "Al Jaddaf",
        //     "Al Jafiliya",
        //     "Al Karama",
        //     "Al Khabisi",
        //     "Al Khwaneej First",
        //     "Al Khwaneej Second",
        //     "Al Kifaf",
        //     "Al Mamzar",
        //     "Al Manara",
        //     "Al Mankhool",
        //     "Al Merkad",
        //     "Al Mina",
        //     "Al Mizhar First",
        //     "Al Mizhar Second",
        //     "Al Muraqqabat",
        //     "Al Murar",
        //     "Al Mushrif",
        //     "Al Muteena",
        //     "Al Nahda First",
        //     "Al Nahda Second",
        //     "Al Nasr, Dubai",
        //     "Al Quoz First",
        //     "Al Quoz Industrial First",
        //     "Al Quoz Industrial Fourth",
        //     "Al Quoz Industrial Second",
        //     "Al Quoz Industrial Third",
        //     "Al Quoz Second",
        //     "Al Quoz Third",
        //     "Al Qusais First",
        //     "Al Qusais Industrial Fifth",
        //     "Al Qusais Industrial First",
        //     "Al Qusais Industrial Fourth",
        //     "Al Qusais Industrial Second",
        //     "Al Qusais Industrial Third",
        //     "Al Qusais Second",
        //     "Al Qusais Third",
        //     "Al Raffa",
        //     "Al Ras",
        //     "Al Rashidiya",
        //     "Al Rigga",
        //     "Al Sabkha",
        //     "Al Safa First",
        //     "Al Safa Second",
        //     "Al Safouh First",
        //     "Al Safouh Second",
        //     "Al Satwa",
        //     "Al Shindagha",
        //     "Al Souq Al Kabeer",
        //     "Al Twar First",
        //     "Al Twar Second",
        //     "Al Twar Third",
        //     "Al Warqa'a Fifth",
        //     "Al Warqa'a First",
        //     "Al Warqa'a Fourth",
        //     "Al Warqa'a Second",
        //     "Al Warqa'a Third",
        //     "Al Wasl",
        //     "Al Waheda",
        //     "Ayal Nasir",
        //     "Aleyas",
        //     "Business Bay",
        //     "Bu Kadra",
        //     "Dubai Investment park First",
        //     "Dubai Investment Park Second",
        //     "Emirates Hill First",
        //     "Emirates Hill Second",
        //     "Emirates Hill Third",
        //     "Hatta",
        //     "Hor Al Anz",
        //     "Hor Al Anz East",
        //     "Jebel Ali 1",
        //     "Jebel Ali 2",
        //     "Jebel Ali Industrial",
        //     "Jebel Ali Palm",
        //     "Jumeira First",
        //     "Palm Jumeira",
        //     "Jumeira Second",
        //     "Jumeira Third",
        //     "Marsa Dubai",
        //     "Mirdif",
        //     "Muhaisanah Fourth",
        //     "Muhaisanah Second",
        //     "Muhaisanah Third",
        //     "Muhaisnah First",
        //     "Nad Al Hammar",
        //     "Nadd Al Shiba Fourth",
        //     "Nadd Al Shiba Second",
        //     "Nadd Al Shiba Third",
        //     "Nad Shamma",
        //     "Naif",
        //     "Port Saeed",
        //     "Arabian Ranches",
        //     "Oud Al Muteena Third",
        //     "Ras Al Khor",
        //     "Ras Al Khor Industrial First",
        //     "Ras Al Khor Industrial Second",
        //     "Ras Al Khor Industrial Third",
        //     "Rigga Al Buteen",
        //     "Trade Centre 1",
        //     "Trade Centre 2",
        //     "Umm Al Sheif",
        //     "Umm Hurair First",
        //     "Umm Hurair Second",
        //     "Umm Ramool",
        //     "Umm Suqeim First",
        //     "Umm Suqeim Second",
        //     "Umm Suqeim Third",
        //     "Wadi Alamardi",
        //     "Warsan First",
        //     "Warsan Second",
        //     "Za'abeel First",
        //     "Za'abeel Second"

        // ];
        // sort($locations);

        // $propertytype = ["Apartment", "Townhouse", "Villa Compound", "Residential Plot", "Residential Building", "Villa", "Penthouse", "Hotel Apartment", "Residential Floor"];
        // sort($propertytype);

        // $status = config('app.user_status');
        $countries = [
            'Afghanistan',
            'Åland Islands',
            'Albania',
            'Algeria',
            'American Samoa',
            'Andorra',
            'Angola',
            'Anguilla',
            'Antarctica',
            'Antigua and Barbuda',
            'Argentina',
            'Armenia',
            'Aruba',
            'Australia',
            'Austria',
            'Azerbaijan',
            'Bahamas',
            'Bahrain',
            'Bangladesh',
            'Barbados',
            'Belarus',
            'Belgium',
            'Belize',
            'Benin',
            'Bermuda',
            'Bhutan',
            'Bolivia, Plurinational State of',
            'Bonaire, Sint Eustatius and Saba',
            'Bosnia and Herzegovina',
            'Botswana',
            'Bouvet Island',
            'Brazil',
            'British Indian Ocean Territory',
            'Brunei Darussalam',
            'Bulgaria',
            'Burkina Faso',
            'Burundi',
            'Cambodia',
            'Cameroon',
            'Canada',
            'Cape Verde',
            'Cayman Islands',
            'Central African Republic',
            'Chad',
            'Chile',
            'China',
            'Christmas Island',
            'Cocos (Keeling) Islands',
            'Colombia',
            'Comoros',
            'Congo',
            'Congo',
            'Cook Islands',
            'Costa Rica',
            'Côte d\'Ivoire',
            'Croatia',
            'Cuba',
            'Curaçao',
            'Cyprus',
            'Czech Republic',
            'Denmark',
            'Djibouti',
            'Dominica',
            'Dominican Republic',
            'Ecuador',
            'Egypt',
            'El Salvador',
            'Equatorial Guinea',
            'Eritrea',
            'Estonia',
            'Ethiopia',
            'Falkland Islands (Malvinas)',
            'Faroe Islands',
            'Fiji',
            'Finland',
            'France',
            'French Guiana',
            'French Polynesia',
            'French Southern Territories',
            'Gabon',
            'Gambia',
            'Georgia',
            'Germany',
            'Ghana',
            'Gibraltar',
            'Greece',
            'Greenland',
            'Grenada',
            'Guadeloupe',
            'Guam',
            'Guatemala',
            'Guernsey',
            'Guinea',
            'Guinea-Bissau',
            'Guyana',
            'Haiti',
            'Heard Island and McDonald Mcdonald Islands',
            'Holy See (Vatican City State)',
            'Honduras',
            'Hong Kong',
            'Hungary',
            'Iceland',
            'India',
            'Indonesia',
            'Iran, Islamic Republic of',
            'Iraq',
            'Ireland',
            'Isle of Man',
            'Israel',
            'Italy',
            'Jamaica',
            'Japan',
            'Jersey',
            'Jordan',
            'Kazakhstan',
            'Kenya',
            'Kiribati',
            'Korea, Democratic People\'s Republic of',
            'Korea, Republic of',
            'Kuwait',
            'Kyrgyzstan',
            'Lao People\'s Democratic Republic',
            'Latvia',
            'Lebanon',
            'Lesotho',
            'Liberia',
            'Libya',
            'Liechtenstein',
            'Lithuania',
            'Luxembourg',
            'Macao',
            'Macedonia, the Former Yugoslav Republic of',
            'Madagascar',
            'Malawi',
            'Malaysia',
            'Maldives',
            'Mali',
            'Malta',
            'Marshall Islands',
            'Martinique',
            'Mauritania',
            'Mauritius',
            'Mayotte',
            'Mexico',
            'Micronesia, Federated States of',
            'Moldova, Republic of',
            'Monaco',
            'Mongolia',
            'Montenegro',
            'Montserrat',
            'Morocco',
            'Mozambique',
            'Myanmar',
            'Namibia',
            'Nauru',
            'Nepal',
            'Netherlands',
            'New Caledonia',
            'New Zealand',
            'Nicaragua',
            'Niger',
            'Nigeria',
            'Niue',
            'Norfolk Island',
            'Northern Mariana Islands',
            'Norway',
            'Oman',
            'Pakistan',
            'Palau',
            'Palestine, State of',
            'Panama',
            'Papua New Guinea',
            'Paraguay',
            'Peru',
            'Philippines',
            'Pitcairn',
            'Poland',
            'Portugal',
            'Puerto Rico',
            'Qatar',
            'Réunion',
            'Romania',
            'Russian Federation',
            'Rwanda',
            'Saint Barthélemy',
            'Saint Helena, Ascension and Tristan da Cunha',
            'Saint Kitts and Nevis',
            'Saint Lucia',
            'Saint Martin (French part)',
            'Saint Pierre and Miquelon',
            'Saint Vincent and the Grenadines',
            'Samoa',
            'San Marino',
            'Sao Tome and Principe',
            'Saudi Arabia',
            'Senegal',
            'Serbia',
            'Seychelles',
            'Sierra Leone',
            'Singapore',
            'Sint Maarten (Dutch part)',
            'Slovakia',
            'Slovenia',
            'Solomon Islands',
            'Somalia',
            'South Africa',
            'South Georgia and the South Sandwich Islands',
            'South Sudan',
            'Spain',
            'Sri Lanka',
            'Sudan',
            'Suriname',
            'Svalbard and Jan Mayen',
            'Swaziland',
            'Sweden',
            'Switzerland',
            'Syrian Arab Republic',
            'Taiwan',
            'Tajikistan',
            'Tanzania, United Republic of',
            'Thailand',
            'Timor-Leste',
            'Togo',
            'Tokelau',
            'Tonga',
            'Trinidad and Tobago',
            'Tunisia',
            'Turkey',
            'Turkmenistan',
            'Turks and Caicos Islands',
            'Tuvalu',
            'Uganda',
            'Ukraine',
            'United Arab Emirates',
            'United Kingdom',
            'United States',
            'United States Minor Outlying Islands',
            'Uruguay',
            'Uzbekistan',
            'Vanuatu',
            'Venezuela, Bolivarian Republic of',
            'Viet Nam',
            'Virgin Islands, British',
            'Virgin Islands, U.S.',
            'Wallis and Futuna',
            'Western Sahara',
            'Yemen',
            'Zambia',
            'Zimbabwe',
        ];
        sort($countries);

        // $client=User::where('role_id','3')->get();

        return view('adminagent.invoices.createinvoices', compact('countries'));
    }

    public function showbookviewsindex()
    {
        return view('showbookview');
    }

    public function createnewcontracts(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'contract_date' => 'required',
            'Property' => 'required',
            'name_of_guest' => 'required',
            'accommodation_charge' => 'required',
            'security_deposit' => 'required',
            'date_of_stay' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'success' => false
            ]);
        }
        try {
            $start_date = strtotime($request->startdate);
            $end_date = strtotime($request->enddate);
            $days = $days = $days = abs(($start_date - $end_date) / 86400);;
            $Contracts = new  Contracts;
            $Contracts->contract_date = $request->contract_date;
            $Contracts->Property = $request->Property;
            $Contracts->name_of_guest = $request->name_of_guest;
            $Contracts->accommodation_charge = $request->accommodation_charge;
            $Contracts->security_deposit = $request->security_deposit;
            $Contracts->date_of_stay = $request->date_of_stay;
            $Contracts->number_of_days = $days;
            $Contracts->save();
            if ($Contracts != null) {
                return response()->json(['success' => true, 'message' => 'Contract created successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error in creating new Contract']);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function createnewcustomer(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required_if:,null&email&unique:users,email',
                'phone' => 'required_if:email,null&regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
                'WhatsApp_number' => 'required',
                // 'password' => 'required|required_with:password_confirm|same:password_confirm'
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used',
                // 'same'    => 'passwrod and confirmed password should be equal',
            ]
        );

        /////////// add to data
        $data = Data::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' =>  $request->phone,
            'phone_whatsup' => $request->WhatsApp_number,
            'source' => "customer enquiry",
            'project' => $request->projectname,
            'agents' => Auth::user()->name,
            'data_status' => 8,
            'previous_status' => 0
        ]);

        /////////// asign to user
        UserData::create([
            'user_id' => Auth::user()->id,
            'data_id' => $data->id
        ]);

        // add comment
        UserDataComment::create([
            'user_id' => Auth::user()->id,
            'data_id' => $data->id,
            'comment' => $request->notes,
            'userstatus' => "Interested"
        ]);

        // add data to leads pool
        $user = booktable::create([
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'WhatsApp_phone' => $data->phone_whatsup,
            'source' => $data->source,
            'project' => $data->project,
            'title' => $data->unique,
            'data_id' => $data->id,
            'previous_state' => '0',
            'previous_state_id' => $data->id,
            'created_by' => Auth::user()->id,
            'is_enquiry_customer' => true,
        ]);

        if ($user != null)
            return response()->json(['success' => true, 'message' => 'Customer created successfully']);
        else
            return response()->json(['success' => false, 'message' => 'Error in creating new customer']);
    }

    public function createnewproperty(Request $request)
    {
        $count = 0;
        foreach ($request->all() as $key => $value) {
            if ($key != "_token" && $key != "balcony" && $key != "common_area" && $value == null) {
                $count += 1;
            }
        }
        if ($count == count($request->all()) - 3) {
            return response()->json(['success' => false, 'message' => 'Please add some data']);
        }
        $property = new Property;
        $property->name = $request->name;
        $property->area = $request->area;
        $property->plot_number = $request->plot_number;
        $property->p_number = $request->p_number;
        $property->secondary_mobile = $request->secondary_mobile;
        $property->nationality = $request->nationality;
        $property->building_name = $request->building_name;
        $property->registration_number = $request->registration_number;
        $property->flat_number = $request->flat_number;
        $property->balcony = ($request->balcony == "on") ? true : false;
        $property->parking_number = $request->parking_number;
        $property->common_area = ($request->common_area  == "on") ? true : false;
        $property->floor = $request->floor;
        $property->rooms = $request->rooms;
        $property->levels = $request->levels;
        $property->email = $request->email;
        $property->phone = $request->phone;
        $property->shops = $request->shops;
        $property->flats = $request->flats;
        $property->offices = $request->offices;
        $property->age = $request->age;
        $property->municipality_number = $request->municipality_number;
        $property->master_project = $request->master_project;
        $property->project = $request->project;
        $property->property_type = $request->property_type;
        $property->type = $request->type;
        $property->villa_number = $request->villa_number;
        $property->actual_area = $request->actual_area;
        $property->save();



        if ($property != null)
            return response()->json(['success' => true, 'message' => 'Property created successfully']);
        else
            return response()->json(['success' => false, 'message' => 'Error in creating new property']);
    }

    // create new agent
    public function createnewuser(Request $request)
    {
        $request->validate(
            [
                'role'=>'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|regex:/^\+(?:[0-9] ?){8,14}[0-9]$/',
                'language' => 'required',
                'password' => 'required|required_with:password_confirm|same:password_confirm',
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used',
                'same'    => 'passwrod and confirmed password should be equal',
                'regex'  => 'Please enter valid phone number',
            ]
        );
        if ($request->hasfile('image')){
            $imageName = rand(0, 10000) . time() . '.' . $request->image->extension();
            $request->image->move(public_path('storage/users/'), $imageName);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image'=>$request->hasfile('image') ? ('storage/users/' .  $imageName) : null,
            'position'=>($request->position) ? $request->position :null,
            'language' => $request->language,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
        ]);
        if ($user != null)
            return response()->json(['success' => true, 'message' => 'User created successfully']);
        else
            return response()->json(['success' => false, 'message' => 'Error in creating new user']);
    }

    // create new buyers
    public function createnewbuyer(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email'
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used',
            ]
        );
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            // 'password' => Hash::make($request->password),
            'role_id' => '4',
        ]);
        if ($user != null)
            return response()->json(['success' => true, 'message' => 'Buyer created successfully']);
        else
            return response()->json(['success' => false, 'message' => 'Error in creating new buyer']);
    }

    public function importenquirycustomer(Request $request)
    {
        try {
            if ($request->file == 'undefined')
                return response()->json(['success' => false, 'message' => 'You should select file first']);
            $validator = Validator::make(
                [
                    'file'      => $request->file,
                    'extension' => strtolower($request->file->getClientOriginalExtension()),
                ],
                [
                    'file'          => 'required',
                    'extension'      => 'required|in:csv',
                ]
            );

            $validator->validate();
            Excel::import(new EnquriyCustomerImport, $request->file('file'));
            return response()->json(['success' => true, 'message' => 'File imported successfully']);
        } catch (Exception $ex) {
            dd($ex);
        }

    }

    public function showbooks(Request $request)
    {
        $users = User::all();
        $userbook = UserBook::all();
        if ($request->campaignsource == '' && $request->userstatus == '') {
            $data = booktable::orderBy('created_at', 'DESC')->get();
        } else if ($request->campaignsource != '' && $request->userstatus == '') {
            $data = booktable::where('campaign_name', $request->campaignsource)->orderBy('created_at', 'DESC')->get();
        } else if ($request->campaignsource == '' && $request->userstatus != '') {
            $userbk = UserBook::where('userstatus', $request->userstatus)->groupBy('book_id')->pluck('book_id');
            $data = booktable::whereIn('id', $userbk)->orderBy('created_at', 'DESC')->get();
        } else {
            $userbk = UserBook::where('userstatus', $request->userstatus)->groupBy('book_id')->pluck('book_id');
            $data = booktable::whereIn('id', $userbk)->where('campaign_name', $request->campaignsource)->orderBy('created_at', 'DESC')->get();
        }

        $userstates = config('app.user_status');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($user) {
                return  date('d-m-Y h-m-s', strtotime($user->created_at));
            })
            ->addColumn('action', function ($row) {
                if ($row->is_enquiry_customer) {
                    $actionBtn = '<a class="delete btn btn-danger btn-md ml-3">Delete</a>' . " ";
                    $actionBtn .= '<a style="background-color:#70cacc" class="edit btn btn-info btn-md ml-1">Edit</a>';
                    return $actionBtn;
                }
            })
            ->addColumn('comments', function ($row) use ($userbook, $users) {
                $values = $userbook->where('book_id', $row->id);
                $res = "";
                foreach ($values as $key => $value) {
                    $user = $users->where('id', $value->user_id)->first();
                    if ($user != null) {
                        $comment = '<div class="row"> <h4> ' . $value->comment . '</h4> , <div style="color:#70cacc">&nbsp;&nbsp;' . $value->userstatus . ' </div> </div> <div class="row"> <h6>' . $user->name . ', ' . $value->created_at . '</h6> </div>';
                        // $comment = '<input style="border-width:0px;border:none;" class="form-control" id="comment mr-2' . $row->id . '" name="comment" value= "' . $user->name .', ' .  $value->comment . ', ' . $value->created_at . '" type="text" >';
                        $res .= $comment;
                    }
                }
                return $res;
                // if ($res != null)
                // else
                //     return '<input class="form-control trackInput" id="comment mr-2' . $row->id . '" name="comment" value="" type="text" >';
            })
            ->addColumn('customerstatus', function ($row) use ($userstates) {
                $userbook = UserBook::select(DB::raw("COUNT(*) as count_row"), 'userstatus')->where('book_id', $row->id)->groupBy('userstatus')->orderBy('count_row', 'desc')->pluck('userstatus', 'count_row')->first();
                $options =  '<select name="" class="form-control ml-2" id="">';
                $options .= "<option> </option>";
                foreach ($userstates as $key => $value) {
                    if ($userbook != null) {
                        if ($value == $userbook)
                            $options .= '<option value=' . $value . ' selected>' . $value . '</option>';
                        else
                            $options .= '<option value=' . $value . '>' . $value . '</option>';
                    } else {
                        $options .= '<option class="selected" value=' . $value . '>' . $value . '</option>';
                    }
                }
                $options .= '</select>';
                return  $options;
            })
            ->addColumn('comment', function ($row) {
                return '<input class="form-control trackInput ml-3 mr-3" id="comment' . $row->id . '" name="comment" value="" type="text" >';
            })
            ->addColumn('addcomment', function ($row) {
                return '<input style="background-color:#70cacc" class="btn btn-md btn-success ml-4 addcomment" value="Add" id="addcomment' . $row->id . '" name="addcomment" type="button" >';
            })
            ->rawColumns(['action', 'comments', 'customerstatus', 'comment', 'addcomment'])
            ->make(true);
    }

    public function showbookviews()
    {
        $data = BookView::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a class="delete btn btn-danger btn-sm">Delete</a>' . " ";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getLavaChart()
    {
        $lava = new Lavacharts;
        $COUNTS = DB::table('data')
            ->select("NATIONALITY as first", DB::raw("COUNT(NATIONALITY) as second"))
            ->groupby('NATIONALITY')
            ->get()->toArray();
        $array = [];
        foreach ($COUNTS as $count) {
            array_push($array, ['0' => $count->first, '1' => $count->second]);
        }


        // foreach ($COUNTS as $COUNT) {
        //     ge::updateOrCreate([
        //         'first' => $COUNT->NATIONALITY,
        //         'second' => $COUNT->second
        //     ],[
        // 'first' =>  $COUNT->NATIONALITY ,
        // 'second' => $COUNT->second ,
        // ]);
        // }
        // $ss = DB::table('data')
        // ->select('NATIONALITY', DB::raw('COUNT(NATIONALITY)'))
        // ->groupby('NATIONALITY')
        // ->get()->toArray();
        // dd($ss);



        $users = $lava->DataTable();
        // $data = ge::select("first as 0","second as 1")->get()->toArray();
        $users->addStringColumn('Country');
        $users->addNumberColumn('Users');
        $users->addRows($array);
        $lava->GeoChart('Users', $users, [
            'colorAxis'                 => ['green'],   //ColorAxis Options
            'enableRegionInteractivity' => true,
            'keepAspectRatio'           => true,
            'minZoom'           => true,
            //SizeAxis Options
        ]);


        return view('lavacharts', compact('lava'));
    }

    public function getProgressB()
    {
        try {
            $totalexcelrows = session('constvar1988', 0) + session('constvar1989', 0);
            $starttime = new DateTime(session('starttime'));
            $elapsedtime = now()->getTimestamp() - $starttime->getTimestamp();
            $minutes = intval($elapsedtime / 60);
            $seconds = $elapsedtime % 60;
            $res = [
                'imported' => session('constvar1988', 0),
                'duplicated' => session('constvar1989', 0),
                'processstatus' => session('processstatus', 0),
                'filename' => session('filename', ''),
                'filesize' =>  session('filesize', 0),
                'totalexcelrows' => $totalexcelrows,
                'elapsedtime' => isset($minutes) ? $minutes . ' m, ' . $seconds . ' s' : ''
            ];
            return $res;
        } catch (Exception $ex) {
            $res = [
                'imported' => 0,
                'duplicated' => 0,
                'processstatus' => 0,
                'filename' => '',
                'filesize' => 0,
                'totalexcelrows' => 0,
                'starttime' => 0
            ];
            return $res;
        }
    }

    public function getImportStatus()
    {
        return session('processstatus', 0);
    }

    public function finishImportStatus()
    {
        session()->put(['processstatus' => 0]);
        session::save();
    }

    public function startImportStatus()
    {
        session()->put(
            [
                'processstatus' => 1,
                'starttime' => now(),
                'imported' => 0,
                'duplicated' => 0
            ]
        );
        session::save();
    }

    public function clearProgressBar()
    {
        session::forget('filename');
        session::forget('filesize');
        session::forget('starttime');
        session::forget('processstatus');
        session::forget('constvar1988');
        session::forget('constvar1989');
        session::forget('imported');
        session::forget('duplicated');
    }

    public function agentdata()
    {
        $areas = Data::select('AREA')->distinct()->where('AREA', '<>', '')->get();
        $emirates = Data::select('EMIRATE')->distinct()->where('EMIRATE', '<>', '')->get();
        $residences = Data::select('RESIDENCE_COUNTRY')->distinct()->where('RESIDENCE_COUNTRY', '<>', '')->get();
        $datasource = Data::select('source')->groupby('source')->get();

        if (Auth::user()->isadmin())
            return view('admin.agentdata')->with('areas', $areas)
                ->with('emirates', $emirates)->with('residences', $residences)->with('datasource', $datasource);
        else
            return view('agent.userhome')->with('areas', $areas)
                ->with('emirates', $emirates)->with('residences', $residences);
    }

    public function index()
    {
        $areas = Data::select('AREA')->distinct()->where('AREA', '<>', '')->get();
        $emirates = Data::select('EMIRATE')->distinct()->where('EMIRATE', '<>', '')->get();
        $residences = Data::select('RESIDENCE_COUNTRY')->distinct()->where('RESIDENCE_COUNTRY', '<>', '')->get();
        $userstates = config('app.user_status');
        $datasource = Data::select('source')->groupby('source')->get();

        if (Auth::user()->isadmin())
            return view('admin.home')->with('areas', $areas)
                ->with('emirates', $emirates)->with('residences', $residences)->with('datasource', $datasource);
        else
            return view('agent.userhome')->with('areas', $areas)
                ->with('emirates', $emirates)->with('residences', $residences)->with('userstates', $userstates)->with('datasource', $datasource);
    }

    public function index1()
    {
        $areas = Data::select('AREA')->distinct()->where('AREA', '<>', '')->get();
        $emirates = Data::select('EMIRATE')->distinct()->where('EMIRATE', '<>', '')->get();
        $residences = Data::select('RESIDENCE_COUNTRY')->distinct()->where('RESIDENCE_COUNTRY', '<>', '')->get();
        $userstatus = config('app.user_status');
        $datasource = Data::select('source')->groupby('source')->get();
        return view('agent.userhomeshow')->with('areas', $areas)
            ->with('emirates', $emirates)->with('residences', $residences)->with('userstatus', $userstatus)->with('datasource', $datasource);
    }

    public function map()
    {
        $markers = DB::table('data')->select('lng', 'lat')->where(
            [
                ['lng', '<>', null],
                ['lat', '<>', null],
                ['lat', '<>', ''],
                ['lat', '<>', ''],
            ]
        )->distinct()->get();

        $emptyMarker = DB::table('data')->select('lng', 'lat')->where(
            [
                ['lng', '=', null],
                ['lat', '=', null],
            ]
        )->get();

        return view('admin.map', compact('markers', 'emptyMarker'));
    }

    public function uploadedFiles()
    {
        $files = DB::table('uploaded_files')->select('id', 'fileName', 'created_at', 'numberofimportedrows')->distinct()->get();
        $totaRowsCount = 0;
        foreach ($files as $value) {
            $totaRowsCount += intval($value->numberofimportedrows);
        }
        return view('admin.uploadedFiles', compact('files', 'totaRowsCount'));
    }

    public function downloadFile($fileName)
    {
        $file = 'uploadedFiles/' . $fileName;
        $headers = array(
            'Content-Type: application/octet-stream',
        );


        return Response::download($file, $fileName, $headers);
    }

    function getall()
    {
        try {
            // $data = Data::all();
            return (Datatables::of(Data::all())->make(true));
        } catch (Exception $th) {
            dd($th);
        }
    }

    public function filterIng($emirates, $area, $residence)
    {
        if ($emirates == 'Show' && $area == 'Show' && $residence == 'Show') {
            $data = DB::table('data')->limit(100)->get();
            return $data;
        }


        $data = DB::table('data')
            ->where('EMIRATE', $emirates)
            ->orWhere('RESIDENCE_COUNTRY', $residence)
            ->orWhere('AREA', $area)->get();
        return $data;
    }

    public function search(Request $request)
    {
        $emirates = $request->emirates;
        $datasource = $request->datasource;
        $residence = $request->residence;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $filtertext = $request->searchday;
        $datasource = $request->datasource;
        $searchdaytext = null;
        $monthfiltertext = null;

        if (!is_null($filtertext)) {
            $filtertext = explode('-', $filtertext);
            $monthfiltertext = $filtertext[1];
            $searchdaytext = $filtertext[0];
            if ($searchdaytext == "" || $searchdaytext == "00")
                $searchdaytext = null;

            if ($monthfiltertext == "" || $monthfiltertext == "00")
                $monthfiltertext = null;
        }

        $filtertype = $request->filtertype;

        $sdate = null;
        $edate = null;
        // search between range
        if (!is_null($startdate) && !is_null($enddate) && $filtertype == 2) {
            $sdate = Carbon::parse($startdate);
            $edate = Carbon::parse($enddate);
            if ($sdate->gt($edate))
                return response()->json(['message' => 'start date must smaller than end date']);
            $sdate = $sdate->subDay();
        }

        //
        if (!is_null($startdate) && $filtertype == 1) {
            $sdate = Carbon::parse($startdate);
        }

        if (Auth::user()->isadmin()) {
            $data = Data::orderBy('id', 'DESC');
        } else {
            $commenteddata = Auth::user()->userdatacomment()->pluck('data_id');
            $data =  Auth::user()->data()->whereNotIn('data.id', $commenteddata);
        }

        if (!is_null($emirates) && $emirates != "Show")
            $data->where('EMIRATE', 'LIKE', '%' . $emirates . '%');
        // if (!is_null($area) && $area != "Show")
        //     $data->where('AREA', 'LIKE', '%' . $area . '%');
        if (!is_null($residence) && $residence != "Show") {
            $data->where('RESIDENCE_COUNTRY', 'LIKE', '%' . $residence . '%');
        }
        if (!is_null($datasource) && $datasource != "Show")
            $data->where('source', '=', $datasource);

        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2) {
            $data->whereBetween('DOB', [$sdate, $edate]);
        }
        if (!is_null($monthfiltertext))
            $data->whereMonth('DOB', '=', $monthfiltertext);

        if (!is_null($searchdaytext))
            $data->whereDay('DOB', '=', $searchdaytext);

        if (Auth::user()->isadmin()) {
            return DataTables::of($data)
                ->addcolumn('check', function () {
                    return null;
                })
                ->rawColumns(['check'])
                ->make(true);
        } else {
            return DataTables::of($data)
                ->addColumn('addComment', function ($row) {
                    return '<div class="row">' .
                        '<div class="col-md-7"><input type="text" class="form-control w-100" id="comment' . $row->data_id . '" name=""></div>' .
                        '<div class="col-md-2 ml-3 mt-1"><button onclick="btn_click_add_comment(' . $row->data_id . ')" type="button" id="' . $row->data_id . '" class="btn btn-primary btn-sm">Add</button></div>' .
                        '</div>';
                })
                ->addColumn('userStatus', function ($row) {
                    return '<select name="userstatus" class="form-control w-75" id="userstatus' . $row->data_id . '" onchange="user_status_change_event(' . $row->data_id . ')">' .
                        '<option selected value="">User status</option>' .
                        '<option value="Interested" > Interested </option>' .
                        '<option value="Not interested" > Not interested </option>' .
                        '<option value="Not answer" > Not answer </option>' .
                        '<option value="Number unavailable/Not working for call/Incomplete no" > Number unavailable/Not working for call/Incomplete no </option>' .
                        '<option value="Switch off/Line busy/Wrong number/Invalid number" > Switch off/Line busy/Wrong number/Invalid number </option>' .
                        '<option value="Others" > Others </option>' .
                        '<option value="Set appointment" > Set appointment </option>' .
                        '</select>';
                })
                ->rawColumns(['addComment', 'userStatus'])
                ->make(true);
        }
    }

    public function search1(Request $request)
    {
        $userid = Auth::user()->id;
        $userstatus = $request->userstatus;
        $datasource = $request->datasource;
        $filtertext = $request->searchday;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $emirates = $request->emirates;
        $searchdaytext = null;
        $monthfiltertext = null;

        if (!is_null($filtertext)) {
            $filtertext = explode('-', $filtertext);
            $monthfiltertext = $filtertext[1];
            $searchdaytext = $filtertext[0];
            if ($searchdaytext == "" || $searchdaytext == "00")
                $searchdaytext = null;

            if ($monthfiltertext == "" || $monthfiltertext == "00")
                $monthfiltertext = null;
        }

        $filtertype = $request->filtertype;

        $sdate = null;
        $edate = null;
        // search between range
        if (!is_null($startdate) && !is_null($enddate) && $filtertype == 2) {
            $sdate = Carbon::parse($startdate);
            $edate = Carbon::parse($enddate);
            if ($sdate->gt($edate))
                return response()->json(['message' => 'start date must smaller than end date']);
        }

        //
        if (!is_null($startdate) && $filtertype == 1) {
            $sdate = Carbon::parse($startdate);
        }

        $data = UserData::join('user_data_comment', function ($join) {
            $join->on('user_data.data_id', '=', 'user_data_comment.data_id')
                ->on('user_data.user_id', '=', 'user_data_comment.user_id');
        })
            ->join('data', 'data.id', '=', 'user_data.data_id')
            ->join('users', 'users.id', '=', 'user_data_comment.user_id')
            ->where('user_data_comment.user_id', $userid)
            ->select(
                'data.PHONE',
                'data.EMAIL',
                'data.NAME',
                'data.EMIRATE',
                'data.ADDRESS',
                'data.GENDER',
                'data.DOB',
                'data.MOBILE',
                'data.SECONDARY_MOBILE',
                'data.Project',
                'data.source',
                'data.lat',
                'data.lng',
                'data.RESIDENCE_COUNTRY',
                'data.NATIONALITY',
                'user_data.data_id',
                'data.Agents',
                'user_data.user_id',
                'users.name as agentname',
                'user_data_comment.userstatus',
                'user_data_comment.comment as comment',
                'user_data_comment.appointment_date',
                'user_data_comment.created_at',
                'data.*'
            );


        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2)
            $data = $data->whereBetween('user_data_comment.created_at', [$sdate, $edate]);
        if (!is_null($monthfiltertext))
            $data = $data->whereMonth('user_data_comment.created_at', $monthfiltertext);
        if (!is_null($searchdaytext))
            $data = $data->whereDay('user_data_comment.created_at', '=', $searchdaytext);

        if ($userstatus != null)
            $data = $data->where('user_data_comment.userstatus', $userstatus);

        if ($emirates != null)
            $data = $data->where('data.emirate', $emirates);

        if (!is_null($datasource) && $datasource != "Show")
            $data = $data->where('data.source', $datasource);

        $data = $data->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('comments', function ($row) {
                $comment = null;
                if ($row->userstatus == "Interested")
                    $comment = '<div class="row ml-1" style="background-color:#FEFEE7"> <p> <b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Not interested")
                    $comment = '<div class="row ml-1" style="background-color:#00ff95"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Not answer")
                    $comment = '<div class="row ml-1" style="background-color:#bab2e1"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Number unavailable/Not working for call/Incomplete no")
                    $comment = '<div class="row ml-1" style="background-color:#ffc55c"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Switch off/Line busy/Wrong number/Invalid number")
                    $comment = '<div class="row ml-1" style="background-color:#AED6F1"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Others")
                    $comment = '<div class="row ml-1" style="background-color:#DAF7A6"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Set appointment")
                    $comment = '<div class="row ml-1" style="background-color:#F9C4F8"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> <p><b>Appointment date: </b> ' . $row->appointment_date . '</p> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else
                    $comment = '<div class="row ml-1"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                return $comment;
            })
            ->rawColumns(['comments'])
            ->make(true);
    }

    public function search2(Request $request)
    {
        $emirates = $request->emirates;
        $area = $request->area;
        $residence = $request->residence;
        $datasource = $request->datasource;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $filtertext = $request->searchday;
        $searchdaytext = null;
        $monthfiltertext = null;

        if (!is_null($filtertext)) {
            $filtertext = explode('-', $filtertext);
            $monthfiltertext = $filtertext[1];
            $searchdaytext = $filtertext[0];
            if ($searchdaytext == "" || $searchdaytext == "00")
                $searchdaytext = null;

            if ($monthfiltertext == "" || $monthfiltertext == "00")
                $monthfiltertext = null;
        }

        $filtertype = $request->filtertype;

        try {
            $sdate = null;
            $edate = null;
            // search between range
            if (!is_null($startdate) && !is_null($enddate) && $filtertype == 2) {
                $sdate = Carbon::parse($startdate);
                $edate = Carbon::parse($enddate);
                if ($sdate->gt($edate))
                    return response()->json(['message' => 'start date must smaller than end date']);
            }

            if (!is_null($startdate) && $filtertype == 1) {
                $sdate = Carbon::parse($startdate);
            }

            $data = Data::get();

            if (!is_null($emirates) && $emirates != "Show")
                $data->where('EMIRATE', 'LIKE', '%' . $emirates . '%');
            if (!is_null($area) && $area != "Show")
                $data->where('AREA', 'LIKE', '%' . $area . '%');
            if (!is_null($residence) && $residence != "Show") {
                $data->where('RESIDENCE_COUNTRY', 'LIKE', '%' . $residence . '%');
            }
            if (!is_null($datasource) && $datasource != "Show")
                $data->where('source', '=', $datasource);
            if (!is_null($sdate) && !is_null($edate) && $filtertype == 2) {
                $data->whereBetween('DOB', [$sdate, $edate]);
            }
            if (!is_null($monthfiltertext))
                $data->whereMonth('DOB', '=', $monthfiltertext);

            if (!is_null($searchdaytext))
                $data->whereDay('DOB', '=', $searchdaytext);

            return DataTables::of($data)
                ->addcolumn('check', function () {
                    return null;
                })
                ->rawColumns(['check'])
                ->make(true);
        } catch (Exception $th) {
            // dd($th);
        }
    }

    public function getinvoicesindex()
    {

        return view('adminagent.invoices.invoices');
    }

    public function getinvoices(Request $request)
    {

        $data = Inventory::with('items');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('items', function ($row) {
                $l = "";

                foreach ($row->items as $key) {
                    $l .= "<div class='row ml-1'> <p> <B>Serial Number:</B> $key->serial_num ,<B>Quanttity:</B> $key->quanttity,<B>Amount:</B> $key->amount ,<B>Description:</B> $key->description_item <p></div>";
                }
                return $l;
            })->addColumn('action', function ($row) {
                $actionBtn = '<a class="download btn btn-danger btn-md ml-3">Download PDF</a>' . " <a class='delete btn btn-danger btn-md ml-3'>Delete</a>";
                return $actionBtn;
            })
            ->rawColumns(['items', 'action'])
            ->make(true);
    }




    public function deletecomment(Request $request)
    {
        try {
            $dataid = $request->id;
            $data = Data::find($dataid);
            // 5 won leads
            // 6 dead leads
            // 7 qualified leads
            // 8 leads pool
            // 9 follow up leads

            if ($data) {
                try {
                    if ($data->data_status == 5) {
                        $wondata = WonLeads::where('data_id', $dataid)->first();
                        Data::find($dataid)->update(['data_status' => $wondata->previous_state, 'previous_status' => 0]);
                        $wondata->delete();
                    } else if ($data->data_status == 6) {
                        $deaddata = DeadLeads::where('data_id', $dataid)->first();
                        Data::find($dataid)->update(['data_status' => $deaddata->previous_state, 'previous_status' => 0]);
                        $deaddata->delete();
                    } else if ($data->data_status == 7) {
                        $qualifieddata = QualifiedLeads::where('data_id', $dataid)->first();
                        Data::find($dataid)->update(['data_status' => $qualifieddata->previous_state, 'previous_status' => 0]);
                        $qualifieddata->delete();
                    } else if ($data->data_status == 8) {
                        $leadspool = booktable::where('data_id', $dataid)->first();
                        Data::find($dataid)->update(['data_status' => $leadspool->previous_state, 'previous_status' => 0]);
                        $leadspool->delete();
                    } else if ($data->data_status == 9) {
                        $followupleads = FollowUpLeads::where('data_id', $dataid)->first();
                        Data::find($dataid)->update(['data_status' => $followupleads->previous_state, 'previous_status' => 0]);
                        $followupleads->delete();
                    }
                    $data = UserData::where('user_id', Auth::user()->id)->where('data_id', $dataid)->first();
                    $data->comment = null;
                    $data->userstatus = null;
                    $data->save();
                    UserDataComment::where('user_id', Auth::user()->id)->where('data_id', $dataid)->delete();
                } catch (Exception $ex) {
                    return response()->json(['success' => false, 'message' => "Data cannot be deleted"]);
                }
                return response()->json(['success' => true, 'message' => "Data comment has been deleted successfully"]);
            } else
                return response()->json(['success' => false, 'message' => "Data not found"]);
        } catch (Exception $ex) {
        }
    }

    public function addcomment(Request $request)
    {
        // if user status is interested from data then we add user to leads pool and set source as customer enquiry
        // if user status is interested from leads pool then add
        // if user status is not interseted then add to dead pools
        // if user status is set appointment then after appointment we save it in won deal

        // data_status:
        // 0 non qualified
        // 1 qualified
        // 2 intersted
        // 3 set apponitment
        // 4 not not interested
        // 5 won leads
        // 6 dead leads
        // 7 qualified leads
        // 8 leads pool
        // 9 follow up leads

        $request->validate([
            'comment' => 'required'
        ]);

        try {
            if ($request->appointment_date != null && $request->userstatus == "Set appointment") {
                // add comment
                UserDataComment::create([
                    'data_id' => $request->checkedrow,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus,
                    'appointment_date' => $request->appointment_date
                ]);

                // change data status to won leads
                $data = Data::find($request->checkedrow);
                $data->previous_status = $data->data_status;
                $data->data_status = 5;
                $data->save();

                // add data to own leads
                WonLeads::create([
                    'name' => $data->NAME,
                    'email' => $data->EMAIL,
                    'phone' => $data->PHONE,
                    'mobile' => $data->MOBILE,
                    'phone_whatsapp' => $data->phone_whatsup,
                    'number_of_beds' => is_numeric($data->No_of_Beds) ? $data->No_of_Beds : null,
                    'source' => $data->source,
                    'project' => $data->Master_Project,
                    'title' => $data->unique,
                    'data_id' => $data->id,
                    'previous_state' => '0',
                    'previous_state_id' => $request->checkedrow,
                    'created_by' => Auth::user()->id
                ]);
            } else if ($request->userstatus == "Interested") {
                // add comment
                UserDataComment::create([
                    'user_id' => Auth::user()->id,
                    'data_id' => $request->checkedrow,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus
                ]);

                // change data status to leads pool
                $data = Data::find($request->checkedrow);
                $data->previous_status = $data->data_status;
                $data->data_status = 8;
                $data->save();
                // dd($data);

                // add data to leads pool
                booktable::create([
                    'name' => $data->NAME,
                    'email' => $data->EMAIL,
                    'phone' => $data->PHONE,
                    'mobile' => $data->MOBILE,
                    'WhatsApp_phone' => $data->phone_whatsup,
                    'number_of_beds' => is_numeric($data->No_of_Beds) ? $data->No_of_Beds : null,
                    'source' => $data->source,
                    'project' => $data->Master_Project,
                    'title' => $data->unique,
                    'data_id' => $data->id,
                    'previous_state' => '0',
                    'previous_state_id' => $request->checkedrow,
                    'created_by' => Auth::user()->id
                ]);
            } else if ($request->userstatus == "Not interested") {
                // add comment
                UserDataComment::create([
                    'data_id' => $request->checkedrow,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus
                ]);
                // add data to own leads
                $data = Data::find($request->checkedrow);
                DeadLeads::create([
                    'name' => $data->NAME,
                    'email' => $data->EMAIL,
                    'phone' => $data->PHONE,
                    'mobile' => $data->MOBILE,
                    'phone_whatsapp' => $data->phone_whatsup,
                    'number_of_beds' => is_numeric($data->No_of_Beds) ? $data->No_of_Beds : null,
                    'source' => $data->source,
                    'project' => $data->Master_Project,
                    'title' => $data->unique,
                    'data_id' => $data->id,
                    'previous_state' => '0',
                    'previous_state_id' => $request->checkedrow,
                    'created_by' => Auth::user()->id
                ]);

                // change data status to dead leads
                $data->previous_status = $data->data_status;
                $data->data_status = 6;
                $data->save();
            } else {
                // add comment
                UserDataComment::create([
                    'data_id' => $request->checkedrow,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus
                ]);

                // change data status to qualified leads
                $data = Data::find($request->checkedrow);
                $data->previous_status = $data->data_status;
                $data->data_status = 7;
                $data->save();

                // add data to qualified leads
                QualifiedLeads::create([
                    'name' => $data->NAME,
                    'email' => $data->EMAIL,
                    'phone' => $data->PHONE,
                    'mobile' => $data->MOBILE,
                    'phone_whatsapp' => $data->phone_whatsup,
                    'number_of_beds' => is_numeric($data->No_of_Beds) ? $data->No_of_Beds : null,
                    'source' => $data->source,
                    'project' => $data->Master_Project,
                    'title' => $data->unique,
                    'data_id' => $data->id,
                    'previous_state' => '0',
                    'previous_state_id' => $request->checkedrow,
                    'created_by' => Auth::user()->id
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Comment entered successfully']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return response()->json(['success' => false, 'message' => 'Error happen call system admin']);
        }
    }

    public function addleadcomment(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:booktables,id',
            'comment' => 'required'
        ]);
        try {
            if (Str::contains($request->comment, '['))
                return response()->json(['success' => false, 'message' => 'You should delete old comment then add new one']);
            $isuserbookfound = UserBook::where('user_id', Auth::user()->id)->where('book_id', $request->book_id)->where('comment', $request->comment)->count();
            if ($isuserbookfound  == 0) {
                $userbook = UserBook::Create([
                    'user_id' => Auth::user()->id,
                    'book_id' => $request->book_id,
                    'comment' => $request->comment,
                    'userstatus' => $request->customerstate
                ]);
                if ($userbook != null)
                    return response()->json(['success' => true, 'message' => 'Comment created successfully']);
                else
                    return response()->json(['success' => false, 'message' => 'Error while creating Comment']);
            }
        } catch (Exception $ex) {
        }
    }

    public function serachforagentdata(Request $request)
    {
        $data = [];
        $user = User::find($request->userid);
        if ($user != null) {
            $temp = $user->data()->pluck('data.id');
            $data = Data::where('assigned', '0');
        }
        return DataTables::of($data)
            ->addcolumn('check', function () {
                return null;
            })
            ->rawColumns(['check'])
            ->make(true);
    }

    public function unassignagentdata(Request $request)
    {
        $request->validate(
            [
                'userid' => 'required|exists:users,id',
                'data' => 'required|json'
            ],
            [
                'data.required' => 'please select data you want to assign !!'
            ]
        );

        try {
            $data = json_decode($request->data);

            $comments = UserDataComment::join('user_data', function ($join) {
                $join->on('user_data_comment.data_id', '=', 'user_data.data_id')
                    ->on('user_data_comment.user_id', '=', 'user_data.user_id');
            })->where('user_data_comment.user_id', $request->userid)->pluck('user_data_comment.data_id')->toArray();

            foreach ($data as $key => $item) {
                if (in_array($item, $comments)) {
                    unset($data[$key]);
                }
            }
            if ($data != null) {
                UserData::where('user_id', $request->userid)->whereIn('data_id', $data)->delete();
                Data::whereIn('id', $data)->update(['assigned' => false]);
                return response()->json(['success' => true, 'message' => 'User data has been unassigned successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Unable to unassign this data']);
            }
        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Error while unassign data for user']);
        }
    }

    public function assignagentdata(Request $request)
    {
        $request->validate(
            [
                'userid' => 'required|exists:users,id',
                'data' => 'required|json'
            ],
            [
                'data.required' => 'please select data you want to assign !!'
            ]
        );

        try {
            $userdata = [];
            $data = json_decode($request->data);
            // $userfound = UserData::where('user_id', $request->userid)->count();
            // if ($userfound > 0) {
            //     $currentuserdata = UserData::select('data_id')->where('user_id', $request->userid)->get();
            //     $repateddatalist = [];
            //     $notrepateddatalist = [];
            //     foreach ($data as $key => $item) {
            //         if ($currentuserdata->contains('data_id', $item))
            //             $repateddatalist[] = $item;
            //         else
            //             $notrepateddatalist[] = $item;
            //     }

            //     foreach ($notrepateddatalist as $key => $item) {
            //         $userdata[] = new UserData([
            //             'user_id' => $request->userid,
            //             'data_id' => $item
            //         ]);
            //     }
            //     $user = User::find($request->userid);
            //     $user->userdata()->saveMany($userdata);

            //     if (count($repateddatalist) > 0) {
            //         $request->session()->remove('repateddatalist');
            //         $request->session()->push('repateddatalist', $repateddatalist);
            //         return response()->json(['success' => false, 'message' => 'There are some duplicated data']);
            //     } else
            //         return response()->json(['success' => true, 'message' => 'User data has been assigned successfully']);
            // } else {
            // }
            foreach ($data as $key => $item) {
                $userdata[] = new UserData([
                    'user_id' => $request->userid,
                    'data_id' => $item
                ]);
            }
            $user = User::find($request->userid);
            $user->userdata()->saveMany($userdata);
            // update data status
            $status = Data::whereIn('id', $data)->update(['assigned' => true]);
            return response()->json(['success' => true, 'message' => 'User data has been assigned successfully']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return response()->json(['success' => false, 'message' => 'Error while assign data for user']);
        }
    }

    // show assigned data for each egent for admin
    public function getassigneddataindex()
    {
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasources = Data::distinct()->pluck('source');
        return view('admin.showagentassigneddata', ['datasources' => $datasources, 'agentnames' => $agentnames, 'assigneddatacount' => 0, 'commenteddatacount' => 0]);
    }

    //////////// get assigned data for each agent for admin
    public function getassignedagentdata(Request $request)
    {
        $datasource = $request->datasource;
        $userdata = UserData::where('user_id', $request->userid)->pluck('data_id');
        $data = Data::whereIn('id', $userdata)->orderBy('created_at', 'DESC');
        if ($datasource != null) {
            $data = $data->where('source', $datasource);
        }
        return DataTables::of($data)
            ->addcolumn('check', function () {
                return null;
            })
            ->rawColumns(['check'])
            ->make(true);
    }

    public function getassigneduserdatainfo(Request $request)
    {
        $assigneddatacount = UserData::where('user_id', $request->userid)->count();
        $commenteddatacount = UserDataComment::where('user_id', $request->userid)->count();
        return response()->json(['succssess' => true, 'assigneddatacount' => $assigneddatacount, 'commenteddatacount' => $commenteddatacount]);
    }

    public function getleaderboard(Request $request)
    {
        $data = [];
        $users = User::all()->except(['role_id' => 1]);
        foreach ($users as $key => $user) {
            $swoflibuwonuinnu = 0;
            $unavnotworkincomp = 0;
            $others = 0;
            $interested = 0;
            $notinterested = 0;
            $notanswer = 0;
            $total = 0;
            if ($user != null) {
                $username = $user->name;
                $swoflibuwonuinnu = $user->userdatacomment()->wherePivot('userstatus', 'Switch off/Line busy/Wrong number/Invalid number')->count();
                $unavnotworkincomp = $user->userdatacomment()->wherePivot('userstatus', 'Number unavailable/Not working for call/Incomplete no')->count();
                $others = $user->userdatacomment()->wherePivot('userstatus', 'Others')->count();
                $interested = $user->userdatacomment()->wherePivot('userstatus', 'Interested')->count();
                $notinterested = $user->userdatacomment()->wherePivot('userstatus', 'Not interested')->count();
                $notanswer = $user->userdatacomment()->wherePivot('userstatus', 'Not answer')->count();
                $notanswer = $user->userdatacomment()->wherePivot('userstatus', 'Not answer')->count();
                $setappointment = $user->userdatacomment()->wherePivot('userstatus', 'Set appointment')->count();
                $total = $swoflibuwonuinnu + $unavnotworkincomp + $others + $interested +  $notinterested + $notanswer + $setappointment;
                $data[] = ['username' => $username, 'swoflibuwonuinnu' => $swoflibuwonuinnu, 'unavnotworkincomp' => $unavnotworkincomp, 'others' => $others, 'interested' => $interested, 'notinterested' => $notinterested, 'notanswer' => $notanswer, 'setappointment' => $setappointment, 'total' => $total];
            }
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('username', function ($row) {
                return ucfirst($row['username']);
            })
            ->make(true);
    }

    public function getadmincommentedinfo(Request $request)
    {
        $userid = null;
        if (Auth::user()->isadmin()) {
            $userid = $request->userid;
        } else {
            $userid = Auth::user()->id;
        }
        $userstatus = $request->userstatus;
        $datasource = $request->datasource;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $emirates = $request->emirates;
        $filtertext = $request->searchday;
        $searchdaytext = null;
        $monthfiltertext = null;
        $swoflibuwonuinnu = 0;
        $unavnotworkincomp = 0;
        $others = 0;
        $interested = 0;
        $notinterested = 0;
        $notanswer = 0;
        $setappointment = 0;
        $total = 0;

        if (!is_null($filtertext)) {
            $filtertext = explode('-', $filtertext);
            $monthfiltertext = $filtertext[1];
            $searchdaytext = $filtertext[0];
            if ($searchdaytext == "" || $searchdaytext == "00")
                $searchdaytext = null;

            if ($monthfiltertext == "" || $monthfiltertext == "00")
                $monthfiltertext = null;
        }

        $filtertype = $request->filtertype;

        $sdate = null;
        $edate = null;
        // search between range
        if (!is_null($startdate) && !is_null($enddate) && $filtertype == 2) {
            $sdate = Carbon::parse($startdate);
            $edate = Carbon::parse($enddate);
            if ($sdate->gt($edate))
                return response()->json(['message' => 'start date must smaller than end date']);
        }

        //
        if (!is_null($startdate) && $filtertype == 1) {
            $sdate = Carbon::parse($startdate);
        }

        $data = UserDataComment::join('user_data', function ($join) {
            $join->on('user_data_comment.data_id', '=', 'user_data.data_id')
                ->on('user_data_comment.user_id', '=', 'user_data.user_id');
        })->join('data', 'data.id', '=', 'user_data_comment.data_id')
            ->select('user_data.data_id', 'user_data.user_id', 'user_data_comment.userstatus', 'user_data_comment.comment', 'user_data_comment.appointment_date', 'user_data_comment.created_at');

        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2)
            $data = $data->whereBetween('user_data_comment.created_at', [$sdate, $edate]);
        if (!is_null($monthfiltertext))
            $data = $data->whereMonth('user_data_comment.created_at', $monthfiltertext);
        if (!is_null($searchdaytext))
            $data = $data->whereDay('user_data_comment.created_at', '=', $searchdaytext);

        if (!is_null($datasource) && $datasource != "Show")
            $data = $data->where('data.source', $datasource);

        if ($userid != null)
            $data = $data->where('user_data_comment.user_id', $userid);

        if ($emirates != null)
            $data = $data->where('data.emirate', $emirates);

        if ($userstatus != null)
            $data = $data->where('user_data_comment.userstatus', $userstatus);

        $data = $data->get();

        $swoflibuwonuinnu = $data->where('userstatus', 'Switch off/Line busy/Wrong number/Invalid number')->count();
        $unavnotworkincomp = $data->where('userstatus', 'Number unavailable/Not working for call/Incomplete no')->count();
        $others = $data->where('userstatus', 'Others')->count();
        $interested = $data->where('userstatus', 'Interested')->count();
        $notinterested = $data->where('userstatus', 'Not interested')->count();
        $notanswer = $data->where('userstatus', 'Not answer')->count();
        $setappointment = $data->where('userstatus', 'Set appointment')->count();

        $total = $swoflibuwonuinnu + $unavnotworkincomp + $others + $interested +  $notinterested + $notanswer + $setappointment;
        return response()->json([
            'succssess' => true,
            'swoflibuwonuinnu' => $swoflibuwonuinnu,
            'unavnotworkincomp' => $unavnotworkincomp,
            'others' => $others,
            'interested' => $interested,
            'notinterested' => $notinterested,
            'notanswer' => $notanswer,
            'setappointment' => $setappointment,
            'total' => $total
        ]);
    }

    public function getcommenteduserdata(Request $request)
    {
        $userid = null;
        if (Auth::user()->isadmin()) {
            $userid = $request->userid;
        } else {
            $userid = Auth::user()->id;
        }
        $userstatus = $request->userstatus;
        $datasource = $request->datasource;
        $filtertext = $request->searchday;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $emirates = $request->emirates;
        $searchdaytext = null;
        $monthfiltertext = null;

        if (!is_null($filtertext)) {
            $filtertext = explode('-', $filtertext);
            $monthfiltertext = $filtertext[1];
            $searchdaytext = $filtertext[0];
            if ($searchdaytext == "" || $searchdaytext == "00")
                $searchdaytext = null;

            if ($monthfiltertext == "" || $monthfiltertext == "00")
                $monthfiltertext = null;
        }

        $filtertype = $request->filtertype;

        $sdate = null;
        $edate = null;
        // search between range
        if (!is_null($startdate) && !is_null($enddate) && $filtertype == 2) {
            $sdate = Carbon::parse($startdate);
            $edate = Carbon::parse($enddate);
            if ($sdate->gt($edate))
                return response()->json(['message' => 'start date must smaller than end date']);
        }

        //
        if (!is_null($startdate) && $filtertype == 1) {
            $sdate = Carbon::parse($startdate);
        }

        $data = UserData::join('user_data_comment', function ($join) {
            $join->on('user_data.data_id', '=', 'user_data_comment.data_id')
                ->on('user_data.user_id', '=', 'user_data_comment.user_id');
        })
            ->join('data', 'data.id', '=', 'user_data.data_id')
            ->join('users', 'users.id', '=', 'user_data_comment.user_id')
            ->select(
                'data.PHONE',
                'data.EMAIL',
                'data.NAME',
                'data.EMIRATE',
                'data.ADDRESS',
                'data.GENDER',
                'data.DOB',
                'data.MOBILE',
                'data.SECONDARY_MOBILE',
                'data.Project',
                'data.source',
                'data.lat',
                'data.lng',
                'data.RESIDENCE_COUNTRY',
                'data.NATIONALITY',
                'user_data.data_id',
                'data.Agents',
                'user_data.user_id',
                'users.name as agentname',
                'user_data_comment.userstatus',
                'user_data_comment.comment as comment',
                'user_data_comment.appointment_date',
                'user_data_comment.created_at',
                'data.*'
            );


        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2)
            $data = $data->whereBetween('user_data_comment.created_at', [$sdate, $edate]);
        if (!is_null($monthfiltertext))
            $data = $data->whereMonth('user_data_comment.created_at', $monthfiltertext);
        if (!is_null($searchdaytext))
            $data = $data->whereDay('user_data_comment.created_at', '=', $searchdaytext);

        if ($userid != null)
            $data = $data->where('user_data_comment.user_id', $userid);

        if ($userstatus != null)
            $data = $data->where('user_data_comment.userstatus', $userstatus);

        if ($emirates != null)
            $data = $data->where('data.emirate', $emirates);

        if (!is_null($datasource) && $datasource != "Show")
            $data = $data->where('data.source', $datasource);

        $data = $data->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('comments', function ($row) {
                $comment = null;
                if ($row->userstatus == "Interested")
                    $comment = '<div class="row ml-1" style="background-color:#FEFEE7"> <p> <b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Not interested")
                    $comment = '<div class="row ml-1" style="background-color:#00ff95"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Not answer")
                    $comment = '<div class="row ml-1" style="background-color:#bab2e1"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Number unavailable/Not working for call/Incomplete no")
                    $comment = '<div class="row ml-1" style="background-color:#ffc55c"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Switch off/Line busy/Wrong number/Invalid number")
                    $comment = '<div class="row ml-1" style="background-color:#AED6F1"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Others")
                    $comment = '<div class="row ml-1" style="background-color:#DAF7A6"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else if ($row->userstatus == "Set appointment")
                    $comment = '<div class="row ml-1" style="background-color:#F9C4F8"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> <p><b>Appointment date: </b> ' . $row->appointment_date . '</p> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                else
                    $comment = '<div class="row ml-1"> <p><b>Comment: </b> ' . $row->comment . '</p> , <div style="color:#70cacc">&nbsp;&nbsp; </div> </div> <div class="row ml-1"> <h6>' . $row->agentname . ', ' . $row->created_at . '</h6> </div>';
                return $comment;
            })
            ->rawColumns(['comments'])
            ->make(true);
    }

    public function wonleadsindex()
    {
        $datasource = WonLeads::groupBy('source')->select('source')->pluck('source');
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $projects = WonLeads::where('project', '!=', '')->select('project')->groupBy('project')->pluck('project');
        return view('admin.wonleads', ['datasource' => $datasource, 'agentnames' => $agentnames, 'projects' => $projects]);
    }

    public function wonleadsdata(Request $request)
    {
        $projects = $request->projects;
        $agentname = $request->agentname;
        $datasource = $request->datasource;
        $data = WonLeads::join('users', 'users.id', '=', 'won_leads.created_by');
        if ($projects != null) {
            $data = $data->where('project', $projects);
        }
        if ($agentname != null) {
            $data = $data->where('created_by', $agentname);
        }
        if ($datasource != null) {
            $data = $data->where('source', $datasource);
        }

        $data = $data->select('won_leads.*', 'users.name as agentname')->get();

        return DataTables::of($data)
            ->make(true);
    }

    public function deadleadsindex()
    {
        $datasource = DeadLeads::groupBy('source')->select('source')->pluck('source');
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $projects = DeadLeads::where('project', '!=', '')->select('project')->groupBy('project')->pluck('project');
        return view('admin.deadleads', ['datasource' => $datasource, 'agentnames' => $agentnames, 'projects' => $projects]);
    }

    public function deadleadsdata(Request $request)
    {
        $projects = $request->projects;
        $agentname = $request->agentname;
        $datasource = $request->datasource;
        $data = DeadLeads::join('users', 'users.id', '=', 'dead_leads.created_by');
        if ($projects != null) {
            $data = $data->where('project', $projects);
        }
        if ($datasource != null) {
            $data = $data->where('source', $datasource);
        }
        if ($agentname != null) {
            $data = $data->where('created_by', $agentname);
        }
        $data = $data->select('dead_leads.*', 'users.name as agentname')->get();
        return DataTables::of($data)
            ->make(true);
    }

    // public function sample()
    // {

    //     $chart = (new LarapexChart)->pieChart()
    //     ->setTitle('Pie')
    //     ->addData([
    //         \App\Models\Data::where('EMIRATE', '=', 'Dubai')->count(),
    //         \App\Models\Data::where('EMIRATE', '=', 'Sharjah')->count(),
    //         \App\Models\Data::where('EMIRATE', '=', 'Abu Dhabi')->count(),
    //     ])
    //     ->setColors(['#a5378f', '#ffc70b','#cc2411'])
    //     ->setLabels(['Dubai', 'Sharjah','Abu Dhabi']);

    //     $chart1 = (new LarapexChart)->barChart()
    //     ->setTitle('Histogram')
    //     ->addBar('Dubai', [\App\Models\Data::where('EMIRATE', '=', 'Dubai')->count()])
    //     ->addBar('Sharjah', [\App\Models\Data::where('EMIRATE', '=', 'Sharjah')->count()])
    //     ->addBar('Abu Dhabi', [\App\Models\Data::where('EMIRATE', '=', 'Abu Dhabi')->count()])
    //     ->setColors(['blue'])
    //     ->setLabels([' ']);
    //     return view('sample')->with('chart',$chart)->with('chart1',$chart1);
    // }

    // public function nationality()
    // {
    //     $chart2 = (new LarapexChart)->barChart()
    //     ->setTitle('Histogram')
    //     ->addBar('Russia', [\App\Models\Data::where('NATIONALITY', '=', 'Russia')->count()])
    //     ->addBar('Kyrgistan',[\App\Models\Data::where('NATIONALITY', '=', 'Kyrgistan')->count()])
    //     ->addBar('India', [\App\Models\Data::where('NATIONALITY', '=', 'India')->count()])
    //     ->addBar('Italy', [\App\Models\Data::where('NATIONALITY', '=', 'Italy')->count()])
    //     ->addBar('South Africa', [\App\Models\Data::where('NATIONALITY', '=', 'South Africa')->count()])
    //     ->addBar('United Kingdom', [\App\Models\Data::where('NATIONALITY', '=', 'United Kingdom')->count()])
    //     ->addBar('United States of America', [\App\Models\Data::where('NATIONALITY', '=', 'United States of America')->count()])
    //     ->addBar('Pakistan', [\App\Models\Data::where('NATIONALITY', '=', 'Pakistan')->count()])
    //     ->addBar('China', [\App\Models\Data::where('NATIONALITY', '=', 'China')->count()])
    //     ->addBar('Afghanistan', [\App\Models\Data::where('NATIONALITY', '=', 'Afghanistan')->count()])
    //     ->addBar('Kuwait', [\App\Models\Data::where('NATIONALITY', '=', 'Kuwait')->count()])
    //     ->addBar('Iran', [\App\Models\Data::where('NATIONALITY', '=', 'Iran')->count()])
    //     ->addBar('France', [\App\Models\Data::where('NATIONALITY', '=', 'France')->count()])
    //     ->addBar('Canada', [\App\Models\Data::where('NATIONALITY', '=', 'Canada')->count()])
    //     ->addBar('Jordan', [\App\Models\Data::where('NATIONALITY', '=', 'Jordan')->count()])
    //     ->addBar('Kazakhstan', [\App\Models\Data::where('NATIONALITY', '=', 'Kazakhstan')->count()])
    //     ->addBar('Brunei', [\App\Models\Data::where('NATIONALITY', '=', 'Brunei')->count()])
    //     ->addBar('Palestine', [\App\Models\Data::where('NATIONALITY', '=', 'Palestine')->count()])
    //     ->addBar('Greece', [\App\Models\Data::where('NATIONALITY', '=', 'Greece')->count()])
    //     ->addBar('Lebanon', [\App\Models\Data::where('NATIONALITY', '=', 'Lebanon')->count()])
    //     ->addBar('South Korea', [\App\Models\Data::where('NATIONALITY', '=', 'South Korea')->count()])
    //     ->addBar('Bangladesh', [\App\Models\Data::where('NATIONALITY', '=', 'Bangladesh')->count()])
    //     ->addBar('United Arab Emirates', [\App\Models\Data::where('NATIONALITY', '=', 'United Arab Emirates')->count()])
    //     ->addBar('Syria', [\App\Models\Data::where('NATIONALITY', '=', 'Syria')->count()])
    //     ->addBar('Northern Ireland', [\App\Models\Data::where('NATIONALITY', '=', 'Northern Ireland')->count()])
    //     ->addBar('Morocco', [\App\Models\Data::where('NATIONALITY', '=', 'Morocco')->count()])
    //     ->setColors(['blue'])
    //     ->setLabels([' ']);

    //     $chart3 = (new LarapexChart)->pieChart()
    //     ->setTitle('Pie')
    //     ->addData([
    //         \App\Models\Data::where('NATIONALITY', '=', 'Russia')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Kyrgistan')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'India')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Italy')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'South Africa')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'United Kingdom')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'United States of America')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Pakistan')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'China')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Afghanistan')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Kuwait')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Iran')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'France')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Canada')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Jordan')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Kazakhstan')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Brunei')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Palestine')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Greece')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Lebanon')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'South Korea')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Bangladesh')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'United Arab Emirates')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Syria')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Northern Ireland')->count(),
    //         \App\Models\Data::where('NATIONALITY', '=', 'Morocco')->count(),
    //     ])
    //     ->setColors(['#a5378f', '#ffc70b','#cc2411','#f00','#80a2c7','#985dde','#7b1dea',
    //     '#1dea3c','#157123','#437115','#b1bf18','#bf6218','#254869','#2fe8a0','#de4f4f'])
    //     ->setLabels(['Russia', 'Kyrgistan','India','Italy','South Africa','United Kingdom',
    //     'United States of America','Pakistan','China','Afghanistan','Kuwait','Iran','France'
    //     ,'Canada','Jordan','Kazakhstan','Brunei','Palestine','Greece','Lebanon','South Korea'
    //     ,'Bangladesh','United Arab Emirates','Syria','Northern Ireland','Morocco']);

    //     return view('nationality')->with('chart',$chart)->with('chart1',$chart1);
    // }

    // public function usage(){
    //     $chart4 = (new LarapexChart)->barChart()
    //     ->setTitle('Histogram')
    //     ->addBar('Residential', [\App\Models\Data::where('USAGE', '=', 'Residential')->count()])
    //     ->addBar('Building',[\App\Models\Data::where('USAGE', '=', 'Building')->count()])
    //     ->addBar('Flat', [\App\Models\Data::where('USAGE', '=', 'Flat')->count()])
    //     ->setColors(['blue'])
    //     ->setLabels([' ']);

    //     $chart5 = (new LarapexChart)->pieChart()
    //     ->setTitle('Pie')
    //     ->addData([
    //         \App\Models\Data::where('USAGE', '=', 'Residential')->count(),
    //         \App\Models\Data::where('USAGE', '=', 'Building')->count(),
    //         \App\Models\Data::where('USAGE', '=', 'Flat')->count(),
    //     ])
    //     ->setColors(['#ffc70b', '#cc2411','#a5378f'])
    //     ->setLabels(['Residential', 'Building','Flat']);

    //     return view('usage')->with('chart',$chart)->with('chart1',$chart1);
    // }

    public function createSupplier(){
        return view('project_managements.suppliers.createsupplier');
    }
    public function storeSupplier(Request $request){
        $validator = Validator::make($request->toArray(), [
            'name'=>'required',
            'mobile'=>'required|min:10',
            'website_links'=>'required',
            'address'=>'required',
        ],[
            'required'=>'The :attribute Field Can Not Be Blank',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'state' => false
            ]);
        }
        $supplier=new Supplier;
        $supplier->name=$request->name;
        $supplier->mobile=$request->mobile;
        $supplier->additional_mobile=$request->additional_mobile;
        $supplier->website_links=$request->website_links;
        $supplier->address=$request->address;
        $supplier->save();
        if($supplier){
            return response()->json([
                'message' => 'The Supplier Has Been Created Successfully',
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error in creating Supplier',
                'state' => false
            ]);
        }
    }
    public function listSuppliers(){
        return view('project_managements.suppliers.listsuppliers');
    }
    public function showlistSuppliers(Request $request){
        $data = Supplier::get();
        return DataTables::of($data)
        ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a class=" delete btn-danger btn btn-sm" >Delete</a>' . "<a  class=' edit ml-1 btn-info btn btn-sm'>Edit</a> ";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function editSupplier($id){
        $Supplier= Supplier::find($id);
        if($Supplier){
            return view('project_managements.suppliers.editsupplier',compact('Supplier'));
        }else{
           return back();
        }
    }
    public function updateSupplier(Request $request){
        $validator = Validator::make($request->toArray(), [
            'name'=>'required',
            'mobile'=>'required|min:10',
            'additional_mobile'=>'required|min:10',
            'website_links'=>'required',
            'address'=>'required',
        ],[
            'required'=>'The :attribute Field Can Not Be Blank',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'state' => false
            ]);
        }
        $supplier=Supplier::find($request->id);
        if($supplier){
            $supplier->update([
                'name'=>$request->name,
                'mobile'=>$request->mobile,
                'additional_mobile'=>$request->additional_mobile,
                'website_links'=>$request->website_links,
                'address'=>$request->address,
            ]);
            return response()->json([
                'message' => 'The Supplier Has Been Updated Successfully',
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error in Updating Supplier',
                'state' => false
            ]);
        }
    }
    public function deleteSupplier(Request $request){
        $supplier=Supplier::find($request->id);
        if($supplier){
            $supplier->delete();
            return response()->json([
                'message' => 'The Supplier Has Been Deleted Successfully',
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In deleting  Supplier',
                'state' => false
            ]);
        }
    }
    public function createSupplierinvoice(){
        $projects=Project::get();
        $suppliers=Supplier::get();
        return view('project_managements.suppliers.createsupplierinvoice',compact('suppliers','projects'));
    }
    public function storeSupplierinvoice(Request $request){
        $validator = Validator::make($request->toArray(), [
            'project'=>'required',
            'supplier'=>'required',
            'image'=>'required|mimes:jpeg,png,jpg',
            'number'=>'required',
            'advanced_payment'=>'required',
            'total_payment'=>'required',
        ],[
            'required'=>'The :attribute Field Can Not Be Blank',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'state' => false
            ]);
        }
        if ($request->hasfile('image')){
            $imageName = rand(0, 10000) . time() . '.' . $request->image->extension();
            $request->image->move(public_path('storage/images/'), $imageName);
        }
        $supplier_invoice=new Supplier_Invoice;
        $supplier_invoice->project_id=$request->project;
        $supplier_invoice->supplier_id=$request->supplier;
        $supplier_invoice->path='storage\images\\' .  $imageName;
        $supplier_invoice->number=$request->number;
        $supplier_invoice->advanced_payment=$request->advanced_payment;
        $supplier_invoice->total_payment=$request->total_payment;
        $supplier_invoice->save();
        if($supplier_invoice){
            return response()->json([
                'message' => 'The Supplier Invoice Has Been Created Successfully',
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In Creating  Supplier Invoice',
                'state' => false
            ]);
        }
    }
    public function listSuppliersinvoice(){
        $supplier_invoices=Supplier_Invoice::get();
        $projects=project::get();
        $suppliers=Supplier::get();
        return view('project_managements.suppliers.listSuppliersinvoice',compact('supplier_invoices','projects','suppliers'));
    }
    public function showSupplierinvoice(Request $request){
        $number = $request->number;
        $suppliers = $request->suppliers;
        $project = $request->project;
        $supplier_invoice_data=Supplier_Invoice::join('projects','projects.id',"=","supplier__invoices.project_id")
        ->join('suppliers','suppliers.id','=',"supplier__invoices.supplier_id")
        ->select('supplier__invoices.*', 'suppliers.name as suppliersname','projects.name as projectsname')
        ->get();
        if($number != null && $number != "ALL" ){
            $supplier_invoice_data=$supplier_invoice_data->where('number','=',$number);
        }
        if($suppliers !=null && $suppliers != "ALL"){
            $supplier_invoice_data=$supplier_invoice_data->where('supplier_id','=',$suppliers);
        }
        if($project != null && $project != "ALL"){
            $supplier_invoice_data=$supplier_invoice_data->where('project_id','=',$project);
        }

        return DataTables::of($supplier_invoice_data)
        ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a class=" delete btn-danger btn btn-sm" >Delete</a>' . "<a  class=' edit ml-1 btn-info btn btn-sm'>Edit</a> "."<a  class='show_image ml-1 btn-primary btn btn-sm'>Show Image</a> ";
                return $actionBtn;
            })
            ->addColumn('image', function ($row) {
                $image ='<img src="'.asset($row->path).'" width=200 height=150 />';
                return $image;
            })
            ->addColumn('status', function ($row) {
                if($row->is_delivered){
                    return true;
                }else{
                    return false;
                }
            })
            ->addColumn('change', function ($row) {
                if($row->is_delivered){
                   $change= "<div class='toggle-rect-bw'>
                    <input  id='".$row->id."' checked class='change'   type='checkbox' name='change'  >
                     <label for='".$row->id."'></label>
                    </div>";
                    return $change;
                }else{
                    $change= "<div class='toggle-rect-bw'>
                    <input  id='".$row->id."' class='change form-check-input ml-4'  role='switch' type='checkbox' name='change'  >
                     <label  class='' for='".$row->id."'></label>
                    </div>";
                    return $change;
                }
            })
            ->rawColumns(['action','image','status','change'])
            ->make(true);
    }
    public function deleteSupplierInvoice(Request $request){
        $supplier_invoice=Supplier_Invoice::find($request->id);
        if($supplier_invoice){
            $supplier_invoice->delete();
            return response()->json([
                'message' => 'The Supplier Invoice Has Been Deleted Successfully',
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In deleting  Supplier Invoice',
                'state' => false
            ]);
        }
    }
    public function editSupplierinvoice($id){
        $supplier_invoice=Supplier_Invoice::find($id);
        $projects=project::get();
        $suppliers=Supplier::get();
        return view('project_managements.suppliers.editSuppliersinvoice',compact('supplier_invoice','projects','suppliers'));
    }
    public function updateSupplierinvoice(Request $request){
        $validator = Validator::make($request->toArray(), [
            'project'=>'required',
            'supplier'=>'required',
            // 'image'=>'required|mimes:jpeg,png,jpg',
            'number'=>'required',
            'advanced_payment'=>'required',
            'total_payment'=>'required',
        ],[
            'required'=>'The :attribute Field Can Not Be Blank',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'state' => false
            ]);
        }
        $supplier_invoice=Supplier_Invoice::find($request->id);
        if($supplier_invoice){
            if ($request->hasfile('image')){
                if(File::exists($supplier_invoice->path)){
                    File::delete($supplier_invoice->path);
                }
                $imageName = rand(0, 10000) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('storage/images/'), $imageName);
                $supplier_invoice->path='storage\images\\' .  $imageName;
            }
            $supplier_invoice->project_id=$request->project;
            $supplier_invoice->supplier_id=$request->supplier;
            $supplier_invoice->number=$request->number;
            $supplier_invoice->total_payment=$request->total_payment;
            $supplier_invoice->advanced_payment=$request->advanced_payment;
            $supplier_invoice->update();
            return response()->json([
                'message' => 'The Supplier Invoice Has Been Updated Successfully',
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In Updating  Supplier Invoice',
                'state' => false
            ]);
        }
    }
    public function changestatus(Request $request){
        $supplier_invoice=Supplier_Invoice::find($request->id);
        if($supplier_invoice){
            $supplier_invoice->is_delivered=$request->change ;
            $supplier_invoice->update();
            return response()->json([
                'message' => 'Change Status Has Been Updated Successfully',
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In Updating  Change Status',
                'state' => false
            ]);
        }
    }
}
