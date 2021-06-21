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
                        <h3 class="text-center">Student-Result-List<h3>
                            @csrf
                            <div class="table-responsive" id="table_data">
                            @include('Teacher.resultpage')
                            </div>
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
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
    function fetch_data(page)
    {
    var _token = $("input[name=_token]").val();
    $.ajax({
        url:"{{ route('Result.pagination') }}",
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
