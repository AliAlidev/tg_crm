<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('progressbar', [HomeController::class, 'getProgressB'])->name('get-progressbar');
route::get('clearprogressbar', [HomeController::class, 'clearProgressBar'])->name('clear-progressbar');
route::get('getImportStatus', [HomeController::class, 'getImportStatus'])->name('get-importstatus');
route::get('finishImportStatus', [HomeController::class, 'finishImportStatus'])->name('finish-importstatus');
route::get('startImportStatus', [HomeController::class, 'startImportStatus'])->name('start-importstatus');

Auth::routes();
Route::get('/createlead', [App\Http\Controllers\HomeController::class, 'createleadindex'])->name('createlead');
Route::post('/createnewlead', [App\Http\Controllers\HomeController::class, 'createnewlead'])->name('create_new_lead');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/agentdata', [App\Http\Controllers\HomeController::class, 'agentdata'])->name('agent_data');
Route::post('/filter', [App\Http\Controllers\HomeController::class, 'filter'])->name('filter');
Route::get('/uploadedFile', [App\Http\Controllers\HomeController::class, 'uploadedFiles'])->name('uploadedFiles');
Route::get('/downloadFile/{fileName}', [App\Http\Controllers\HomeController::class, 'downloadFile']);
Route::get('emirates', [App\Http\Controllers\HomeController::class, 'sample'])->name('sample');
Route::get('nationality', [App\Http\Controllers\HomeController::class, 'nationality'])->name('nationality');
Route::get('usage', [App\Http\Controllers\HomeController::class, 'usage'])->name('usage');
Route::post('deleteFile/{id}', [App\Http\Controllers\ImportExcelController::class, 'deleteFile'])->name('deleteFile');
Route::get('geochart', [App\Http\Controllers\HomeController::class, 'getLavaChart'])->name('geochart');

Route::get('filterIng/{emirates}&{area}&{residence}', [App\Http\Controllers\HomeController::class, 'filterIng']);


Route::get('/register', function () {
    return view('auth.login');
});

Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::post('allposts', [App\Http\Controllers\HomeController::class, 'search'])->name('allposts');
Route::post('allposts1', [App\Http\Controllers\HomeController::class, 'search1'])->name('allposts1');
Route::post('allposts2', [App\Http\Controllers\HomeController::class, 'search2'])->name('allposts2');
Route::post('serachforagentdata', [App\Http\Controllers\HomeController::class, 'serachforagentdata'])->name('serach_for_agent_data');
Route::post('addcomment', [App\Http\Controllers\HomeController::class, 'addcomment'])->name('add_comment');
Route::post('deletecomment', [App\Http\Controllers\HomeController::class, 'deletecomment'])->name('delete_comment');
Route::get('index1', [App\Http\Controllers\HomeController::class, 'index1'])->name('index1');
Route::get('showcommenteddata', [App\Http\Controllers\HomeController::class, 'showcommenteddata'])->name('show_commented_data');
Route::post('getcommenteduserdata', [App\Http\Controllers\HomeController::class, 'getcommenteduserdata'])->name('get_commented_user_data');
Route::post('addleadcomment', [App\Http\Controllers\HomeController::class, 'addleadcomment'])->name('add_lead_comment');


// Excel Routes
Route::get('/export_excel', [App\Http\Controllers\ExportExcelController::class, 'index']);
Route::post('/export_excel/excel', [App\Http\Controllers\ExportExcelController::class, 'excel'])->name('export_excel.excel');

Route::get('map', [App\Http\Controllers\HomeController::class, 'map'])->name('map');

Route::get('import', [App\Http\Controllers\ImportExcelController::class, 'index'])->name('import_index');

route::post('createnewbuyer', [App\Http\Controllers\HomeController::class, 'createnewbuyer'])->name('create_new_buyer');
route::get('createbuyerindex', [App\Http\Controllers\HomeController::class, 'createbuyerindex'])->name('create_buyer_index');
route::post('updatebuyer', [App\Http\Controllers\HomeController::class, 'updatebuyer'])->name('update_buyer');

route::get('createuserindex', [App\Http\Controllers\HomeController::class, 'createuserindex'])->name('create_user_index');
route::post('createnewuser', [App\Http\Controllers\HomeController::class, 'createnewuser'])->name('create_new_user');
route::get('updateuserindex/{id?}', [App\Http\Controllers\HomeController::class, 'updateuserindex'])->name('update_user_index');
route::post('updateuser', [App\Http\Controllers\HomeController::class, 'updateuser'])->name('update_user');

route::post('createnewproperty', [App\Http\Controllers\HomeController::class, 'createnewproperty'])->name('create_new_property');

route::get('createcustomerindex', [App\Http\Controllers\HomeController::class, 'createcustomerindex'])->name('create_customer_index');
route::post('createnewcustomer', [App\Http\Controllers\HomeController::class, 'createnewcustomer'])->name('create_new_customer');
route::get('updatecustomerindex/{id?}', [App\Http\Controllers\HomeController::class, 'updatecustomerindex'])->name('update_customer_index');
route::post('updatecustomer', [App\Http\Controllers\HomeController::class, 'updatecustomer'])->name('update_customer');
route::post('deletecustomer', [App\Http\Controllers\HomeController::class, 'deletecustomer'])->name('delete_customer');

route::get('createcontractsindex', [App\Http\Controllers\HomeController::class, 'createcontractsindex'])->name('create_contracts_index');
route::post('createnewcontracts', [App\Http\Controllers\HomeController::class, 'createnewcontracts'])->name('create_new_contracts');

route::post('assignagenttolandpage', [App\Http\Controllers\HomeController::class, 'assignagenttolandpage'])->name('assign_agent_to_landpage');
route::post('listassignedlandingagent', [App\Http\Controllers\HomeController::class, 'listassignedlandingagent'])->name('list_assigned_landing_agent');

route::get('assignagentforlanding', [App\Http\Controllers\HomeController::class, 'assignagentforlanding'])->name('assign_agent_for_landing');
route::post('deletelanding', [App\Http\Controllers\HomeController::class, 'deletelanding'])->name('delete_landing');

route::get('listcontractsindex', [App\Http\Controllers\HomeController::class, 'listcontractsindex'])->name('list_contracts_index');
route::post('listContracts', [App\Http\Controllers\HomeController::class, 'listContracts'])->name('listContracts');
route::post('downloadContracts', [App\Http\Controllers\HomeController::class, 'downloadContracts'])->name('downloadContracts');
route::post('deletecontracts', [App\Http\Controllers\HomeController::class, 'deletecontracts'])->name('deletecontracts');


route::get('listusersindex', [App\Http\Controllers\HomeController::class, 'listusersindex'])->name('list_users_index');
route::post('listusers', [App\Http\Controllers\HomeController::class, 'listusers'])->name('list_users');
route::post('deleteuser', [App\Http\Controllers\HomeController::class, 'deleteuser'])->name('delete_user');

route::get('listpropertiesindex', [App\Http\Controllers\HomeController::class, 'listpropertiesindex'])->name('list_properties_index');
route::post('listproperties', [App\Http\Controllers\HomeController::class, 'listproperties'])->name('list_properties');
route::post('deleteproperty', [App\Http\Controllers\HomeController::class, 'deleteproperty'])->name('delete_property');

route::get('createpropertyindex', [App\Http\Controllers\HomeController::class, 'createpropertyindex'])->name('create_property_index');
route::post('getassigneduserdatainfo', [App\Http\Controllers\HomeController::class, 'getassigneduserdatainfo'])->name('get_assigned_user_data_info');
route::post('getusercommentedinfo', [App\Http\Controllers\HomeController::class, 'getusercommentedinfo'])->name('get_user_commented_info');
route::post('getadmincommentedinfo', [App\Http\Controllers\HomeController::class, 'getadmincommentedinfo'])->name('get_admin_commented_info');

route::post('getcustomerpaymentsinfo', [App\Http\Controllers\HomeController::class, 'getcustomerpaymentsinfo'])->name('get_customer_payments_info');
route::post('getcustomerpropertiesinfo', [App\Http\Controllers\HomeController::class, 'getcustomerpropertiesinfo'])->name('get_customer_properties_info');

route::get('getassigneddataindex', [App\Http\Controllers\HomeController::class, 'getassigneddataindex'])->name('get_assigned_data_index');
route::post('getassignedagentdata', [App\Http\Controllers\HomeController::class, 'getassignedagentdata'])->name('get_assigned_agent_data');
route::post('unassignagentdata', [App\Http\Controllers\HomeController::class, 'unassignagentdata'])->name('unassign_agent_data');
route::post('assignagentdata', [App\Http\Controllers\HomeController::class, 'assignagentdata'])->name('assign_agent_data');
route::get('assignagentdataindex', [App\Http\Controllers\HomeController::class, 'assignagentdataindex'])->name('assign_agent_data_index');
route::get('showbooksindex', [App\Http\Controllers\HomeController::class, 'showbooksindex'])->name('showbooksindex');
route::post('showbooks', [App\Http\Controllers\HomeController::class, 'showbooks'])->name('showbooks');
route::get('showbookviews', [App\Http\Controllers\HomeController::class, 'showbookviews'])->name('show_book_views');
route::get('showbookviewsindex', [App\Http\Controllers\HomeController::class, 'showbookviewsindex'])->name('show_book_views_index');

route::post('importenquirycustomer', [App\Http\Controllers\HomeController::class, 'importenquirycustomer'])->name('import_enquiry_customer');

route::get('charts', [ChartController::class, 'index'])->name('getcharts');

route::get('leaderboardindex', [HomeController::class, 'leaderboardindex'])->name('leader_board_index');
route::post('getleaderboard', [HomeController::class, 'getleaderboard'])->name('get_leader_board');

Route::post('import', [App\Http\Controllers\ImportExcelController::class, 'import'])->name('importprocessajax');


// qualified data
route::get('qualifiedleadsindex', [App\Http\Controllers\QualifiedLeadsController::class, 'qualifiedleadsindex'])->name('qualified_leads_index');
route::post('qualifiedleads', [App\Http\Controllers\QualifiedLeadsController::class, 'qualifiedleads'])->name('qualified_leads');
route::get('assignagentqualifieddataindex', [App\Http\Controllers\QualifiedLeadsController::class, 'assignagentqualifieddataindex'])->name('assign_agent_qualified_data_index');
route::post('assignagentqualifieddata', [App\Http\Controllers\QualifiedLeadsController::class, 'assignagentqualifieddata'])->name('assign_agent_qualified_data');
route::post('unassignagentqualifieddata', [App\Http\Controllers\QualifiedLeadsController::class, 'unassignagentqualifieddata'])->name('unassign_agent_qualified_data');
route::post('searchforagentqualifieddata', [App\Http\Controllers\QualifiedLeadsController::class, 'searchforagentqualifieddata'])->name('search_for_agent_qualified_data');
route::get('qualifieduserhomeindex', [App\Http\Controllers\QualifiedLeadsController::class, 'qualifieduserhomeindex'])->name('qualified_user_home_index');
Route::post('qualifieduserhomedata', [App\Http\Controllers\QualifiedLeadsController::class, 'qualifieduserhomedata'])->name('qualified_user_home_data');
Route::post('addqualifiedcomment', [App\Http\Controllers\QualifiedLeadsController::class, 'addqualifiedcomment'])->name('add_qualified_comment');
Route::get('showqualifieddatacommentsindex', [App\Http\Controllers\QualifiedLeadsController::class, 'showqualifieddatacommentsindex'])->name('show_qualified_data_comments_index');
Route::post('showqualifieddatacomments', [App\Http\Controllers\QualifiedLeadsController::class, 'showqualifieddatacomments'])->name('show_qualified_data_comments');
route::post('getqualifieddatacommentsinfo', [App\Http\Controllers\QualifiedLeadsController::class, 'getqualifieddatacommentsinfo'])->name('get_qualified_data_comments_info');
route::post('getadminqualifieddatacommentsinfo', [App\Http\Controllers\QualifiedLeadsController::class, 'getadminqualifieddatacommentsinfo'])->name('get_admin_qualified_data_comments_info');
route::get('showuserqualifieddatacommentsindex', [App\Http\Controllers\QualifiedLeadsController::class, 'showuserqualifieddatacommentsindex'])->name('show_user_qualified_data_comments_index');
route::get('showassignedagentqualifiedindex', [App\Http\Controllers\QualifiedLeadsController::class, 'showassignedagentqualifiedindex'])->name('show_assigned_agent_qualified_index');
route::post('showassignedagentqualifieddata', [App\Http\Controllers\QualifiedLeadsController::class, 'showassignedagentqualifieddata'])->name('show_assigned_agent_qualified_data');

// leads pool
route::get('leadspoolindex', [App\Http\Controllers\LeadsPoolController::class, 'leadspoolindex'])->name('leads_pool_index');
route::post('leadspool', [App\Http\Controllers\LeadsPoolController::class, 'leadspool'])->name('leads_pool');
route::get('assignagentleadspoolindex', [App\Http\Controllers\LeadsPoolController::class, 'assignagentleadspoolindex'])->name('assign_agent_leads_pool_index');
route::post('assignagentleadspooldata', [App\Http\Controllers\LeadsPoolController::class, 'assignagentleadspooldata'])->name('assign_agent_leads_pool_data');
route::post('unassignagentleadspooldata', [App\Http\Controllers\LeadsPoolController::class, 'unassignagentleadspooldata'])->name('unassign_agent_leads_pool_data');
route::post('searchforagentleadspooldata', [App\Http\Controllers\LeadsPoolController::class, 'searchforagentleadspooldata'])->name('search_for_agent_leads_pool_data');
route::get('leadspooluserhomeindex', [App\Http\Controllers\LeadsPoolController::class, 'leadspooluserhomeindex'])->name('leads_pool_user_home_index');
Route::post('leadspooluserhomedata', [App\Http\Controllers\LeadsPoolController::class, 'leadspooluserhomedata'])->name('leads_pool_user_home_data');
Route::post('addleadspoolcomment', [App\Http\Controllers\LeadsPoolController::class, 'addleadspoolcomment'])->name('add_leads_pool_comment');
Route::get('showleadspooldatacommentsindex', [App\Http\Controllers\LeadsPoolController::class, 'showleadspooldatacommentsindex'])->name('show_leads_pool_data_comments_index');
Route::post('showleadspooldatacomments', [App\Http\Controllers\LeadsPoolController::class, 'showleadspooldatacomments'])->name('show_leads_pool_data_comments');
route::post('getleadspooldatacommentsinfo', [App\Http\Controllers\LeadsPoolController::class, 'getleadspooldatacommentsinfo'])->name('get_leads_pool_data_comments_info');
route::post('getadminleadspooldatacommentsinfo', [App\Http\Controllers\LeadsPoolController::class, 'getadminleadspooldatacommentsinfo'])->name('get_admin_leads_pool_data_comments_info');
route::get('showuserleadspooldatacommentsindex', [App\Http\Controllers\LeadsPoolController::class, 'showuserleadspooldatacommentsindex'])->name('show_user_leads_pool_data_comments_index');
route::get('showassignedagentleadspoolindex', [App\Http\Controllers\LeadsPoolController::class, 'showassignedagentleadspoolindex'])->name('show_assigned_agent_leads_pool_index');
route::post('showassignedagentleadspooldata', [App\Http\Controllers\LeadsPoolController::class, 'showassignedagentleadspooldata'])->name('show_assigned_agent_leads_pool_data');

// follow up leads
route::get('followupindex', [App\Http\Controllers\FollowUpController::class, 'followupindex'])->name('follow_up_index');
route::post('followup', [App\Http\Controllers\FollowUpController::class, 'followup'])->name('follow_up');
route::get('assignagentfollowupindex', [App\Http\Controllers\FollowUpController::class, 'assignagentfollowupindex'])->name('assign_agent_follow_up_index');
route::post('assignagentfollowupdata', [App\Http\Controllers\FollowUpController::class, 'assignagentfollowupdata'])->name('assign_agent_follow_up_data');
route::post('unassignagentfollowupdata', [App\Http\Controllers\FollowUpController::class, 'unassignagentfollowupdata'])->name('unassign_agent_follow_up_data');
route::post('searchforagentfollowupdata', [App\Http\Controllers\FollowUpController::class, 'searchforagentfollowupdata'])->name('search_for_agent_follow_up_data');
route::get('followupuserhomeindex', [App\Http\Controllers\FollowUpController::class, 'followupuserhomeindex'])->name('follow_up_user_home_index');
Route::post('followupuserhomedata', [App\Http\Controllers\FollowUpController::class, 'followupuserhomedata'])->name('follow_up_user_home_data');
Route::post('addfollowupcomment', [App\Http\Controllers\FollowUpController::class, 'addfollowupcomment'])->name('add_follow_up_comment');
Route::get('showfollowupdatacommentsindex', [App\Http\Controllers\FollowUpController::class, 'showfollowupdatacommentsindex'])->name('show_follow_up_data_comments_index');
Route::post('showfollowupdatacomments', [App\Http\Controllers\FollowUpController::class, 'showfollowupdatacomments'])->name('show_follow_up_data_comments');
route::post('getfollowupdatacommentsinfo', [App\Http\Controllers\FollowUpController::class, 'getfollowupdatacommentsinfo'])->name('get_follow_up_data_comments_info');
route::post('getadminfollowupdatacommentsinfo', [App\Http\Controllers\FollowUpController::class, 'getadminfollowupdatacommentsinfo'])->name('get_admin_follow_up_data_comments_info');
route::get('showuserfollowupdatacommentsindex', [App\Http\Controllers\FollowUpController::class, 'showuserfollowupdatacommentsindex'])->name('show_user_follow_up_data_comments_index');
route::get('showassignedagentfollowupindex', [App\Http\Controllers\FollowUpController::class, 'showassignedagentfollowupindex'])->name('show_assigned_agent_follow_up_index');
route::post('showassignedagentfollowupdata', [App\Http\Controllers\FollowUpController::class, 'showassignedagentfollowupdata'])->name('show_assigned_agent_follow_up_data');


route::get('wonleadsindex', [App\Http\Controllers\HomeController::class, 'wonleadsindex'])->name('won_leads_index');
route::post('wonleadsdata', [App\Http\Controllers\HomeController::class, 'wonleadsdata'])->name('won_leads_data');

route::get('deadleadsindex', [App\Http\Controllers\HomeController::class, 'deadleadsindex'])->name('dead_leads_index');
route::post('deadleadsdata', [App\Http\Controllers\HomeController::class, 'deadleadsdata'])->name('dead_leads_data');

route::get('createnvoicesindex', [App\Http\Controllers\HomeController::class, 'createnvoicesindex'])->name('create_invoices_index');
route::post('createnewinvoices', [App\Http\Controllers\HomeController::class, 'createnewinvoices'])->name('create_new_invoices');
route::get('getinvoicesindex', [App\Http\Controllers\HomeController::class, 'getinvoicesindex'])->name('get_invoices_index');
Route::post('getinvoices', [App\Http\Controllers\HomeController::class, 'getinvoices'])->name('get_invoices');
Route::post('downloadInvoices', [App\Http\Controllers\HomeController::class, 'downloadInvoices'])->name('downloadInvoices');
Route::post('deleteInvoices', [App\Http\Controllers\HomeController::class, 'deleteInvoices'])->name('DELETE_INVOICE');
/////
Route::get('createSupplier', [App\Http\Controllers\HomeController::class, 'createSupplier'])->name('create_Supplier');
Route::post('storeSupplier', [App\Http\Controllers\HomeController::class, 'storeSupplier'])->name('storeSupplier');
Route::get('listSuppliers', [App\Http\Controllers\HomeController::class, 'listSuppliers'])->name('list_Suppliers');
Route::post('showlistSuppliers', [App\Http\Controllers\HomeController::class, 'showlistSuppliers'])->name('showlistSuppliers');
Route::get('editSupplier/{id?}', [App\Http\Controllers\HomeController::class, 'editSupplier'])->name('editSupplier');
Route::post('updateSupplier', [App\Http\Controllers\HomeController::class, 'updateSupplier'])->name('updateSupplier');
Route::post('deleteSupplier', [App\Http\Controllers\HomeController::class, 'deleteSupplier'])->name('deleteSupplier');
////
Route::get('createSupplierinvoice', [App\Http\Controllers\HomeController::class, 'createSupplierinvoice'])->name('create_Supplier_invoice');
Route::post('storeSupplierinvoice', [App\Http\Controllers\HomeController::class, 'storeSupplierinvoice'])->name('storeSupplierinvoice');
Route::get('listSuppliersinvoice', [App\Http\Controllers\HomeController::class, 'listSuppliersinvoice'])->name('listSuppliersinvoice');
Route::post('showSupplierinvoice', [App\Http\Controllers\HomeController::class, 'showSupplierinvoice'])->name('show_Supplier_invoice');
Route::post('deleteSupplierInvoice', [App\Http\Controllers\HomeController::class, 'deleteSupplierInvoice'])->name('deleteSupplierInvoice');
Route::get('editSupplierinvoice/{id?}', [App\Http\Controllers\HomeController::class, 'editSupplierinvoice'])->name('editSupplierinvoice');
Route::post('updateSupplierinvoice', [App\Http\Controllers\HomeController::class, 'updateSupplierinvoice'])->name('updateSupplierinvoice');
Route::post('changestatus', [App\Http\Controllers\HomeController::class, 'changestatus'])->name('change_status');


Route::get('createnewprojectindex', [ProjectController::class, 'createnewprojectindex'])->name('create_new_project_index');
Route::post('createnewproject', [ProjectController::class, 'createnewproject'])->name('create_new_project');
Route::get('architectureprojectslistindex', [ProjectController::class, 'architectureprojectslistindex'])->name('architecture_projects_list_index');
Route::post('architectureprojectslist', [ProjectController::class, 'architectureprojectslist'])->name('architecture_projects_list');
Route::post('deleteproject', [ProjectController::class, 'deleteproject'])->name('delete_project');
Route::get('editproject/{id?}', [ProjectController::class, 'editproject'])->name('edit_project');
Route::post('updateproject', [ProjectController::class, 'updateproject'])->name('update_project');
Route::get('civilprojectslistindex', [ProjectController::class, 'civilprojectslistindex'])->name('civil_projects_list_index');
Route::post('civilprojectslist', [ProjectController::class, 'civilprojectslist'])->name('civil_projects_list');
/////
Route::get('projecttasks/{id?}', [ProjectController::class, 'projecttasks'])->name('projecttasks');
Route::post('storeTask', [ProjectController::class, 'storeTask'])->name('storeTask');
// Route::post('listtask' , [ProjectController::class,'listtask'])->name('listtask');









///////// projects managements
Route::get('project_progress_index/{id?}',[ProjectController::class,'project_progress_index'])->name('project_progress_index');
Route::post('save_design_service',[ProjectController::class,'save_design_service'])->name('save_design_service');
Route::post('edit_design_service',[ProjectController::class,'edit_design_service'])->name('edit_design_service');
Route::post('DownloadDesignServices', [ProjectController::class, 'DownloadDesignServices'])->name('DownloadDesignServices');
Route::post('Change_paid_design_service', [ProjectController::class, 'Change_paid_design_service'])->name('Change_paid_design_service');
////// material_and_furniture
Route::post('create_material_and_furniture',[ProjectController::class,'create_material_and_furniture'])->name('create_material_and_furniture');
Route::post('edit_material_and_furniture',[ProjectController::class,'edit_material_and_furniture'])->name('edit_material_and_furniture');
////contact_section
Route::post('create_contact_section',[ProjectController::class,'create_contact_section'])->name('create_contact_section');
Route::post('Delete_contact',[ProjectController::class,'Delete_contact'])->name('Delete_contact');
Route::post('update_contact',[ProjectController::class,'update_contact'])->name('update_contact');
//////material_and_furniture_list
Route::post('create_material_and_furniture_list',[ProjectController::class,'create_material_and_furniture_list'])->name('create_material_and_furniture_list');
Route::post('create_material_and_furniture_alert_list_create_row',[ProjectController::class,'create_material_and_furniture_alert_list_create_row'])->name('create_material_and_furniture_alert_list_create_row');
Route::post('Delete_material_and_furniture_alert_list_create_row',[ProjectController::class,'Delete_material_and_furniture_alert_list_create_row'])->name('Delete_material_and_furniture_alert_list_create_row');
Route::post('update_material_and_furniture_alert_list_create_row',[ProjectController::class,'update_material_and_furniture_alert_list_create_row'])->name('update_material_and_furniture_alert_list_create_row');
////costs
Route::post('create_costs',[ProjectController::class,'create_costs'])->name('create_costs');
//architecture_tax_invoice
Route::post('create_architecture_tax_invoice',[ProjectController::class,'create_architecture_tax_invoice'])->name('create_architecture_tax_invoice');
Route::post('DownloadArchitectureTaxInvoice',[ProjectController::class,'DownloadArchitectureTaxInvoice'])->name('DownloadArchitectureTaxInvoice');
Route::post('DownloadTaxInvoice',[ProjectController::class,'DownloadTaxInvoice'])->name('DownloadTaxInvoice');
