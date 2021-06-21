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
                        <h3 class="text-center">Standard List<h3>
                            @csrf
                            <div class="table-responsive" id="table_data">
                            @include('Admin.standardpage')
                            </div>
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
    function deletestandard(id)
    {
        if(confirm("Do you realy want to delete this standard?"))
        {
             $.ajax({
                url: 'standardlist/'+id,
                type:'DELETE',
                data:{
                    _token: $("input[name=_token]").val()
                },
                success:function(response){
                      $("#sta"+id).remove();
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
        url:"{{ route('standard.pagination') }}",
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
