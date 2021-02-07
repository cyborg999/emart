
	<!-- Modal -->
<div class="modal fade" id="updateModal" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm">
            <h5>Please enter your password to update this record.</h5>
            <form id="updateVerify">
            	<input type="hidden" name="updateVerify" value="true">
	            <input type="password" id="password" class="password form-control" name="password">
	            <br>
    	        <input type="submit" class="btn btn-lg btn-primary" value="submit" >
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<a href="" data-toggle="modal" data-target="#updateModal">test</a>