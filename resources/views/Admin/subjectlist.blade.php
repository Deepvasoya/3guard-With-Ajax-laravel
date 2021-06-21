@extends('layouts.auth')

@section('content')

<div class="container">
    <div id="success"></div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                 <div class="card-header">
                    <a href="{{ route('Student.list') }}" style="text-decoration: none" class="mx-2">Students</a>
                    <a href="{{ route('list.result') }}" style="text-decoration: none" class="mx-2">Results</a>
                    <a href="{{ route('Teacherss.list') }}" style="text-decoration: none" class="mx-3">Teachers</a>
                    <a href="{{ route('Subject.list') }}" style="text-decoration: none" class="mx-3">Subject</a>
                    <a style="text-decoration: none" class="mx-3" data-bs-toggle="modal" data-bs-target="#subjectModal">Add New-subject</a>
                    <a href="{{ route('Standard.list') }}" style="text-decoration: none" class="mx-3">Standard</a>
                    <a style="text-decoration: none" class="mx-3" data-bs-toggle="modal" data-bs-target="#standardModal">Add New-standard</a>
                </div>
                @include('Admin.modal')
                <div class="card-body">
                    <div class="container">
                        <h3 class="text-center">Subject List<h3>
                            @csrf
                            <div class="table-responsive" id="table_data">
                            @include('Admin.subjectpage')
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!--Edit subject Modal -->
<div class="modal fade" id="subjectEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           <form id="subjectdeditdata">
                        @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group my-3">
                        <label>Subject</label>
                        <input type="text" max="2" class="form-control" name="subjectedit" id="subjectedit" placeholder="Enter subject">
                        <span class="text-danger" id="subjectError"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
            </form>
      </div>
    </div>
  </div>
</div>
@section('script')

<!--Edit and Update User Jquery -->
<script>
    function editsubject(id)
    {
        $.get('subjectlist/'+id,function(subj){
                $("#id").val(subj.id);
                $("#subjectedit").val(subj.subject);
                $("#subjectEditModal").modal('toggle');
        });
    }
        $(document).on("submit","#subjectdeditdata", function(e){
              e.preventDefault();
              let id = $("#id").val();
              let subject = $("#subjectedit").val();
              let _token = $("input[name=_token]").val();
               $.ajax({
                url:"{{ route('Subject.update') }}",
                type:'PUT',
                data:{
                    id:id,
                    subject:subject,
                    _token:_token
                },
                success:function(response){
                      $("#subjectEditModal").modal('toggle');
                      $("#subjectdeditdata")[0].reset();
                       $("#success").text(response.success);
                        setTimeout(function() { $("#success").hide().html(''); }, 5000);
                        setInterval(function(){
                                location.reload();
                            }, 2000);
                    }
             });
         });
</script>

<!--Delete-->
<script>
    function deletesubject(id)
    {
        if(confirm("Do you realy want to delete this subject?"))
        {
             $.ajax({
                url: 'subjectlist/'+id,
                type:'DELETE',
                data:{
                    _token: $("input[name=_token]").val()
                },
                success:function(response){
                      $("#sub"+id).remove();
                       $("#success").text(response.success);
                        setTimeout(function() { $("#success").hide().html(''); }, 5000);
                        setInterval(function(){
                                location.reload();
                            }, 2000);
                    }
             });
        }
    }
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
        url:"{{ route('subject.pagination') }}",
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
