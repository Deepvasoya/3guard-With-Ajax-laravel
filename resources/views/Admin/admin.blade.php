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

                        <input class="form-control mr-sm-2 col-4" type="search" id="Search" name="Search" placeholder="Search" aria-label="Search">

                        <h3 class="text-center">Student List<h3>
                            @csrf
                            <div class="table-responsive" id="table_data">
                            @include('Admin.studentpage')
                            </div>
                            <div class="input-group">
                        <input type="hidden" name="hidden_page"  id="hidden_page" value="1" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!--Delete-->
<script>
    function studentdelete(id)
    {
        if(confirm("Do you realy want to delete this subject?"))
        {
              $.ajax({
                url: 'admin/'+id,
                type:'DELETE',
                data:{
                    _token: $("input[name=_token]").val()
                },
                success:function(response){
                      $("#stud"+id).remove();
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
        var query =  $("#Search").val();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page, query);
    });
    function fetch_data(page,query)
    {
    var _token = $("input[name=_token]").val();
    $.ajax({
        url:" /admin/fetch?page="+page+"&query="+query,
        method:"GET",
        data:{_token:_token, page:page, query:query},
        success:function(response)
        {
        $('#table_data').html(response);
        }
        });
    }

    $(document).ready(function(){
        $(document).on('keyup', '#Search', function(){
            var page = $('#hidden_page').val();
            var query =  $("#Search").val();
            fetch_data(page,query);
         });
    });
});
</script>
@endsection
