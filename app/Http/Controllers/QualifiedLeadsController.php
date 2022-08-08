<?php

namespace App\Http\Controllers;

use App\Models\booktable;
use App\Models\Data;
use App\Models\DeadLeads;
use App\Models\FollowUpLeads;
use App\Models\QualifiedLeads;
use App\Models\User;
use App\Models\UserQualifiedLeads;
use App\Models\UserQualifiedLeadsComment;
use App\Models\WonLeads;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class QualifiedLeadsController extends Controller
{

    //////////////////////////// show qualified leads index for admin
    public function qualifiedleadsindex()
    {
        $projects = QualifiedLeads::select('project')->groupBy('project')->pluck('project');
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasources = QualifiedLeads::select('source')->groupby('source')->get();
        return view('admin.qualified.qualifiedleads', ['projects' => $projects, 'agentnames' => $agentnames, 'datasources' => $datasources]);
    }

    //////////////////////////// show qualified leads for admin
    public function qualifiedleads(Request $request)
    {
        $agentname = $request->agentname;
        $datasource = $request->datasource;
        $projects = $request->projects;

        $data = QualifiedLeads::join('users', 'users.id', '=', 'qualified_leads.created_by')->where('assigned', 0);
        if ($agentname != null) {
            $data = $data->where('created_by', $agentname);
        }
        if ($datasource != null) {
            $data = $data->where('source', $datasource);
        }
        if ($projects != null) {
            $data = $data->where('project', $projects);
        }
        $data = $data->select('qualified_leads.*', 'users.name as agentname')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    //////////////////////////// return list of unassigned data for qualified leads data table for admin
    public function searchforagentqualifieddata(Request $request)
    {
        $data = QualifiedLeads::where('assigned', 0);
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

    //////////////////////////// show assigned qualified data index for agent
    public function qualifieduserhomeindex()
    {
        $projects = QualifiedLeads::select('project')->groupBy('project')->get();
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasource = QualifiedLeads::select('source')->groupBy('source')->get();
        $userstates = config('app.user_status');
        return view('agent.qualified.qualifieduserhome', ['projects' => $projects, 'agentnames' => $agentnames, 'datasource' => $datasource, 'userstates' => $userstates]);
    }

    //////////////////////////// show assigned qualified data for agent
    public function qualifieduserhomedata(Request $request)
    {
        $project = $request->project;
        $datasource = $request->datasource;

        $data = QualifiedLeads::query();
        if ($project != null) {
            $data = QualifiedLeads::where('project', $project);
        }
        if ($datasource != null) {
            $data = QualifiedLeads::where('source', $datasource);
        }

        $temp0 = Auth::user()->userqualifieddata()->pluck('qualified_leads_id');
        $data = $data->whereIn('qualified_leads.id', $temp0);
        $temp = Auth::user()->userqualifieddatacomment()->pluck('qualified_leads_id');
        $data = $data->whereNotIn('qualified_leads.id', $temp);
        $data = $data->join('users', 'users.id', '=', 'qualified_leads.created_by');
        $data = $data->select('qualified_leads.*', 'users.name as agentname');
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

    //////////////////// assign agent to qualified data index for admin
    public function assignagentqualifieddataindex()
    {
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasources = QualifiedLeads::select('source')->groupBy('source')->get();
        return view('admin.qualified.assignagentqualifieddata', ['agentnames' => $agentnames, 'datasources' => $datasources]);
    }

    //////////////////// assign agent to qualified data for admin
    public function assignagentqualifieddata(Request $request)
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
                $userdata[] = new UserQualifiedLeads([
                    'user_id' => $request->userid,
                    'qualified_leads_id' => $item
                ]);
            }
            $user = User::find($request->userid);
            $user->userqualifieddata()->saveMany($userdata);
            // update data status
            $status = QualifiedLeads::whereIn('id', $data)->update(['assigned' => true]);
            return response()->json(['success' => true, 'message' => 'User data has been assigned successfully']);
        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Error while assign data for user']);
        }
    }

    //////////////////// unassign agent from qualified data for admin
    public function unassignagentqualifieddata(Request $request)
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

            $comments = UserQualifiedLeadsComment::join('user_qualified_leads', function ($join) {
                $join->on('user_qualified_leads_comments.qualified_leads_id', '=', 'user_qualified_leads.qualified_leads_id')
                    ->on('user_qualified_leads_comments.user_id', '=', 'user_qualified_leads.user_id');
            })->where('user_qualified_leads_comments.user_id', $request->userid)->pluck('user_qualified_leads_comments.qualified_leads_id')->toArray();

            foreach ($data as $key => $item) {
                if (in_array($item, $comments)) {
                    unset($data[$key]);
                }
            }
            if ($data != null) {
                UserQualifiedLeads::where('user_id', $request->userid)->whereIn('qualified_leads_id', $data)->delete();
                Data::whereIn('id', $data)->update(['assigned' => false]);
                return response()->json(['success' => true, 'message' => 'User data has been unassigned successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Unable to unassign this data']);
            }
        } catch (Exception $ex) {
            dd($ex->getMessage());
            return response()->json(['success' => false, 'message' => 'Error while unassign data for user']);
        }
    }

    //////////////////// add comment on qualified data for agent
    public function addqualifiedcomment(Request $request)
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
                UserQualifiedLeadsComment::create([
                    'qualified_leads_id' => $request->checkedrow,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus,
                    'appointment_date' => $request->appointment_date
                ]);

                // change data status to won leads
                $data = QualifiedLeads::find($request->checkedrow);

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
                    'previous_state' => '7',
                    'previous_state_id' => $request->checkedrow,
                    'created_by' => Auth::user()->id
                ]);

                // $data->delete();
                // change data status to dead leads
                Data::where('id', $data->data_id)->update(['previous_status' => DB::raw('data_status'), 'data_status' => 5]);
            } else if ($request->userstatus == "Interested") {
                // add comment
                UserQualifiedLeadsComment::create([
                    'user_id' => Auth::user()->id,
                    'qualified_leads_id' => $request->checkedrow,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus
                ]);

                // change data status to leads pool
                $data = QualifiedLeads::find($request->checkedrow);

                // add data to leads pool
                booktable::create([
                    'name' => $data->name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                    'mobile'=>$data->mobile,
                    'WhatsApp_phone'=>$data->phone_whatsup,
                    'number_of_beds' => $data->number_of_beds,
                    'source' => $data->source,
                    'project' => $data->project,
                    'title' => $data->title,
                    'data_id' => $data->data_id,
                    'previous_state' => '7',
                    'previous_state_id' => $request->checkedrow,
                    'created_by' => Auth::user()->id
                ]);

                // $data->delete();
                // change data status to dead leads
                Data::where('id', $data->data_id)->update(['previous_status' => DB::raw('data_status'), 'data_status' => 8]);
            } else if ($request->userstatus == "Not interested") {
                // add comment
                UserQualifiedLeadsComment::create([
                    'qualified_leads_id' => $request->checkedrow,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus
                ]);
                // add data to own leads
                $data = QualifiedLeads::find($request->checkedrow);
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
                    'previous_state' => '7',
                    'previous_state_id' => $request->checkedrow,
                    'created_by' => Auth::user()->id
                ]);

                // $data->delete();
                // change data status to dead leads
                Data::where('id', $data->data_id)->update(['previous_status' => DB::raw('data_status'), 'data_status' => 6]);
            } else {
                // add comment
                UserQualifiedLeadsComment::create([
                    'qualified_leads_id' => $request->checkedrow,
                    'user_id' => Auth::user()->id,
                    'comment' => $request->comment,
                    'userstatus' => $request->userstatus
                ]);
                // add data to own leads
                $data = QualifiedLeads::find($request->checkedrow);
                FollowUpLeads::create([
                    'name' => $data->name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                    'mobile'=>$data->MOBILE,
                    'phone_whatsapp'=>$data->phone_whatsup,
                    'number_of_beds' => $data->number_of_beds,
                    'source' => $data->source,
                    'project' => $data->project,
                    'title' => $data->title,
                    'data_id' => $data->data_id,
                    'previous_state' => '7',
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

    //////////////////////////// show comments on qualified data index for admin
    public function showuserqualifieddatacommentsindex()
    {
        $userstatus = config('app.user_status');
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasources = QualifiedLeads::select('source')->groupBy('source')->get();
        return view('admin.qualified.showusercommentedqualifieddata', ['userstatus' => $userstatus, 'datasources' => $datasources, 'agentnames' => $agentnames]);
    }

    //////////////////////////// show comemnts on qualified data index for agent
    public function showqualifieddatacommentsindex()
    {
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $userstatus = config('app.user_status');
        $datasources = QualifiedLeads::select('source')->groupBy('source')->get();
        return view('agent.qualified.showqualifieddatacomment', ['agentnames' => $agentnames, 'userstatus' => $userstatus, 'datasources' => $datasources]);
    }

    //////////////////////////// show comemnts on qualified data for agent and admin
    public function showqualifieddatacomments(Request $request)
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

        $data = UserQualifiedLeads::join('user_qualified_leads_comments', function ($join) {
            $join->on('user_qualified_leads.qualified_leads_id', '=', 'user_qualified_leads_comments.qualified_leads_id')
                ->on('user_qualified_leads.user_id', '=', 'user_qualified_leads_comments.user_id');
        })
            ->join('qualified_leads', 'qualified_leads.id', '=', 'user_qualified_leads.qualified_leads_id')
            ->join('users', 'users.id', '=', 'user_qualified_leads_comments.user_id')
            ->select(
                'qualified_leads.*',
                'qualified_leads.phone',
                'qualified_leads.email',
                'qualified_leads.name',
                'qualified_leads.project',
                // 'qualified_leads.MOBILE',
                'qualified_leads.source',
                'user_qualified_leads.qualified_leads_id',
                'user_qualified_leads.user_id',
                'users.name as agentname',
                'user_qualified_leads_comments.userstatus',
                'user_qualified_leads_comments.comment as comment',
                'user_qualified_leads_comments.appointment_date',
                'user_qualified_leads_comments.created_at'
            );

        /////////////////////// agent filter
        if ($userid != null) {
            $data = $data->where('user_qualified_leads_comments.user_id', $userid);
        }

        /////////////////////// date filter
        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2)
            $data = $data->whereBetween('user_qualified_leads_comments.created_at', [$sdate, $edate]);
        if (!is_null($monthfiltertext))
            $data = $data->whereMonth('user_qualified_leads_comments.created_at', $monthfiltertext);
        if (!is_null($searchdaytext))
            $data = $data->whereDay('user_qualified_leads_comments.created_at', '=', $searchdaytext);


        /////////////////////// customer status filter
        if ($userstatus != null)
            $data = $data->where('user_qualified_leads_comments.userstatus', $userstatus);

        /////////////////////// data source filter
        if (!is_null($datasource) && $datasource != "Show")
            $data = $data->where('qualified_leads.source', $datasource);

        /////////////////////// data project filter
        if (!is_null($project) && $project != "Show")
            $data = $data->where('qualified_leads.project', $project);

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

    //////////////////// show comments info on qualified leads for admin and agent
    public function getadminqualifieddatacommentsinfo(Request $request)
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

            $edate->addDay();
        }

        // specific date filteration
        if (!is_null($startdate) && $filtertype == 1) {
            $sdate = Carbon::parse($startdate);
        }

        $data = UserQualifiedLeads::join('user_qualified_leads_comments', function ($join) {
            $join->on('user_qualified_leads.qualified_leads_id', '=', 'user_qualified_leads_comments.qualified_leads_id')
                ->on('user_qualified_leads.user_id', '=', 'user_qualified_leads_comments.user_id');
        })
            ->join('qualified_leads', 'qualified_leads.id', '=', 'user_qualified_leads.qualified_leads_id')
            ->join('users', 'users.id', '=', 'user_qualified_leads_comments.user_id')
            ->select(
                'qualified_leads.*',
                'qualified_leads.phone',
                'qualified_leads.email',
                'qualified_leads.name',
                'qualified_leads.project',
                // 'qualified_leads.MOBILE',
                'qualified_leads.source',
                'user_qualified_leads.qualified_leads_id',
                'user_qualified_leads.user_id',
                'users.name as agentname',
                'user_qualified_leads_comments.userstatus',
                'user_qualified_leads_comments.comment as comment',
                'user_qualified_leads_comments.appointment_date',
                'user_qualified_leads_comments.created_at'
            );

        /////////////////////// date filter
        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2)
            $data = $data->whereBetween('user_qualified_leads_comments.created_at', [$sdate, $edate]);
        if (!is_null($monthfiltertext))
            $data = $data->whereMonth('user_qualified_leads_comments.created_at', $monthfiltertext);
        if (!is_null($searchdaytext))
            $data = $data->whereDay('user_qualified_leads_comments.created_at', '=', $searchdaytext);

        /////////////////////// agent filter
        if ($userid != null)
            $data = $data->where('user_qualified_leads_comments.user_id', $userid);

        /////////////////////// customer status filter
        if ($userstatus != null)
            $data = $data->where('user_qualified_leads_comments.userstatus', $userstatus);

        /////////////////////// data source filter
        if (!is_null($datasource) && $datasource != "Show")
            $data = $data->where('qualified_leads.source', $datasource);

        /////////////////////// data project filter
        if (!is_null($project) && $project != "Show")
            $data = $data->where('qualified_leads.project', $project);

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

    //////////////////// show assigned agent for qualified data index for admin
    public function showassignedagentqualifiedindex()
    {
        $agentnames = User::select('id', 'name')->where('role_id', 'like', '%3%')->get();
        $datasources = QualifiedLeads::select('source')->groupBy('source')->pluck('source');
        return view('admin.qualified.showassignedagentqualifieddata', ['agentnames' => $agentnames, 'datasources' => $datasources]);
    }

    //////////////////// show assigned agent for qualified data for admin
    public function showassignedagentqualifieddata(Request $request)
    {
        $datasource = $request->datasource;
        $userdata = UserQualifiedLeads::where('user_id', $request->userid)->pluck('qualified_leads_id');
        $data = QualifiedLeads::join('users', 'users.id', '=', 'qualified_leads.created_by')->whereIn('qualified_leads.id', $userdata)->orderBy('created_at', 'DESC');
        if ($request->datasource != null)
            $data = $data->where('qualified_leads.source', $datasource);
        $data = $data->select('qualified_leads.*', 'users.name as agentname');
        return DataTables::of($data)
            ->addcolumn('check', function () {
                return null;
            })
            ->rawColumns(['check'])
            ->make(true);
    }
}
