
<!-- Upload Modal-->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload a file</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{route('inform_upload')}}" enctype="multipart/form-data">
                <div class="modal-body">
                    <label for='fileToUpload'>Select file to upload: </label>
                    <input type="file" class='form-control' name="inform" id="fileToUpload" required>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <input type="text"  name="application_id" id='inform_app_id' value='' hidden>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type='submit' class="btn btn-danger" id="submitBtnModal">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
