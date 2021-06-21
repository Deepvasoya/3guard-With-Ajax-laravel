<!-- table -->
<table class="table" id="standardtable"  style="font-size: 15px;">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Standard</th>
      <th scope="col" width="200px">Perform</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($standards as $data)
    <tr id="sta{{ $data->id  }}">
            <td>{{ $data->id  }}</td>
            <td>{{ $data->standard  }}</td>
            <td>
                <a href="javascript:void(0)" onclick="deletestandard({{ $data->id }})" class="btn btn-danger">Delete</a>
            </td>
    </tr>
     @endforeach
  </tbody>
</table>

<div class="d-flex pagination justify-content-center">
    {!! $standards->links() !!}
</div>
