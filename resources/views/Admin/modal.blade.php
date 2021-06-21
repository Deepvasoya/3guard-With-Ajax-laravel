<div id="success"></div>

<!-- Add New-subject -->
<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New-subject</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <form id="subjectdata">
                        @csrf
                    <div class="form-group my-3">
                        <label>Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Subject">
                        <span class="text-danger" id="subjectError"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                 </form>
      </div>
    </div>
  </div>
</div>

<!-- Add New-standard -->
<div class="modal fade" id="standardModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New-standard</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
              <form id="standarddata">
                        @csrf
                    <div class="form-group my-3">
                        <label>Standard</label>
                        <input type="text" max="2" class="form-control" name="standard" id="standard" placeholder="Enter standard">
                        <span class="text-danger" id="standardError"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                 </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $(document).on("submit","#subjectdata", function(e){
        e.preventDefault();
        let subject = $("#subject").val();
        let _token = $("input[name=_token]").val();
            $.ajax({
                url:"{{ route('add.newsubject') }}",
                type:'POST',
                data:{
                    subject:subject,
                    _token:_token
                },
                success:function(response){
                    if(response)
                    {
                      $("#subjectdata")[0].reset();
                      $("#subjectModal").modal('hide');
                      $("#success").text(response.success);
                        setTimeout(function() { $("#success").hide().html(''); }, 5000);
                        setInterval(function(){
                                location.reload();
                            }, 2000);
                    }
                },
                 error:function (response) {
                    $('#subjectError').text(response.responseJSON.errors.subject);
                    }
             });
 });

 $(document).on("submit","#standarddata", function(e){
        e.preventDefault();
        let standard = $("#standard").val();
        let _token = $("input[name=_token]").val();
            $.ajax({
                url:"{{ route('add.newstandard') }}",
                type:'POST',
                data:{
                    standard:standard,
                    _token:_token
                },
                success:function(response){
                    if(response)
                    {
                      $("#standarddata")[0].reset();
                      $("#standardModal").modal('hide');
                      $("#success").text(response.success);
                        setTimeout(function() { $("#success").hide().html(''); }, 5000);
                        setInterval(function(){
                                location.reload();
                            }, 2000);
                    }
                },
                 error:function (response) {
                    $('#standardError').text(response.responseJSON.errors.standard);
                    }
             });
 });
});
</script>
