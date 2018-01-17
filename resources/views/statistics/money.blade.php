@extends('layouts.dashboard')

@section('page-level-plugins')
<link href="{{URL::asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" />
@endsection

@section('page-content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('my_applications')}}">{{trans('navbar.title')}}</a>
        </li>
        <li class="breadcrumb-item active">{{trans('statistics.statistics')}}</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> {{trans('statistics.statistics_money')}}
        </div>
        <div class="card-body">
            
            <div class="mt-3 text-center">
                <span class="h4"> {{trans('statistics.statistics_total')}} 
                    <strong class="text-danger">
                        ${{
                        (isset($total_money_invested['Student']) ? $total_money_invested['Student'] : 0) +
                        (isset($total_money_invested['Administration']) ? $total_money_invested['Administration'] : 0 )+
                        (isset($total_money_invested['Profesor']) ? $total_money_invested['Profesor'] : 0 )
                        }} 
                    </strong>
                </span>
            </div>
            
            <div class="table-responsive mt-4">
                <table class="table table-bordered collaptable" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <th>{{trans('statistics.unit_name')}}</th>
                            <th>{{trans('statistics.student_short')}}</th>
                            <th>{{trans('statistics.administration_short')}}</th>
                            <th>{{trans('statistics.profesor_short')}}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-light">
                            <th>{{trans('statistics.unit_name')}}</th>
                            <th>{{trans('statistics.student_short')}}</th>
                            <th>{{trans('statistics.administration_short')}}</th>
                            <th>{{trans('statistics.profesor_short')}}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($money_invested as $unit_name=>$statistic)
                        <tr class="bg-light">
                            <td>{{$unit_name}}</td>
                            <td>${{isset($statistic['Student']) ? $statistic['Student'] : 0}}</td>
                            <td>${{isset($statistic['Administration']) ? $statistic['Administration'] : 0}}</td>
                            <td>${{isset($statistic['Profesor']) ? $statistic['Profesor'] : 0}}</td>
                        </tr>
                        @endforeach
                        <tr class="bg-light">
                            <td>{{trans('statistics.sum')}}</td>
                            <td>${{isset($total_money_invested['Student']) ? $total_money_invested['Student'] : 0 }}</td>
                            <td>${{isset($total_money_invested['Administration']) ? $total_money_invested['Administration'] : 0 }}</td>
                            <td>${{isset($total_money_invested['Profesor']) ? $total_money_invested['Profesor'] : 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</div>


@endsection

@section('page-level-scripts')
<script src="{{URL::asset('js/sb-admin-datatables.min.js')}}"></script>
<script src="{{URL::asset('vendor/CollapTable/jquery.aCollapTable.js')}}" />
</script>


<script type="text/javascript">

    $('#dataTable').dataTable( {
        "ordering": false
      } );
</script>
        
    
    
@endsection