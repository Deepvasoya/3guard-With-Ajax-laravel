<!-- table -->
<table class="table" id="teachertable" style="font-size: 15px;">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Taken-Subject</th>
      <th scope="col" width="200px">Perform</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($teacher as $data)
    <tr id="tea{{ $data->id  }}">
            <td>{{ $data->id  }}</td>
            <td>{{ $data->name  }}</td>
            <td>{{ $data->email  }}</td>
            <td>{{ $data->subject  }}</td>
            <td>
                 <a href="javascript:void(0)" onclick="deleteteacher({{ $data->id }})" class="btn btn-danger">Delete</a>
            </td>
    </tr>
     @endforeach
  </tbody>
</table>

<div class="d-flex pagination justify-content-center">
    {!! $teacher->links() !!}
</div>
