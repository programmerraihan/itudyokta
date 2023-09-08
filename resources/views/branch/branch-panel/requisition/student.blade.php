<div class="row">
    <div class="col-lg-12">
        <fieldset>
            <legend> Student List </legend>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Latest Transaction</h4>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="thead-light">
                                <tr>

                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Student Phon Number</th>
                                    <th style="width: 20px; text-align:left;">
                                      <input type="checkbox" id="all"> All
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($students as $student)
                                    <tr id="student_id">

                                        <td><a href="javascript: void(0);"
                                                class="text-body font-weight-bold">{{ $student->id }}</a>
                                        </td>
                                        <td>{{ $student->student->name }}</td>
                                        <td>
                                            {{ $student->student->mobile }}
                                        </td>

                                        <td style="width: 20px; text-align:left;">
                                            <input type="checkbox" class="check" id="customCheck2" value="{{$student->id}}" name="student[]">
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                   
                </div>
            </div>

            <button class="btn btn-success" style="width: 100%;">Submit</button>
        </fieldset>
    </div>
</div>

<script>
  $('#all').click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
  })
</script>
