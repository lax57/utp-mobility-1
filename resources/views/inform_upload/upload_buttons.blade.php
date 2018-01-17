<div class="row mx-2"> 
<!--Delete applicationStatus if user can upload multiple informs and replacing old ones -->
@if((($application->inform ==null && $application->withinDeadline()) || $application->withinDeadline() || $application->applicationStatus-> name == App\ApplicationStatus::FEEDBACK_REQUIRED) && Auth::user()->hasPermission(App\Permission::CREATE_APPLICATION))   
    <a class="fa fa-upload fa-2x text-success mx-auto upload-in-btn"  href="" data-toggle="tooltip" title="{{trans('informs.upload')}}" aria-hidden="true" data-application='{{$application->id}}'></a>
@endif
@if($application->inform !=null)
    <a class="fa fa-download fa-2x text-warning mx-auto download-in-btn"  href="{{route('inform_download', ['application_id' => $application->id] )}}" data-toggle="tooltip" title="{{trans('informs.download')}}" aria-hidden="true" data-application='{{$application->id}}'></a>
@endif

</div>
<div class="smaller text-center">
    @if($application->inform != null && App\ApplicationStatus::HISTORICAL == $application->applicationStatus->name && $application->inform->within_deadline)
    <label class="m-0 text-success ">{{trans('informs.within_deadline')}}</label>
    @elseif($application->inform != null)
    <label class="m-0 text-warning ">{{trans('informs.after_deadline')}}</label>
    @endif
    @if($application->inform == null && !$application->withinDeadline() && App\ApplicationStatus::FEEDBACK_REQUIRED == $application->applicationStatus->name)
    <label class="m-0 text-danger ">{{trans('informs.never_uploaded')}}</label>
    @endif
</div>