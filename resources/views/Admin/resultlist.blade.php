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

                        {{-- <input class="form-control mr-sm-2 col-4" type="search" id="Search" name="Search" placeholder="Search" aria-label="Search"> --}}
            <div class="form-group row">
                <label for="standard" class="col-md-5 col-form-label text-md-right">{{ __('Standard') }}</label>
                     <div class="col-md-6">
                        <form action="">
                         <div class="select-container">
                            <select class="form-control col-4" id="stan">
                                <option>Select standard</option>
                                @foreach ($standard as $class)
                                    <option value="{{ $class->standard }}">
                                        {{ $class->standard }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        </form>
                    </div>
            </div>

                        <h3 class="text-center">Student-Result-List<h3>
                            @csrf
                            <div class="table-responsive" id="table_data">
                            @include('Admin.resultpage')
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
<script>
$(document).ready(function(){
    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        // var key =  $("#Search").val();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    $('#stan').on('change', function() {
           fetch_data();
    });

    function fetch_data(page,key)
    {
         var standard = $("#stan option:selected").val();
         var _token = $("input[name=_token]").val();
            $.ajax({
                url:" /admin/listresult/fetch?page="+page,
                method:"GET",
                data:{_token:_token,page:page,standard:standard},
                success:function(response)
                {
                $('#table_data').html(response);
                }
                });
    }

    //  $(document).ready(function(){
    //     $(document).on('keyup', '#Search', function(){
    //         var page = $('#hidden_page').val();
    //         var key =  $("#Search").val();
    //         fetch_data(page,key);
    //      });
    // });
});
</script>
@endsection
