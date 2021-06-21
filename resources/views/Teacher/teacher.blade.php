@extends('layouts.auth')

@section('content')
<div>
    <div id="success"></div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                      <a href="{{ route('Teacher.list') }}" style="text-decoration: none" class="mx-2">Students-list</a>
                      <a href="{{ route('Result.list') }}" style="text-decoration: none" class="mx-2">Result-list</a>
                </div>
                <div class="card-body">
                    <div>
                        <h3 class="text-center">Student List<h3>
                            @csrf
                            <div class="table-responsive" id="table_data">
                            @include('Teacher.studentpage')
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!--Put Marks Model-->
<div class="modal fade" id="putmarksModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Result</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           <form id="putstudentmarks">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="form-group my-3">
                    <label>English</label>
                    <input type="text" max="3" class="form-control" name="english" id="english" placeholder="Enter English Marks">
                    <span class="text-danger" id="englishError"></span>
                </div>
                <div class="form-group my-3">
                    <label>Gujarati</label>
                    <input type="text" max="3" class="form-control" name="gujarati" id="gujarati" placeholder="Enter Gujarati Marks">
                    <span class="text-danger" id="gujaratiError"></span>
                </div>
                <div class="form-group my-3">
                    <label>Hindi</label>
                    <input type="text" max="3" class="form-control" name="hindi" id="hindi" placeholder="Enter Hindi Marks">
                    <span class="text-danger" id="hindiError"></span>
                </div>
                <div class="form-group my-3">
                    <label>Sanskrit</label>
                    <input type="text" max="3" class="form-control" name="sanskrit" id="sanskrit" placeholder="Enter Sanskrit Marks">
                    <span class="text-danger" id="snskritError"></span>
                </div>
                <div class="form-group my-3">
                    <label>Maths</label>
                    <input type="text" max="3" class="form-control" name="maths" id="maths" placeholder="Enter Maths Marks">
                    <span class="text-danger" id="mathsError"></span>
                </div>
                <div class="form-group my-3">
                    <label>Average</label>
                    <input type="text" max="3" class="form-control" name="average" id="average" placeholder="Enter Total Average">
                    <span class="text-danger" id="averageError"></span>
                </div>
                <div class="form-group my-3">
                    <label>Percentage</label>
                    <input type="text" max="3" class="form-control" name="percentage" id="percentage" placeholder="Enter Percentage">
                    <span class="text-danger" id="percentageError"></span>
                </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
    function putmarks(id)
    {
        $("#id").val(id);
        $("#putmarksModal").modal('toggle');
    }

     $(document).on("submit","#putstudentmarks", function(e){
              e.preventDefault();
              let sid = $("#id").val();
              let english = $("#english").val();
              let gujarati = $("#gujarati").val();
              let hindi = $("#hindi").val();
              let sanskrit = $("#sanskrit").val();
              let maths = $("#maths").val();
              let average = $("#average").val();
              let percentage = $("#percentage").val();
              let _token = $("input[name=_token]").val();
               $.ajax({
                url:"{{ route('add.result') }}",
                type:'POST',
                data:{
                    sid:sid,
                    english:english,
                    gujarati:gujarati,
                    hindi:hindi,
                    sanskrit:sanskrit,
                    maths:maths,
                    average:average,
                    percentage:percentage,
                    _token:_token
                },
                success:function(response){
                      $("#putmarksModal").modal('toggle');
                      $("#putstudentmarks")[0].reset();
                      $("#rej"+sid+" a:first").addClass("d-none");
                      $("#rej"+sid+" a:last").removeClass("d-none");
                      $("#success").text(response.success);
                        setTimeout(function() { $("#success").hide().html(''); }, 5000);
                    },
                error:function (response) {
                    $('#englishError').text(response.responseJSON.errors.english);
                    $('#gujaratiError').text(response.responseJSON.errors.gujarati);
                    $('#hindiError').text(response.responseJSON.errors.hindi);
                    $('#snskritError').text(response.responseJSON.errors.sanskrit);
                    $('#mathsError').text(response.responseJSON.errors.maths);
                    $('#averageError').text(response.responseJSON.errors.average);
                    $('#percentageError').text(response.responseJSON.errors.percentage);
                    }
             });
         });
</script>
<script>
$(document).ready(function(){
    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
    function fetch_data(page)
    {
    var _token = $("input[name=_token]").val();
    $.ajax({
        url:"{{ route('teacher.pagination') }}",
        method:"POST",
        data:{_token:_token, page:page},
        success:function(response)
        {
        $('#table_data').html(response);
        }
        });
    }
});
</script>
@endsection
