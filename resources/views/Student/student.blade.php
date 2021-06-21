@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Student Dashboard</div>

                <div class="card-body">
                     <h1 class="text-center">My Profile</h1>
                     <table class="my-5 text-center" style="width:100%">
                            <tr>
                                <th>Name:</th>
                                <td>{{ Auth::user()->id }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <th>Enroll No:</th>
                                <td>{{ Auth::user()->enrollno }}</td>
                            </tr>
                             <tr>
                                <th>Standard:</th>
                                <td>{{ Auth::user()->standard }}</td>
                            </tr>
                    </table>
                                <div class="d-flex justify-content-center">
                                   <form id="result">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                                        <button type="submit" class="btn btn-primary">Show Result</button>
                                  <form>
                                </div>
                            <div id="success" class="my-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function(){
  $(document).on("submit","#result", function(e){
       e.preventDefault();
       let id = $("#id").val();
       let _token = $("input[name=_token]").val();

        $.ajax({
                url:"{{ route('Student.result') }}",
                type:'POST',
                data:{
                    id:id,
                    _token:_token
                },
                success:function(response){
                       if(response){
                                  $('#success').html('<hr><hr><h3 class="text-center">Result</h3><table class="my-5 text-center" style="width:75%"><tr><th>English :---</th><th>100</th><td>'+response.english+'</td></tr><tr><th>Gujarati :---</th><th>100</th><td>'+response.gujarati+'</td></tr><tr><th>Hindi :---</th><th>100</th><td>'+response.hindi+'</td></tr><tr><th>Sanskrit :---</th><th>100</th><td>'+response.sanskrit+'</td></tr><tr><th>Maths :---</th><th>100</th><td>'+response.maths+'</td></tr><hr><tr><th>Total :---</th><th>500</th><td>'+response.average+'</td></tr><hr><tr><th>Percentage :---</th><th>100%</th><td>'+response.percentage+'%</td></tr></hr></table>');
                       }
                       else{
                           $('#success').html('<h3>No Result Found</h3>');
                       }

                    }
             });
 });
});
</script>
@endsection
