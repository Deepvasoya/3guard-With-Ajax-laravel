<table class="table" id="resulttable" style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Enroll-No</th>
                                        <th scope="col">Standard</th>
                                        <th scope="col">English</th>
                                        <th scope="col">Gujarati</th>
                                        <th scope="col">Hindi</th>
                                        <th scope="col">Sanskrit</th>
                                        <th scope="col">Maths</th>
                                        <th scope="col">Average</th>
                                        <th scope="col">Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($student as $data)
                                        <tr>
                                                <td>{{ $data->id  }}</td>
                                                <td>{{ $data->name  }}</td>
                                                <td>{{ $data->email  }}</td>
                                                <td>{{ $data->enrollno  }}</td>
                                                <td>{{ $data->standard  }}</td>
                                                <td>{{ $data->english  }}</td>
                                                <td>{{ $data->gujarati  }}</td>
                                                <td>{{ $data->hindi  }}</td>
                                                <td>{{ $data->sanskrit  }}</td>
                                                <td>{{ $data->maths  }}</td>
                                                <td>{{ $data->average  }}</td>
                                                <td>{{ $data->percentage  }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
</table>

<div class="d-flex pagination justify-content-center">
    {!! $student->links() !!}
</div>
