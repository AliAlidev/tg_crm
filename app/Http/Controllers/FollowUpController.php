<?php

namespace App\Http\Controllers;

use App\Models\booktable;
use App\Models\Data;
use App\Models\DeadLeads;
use App\Models\FollowUpLeads;
use App\Models\User;
use App\Models\UserFollowUpLeads;
use App\Models\UserFollowUpLeadsComment;
use App\Models\WonLeads;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FollowUpController extends Controller
{

    //////////////////////////// show followup leads index for admin
    public function followupindex()
    {
        $datasource = FollowUpLeads::select('source')->groupBy('source')->pluck('source');
        $projects = FollowUpLeads::select('project')->groupBy('project')->pluck('project');
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        // $projects = FollowUpLeads::where('project', '!=', '')->select('project')->groupBy('project')->pluck('project');
        return view('admin.followup.followup', ['projects' => $projects, 'datasource' => $datasource, 'agentnames' => $agentnames]);
    }

    //////////////////////////// show followup leads for admin
    public function followup(Request $request)
    {
        $agentname = $request->agentname;
        $datasource = $request->datasource;
        $projects = $request->projects;

        $data = FollowUpLeads::join('users', 'users.id', '=', 'follow_up_leads.created_by')->where('assigned', 0);
        if ($agentname != null) {
            $data = $data->where('created_by', $agentname);
        }
        if ($datasource != null) {
            $data = $data->where('source', $datasource);
        }
        if ($projects != null) {
            $data = $data->where('project', $projects);
        }
        $data = $data->select('follow_up_leads.*', 'users.name as agentname')->get();

        return DataTables::of($data)
            ->addIndexColumn()
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

    //////////////////////////// assigne agent to followup leads data index for admin
    public function assignagentfollowupindex()
    {
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasources = FollowUpLeads::select('source')->groupBy('source')->get();
        return view('admin.followup.assignagentfollowupdata', ['agentnames' => $agentnames, 'datasources' => $datasources]);
    }

    //////////////////////////// assign agent to followup leads data for admin
    public function assignagentfollowupdata(Request $request)
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
                $userdata[] = new UserFollowUpLeads([
                    'user_id' => $request->userid,
                    'follow_up_id' => $item
                ]);
            }
            $user = User::find($request->userid);
            $user->userfollowupdata()->saveMany($userdata);
            // update data status
            $status = FollowUpLeads::whereIn('id', $data)->update(['assigned' => true]);
            return response()->json(['success' => true, 'message' => 'User data has been assigned successfully']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return response()->json(['success' => false, 'message' => 'Error while assign data for user']);
        }
    }

    //////////////////////////// return list of unassigned data for followup leads data table for admin
    public function searchforagentfollowupdata(Request $request)
    {
        $data = FollowUpLeads::where('assigned', 0);
        $datasource = $request->project;
        if ($datasource != null)
            $data = $data->where('source', $datasource);
        return DataTables::of($data)
            ->addcolumn('check', function () {
                return null;
            })
            ->rawColumns(['check'])
            ->make(true);
    }

    //////////////////////////// add comments on followup leads data for agent
    public function addfollowupcomment(Request $request)
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
                UserFollowUpLeadsComment::create([
                    'follow_up_id' => $request->checkedrow,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus,
                    'appointment_date' => $request->appointment_date
                ]);

                // change data status to won leads
                $data = FollowUpLeads::find($request->checkedrow);

                // add data to own leads
                WonLeads::create([
                    'name' => $data->name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                    'mobile'=>$data->mobile,
                    'phone_whatsapp'=>$data->phone_whatsup,
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
            } else {
                // add comment
                UserFollowUpLeadsComment::create([
                    'follow_up_id' => $request->checkedrow,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus
                ]);

                // add data to own leads
                $data = FollowUpLeads::find($request->checkedrow);
                DeadLeads::create([
                    'name' => $data->name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                    'mobile'=>$data->mobile,
                    'phone_whatsapp'=>$data->phone_whatsup,
                    'number_of_beds' => $data->number_of_beds,
                    'source' => $data->source,
                    'project' => $data->project,
                    'title' => $data->title,
                    'data_id' => $data->data_id,
                    'previous_state' => '9',
                    'previous_state_id' => $request->checkedrow,
                    'created_by' => Auth::user()->id
                ]);

                // $data->delete();
                // change data status to dead leads
                Data::where('id', $data->data_id)->update(['previous_status' => DB::raw('data_status'), 'data_status' => 6]);
            }

            return response()->json(['success' => true, 'message' => 'Comment entered successfully']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return response()->json(['success' => false, 'message' => 'Error happen call system admin']);
        }
    }

    //////////////////////////// show assigned followup leads data index for agent
    public function followupuserhomeindex()
    {
        $projects = FollowUpLeads::select('project')->groupBy('project')->get();
        $datasource = FollowUpLeads::select('source')->groupBy('source')->get();
        return view('agent.followup.followupuserhome', ['projects' => $projects, 'datasource' => $datasource]);
    }

    //////////////////////////// show assigned followup leads data for agent
    public function followupuserhomedata(Request $request)
    {
        $project = $request->project;
        $datasource = $request->datasource;

        $data = FollowUpLeads::query();
        if ($project != null) {
            $data = $data->where('project', $project);
        }
        if ($datasource != null) {
            $data = $data->where('source', $datasource);
        }

        $temp0 = Auth::user()->userfollowupdata()->pluck('follow_up_id');
        $data = $data->whereIn('follow_up_leads.id', $temp0);
        $temp = Auth::user()->userfollowupdatacomment()->pluck('follow_up_id');
        $data = $data->whereNotIn('follow_up_leads.id', $temp);
        $data = $data->join('users', 'users.id', '=', 'follow_up_leads.created_by');
        $data = $data->select('follow_up_leads.*', 'users.name as agentname');
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
                    '<option value="Not interested" > Not interested </option>' .
                    '<option value="Set appointment" > Set appointment </option>' .
                    '</select>';
            })
            ->rawColumns(['comments', 'userstatus'])
            ->make(true);
    }

    //////////////////////////// show comments on followup leads data index for admin
    public function showuserfollowupdatacommentsindex()
    {
        $userstatus = config('app.follow_up_user_status');
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasources = FollowUpLeads::select('source')->groupBy('source')->get();
        return view('admin.followup.showuserfollowupdatacomment', ['userstatus' => $userstatus, 'datasources' => $datasources, 'agentnames' => $agentnames]);
    }

    //////////////////////////// show comments on followup leads data index for agent
    public function showfollowupdatacommentsindex()
    {
        $userstatus = config('app.follow_up_user_status');
        $datasources = FollowUpLeads::select('source')->groupBy('source')->get();
        return view('agent.followup.showfollowupdatacomment', ['userstatus' => $userstatus, 'datasources' => $datasources]);
    }

    //////////////////////////// show comments on followup leads data for agent and admin
    public function showfollowupdatacomments(Request $request)
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
        $userid = null;
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

        $data = UserFollowUpLeads::join('user_follow_up_leads_comments', function ($join) {
            $join->on('user_follow_up_leads.follow_up_id', '=', 'user_follow_up_leads_comments.follow_up_id')
                ->on('user_follow_up_leads.user_id', '=', 'user_follow_up_leads_comments.user_id');
        })
            ->join('follow_up_leads', 'follow_up_leads.id', '=', 'user_follow_up_leads.follow_up_id')
            ->join('users', 'users.id', '=', 'user_follow_up_leads_comments.user_id')
            ->select(
                'follow_up_leads.*',
                'follow_up_leads.phone',
                'follow_up_leads.email',
                'follow_up_leads.name',
                'follow_up_leads.project',
                // 'follow_up_leads.MOBILE',
                'follow_up_leads.source',
                'user_follow_up_leads.follow_up_id',
                'user_follow_up_leads.user_id',
                'users.name as agentname',
                'user_follow_up_leads_comments.userstatus',
                'user_follow_up_leads_comments.comment as comment',
                'user_follow_up_leads_comments.appointment_date',
                'user_follow_up_leads_comments.created_at'
            );

        /////////////////////// agent filter
        if ($userid != null) {
            $data = $data->where('user_follow_up_leads_comments.user_id', $userid);
        }

        /////////////////////// date filter
        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2)
            $data = $data->whereBetween('user_follow_up_leads_comments.created_at', [$sdate, $edate]);
        if (!is_null($monthfiltertext))
            $data = $data->whereMonth('user_follow_up_leads_comments.created_at', $monthfiltertext);
        if (!is_null($searchdaytext))
            $data = $data->whereDay('user_follow_up_leads_comments.created_at', '=', $searchdaytext);

        /////////////////////// customer status filter
        if ($userstatus != null)
            $data = $data->where('user_follow_up_leads_comments.userstatus', $userstatus);

        /////////////////////// data source filter
        if (!is_null($datasource) && $datasource != "Show")
            $data = $data->where('follow_up_leads.source', $datasource);

        /////////////////////// data project filter
        if (!is_null($project) && $project != "Show")
            $data = $data->where('follow_up_leads.project', $project);

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

    //////////////////////////// show comments info on followup leads data for agent and admin
    public function getadminfollowupdatacommentsinfo(Request $request)
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

        $data = UserFollowUpLeads::join('user_follow_up_leads_comments', function ($join) {
            $join->on('user_follow_up_leads.follow_up_id', '=', 'user_follow_up_leads_comments.follow_up_id')
                ->on('user_follow_up_leads.user_id', '=', 'user_follow_up_leads_comments.user_id');
        })
            ->join('follow_up_leads', 'follow_up_leads.id', '=', 'user_follow_up_leads.follow_up_id')
            ->join('users', 'users.id', '=', 'user_follow_up_leads_comments.user_id')
            ->select(
                'follow_up_leads.*',
                'follow_up_leads.phone',
                'follow_up_leads.email',
                'follow_up_leads.name',
                'follow_up_leads.project',
                // 'follow_up_leads.MOBILE',
                'follow_up_leads.source',
                'user_follow_up_leads.follow_up_id',
                'user_follow_up_leads.user_id',
                'users.name as agentname',
                'user_follow_up_leads_comments.userstatus',
                'user_follow_up_leads_comments.comment as comment',
                'user_follow_up_leads_comments.appointment_date',
                'user_follow_up_leads_comments.created_at'
            );

        /////////////////////// agent filter
        if ($userid != null) {
            $data = $data->where('user_follow_up_leads_comments.user_id', $userid);
        }

        /////////////////////// date filter
        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2)
            $data = $data->whereBetween('user_follow_up_leads_comments.created_at', [$sdate, $edate]);
        if (!is_null($monthfiltertext))
            $data = $data->whereMonth('user_follow_up_leads_comments.created_at', $monthfiltertext);
        if (!is_null($searchdaytext))
            $data = $data->whereDay('user_follow_up_leads_comments.created_at', '=', $searchdaytext);

        /////////////////////// customer status filter
        if ($userstatus != null)
            $data = $data->where('user_follow_up_leads_comments.userstatus', $userstatus);

        /////////////////////// data source filter
        if (!is_null($datasource) && $datasource != "Show")
            $data = $data->where('follow_up_leads.source', $datasource);

        /////////////////////// data project filter
        if (!is_null($project) && $project != "Show")
            $data = $data->where('follow_up_leads.project', $project);

        $data = $data->get();

        $setappointment = $data->where('userstatus', 'Set appointment')->count();
        $notinterested = $data->where('userstatus', 'Not interested')->count();

        $total =  $notinterested + $setappointment;
        return response()->json([
            'succssess' => true,
            'notinterested' => $notinterested,
            'setappointment' => $setappointment,
            'total' => $total
        ]);
    }

    //////////////////////////// show assigned leads pool data index for admin
    public function showassignedagentfollowupindex()
    {
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasources = FollowUpLeads::select('source')->groupBy('source')->pluck('source');
        return view('admin.followup.showassignedagentfollowupdata', ['agentnames' => $agentnames, 'datasources' => $datasources]);
    }
    //////////////////////////// unassign followup leads data
    public function unassignagentfollowupdata(Request $request)
    {
        // dd($request->all());
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
            $comments = UserFollowUpLeadsComment::join('user_follow_up_leads', function ($join) {
                $join->on('user_follow_up_leads_comments.follow_up_id', '=', 'user_follow_up_leads.follow_up_id')
                    ->on('user_follow_up_leads_comments.user_id', '=', 'user_follow_up_leads.user_id');
            })->where('user_follow_up_leads_comments.user_id', $request->userid)->pluck('user_follow_up_leads_comments.follow_up_id')->toArray();
            foreach ($data as $key => $item) {
                if (in_array($item, $comments)) {
                    unset($data[$key]);
                }
            }
            if ($data != null) {
                UserFollowUpLeads::where('user_id', $request->userid)->whereIn('follow_up_id', $data)->delete();
                Data::whereIn('id', $data)->update(['assigned' => false]);
                return response()->json(['success' => true, 'message' => 'User data has been unassigned successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Unable to unassign this data']);
            }
        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Error while unassign data for user']);
        }
    }

    //////////////////////////// show assigned leads pool data for admin
    public function showassignedagentfollowupdata(Request $request)
    {
        $data = FollowUpLeads::join('users', 'users.id', '=', 'follow_up_leads.created_by');
        $datasource = $request->datasource;
        $userid = $request->userid;
        if ($datasource != null) {
            $data = $data->where('source', $datasource);
        }
        $users = User::all();
        $user = $users->where('id', $userid)->first();
        if ($user != null) {
            $temp = $user->followupdata()->pluck('follow_up_id');
            $data = $data->whereIn('follow_up_leads.id', $temp);
            $data = $data->select('follow_up_leads.*', 'users.name as agentname')->get();
        } else {
            $data = [];
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addcolumn('check', function () {
                return null;
            })
            ->rawColumns(['check'])
            ->make(true);
    }
}
