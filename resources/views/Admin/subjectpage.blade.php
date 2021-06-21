<!-- table -->
<table class="table" id="subjecttable" style="font-size: 15px;">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Subject</th>
      <th scope="col" width="200px">Perform</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($subjects as $data)
    <tr id="sub{{ $data->id  }}">
            <td>{{ $data->id  }}</td>
            <td>{{ $data->subject  }}</td>
            <td>
               <a href="javascript:void(0)" onclick="editsubject({{ $data->id }})" class="btn btn-info">Edit</a>
               <a href="javascript:void(0)" onclick="deletesubject({{ $data->id }})" class="btn btn-danger">Delete</a>
            </td>
    </tr>
     @endforeach
  </tbody>
</table>

<div class="d-flex pagination justify-content-center">
    {!! $subjects->links() !!}
</div>
