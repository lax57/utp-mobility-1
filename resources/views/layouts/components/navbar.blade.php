<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{route('my_applications')}}">{{trans('navbar.title')}}</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <li class="nav-item {{ Request::is('myapplications*') ? 'active' : '' }}" data-toggle="tooltip" data-placement="right" title="My applications">
                <a class="nav-link" href="{{route('my_applications')}}">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">{{trans('navbar.my_applications')}}</span>
                </a>
            </li>

            @if(Auth::user()->hasPermission(App\Permission::CREATE_APPLICATION))
            <li class="nav-item {{Request::is('newmobility*') ? 'active' : '' }}" data-toggle="tooltip" data-placement="right" title="New mobility">
                <a class="nav-link" href="{{route('new_mobility')}}">
                    <i class="fa fa-fw fa-telegram"></i>
                    <span class="nav-link-text">{{trans('navbar.new_mobility')}}</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasPermission(App\Permission::CREATE_APPLICATION))
            <li class="nav-item {{Request::is('notifications*') ? 'active' : '' }}" data-toggle="tooltip" data-placement="right" title="New mobility">
                <a class="nav-link" href="{{route('notifications')}}">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="nav-link-text">{{trans('navbar.notifications')}}</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasPermission(App\Permission::EVALUATE_APPLICATIONS))
            <li class="nav-item {{Request::is('evaluate*') ? 'active' : '' }}" data-toggle="tooltip" data-placement="right" title="Evaluation List">
                <a class="nav-link" href="{{route('evaluate_list')}}">
                    <i class="fa fa-fw fa-graduation-cap"></i>
                    <span class="nav-link-text">{{trans('navbar.evaluate_applications')}}</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasPermission(App\Permission::MANAGE_WEBSITE))
            <li class="nav-item " data-toggle="tooltip" data-placement="right" title="" data-original-title="Components" aria-describedby="tooltip100870">
                <a class="nav-link nav-link-collapse  " data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion" aria-expanded="false">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">{{trans('navbar.portal_administration')}}</span>
                </a>
                <ul class="sidenav-second-level collapse {{Request::is('dashboard/accounts*') ? 'show' : '' }}" id="collapseComponents" style="">
                    <li class="{{Request::is('dashboard/accounts*') ? 'active' : '' }}">
                        <a href="{{route('show_accounts')}}">{{trans('navbar.accounts_management')}}</a>
                    </li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->hasPermission(App\Permission::MANAGE_WEBSITE))
            <li class="nav-item " data-toggle="tooltip" data-placement="right" title="" data-original-title="Components" aria-describedby="tooltip100870">
                <a class="nav-link nav-link-collapse  " data-toggle="collapse" href="#collapseComponents2" data-parent="#exampleAccordion" aria-expanded="false">
                    <i class="fa fa-fw fa-sort-numeric-desc"></i>
                    <span class="nav-link-text">{{trans('statistics.statistics')}}</span>
                </a>
                <ul class="sidenav-second-level collapse {{Request::is('statistics/*') ? 'show' : '' }} collapseComponents2" id="collapseComponents2" style="">
                    <li class="{{Request::is('statistics/units*') ? 'active' : '' }}">
                        <a href="{{route('statistics_units')}}">{{trans('statistics.by_units')}}</a>
                    </li>
                    <li class="{{Request::is('statistics/types*') ? 'active' : '' }}">
                        <a href="{{route('statistics_types')}}">{{trans('statistics.by_event_type')}}</a>
                    </li>
                    <li class="{{Request::is('statistics/countries*') ? 'active' : '' }}">
                        <a href="{{route('statistics_countries')}}">{{trans('statistics.by_countries')}}</a>
                    </li>
                    <li class="{{Request::is('statistics/money*') ? 'active' : '' }}">
                        <a href="{{route('statistics_money')}}">{{trans('statistics.by_money')}}</a>
                    </li>
                </ul>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-4 w-100 d-inline-block align-content-center">

           

            <li class="nav-item float-left mr-3"  ><img class="img-rounded" src="{{URL::asset('img/person.jpg')}}" style="border-radius:50%; width:40px; border-width:10px " /></li>

            <li class=" h5 text-white float-left mt-2">  {{ Auth::user()->name }} {{ Auth::user()->last_name }}</li>



            <li class="nav-item float-right">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</nav>