<?php

namespace App\Http\Controllers;

use App\Models\booktable;
use App\Models\Campaign;
use App\Models\Data;
use App\Models\DeadLeads;
use App\Models\FollowUpLeads;
use App\Models\User;
use App\Models\UserLeadsPool;
use App\Models\UserLeadsPoolComment;
use App\Models\WonLeads;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LeadsPoolController extends Controller
{
    //////////////////////////// show leads pool index for admin
    public function leadspoolindex()
    {
        $campaignsources  = Campaign::select('name')->groupBy('name')->pluck('name');
        $datasource = booktable::select('source')->groupBy('source')->pluck('source');
        $projects = booktable::select('project')->groupBy('project')->pluck('project');
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        return view('admin.leadspool.leadsbool', ['projects' => $projects, 'campaignsources' => $campaignsources, 'datasource' => $datasource, 'agentnames' => $agentnames]);
    }

    //////////////////////////// show leads pool for admin
    public function leadspool(Request $request)
    {
        $campaignsource = $request->campaignsource;
        $projects = $request->projects;
        $agentname = $request->agentname;
        $datasource = $request->datasource;

        $data = booktable::join('users', 'users.id', '=', 'booktables.created_by')->where('assigned', 0);
        if ($campaignsource != null) {
            $data = $data->where('campaign_name', $campaignsource);
        }
        if ($projects != null) {
            $data = $data->where('project', $projects);
        }
        if ($datasource != null) {
            $data = $data->where('source', $datasource);
        }
        if ($agentname != null) {
            $data = $data->where('created_by', $agentname);
        }
        $data = $data->select('booktables.*', 'users.name as agentname')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                if ($row->is_enquiry_customer) {
                    $actionBtn = '<a class="delete btn btn-danger btn-md ml-3">Delete</a>' . " ";
                    $actionBtn .= '<a style="background-color:#70cacc" class="edit btn btn-info btn-md ml-1">Edit</a>';
                    return $actionBtn;
                } else if ($row->created_by == 0) {
                    $actionBtn = '<a class="delete btn btn-danger btn-md ml-3">Delete</a>' . " ";
                    return $actionBtn;
                }
            })
            ->make(true);
    }

    //////////////////////////// show assigned leads pool data index for agent
    public function leadspooluserhomeindex()
    {
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasource = booktable::select('source')->groupBy('source')->get();
        $projects = booktable::select('project')->groupBy('project')->get();
        $userstates = config('app.user_status');
        return view('agent.leadspool.leadspooluserhome', ['projects' => $projects, 'agentnames' => $agentnames, 'datasource' => $datasource, 'userstates' => $userstates]);
    }

    //////////////////////////// show assigned leads pool data for agent
    public function leadspooluserhomedata(Request $request)
    {
        $project = $request->project;
        $datasource = $request->datasource;

        $data = booktable::query();
        if ($project != null) {
            $data = booktable::where('project', $project);
        }
        if ($datasource != null) {
            $data = booktable::where('source', $datasource);
        }

        $temp0 = Auth::user()->userleadsbooldata()->pluck('leads_pool_id');
        $data = $data->whereIn('booktables.id', $temp0);
        $temp = Auth::user()->userleadspooldatacomment()->pluck('leads_pool_id');
        $data = $data->whereNotIn('booktables.id', $temp);
        $data = $data->join('users', 'users.id', '=', 'booktables.created_by');
        $data = $data->select('booktables.*', 'users.name as agentname');
        return DataTables::of($data)
            ->addColumn('comments', function ($row) {
                return '<div class="row">' .
                    '<div class="col-md-7"><input type="text" class="form-control w-100" id="comment' . $row->id . '" name=""></div>' .
                    '<div class="col-md-2 ml-3 mt-1"><button onclick="btn_click_add_comment(' . $row->id . ')" type="button" id="' . $row->id . '" class="btn btn-primary">Add</button></div>' .
                    '</div>';
            })
            ->addColumn('userstatus', function ($row) {
                return '<select name="userstatus" class="form-control w-75" id="userstatus' . $row->id . '" onchange="user_status_change_event(' . $row->id . ')">' .
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
            ->rawColumns(['comments', 'userstatus'])
            ->make(true);
    }

    //////////////////////////// show assigned leads pool data index for admin
    public function showassignedagentleadspoolindex()
    {
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasources = booktable::select('source')->groupBy('source')->pluck('source');
        return view('admin.leadspool.showassignedagentleadspooldata', ['agentnames' => $agentnames, 'datasources' => $datasources]);
    }

    //////////////////////////// show assigned leads pool data for admin
    public function showassignedagentleadspooldata(Request $request)
    {

        $data = booktable::get();

        $datasource = $request->datasource;
        $userid = $request->userid;

        if ($datasource != null) {
            $data = $data->where('source', $datasource);
        }

        $user = User::find($userid);
        if ($user != null) {
            $temp = $user->leadspooldata()->pluck('leads_pool_id');
            $data = $data->whereIn('id', $temp);
        } else {
            $data = [];
        }

        $users = User::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_by', function ($row) use ($users) {
                $user = $users->where('id', $row->created_by)->first();
                if ($user != null)
                    return $user->name;
                else
                    return null;
            })
            ->editColumn('created_at', function ($user) {
                return  date('d-m-Y h-m-s', strtotime($user->created_at));
            })
            ->addcolumn('check', function () {
                return null;
            })
            ->rawColumns(['check'])
            ->make(true);
    }

    //////////////////////////////unassign agent leads pool data
    public function unassignagentleadspooldata(Request $request)
    {
        $request->validate(
            [
                'userid' => 'required|exists:users,id',
                'data' => 'required|json'
            ],
            [
                'data.required' => 'please select data you want to Unassign !!'
            ]
        );
        try {
            $data = json_decode($request->data);

            $comments = UserLeadsPoolComment::join('user_leads_pools', function ($join) {
                $join->on('user_leads_pool_comments.leads_pool_id', '=', 'user_leads_pools.leads_pool_id')
                    ->on('user_leads_pool_comments.user_id', '=', 'user_leads_pools.user_id');
            })->where('user_leads_pool_comments.user_id', $request->userid)->pluck('user_leads_pool_comments.leads_pool_id')->toArray();
            foreach ($data as $key => $item) {
                if (in_array($item, $comments)) {
                    unset($data[$key]);
                }
            }
            if ($data != null) {
                UserLeadsPool::where('user_id', $request->userid)->whereIn('leads_pool_id', $data)->delete();
                Data::whereIn('id', $data)->update(['assigned' => false]);
                return response()->json(['success' => true, 'message' => 'User data has been unassigned successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Unable to unassign this data']);
            }
        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Error while unassign data for user']);
        }
    }

    //////////////////////////// return list of unassigned data for leads pool data table for admin
    public function searchforagentleadspooldata(Request $request)
    {
        $data = booktable::where('assigned', 0);
        $datasource = $request->project;
        if ($datasource != null)
            $data = $data->where('source', $datasource);
        $data = $data->get();
        return DataTables::of($data)
            ->addcolumn('check', function () {
                return null;
            })
            ->rawColumns(['check'])
            ->make(true);
    }

    //////////////////////////// assigne agent to leads pool data index for admin
    public function assignagentleadspoolindex()
    {
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasources = booktable::select('source')->groupBy('source')->get();
        return view('admin.leadspool.assignagentleadspooldata', ['agentnames' => $agentnames, 'datasources' => $datasources]);
    }

    //////////////////////////// assign agent to leads pool data for admin
    public function assignagentleadspooldata(Request $request)
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
            foreach ($data as $key => $item) {
                $userdata[] = new UserLeadsPool([
                    'user_id' => $request->userid,
                    'leads_pool_id' => $item
                ]);
            }
            $user = User::find($request->userid);
            $user->userleadspooldata()->saveMany($userdata);
            // update data status
            $status = booktable::whereIn('id', $data)->update(['assigned' => true]);
            return response()->json(['success' => true, 'message' => 'User data has been assigned successfully']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return response()->json(['success' => false, 'message' => 'Error while assign data for user']);
        }
    }

    //////////////////////////// add comments on leads bool data for agent
    public function addleadspoolcomment(Request $request)
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
                UserLeadsPoolComment::create([
                    'leads_pool_id' => $request->checkedrow,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus,
                    'appointment_date' => $request->appointment_date
                ]);

                // change data status to won leads
                $data = booktable::find($request->checkedrow);

                // add data to own leads
                WonLeads::create([
                    'name' => $data->name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                    'mobile'=>$data->mobile,
                    'phone_whatsapp'=>$data->WhatsApp_phone,
                    'number_of_beds' => $data->number_of_beds,
                    'source' => $data->source,
                    'project' => $data->project,
                    'title' => $data->title,
                    'data_id' => $data->data_id,
                    'previous_state' => '8',
                    'previous_state_id' => $request->checkedrow,
                    'created_by' => Auth::user()->id
                ]);
                // $data->delete();
                // change data status to won leads
                Data::where('id', $data->data_id)->update(['previous_status' => DB::raw('data_status'), 'data_status' => 5]);
            } else if ($request->userstatus == "Not interested") {
                // add comment
                UserLeadsPoolComment::create([
                    'leads_pool_id' => $request->checkedrow,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus
                ]);
                // add data to own leads
                $data = booktable::find($request->checkedrow);
                DeadLeads::create([
                    'name' => $data->name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                    'mobile'=>$data->mobile,
                    'phone_whatsapp'=>$data->WhatsApp_phone,
                    'number_of_beds' => $data->number_of_beds,
                    'source' => $data->source,
                    'project' => $data->project,
                    'title' => $data->title,
                    'data_id' => $data->data_id,
                    'previous_state' => '8',
                    'previous_state_id' => $request->checkedrow,
                    'created_by' => Auth::user()->id
                ]);

                // $data->delete();
                // change data status to dead leads
                Data::where('id', $data->data_id)->update(['previous_status' => DB::raw('data_status'), 'data_status' => 6]);
            } else {
                // add comment
                UserLeadsPoolComment::create([
                    'user_id' => Auth::user()->id,
                    'leads_pool_id' => $request->checkedrow,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus
                ]);

                // change data status to leads pool
                $data = booktable::find($request->checkedrow);

                // add data to follow up leads
                FollowUpLeads::create([
                    'name' => $data->name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                    'mobile'=>$data->mobile,
                    'phone_whatsapp'=>$data->WhatsApp_phone,
                    'number_of_beds' => $data->number_of_beds,
                    'source' => $data->source,
                    'project' => $data->project,
                    'data_id' => $data->data_id,
                    'title' => $data->title,
                    'data_id' => $data->data_id,
                    'previous_state' => '8',
                    'previous_state_id' => $request->checkedrow,
                    'created_by' => Auth::user()->id
                ]);

                // $data->delete();
                // change data status to follow up leads
                Data::where('id', $data->data_id)->update(['previous_status' => DB::raw('data_status'), 'data_status' => 9]);
                // $data->delete();
            }

            return response()->json(['success' => true, 'message' => 'Comment entered successfully']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return response()->json(['success' => false, 'message' => 'Error happen call system admin']);
        }
    }

    //////////////////////////// show comments on leads pool data index for admin
    public function showuserleadspooldatacommentsindex()
    {
        $userstatus = config('app.user_status');
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasources = booktable::select('source')->groupBy('source')->get();
        return view('admin.leadspool.showuserleadspooldatacomment', ['userstatus' => $userstatus, 'datasources' => $datasources, 'agentnames' => $agentnames]);
    }

    //////////////////////////// show comments on leads pool data index for agent
    public function showleadspooldatacommentsindex()
    {
        $userstatus = config('app.user_status');
        $datasources = booktable::select('source')->groupBy('source')->get();
        return view('agent.leadspool.showleadspooldatacomment', ['userstatus' => $userstatus, 'datasources' => $datasources]);
    }

    //////////////////////////// show comments on leads pool data for agent and admin
    public function showleadspooldatacomments(Request $request)
    {
        $userid = null;
        if (Auth::user()->isadmin()) {
            $userid = $request->agentname;
        } else {
            $userid = Auth::user()->id;
        }
        $userstatus = $request->userstatus;
        $datasource = $request->datasource;
        $project = $request->project;
        $filtertext = $request->searchday;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
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
        // date range filteration
        if (!is_null($startdate) && !is_null($enddate) && $filtertype == 2) {
            $sdate = Carbon::parse($startdate);
            $edate = Carbon::parse($enddate);
            if ($sdate->gt($edate))
                return response()->json(['message' => 'start date must smaller than end date']);
            // $sdate = $sdate->toDateString();
            $edate = $edate->addDay();
        }

        // specific date filteration
        if (!is_null($startdate) && $filtertype == 1) {
            $sdate = Carbon::parse($startdate);
        }

        $data = UserLeadsPool::join('user_leads_pool_comments', function ($join) {
            $join->on('user_leads_pools.leads_pool_id', '=', 'user_leads_pool_comments.leads_pool_id')
                ->on('user_leads_pools.user_id', '=', 'user_leads_pool_comments.user_id');
        })
            ->join('booktables', 'booktables.id', '=', 'user_leads_pools.leads_pool_id')
            ->join('users', 'users.id', '=', 'user_leads_pool_comments.user_id')
            ->select(
                'booktables.*',
                'booktables.phone',
                'booktables.email',
                'booktables.name',
                'booktables.project',
                'booktables.mobile',
                'booktables.source',
                'user_leads_pools.leads_pool_id',
                'user_leads_pools.user_id',
                'users.name as agentname',
                'user_leads_pool_comments.userstatus',
                'user_leads_pool_comments.comment as comment',
                'user_leads_pool_comments.appointment_date',
                'user_leads_pool_comments.created_at'
            );

        /////////////////////// agent filter
        if ($userid != null) {
            $data = $data->where('user_leads_pool_comments.user_id', $userid);
        }

        /////////////////////// date filter
        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2)
            $data = $data->whereBetween('user_leads_pool_comments.created_at', [$sdate, $edate]);
        if (!is_null($monthfiltertext))
            $data = $data->whereMonth('user_leads_pool_comments.created_at', $monthfiltertext);
        if (!is_null($searchdaytext))
            $data = $data->whereDay('user_leads_pool_comments.created_at', '=', $searchdaytext);

        /////////////////////// customer status filter
        if ($userstatus != null)
            $data = $data->where('user_leads_pool_comments.userstatus', $userstatus);

        /////////////////////// data source filter
        if (!is_null($datasource) && $datasource != "Show")
            $data = $data->where('booktables.source', $datasource);

        /////////////////////// data project filter
        if (!is_null($project) && $project != "Show")
            $data = $data->where('booktables.project', $project);

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

    //////////////////////////// show comments info on leads pool data for agent and admin
    public function getadminleadspooldatacommentsinfo(Request $request)
    {
        $userid = null;
        if (Auth::user()->isadmin()) {
            $userid = $request->agentname;
        } else {
            $userid = Auth::user()->id;
        }

        $userstatus = $request->userstatus;
        $datasource = $request->datasource;
        $project = $request->project;
        $filtertext = $request->searchday;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
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
        // date range filteration
        if (!is_null($startdate) && !is_null($enddate) && $filtertype == 2) {
            $sdate = Carbon::parse($startdate);
            $edate = Carbon::parse($enddate);
            if ($sdate->gt($edate))
                return response()->json(['message' => 'start date must smaller than end date']);
            // $sdate = $sdate->toDateString();
            $edate = $edate->addDay();
        }

        // specific date filteration
        if (!is_null($startdate) && $filtertype == 1) {
            $sdate = Carbon::parse($startdate);
        }

        $data = UserLeadsPool::join('user_leads_pool_comments', function ($join) {
            $join->on('user_leads_pools.leads_pool_id', '=', 'user_leads_pool_comments.leads_pool_id')
                ->on('user_leads_pools.user_id', '=', 'user_leads_pool_comments.user_id');
        })
            ->join('booktables', 'booktables.id', '=', 'user_leads_pools.leads_pool_id')
            ->join('users', 'users.id', '=', 'user_leads_pool_comments.user_id')
            ->select(
                'booktables.*',
                'booktables.phone',
                'booktables.email',
                'booktables.name',
                'booktables.project',
                // 'booktables.MOBILE',
                'booktables.source',
                'user_leads_pools.leads_pool_id',
                'user_leads_pools.user_id',
                'users.name as agentname',
                'user_leads_pool_comments.userstatus',
                'user_leads_pool_comments.comment as comment',
                'user_leads_pool_comments.appointment_date',
                'user_leads_pool_comments.created_at'
            );

        /////////////////////// agent filter
        if ($userid != null) {
            $data = $data->where('user_leads_pool_comments.user_id', $userid);
        }

        /////////////////////// date filter
        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2)
            $data = $data->whereBetween('user_leads_pool_comments.created_at', [$sdate, $edate]);
        if (!is_null($monthfiltertext))
            $data = $data->whereMonth('user_leads_pool_comments.created_at', $monthfiltertext);
        if (!is_null($searchdaytext))
            $data = $data->whereDay('user_leads_pool_comments.created_at', '=', $searchdaytext);

        /////////////////////// customer status filter
        if ($userstatus != null)
            $data = $data->where('user_leads_pool_comments.userstatus', $userstatus);

        /////////////////////// data source filter
        if (!is_null($datasource) && $datasource != "Show")
            $data = $data->where('booktables.source', $datasource);

        /////////////////////// data project filter
        if (!is_null($project) && $project != "Show")
            $data = $data->where('booktables.project', $project);

        $data = $data->get();

        $setappointment = $data->where('userstatus', 'Set appointment')->count();
        $swoflibuwonuinnu = $data->where('userstatus', 'Switch off/Line busy/Wrong number/Invalid number')->count();
        $unavnotworkincomp = $data->where('userstatus', 'Number unavailable/Not working for call/Incomplete no')->count();
        $others = $data->where('userstatus', 'Others')->count();
        $interested = $data->where('userstatus', 'Interested')->count();
        $notinterested = $data->where('userstatus', 'Not interested')->count();
        $notanswer = $data->where('userstatus', 'Not answer')->count();

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
}
