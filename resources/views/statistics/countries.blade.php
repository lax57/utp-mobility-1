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
            <i class="fa fa-table"></i> {{trans('statistics.statistics_countries')}}
        </div>
        <div class="card-body">
            
            <div class="table-responsive ">
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
                        @foreach($countries as $name=>$continent)
                        <tr data-id="{{array_search($name,array_keys($continents))+1}}" data-parent="" class="bg-light">
                            <td>{{$name}}</td>
                            <td>{{ isset($continents[$name]['Student']) ? $continents[$name]['Student']  : 0 }}</td>
                            <td>{{ isset($continents[$name]['Administration']) ? $continents[$name]['Admin{istration']  : 0 }}</td>
                            <td>{{ isset($continents[$name]['Profesor']) ? $continents[$name]['Profesor']  : 0 }}</td>
                        </tr>
                            @foreach($continent as $country_name => $country)
                            <tr data-id="x" data-parent="{{array_search($name,array_keys($continents))+1}}">
                                <td>{{$country_name}}</td>
                                <td>{{ isset($country['Student']) ? $country['Student']  : 0 }}</td>
                                <td>{{ isset($country['Administration']) ? $country['Administration'] : 0 }}</td>
                                <td>{{ isset($country['Profesor']) ? $country['Profesor'] : 0 }}</td>
                            </tr>
                            @endforeach
                        
                        @endforeach
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
    $(document).ready(function(){
      $('.collaptable').aCollapTable({ 
        startCollapsed: true,
        addColumn: true, 
        plusButton: '<i class="fa fa-plus"></i>', 
        minusButton: '<i class="fa fa-minus"></i>' 
      });
    });
    
    $('#dataTable').dataTable( {
        "ordering": false
      } );
</script>
        
    
    
@endsection