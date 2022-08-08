<nav class="sidebar">

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <ul>
        <li>
            <div class="text">
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-left" href="{{ url('/createlead') }}">
                    <div class="sidebar-brand-icon">
                        <img src="{{asset('img/logo2.png')}}" style="width: 4.4rem;" class="user-img img-responsive" alt="">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </div>
                </a>
            </div>
        </li>
        <li id="sbitem1">
            <a href="#" class="link-content leads-btn"><span class="left-title">Leads</span><span
                    class="fas fa-caret-down first"></span></a>
            <ul class="leads-show">
                @if (Auth::user()->isadmin())
                    <li id="sbitem1_1"><a href="{{ route('leads_pool_index') }}"><i class="fas fa-fw fa-table"></i>
                            Leads pool</a></li>
                    <li id="sbitem1_2"><a href="{{ route('won_leads_index') }}"><i class="fas fa-fw fa-table"></i> Won
                            leads</a></li>
                    <li id="sbitem1_3"><a href="{{ route('dead_leads_index') }}"><i class="fas fa-fw fa-table"></i>
                            Dead leads</a></li>
                    <li id="sbitem1_5"><a href="{{ route('follow_up_index') }}"><i class="fas fa-fw fa-table"></i>
                            Follow up leads</a></li>
                @endif
                @if (Auth::user()->isadmin())
                    <li id="sbitem1_4"><a href="{{ route('qualified_leads_index') }}"><i
                                class="fas fa-fw fa-table"></i> Qualified leads</a></li>
                @endif
                @if (Auth::user()->isagent() || Auth::user()->isadmin())
                    <li id="sbitem1_6"><a href="{{ route('create_customer_index') }}"><i class="fas fa-ad"></i>
                            Customer enquiry</a></li>
                @endif
                <li id="sbitem1_7"><a href="{{ route('home') }}"><i class="fas fa-fw fa-table"></i>
                    Imported Data</a></li>
                <li id="sbitem1_16">
                    <a href="{{ route('createlead') }}" ><i class="fas fa-fw fa-table"></i>
                        Create Lead
                    </a>
                </li>

                @if (Auth::user()->isagent() || Auth::user()->isconsultant())
                    <li id="sbitem1_7_1"><a href="{{ route('index1') }}"><i class="fas fa-fw fa-table"></i>
                            Commented data</a></li>
                @endif
                @if (Auth::user()->isadmin())
                    <li id="sbitem1_8"><a href="{{ route('agent_data') }}"><i class="fas fa-fw fa-table"></i> Agent
                            data</a></li>
                    <li id="sbitem1_9"><a href="{{ route('map') }}"><i class="fas fa-fw fa-table"></i>
                            Map</a>
                    </li>
                @endif
                @if (Auth::user()->isagent() || Auth::user()->isconsultant())
                    <li id="sbitem1_10"><a href="{{ route('qualified_user_home_index') }}"><i
                                class="fas fa-fw fa-table"></i>
                            Qualified data</a>
                    </li>
                    <li id="sbitem1_11"><a href="{{ route('show_qualified_data_comments_index') }}"><i
                                class="fas fa-fw fa-table"></i>
                            Qualified data comments</a>
                    </li>
                    <li id="sbitem1_12"><a href="{{ route('leads_pool_user_home_index') }}"><i
                                class="fas fa-fw fa-table"></i>
                            Leads pool data</a>
                    </li>
                    <li id="sbitem1_13"><a href="{{ route('show_leads_pool_data_comments_index') }}"><i
                                class="fas fa-fw fa-table"></i>
                            Leads pool data comments</a>
                    </li>
                    <li id="sbitem1_14"><a href="{{ route('follow_up_user_home_index') }}"><i
                                class="fas fa-fw fa-table"></i>
                            Follow up leads data</a>
                    </li>
                    <li id="sbitem1_15"><a href="{{ route('show_follow_up_data_comments_index') }}"><i
                                class="fas fa-fw fa-table"></i>
                            Follow up leads data comments</a>
                    </li>
                @endif
            </ul>
        </li>


        @if (Auth::user()->isadmin())
            <li id="sbitem2">
                <a href="#" class="link-content  asd-btn"><span class="left-title">Assign & show data</span><span
                        class="fas fa-caret-down second"></span></a>
                <ul class="asd-show">
                    <li id="sbitem2_1"><a href="{{ route('assign_agent_data_index') }}"><i
                                class="fas fa-ad"></i> Assign imported data to agent</a></li>
                    <li id="sbitem2_2"><a href="{{ route('assign_agent_qualified_data_index') }}"><i
                                class="fas fa-ad"></i> Assign qualified data to agent</a></li>
                    <li id="sbitem2_3"><a href="{{ route('assign_agent_leads_pool_index') }}"><i
                                class="fas fa-ad"></i> Assign Leads pool data to agent</a></li>
                    <li id="sbitem2_4"><a href="{{ route('assign_agent_follow_up_index') }}"><i
                                class="fas fa-ad"></i> Assign follow up data to agent</a></li>
                    <li id="sbitem2_4_1"><a href="{{ route('get_assigned_data_index') }}"><i
                                class="fas fa-fw fa-table"></i> Assigned imported data</a>
                    </li>
                    <li id="sbitem2_5"><a href="{{ route('show_assigned_agent_qualified_index') }}"><i
                                class="fas fa-ad"></i> Assigned
                            qualified data</a></li>
                    <li id="sbitem2_6"><a href="{{ route('show_assigned_agent_leads_pool_index') }}"><i
                                class="fas fa-ad"></i> Assigned
                            leads pool data</a></li>
                    <li id="sbitem2_7"><a href="{{ route('show_assigned_agent_follow_up_index') }}"><i
                                class="fas fa-ad"></i> Assigned
                            follow up leads data</a></li>
                    <li id="sbitem2_7_1"><a href="{{ route('show_commented_data') }}"><i
                                class="fas fa-fw fa-table"></i> Commented data</a></li>
                    <li id="sbitem2_9"><a href="{{ route('show_user_qualified_data_comments_index') }}"><i
                                class="fas fa-fw fa-table"></i> Commented qualified
                            data</a></li>
                    <li id="sbitem2_10"><a href="{{ route('show_user_leads_pool_data_comments_index') }}"><i
                                class="fas fa-fw fa-table"></i> Commented leads
                            pool data</a></li>
                    <li id="sbitem2_11"><a href="{{ route('show_user_follow_up_data_comments_index') }}"><i
                                class="fas fa-fw fa-table"></i> Commented follow up
                            leads data</a></li>
                </ul>
            </li>
        @endif


        @if (Auth::user()->isadmin())
            <li id="sbitem3">
                <a href="#" class="link-content report-btn"><span class="left-title">Report</span><span
                        class="fas fa-caret-down third"></span></a>
                <ul class="report-show">
                    <li id="sbitem3_1"><a href="{{ route('getcharts') }}"><i class="fas fa-chart-pie"></i>
                            Charts</a></li>
                    <li id="sbitem3_2"><a href="{{ route('geochart') }}"><i class="fas fa-chart-pie"></i>
                            Geo
                            chart</a></li>
                    <li id="sbitem3_5"><a href="{{ route('leader_board_index') }}"><i class="fas fa-fw fa-table"></i>
                            Leaderboard</a></li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->isadmin())
            <li id="sbitem4">
                <a href="#" class="link-content au-btn"><span class="left-title">Admin & Users</span><span
                        class="fas fa-caret-down fourth"></span></a>
                <ul class="au-show">
                    <li id="sbitem4_1_1"><a href="{{ route('create_buyer_index') }}"><i class="fas fa-ad"></i>
                            Create buyer</a></li>
                    <li id="sbitem4_1"><a href="{{ route('create_user_index') }}"><i class="fas fa-ad"></i>
                            Create User</a></li>
                    <li id="sbitem4_2"><a href="{{ route('assign_agent_for_landing') }}"><i
                                class="fas fa-fw fa-table"></i> Assign agent for
                            landing</a></li>
                    <li id="sbitem4_3"><a href="{{ route('list_users_index') }}"><i class="fas fa-fw fa-table"></i>
                            List users</a></li>
                    <li id="sbitem4_4"><a href="{{ route('import_index') }}"><i class="fas fa-ad"></i>
                            Import</a></li>
                    <li id="sbitem4_5"><a href="{{ route('uploadedFiles') }}"><i class="fas fa-ad"></i>
                            Export & uploaded files</a>
                    </li>
                    {{-- <li id="sbitem4_6"><a href="{{ route('create_user_index') }}">Create users & admins</a>
                </li> --}}
                    {{-- <li id="sbitem4_7"><a href="{{ route('update_user_index') }}">Profile</a></li> --}}
                </ul>
            </li>
        @endif

        <li id="sbitem5">
            <a href="#" class="link-content pm-btn"><span class="left-title">Property Management</span><span
                    class="fas fa-caret-down fifth"></span></a>
            <ul class="pm-show">
                @if (Auth::user()->isadmin())
                    <li id="sbitem5_1"><a href="{{ route('create_property_index') }}"><i class="fas fa-ad fa-table"></i>
                            Create property</a>
                    </li>
                    <li id="sbitem5_3"><a href="{{ route('list_properties_index') }}"><i
                        class="fas fa-fw fa-table"></i> List properties</a>
                    </li>
                    <li id="sbitem5_2"><a href="{{ route('create_contracts_index') }}"><i class="fas fa-ad fa-table"></i>
                            Create Contract</a></li>

                @endif
                @if (Auth::user()->iscustomer() || Auth::user()->isadmin())
                    <li id="sbitem5_4"><a href="{{ route('list_contracts_index') }}"><i
                                class="fas fa-fw fa-table"></i> List Contracts</a></li>
                @endif
                @if (Auth::user()->isagent() || Auth::user()->isadmin())
                    <li id="sbitem5_5"><a href="{{ route('create_invoices_index') }}"><i class="fas fa-ad fa-table"></i>
                            Create invoices</a>
                    </li>
                    <li id="sbitem5_6"><a href="{{ route('get_invoices_index') }}"><i
                                class="fas fa-fw fa-table"></i>  List invoices</a>
                    </li>
                @endif
            </ul>
        </li>
        <li id="sbitem7">
            <a href="#" class="link-content pmSuppliers"><span class="left-title">Suppliers Management</span><span
                    class="fas fa-caret-down Suppliers"></span></a>
            <ul class="sups1">
                    <li id="sbitem7_1"><a href="{{ route('create_Supplier') }}"><i class="fas fa-ad fa-table"></i>
                            Create Supplier</a>
                    </li>
                    <li id="sbitem7_3"><a href="{{ route('list_Suppliers') }}"><i
                        class="fas fa-fw fa-table"></i> List Suppliers</a>
                    </li>
                    <li id="sbitem7_4"><a href="{{ route('create_Supplier_invoice') }}"><i
                        class="fas fa-fw fa-table"></i> Create Supplier Invoice</a>
                    </li>
                    <li id="sbitem7_5"><a href="{{ route('listSuppliersinvoice') }}"><i
                        class="fas fa-fw fa-table"></i> List Supplier Invoice</a>
                    </li>
            </ul>
        </li>

        @if (Auth::user()->isadmin())
            <li id="sbitem6">
                <a href="#" class="link-content pro-btn"><span class="left-title">Projects Management</span><span
                        class="fas fa-caret-down sixth"></span></a>
                <ul class="pro-show">
                    <li id="sbitem6_1"><a href="{{ route('create_new_project_index') }}"><i class="fas fa-ad fa-table"></i>
                            Create New Project</a></li>
                    <li id="sbitem6_2"><a href="{{ route('architecture_projects_list_index') }}"><i class="fas fa-ad fa-table"></i>
                            Architecture Projects List</a></li>
                    <li id="sbitem6_3"><a href="{{ route('civil_projects_list_index') }}"><i class="fas fa-fw fa-table"></i>
                            Civil Projects List</a></li>
                </ul>
            </li>
        @endif

        {{-- Log Out --}}
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <span class="left-title"> {{ __('Logout') }}</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

    </ul>
</nav>
