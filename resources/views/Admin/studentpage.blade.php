<!-- table -->
<table class="table" id="studenttable" style="font-size: 15px;">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Enroll-No</th>
      <th scope="col">Standard</th>
      <th scope="col" width="200px">Perform</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($student as $data)
    <tr id="stud{{ $data->id  }}">
            <td>{{ $data->id  }}</td>
            <td>{{ $data->name  }}</td>
            <td>{{ $data->email  }}</td>
            <td>{{ $data->enrollno  }}</td>
            <td>{{ $data->standard  }}</td>
            <td>
                 <a href="javascript:void(0)" onclick="studentdelete({{ $data->id }})" class="btn btn-danger btn-sm">Delete</a>
            </td>
    </tr>
     @endforeach
  </tbody>
</table>

<div class="d-flex pagination justify-content-center">
    {!! $student->links() !!}
</div>
