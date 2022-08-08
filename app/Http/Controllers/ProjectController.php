<?php

namespace App\Http\Controllers;

use App\Models\ArchitectureTaxInvoice;
use App\Models\Contact;
use App\Models\Cost;
use App\Models\default_value;
use App\Models\DesignServices;
use App\Models\MaterialAndFurnitureList;
use App\Models\MaterialAndFurnitureListRows;
use App\Models\MaterialAndFurnitureProposal;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectType;
use App\Models\ProjectUser;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Exception;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\PseudoTypes\False_;
use PhpParser\Node\Const_;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function createnewprojectindex()
    {
        $projecttypes = ProjectType::all();
        $users = User::all()->whereIn('role_id', [5, 6, 7]);
        return view('projects_management.projects.createproject', ['projecttypes' => $projecttypes, 'users' => $users]);
    }
    public function createnewproject(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'code' => 'required',
                'date' => 'required',
                'client' => 'required',
                'description' => 'required',
                'contributors' => 'required',
                'projecttype' => 'required'
            ]
        );
        try {
            $project = new Project;
            $project->name = $request->name;
            $project->code = $request->code;
            $project->date = $request->date;
            $project->client = $request->client;
            $project->description = $request->description;
            $project->status = 'running';
            $project->stage = 'new';
            $project->project_type = $request->projecttype;
            $project->save();
            $users = $request->contributors;

            foreach ($users as $key => $user) {
                $data = [
                    'user_id' => $user,
                    'project_id' => $project->id
                ];
                ProjectUser::create($data);
            }
            if ($project != null)
                return response()->json(['success' => true, 'message' => 'Project created successfully']);
            else
                return response()->json(['success' => false, 'message' => 'Error in creating new project']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }
    public function architectureprojectslistindex()
    {
        $status = Project::where('project_type', '1')->groupBy('status')->pluck('status');
        $stages = Project::where('project_type', '1')->groupBy('stage')->pluck('stage');
        return view('projects_management.projects.architectureprojectslist', ['status' => $status, 'stages' => $stages]);
    }
    public function architectureprojectslist(Request $request)
    {
        $status = $request->status;
        $stage = $request->stage;
        $startdate = $request->startdate;
        $enddate = $request->enddate;

        $filtertype = $request->filtertype;
        $sdate = null;
        $edate = null;
        // date range filteration
        if (!is_null($startdate) && !is_null($enddate) && $filtertype == 2) {
            $sdate = Carbon::parse($startdate);
            $edate = Carbon::parse($enddate);
            if ($sdate->gt($edate))
                return response()->json(['message' => 'start date must smaller than end date']);
            $sdate = $sdate->subDay();
        }

        // specific date filteration
        if (!is_null($startdate) && $filtertype == 1) {
            $sdate = Carbon::parse($startdate);
        }

        $data = Project::where('project_type', '1');

        // date filter
        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2)
            $data = $data->whereBetween('date', [$sdate, $edate]);
        // status filter
        if ($status != null)
            $data = $data->where('status', $status);
        // stage filter
        if (!is_null($stage))
            $data = $data->where('stage', $stage);

        $data = $data->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['code']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['client']), Str::lower($request->get('search')))) {
                            return true;
                        }
                        return false;
                    });
                }
            })
            ->addColumn('action', function ($row) {
                if ($row->status == "done") {
                    $actionBtn = '<a class=" progress1 btn-success btn btn-sm">Progress</a>' . '<a class="task ml-1 btn-secondary btn btn-sm">Task</a>';
                    return $actionBtn;
                } else {
                    $actionBtn = '<a class="delete btn-danger btn btn-sm">Delete</a>' . "<a  class='edit ml-1 btn-info btn btn-sm'>Edit</a>"
                        . '<a class="progress1 ml-1 btn-success btn btn-sm">Progress</a>' . '<a class="task ml-1 btn-secondary btn btn-sm">Task</a>';
                    return $actionBtn;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function deleteproject(Request $request)
    {
        $civilproject = Project::find($request->id);
        $data = ProjectUser::where('project_id', $request->id)->delete();
        if ($civilproject) {
            $civilproject->delete();
            return response()->json([
                'message' => 'The project Has Been Deleted Successfully',
                'state' => true
            ]);
        } else {
            return response()->json([
                'message' => 'Error In deleting project',
                'state' => false
            ]);
        }
    }

    public function editproject($id)
    {
        $project = Project::find($id);
        if ($project) {
            $projecttypes = ProjectType::all();
            $project_users = ProjectUser::where('project_id', $id)->join('users', 'users.id', '=', 'project_users.user_id')->pluck('user_id')->toArray();
            // dd($project_users);
            $users = User::all()->whereIn('role_id', [5, 6, 7]);
            return view('projects_management.projects.editproject', ['project' => $project, 'projecttypes' => $projecttypes, 'users' => $users, 'project_users' => $project_users]);
        } else {
            return back();
        }
    }

    public function updateproject(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'name' => 'required',
                'code' => 'required',
                'date' => 'required',
                'client' => 'required',
                'description' => 'required',
                'contributors' => 'required',
                'projecttype' => 'required'
            ]
        );
        try {
            $project = Project::where('id', $request->id)->first();
            $project->name = $request->name;
            $project->code = $request->code;
            $project->date = $request->date;
            $project->client = $request->client;
            $project->description = $request->description;
            $project->project_type = $request->projecttype;
            $project->update();

            $val = ProjectUser::where('project_id', $request->id)->delete();
            $users = $request->contributors;

            foreach ($users as $key => $user) {
                $data = [
                    'user_id' => $user,
                    'project_id' => $project->id
                ];
                ProjectUser::create($data);
            }
            if ($project != null)
                return response()->json(['success' => true, 'message' => 'Project Update successfully']);
            else
                return response()->json(['success' => false, 'message' => 'Error in Update project']);
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function civilprojectslistindex()
    {
        $status = Project::where('project_type', '2')->groupBy('status')->pluck('status');
        $stages = Project::where('project_type', '2')->groupBy('stage')->pluck('stage');
        return view('projects_management.projects.civilprojectslist', ['status' => $status, 'stages' => $stages]);
    }
    public function civilprojectslist(Request $request)
    {
        $status = $request->status;
        $stage = $request->stage;
        $startdate = $request->startdate;
        $enddate = $request->enddate;

        $filtertype = $request->filtertype;

        $sdate = null;
        $edate = null;
        // date range filteration
        if (!is_null($startdate) && !is_null($enddate) && $filtertype == 2) {
            $sdate = Carbon::parse($startdate);
            $edate = Carbon::parse($enddate);
            if ($sdate->gt($edate))
                return response()->json(['message' => 'start date must smaller than end date']);
            $sdate = $sdate->subDay();
        }

        // specific date filteration
        if (!is_null($startdate) && $filtertype == 1) {
            $sdate = Carbon::parse($startdate);
        }

        $data = Project::where('project_type', '2');

        // date filter
        if (!is_null($sdate) && !is_null($edate) && $filtertype == 2)
            $data = $data->whereBetween('date', [$sdate, $edate]);
        // status filter
        if ($status != null)
            $data = $data->where('status', $status);
        // stage filter
        if (!is_null($stage))
            $data = $data->where('stage', $stage);

        $data = $data->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['code']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['client']), Str::lower($request->get('search')))) {
                            return true;
                        }
                        return false;
                    });
                }
            })
            ->addColumn('action', function ($row) {
                if ($row->status == "done") {
                    $actionBtn = '<a class=" progress1 btn-success btn btn-sm">Progress</a>' . '<a class="task ml-1 btn-secondary btn btn-sm">Task</a>';
                    return $actionBtn;
                } else {
                    $actionBtn = '<a class="delete btn-danger btn btn-sm">Delete</a>' . "<a  class='edit ml-1 btn-info btn btn-sm'>Edit</a>"
                        . '<a class="progress1 ml-1 btn-success btn btn-sm">Progress</a>' . '<a class="task ml-1 btn-secondary btn btn-sm">Task</a>';
                    return $actionBtn;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function projecttasks($id)
    {
        $project_de = Project::find($id);
        $projectTasks = ProjectTask::where('project_id', $id)->get();
        if ($project_de) {
            $project_users = ProjectUser::where('project_id', $id)->join('users', 'users.id', '=', 'project_users.user_id')->get();
            $project_type = ProjectType::where('id', $project_de->project_type)->first();
            return view('projects_management.projects.projecttasks', compact('project_de', 'project_users', 'project_type', 'projectTasks'));
        } else {
            return back();
        }
    }
    public function storeTask(Request $request)
    {
        $data=[];
        $tasks = [];
        $start_dates = [];
        $end_tasks = [];
        $contributors = [];
        $tasks = [];
        foreach ($request->task as $key => $item) {
            if ($item != null)
                $data['tasks'][] = $item;
        }
        foreach ($request->start_date as $key => $item) {
            if ($item != null)
                $data['start_dates'][] = $item;
        }
        foreach ($request->end_task as $key => $item) {
            if ($item != null)
                $data['end_tasks'][] = $item;
        }
        foreach ($request->contributors as $key => $item) {
            if ($item != null)
                $data['contributors'][] = $item;
        }

        // $validator = Validator::make($request->toArray(), [
        //     'contributors' => 'required|array',
        //     'end_task' => 'required|array',
        //     'start_date' => 'required|array',
        //     'task' => 'required|array',
        //     'task.*' => 'required',
        //     'contributors.*' => 'required',
        //     'end_task.*' => 'required',
        //     'start_date.*' => 'required',

        // ], [
        //     'required' => 'The :attribute Field Can Not Be Blank',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'message' => $validator->errors()->all(),
        //         'state' => false
        //     ]);
        // }
        // remove old
        ProjectTask::where('project_id', $request->project_id)->delete();
        $l = 0;
        for ($i = 0; $i < count($data['tasks']); $i++) {
            $project_task = new ProjectTask;
            $project_task->task = $data['tasks'][$i];
            $project_task->start_date = $data['start_dates'][$i];
            $project_task->end_date = $data['end_tasks'][$i];
            $project_task->project_id = $request->project_id;
            $project_task->contributors = $data['contributors'][$i];
            $project_task->save();
            if ($project_task) {
                $l++;
            }
        }
        if ($l == count($data['tasks'])) {
            return response()->json([
                'message' => 'The Tasks Has Been Created Successfully',
                'state' => true
            ]);
        } else {
            return response()->json([
                'message' => 'Error In Creating  Task',
                'state' => false
            ]);
        }
    }
    public function listtask(Request $request)
    {
        $data = ProjectTask::where('project_id', $request->id)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a class=" delete btn-danger btn btn-sm" >Delete</a>' . "<a  class=' edit ml-1 btn-info btn btn-sm'>Edit</a> ";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function project_progress_index($id)
    {
        $contacts=[];
        $cost=[];
        $tax_invoice=[];
        $material_and_furniture_lists=[];
        $project=Project::find($id);
        $projecttasks = ProjectTask::where('project_id', $id)->get();
        $Design_Service_stage_a=default_value::where('name','stage_a')->first();
        if ($project) {
            $project_users = ProjectUser::where('project_id', $id)->join('users', 'users.id', '=', 'project_users.user_id')->get();
            $project_type = ProjectType::where('id', $project->project_type)->first();
            $project_service=DesignServices::where('project_id',$id)->first();
            $material_and_furniture=MaterialAndFurnitureProposal::where('project_id',$id)->first();
            if($material_and_furniture){
                $contacts=Contact::where('material_and_furniture_proposals_id',$material_and_furniture->id)->get();
                $material_and_furniture_lists=MaterialAndFurnitureList::where('material_and_furniture_proposals_id',$material_and_furniture->id)->with('MaterialAndFurnitureListrow')->get();
                $cost=Cost::where('material_and_furniture_proposals_id',$material_and_furniture->id)->first();
                $tax_invoice=ArchitectureTaxInvoice::where('material_and_furniture_proposals_id',$material_and_furniture->id)->first();
            }
            // dd($material_and_furniture_lists);
            return view('projects_managements.projects.architecture_project_progress', compact('project', 'project_users', 'project_type', 'projecttasks','Design_Service_stage_a','project_service','material_and_furniture','contacts','material_and_furniture_lists','cost','tax_invoice'));

        } else {
            return back();
        }
    }
    public function save_design_service(Request $request){
        $stage_b=default_value::where('name','stage_b')->first();
        $stage_c=default_value::where('name','stage_c')->first();
        $stage_d=default_value::where('name','stage_d')->first();
        $subtotal=$request->subtotal;
        $vat=$subtotal*0.05;
        $grand_total=$vat + $subtotal;
        default_value::where('name','stage_a')->update([
            'value'=>strip_tags($request->design_service_stage_a)
        ]);
        $DesignService=DesignServices::where('project_id',$request->project_id)->first();
        if($DesignService){
            $DesignService->update([
                'stage_a'=>$request->design_service_stage_a,
                'Subtotal'=>$subtotal,
                'vat'=>$vat,
                'grand_total'=>$grand_total,
            ]);
            return response()->json([
                'message' => 'Design Service Has Been Edit Successfully',
                'state' => true
            ]);
        }else{
            $project=Project::find($request->project_id)->update([
                'stage' => 'Design Service',
            ]);
            $DesignService=DesignServices::create([
                'project_id'=>$request->project_id,
                'stage_a'=>$request->design_service_stage_a,
                'stage_b'=>$stage_b->value,
                'stage_c'=>$stage_c->value,
                'stage_d'=>$stage_d->value,
                'Subtotal'=>$subtotal,
                'vat'=>$vat,
                'grand_total'=>$grand_total,
            ]);
            return response()->json([
                'message' => 'Design Service Has Been Saved Successfully',
                'state' => true
            ]);
        }
    }
    public function DownloadDesignServices(Request $request){
        // dd($request->all());
        $project = Project::find($request->id);
        if ($project) {
            $designserver =DesignServices::where('project_id',$request->id )->first();
            $stage_as=explode("\n", $designserver->stage_a);
            $stage_bs=explode("\n", $designserver->stage_b);
            $stage_cs=explode("\n", $designserver->stage_c);
            $stage_ds=explode("\n", $designserver->stage_d);
            $date=new DateTime($project->date);
            $day = $date->format('d \of F Y');
            $pdf = PDF::loadView('DesignServicespdf', compact('designserver', 'project','stage_as','stage_bs','stage_cs','stage_ds','day'));
            return $pdf->download('DesignServices'. Auth::user()->id .'.pdf');
        } else {
            return response()->json(['success' => true, 'message' => 'Error while  download invoice']);

        }
    }
    public function Change_paid_design_service(Request $request){
        $DesignService=DesignServices::where('project_id',$request->id)->first();
        $project=Project::find($request->id)->update([
            'stage' => 'Material Proposal',
        ]);
        if($DesignService){
            $DesignService->update([
                'is_paid'=> true
            ]);
            return response()->json([
                'message' => 'Paid Design Service Has Been Updated Successfully',
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Design Service Not Found',
                'state' => False
            ]);
        }
    }
    ///////Material And Furniture Proposal
    ///create_material_and_furniture
    public function create_material_and_furniture(Request $request){
        $material_and_furniture=MaterialAndFurnitureProposal::where('project_id',$request->id)->first();

        if($material_and_furniture){
            $material_and_furniture->update([
                'date'=>$request->date,
                'note'=>$request->create_material_and_furniture_texteditor,
                'is_paid'=>false
            ]);
            return response()->json([
                'message' => 'Material And Furniture Proposal Has Been Edit Successfully',
                'data'=>$material_and_furniture->id,
                'state' => true
            ]);
        }else{
            $material_and_furniture=MaterialAndFurnitureProposal::create([
                'project_id'=>$request->id,
                'date'=>$request->date,
                'note'=>$request->create_material_and_furniture_texteditor,
                'is_paid'=>false
            ]);;
            return response()->json([
                'message' => ' Material And Furniture Proposal Has Been Creating Successfully ',
                'data'=>$material_and_furniture->id,
                'state' => true
            ]);
        }
    }

    ///contact_section
    public function create_contact_section(Request $request){
        $contact=Contact::create([
            'name'=>$request->name,
            'position'=>$request->position,
            'material_and_furniture_proposals_id'=>$request->material_and_furniture_id
        ]);
        if($contact){
            return response()->json([
                'message' => 'Contact Has Been Created Successfully',
                'data'=>$contact,
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In Creating Contact',
                'state' => false
            ]);
        }
    }
    public function Delete_contact(Request $request){
        $contact=Contact::find($request->id);
        if($contact){
            $contact->delete();
            return response()->json([
                'message' => 'Contact Has Been Deleted Successfully',
                'data'=>$request->id,
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In Deleting Contact',
                'state' => false
            ]);
        }

    }
    public function update_contact(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->toArray(), [
            'name'=>'required',
            'position'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'state' => false
            ]);
        }
        $contact=Contact::find($request->id);
        if($contact){
            $contact->update([
                'name'=>$request->name,
                'position'=>$request->position,
            ]);
            return response()->json([
                'message' => 'Contact Has Been Updated Successfully',
                'data'=>$contact,
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In Updating  Contact',
                'state' => false
            ]);
        }
    }
    /////material_and_furniture_list
    public function create_material_and_furniture_list(Request $request){
        $material_and_furniture_list=MaterialAndFurnitureList::create([
            'material_and_furniture_proposals_id'=>$request->material_and_furniture_id_for_list,
            'title'=>$request->list_title,
            'note'=>$request->list_note,
            'total'=>'0',
        ]);
        if($material_and_furniture_list){
            return response()->json([
                'message' => 'Material And Furniture List Has Been Created Successfully',
                'data'=>$material_and_furniture_list,
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In Creating Material And Furniture List',
                'state' => false
            ]);
        }
    }
    public function create_material_and_furniture_alert_list_create_row(Request $request){
        // dd($request->all());

        $validator = Validator::make($request->toArray(), [
            "S_NO"=> 'required',
            "item_category" =>'required',
            "list_size" => 'required',
            "list_material_description" =>'required',
            "list_unit" => 'required',
            "list_qty" => 'required',
            "lsit_currency" => 'required',
            "list_unit_price" => 'required',
            "list_brands" => 'required',
            "list_website_links" => 'required',
            'list_file'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => "You should enter data",
                'state' => false
            ]);
        }
        if ($request->hasfile('list_file')){
            $imageName = rand(0, 10000) . time() . '.' . $request->list_file->extension();
            $request->list_file->move(public_path('storage/material_and_furniture/'), $imageName);
        }
        $TOTAL_PRICE=$request->list_qty * $request->list_unit_price;
        $m_a_f_l_r=MaterialAndFurnitureListRows::create([
            'material_and_furniture_list_row_id' =>$request->id,
            "s_no"=> $request->S_NO ,
            "item_category" => $request->item_category,
            "size" => $request->list_size,
            "material_description" => $request->list_material_description,
            "photo"=>'storage\material_and_furniture\\' .  $imageName,
            "unit" => $request->list_unit,
            "qty" => $request->list_qty,
            "currency" => $request->lsit_currency,
            "unit_price" => $request->list_unit_price,
            "brands" => $request->list_brands,
            "website_links" => $request->list_website_links,
            'total_price'=>$TOTAL_PRICE
        ]);
        if($m_a_f_l_r){
            $total=0;
             $amaunts=MaterialAndFurnitureListRows::where('material_and_furniture_list_row_id',$request->id)->get();
            foreach($amaunts as $amaunt){
                $total+=$amaunt->total_price;
            }
            MaterialAndFurnitureList::find($request->id)->update([
                'total'=>$total,
            ]);
            return response()->json([
                'message' => 'Material And Furniture List Row Has Been Created Successfully',
                'data'=>$m_a_f_l_r,
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In Creating Material And Furniture List Row ',
                'state' => false
            ]);
        }
    }
    public function Delete_material_and_furniture_alert_list_create_row(Request $request){
        $m_a_f_l_r=MaterialAndFurnitureListRows::find($request->id);
        if($m_a_f_l_r){
            $m_a_f_l_r->delete();
            $total=0;
             $amaunts=MaterialAndFurnitureListRows::where('material_and_furniture_list_row_id',$request->id)->get();
            foreach($amaunts as $amaunt){
                $total+=$amaunt->total_price;
            }
            MaterialAndFurnitureList::find($request->id)->update([
                'total'=>$total,
            ]);
            return response()->json([
                'message' => 'Material And Furniture List Row Has Been Deleted Successfully',
                'data'=>$request->id,
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In Deleting Material And Furniture List Row ',
                'state' => false
            ]);
        }
    }
    public function update_material_and_furniture_alert_list_create_row(Request $request){
        $validator = Validator::make($request->toArray(), [
            "S_NO_upate"=> 'required',
            "item_category_update" =>'required',
            "list_size_update" => 'required',
            "list_material_description_update" =>'required',
            "list_unit_update" => 'required',
            "list_qty_update" => 'required',
            "lsit_currency_update" => 'required',
            "list_unit_price_update" => 'required',
            "list_brands_update" => 'required',
            "list_website_links_update" => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => "You should enter data",
                'state' => false
            ]);
        }
        $m_a_f_l_r=MaterialAndFurnitureListRows::find($request->list_id_update);
        if($m_a_f_l_r){
            if ($request->hasfile('list_file_update')){
                if(File::exists($m_a_f_l_r->photo)){
                    File::delete($m_a_f_l_r->photo);
                }
                $imageName = rand(0, 10000) . time() . '.' . $request->list_file_update->extension();
                $request->list_file_update->move(public_path('storage/material_and_furniture/'), $imageName);
                $m_a_f_l_r->photo='storage\material_and_furniture\\' .  $imageName;
            }
            $m_a_f_l_r->s_no=$request->S_NO_upate;
            $m_a_f_l_r->item_category=$request->item_category_update;
            $m_a_f_l_r->material_description=$request->list_material_description_update;
            $m_a_f_l_r->size=$request->list_size_update;
            $m_a_f_l_r->unit=$request->list_unit_update;
            $m_a_f_l_r->qty=$request->list_qty_update;
            $m_a_f_l_r->currency=$request->lsit_currency_update;
            $m_a_f_l_r->unit_price=$request->list_unit_price_update;
            $m_a_f_l_r->brands=$request->list_brands_update;
            $m_a_f_l_r->website_links=$request->list_website_links_update;
            $m_a_f_l_r->total_price=$request->list_qty_update * $request->list_unit_price_update;
            $m_a_f_l_r->update();
            $total=0;
             $amaunts=MaterialAndFurnitureListRows::where('material_and_furniture_list_row_id',$request->id)->get();
            foreach($amaunts as $amaunt){
                $total+=$amaunt->total_price;
            }
            MaterialAndFurnitureList::find($request->id)->update([
                'total'=>$total,
            ]);
            return response()->json([
                'message' => 'Material And Furniture List Row Has Been Updated Successfully',
                'data'=>$m_a_f_l_r,
                'state' => true
            ]);
        }else{
            return response()->json([
                'message' => 'Error In Updating  Material And Furniture List Row',
                'state' => false
            ]);
        }
    }
    public function create_costs(Request $request){
        $cost=Cost::where('material_and_furniture_proposals_id',$request->materal_and_f_id)->first();
        $furniture_total=0;
        $material_and_furniture_proposals_lists=MaterialAndFurnitureList::where('material_and_furniture_proposals_id',$request->materal_and_f_id)->get();
        foreach($material_and_furniture_proposals_lists as $material_and_furniture_proposals_list){
            $furniture_total+=$material_and_furniture_proposals_list->total;
        }
        $design_fee=$furniture_total*0.15;
        $total_amount=$design_fee+$furniture_total;
        $vat_fee=$total_amount*0.05;
        $grand_tota=$vat_fee+$total_amount+$design_fee+$furniture_total;
        if($cost){
            $cost->update([
                'installation_fees'=>$request->costs_installation_fees,
            ]);
            return response()->json([
                'message' => 'Cost Has Been Edit Successfully',
                'data'=>$cost,
                'state' => true
            ]);
        }else{
            $cost=Cost::create([
                'installation_fees'=>$request->costs_installation_fees,
                'material_and_furniture_proposals_id'=>$request->materal_and_f_id,
                'grand_total'=>$grand_tota,
                'vat_fee'=>$vat_fee,
                'total_amount'=>$total_amount,
                'design_fee'=>$design_fee,
                'furniture_total'=>$furniture_total
            ]);
            return response()->json([
                'message' => 'Cost Has Been Creating Successfully ',
                'data'=>$cost,
                'state' => true
            ]);
        }
    }
    public function create_architecture_tax_invoice(Request $request){
        $architecture_tax_invoice=ArchitectureTaxInvoice::where('material_and_furniture_proposals_id',$request->material_and_furniture_id)->first();
        $material_and_furniture=MaterialAndFurnitureProposal::find($request->material_and_furniture_id);
        if($architecture_tax_invoice){
            $architecture_tax_invoice->update([
                'code'=>$request->code,
                'date'=>$request->date,
                'terms_and_conditions'=>$request->terms
            ]);
            return response()->json([
                'message' => 'Architecture Tax Invoice Has Been Edit Successfully',
                'data'=>$architecture_tax_invoice->id,
                'state' => true
            ]);
        }else{
            $project=Project::find($material_and_furniture->project_id)->update([
                'stage' => 'Tax Invoice',
            ]);
            ArchitectureTaxInvoice::create([
                'material_and_furniture_proposals_id'=>$request->material_and_furniture_id,
                'code'=>$request->code,
                'date'=>$request->date,
                'terms_and_conditions'=>$request->terms
            ]);
            return response()->json([
                'message' => 'Architecture Tax Invoice Creating Successfully ',
                'data'=>$architecture_tax_invoice->id,
                'state' => true
            ]);
        }
    }
    public function DownloadArchitectureTaxInvoice(Request $request){
        $ArchitectureTaxInvoice=ArchitectureTaxInvoice::find($request->id);
        $material_and_furniture=MaterialAndFurnitureProposal::find($ArchitectureTaxInvoice->material_and_furniture_proposals_id);
        $notes=explode("\n", $material_and_furniture->note);
        $contacts=Contact::where('material_and_furniture_proposals_id',$material_and_furniture->id)->get();
        $cost=cost::where('material_and_furniture_proposals_id',$material_and_furniture->id)->first();
        $project=Project::find($material_and_furniture->project_id);
        $terms=explode("\n", $ArchitectureTaxInvoice->terms_and_conditions);
        // $customPaper = array(0,0,567.00,283.80);
        $material_and_furniture_lists=MaterialAndFurnitureList::where('material_and_furniture_proposals_id',$material_and_furniture->id)->with('MaterialAndFurnitureListrow')->get();
        // return view('projects_managements.ArchitectureTaxInvoicepdf',compact('ArchitectureTaxInvoice','material_and_furniture','project','material_and_furniture_lists','contacts','cost','notes','terms'));
        $pdf = PDF::loadView('projects_managements.ArchitectureTaxInvoicepdf',compact('ArchitectureTaxInvoice','material_and_furniture','project','material_and_furniture_lists','contacts','cost','notes','terms'));
        return $pdf->download('ArchitectureTaxInvoicepdf'. Auth::user()->id .'.pdf');

    }
    public function DownloadTaxInvoice(Request $request){
        $project=Project::find($request->id);
        $material_and_furniture=MaterialAndFurnitureProposal::where('project_id',$request->id)->first();
        $material_and_furniture_lists=MaterialAndFurnitureList::where('material_and_furniture_proposals_id',$material_and_furniture->id)->with('MaterialAndFurnitureListrow')->get();
        $contacts=Contact::where('material_and_furniture_proposals_id',$material_and_furniture->id)->get();
        $pdf = PDF::loadView('projects_managements.projects.taxinvoice',compact('material_and_furniture','project','material_and_furniture_lists','contacts'));
        return $pdf->download('taxinvoice'. Auth::user()->id .'.pdf');
    }
}
