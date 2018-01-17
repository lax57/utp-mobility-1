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
            <i class="fa fa-table"></i> {{trans('statistics.statistics_types')}}
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                        @foreach($types_results as $type_name=>$result)
                        <tr>
                            <td>{{$type_name}}</td>
                            <td>{{ isset($result['Student']) ? $result['Student']  : 0 }}</td>
                            <td>{{ isset($result['Researcher']) ? $result['Researcher'] : 0 }}</td>
                            <td>{{ isset($result['Profesor']) ? $result['Profesor'] : 0 }}</td>
                        </tr>
                        
                        @endforeach
                        <tr >
                            <td>SUM</td>
                            <td>{{isset($sum_of_types['Student']) ? $sum_of_types['Student'] : 0 }}</td>
                            <td>{{isset($sum_of_types['Administration']) ? $sum_of_types['Administration'] : 0 }}</td>
                            <td>{{isset($sum_of_types['Profesor']) ? $sum_of_types['Profesor'] : 0 }}</td>
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

    
</script>
        
    
    
@endsection