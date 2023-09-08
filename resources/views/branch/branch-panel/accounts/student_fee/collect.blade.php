<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <fieldset>
                    {{-- @dd($student->name); --}}
                    <legend>Student Informations</legend>
                    <div class="row">
                        <div class="form-group col-md-3">

                            <label>Name: {{ $student->name }}</label>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Roll: {{ $student->roll_no_student }}</label>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Branch Name: {{ \App\Models\Branch::find($student->branch_id)->name }}</label>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Course Name:
                            {{ \App\Models\CourseTitle::find($student->course_title_id)->title }}</label>
                    </div>
            </div>

        </div>
        </fieldset>

        <form action="{{ route('branch.student.fee.collect.all') }}" method="POST" class="form-horizontal"
            enctype="multipart/form-data" target="_blank">
            @csrf
            <table class="table table-bordered table-hover" id="sample_1" style="width:100%">
                <thead>
                    <tr>
                        <th>Head Name</th>
                        <th>Month</th>
                        <th>Generated Price</th>
                        <th>Waiver Amount</th>
                        <th>Fine Amount</th>
                        <th>Total Amounts</th>
                        <th>Paid Amount</th>
                        <th>Due Amount</th>
                        <th>Paid Amount</th>
                        <th>Fine Amount</th>
                        <th>Waiver Amount</th>
                        <th>Waiver Note</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $AssignFee = 0;
                        $TotalAmount = 0;
                        $TotalAmountOrginal = 0;
                        $TotalPaidAmount = 0;
                        $TotalDiscountAmount = 0;
                        $TotalDueAmount = 0;
                        $fineAmount = 0;
                        $TotalfineAmount = 0;
                        $total_amounts = 0;
                    @endphp




                    {{-- @dd($fees); --}}
                    @foreach ($fees as $i => $fee)
                        @if ($fee->due > 0)
                            <input type="hidden" name="array[{{ $i }}][fee_id]" value="{{ $fee->id }}">
                            <input type="hidden" name="array[{{ $i }}][account_head_id]"
                                value="{{ $fee->account_head_id }}">

                            @php
                                $DiscountAmount = App\Models\StudentFeeCollections::where('fee_id', $fee->id)->sum('discount');
                                
                                $fineAmount = App\Models\StudentFeeCollections::where('fee_id', $fee->id)->sum('fine');
                                
                                $TotalDiscountAmount += $DiscountAmount;
                                $TotalfineAmount += $fineAmount;
                                
                                $TotalDueAmount += $fee->due;
                                $TotalPaidAmount += $fee->paid;
                                $TotalAmountOrginal += $fee->amount;
                                
                            @endphp

                            <tr>
                                <th>{{ $student->name }}</th>
                                <th>
                                    {{ \Carbon\Carbon::parse($fee['fee_date'])->format('F') }},
                                    {{ Carbon\Carbon::parse($fee['fee_date'])->format('Y') }}
                                </th>
                                <th style="text-align: right;">{{ $fee->amount }}</th>
                                <th style="text-align: right;">{{ $DiscountAmount }}</th>
                                <th style="text-align: right;">{{ $fineAmount }}</th>
                                <th style="text-align: right;">
                                    {{ $fee->amount - $DiscountAmount + $fineAmount }}</th>
                                <th style="text-align: right;">{{ $fee->paid }}</th>

                                <th style="text-align: right;">{{ $fee->due }}</th>


                                <th>
                                    <input type="text" name="array[{{ $i }}][paid_amount]"
                                        class="form-control" placeholder="Paid Amount">
                                </th>

                                <th>
                                    <input type="text" name="array[{{ $i }}][fine]" class="form-control"
                                        placeholder="Fine Amount">
                                </th>
                                <th>
                                    <input type="text" name="array[{{ $i }}][waiver]"
                                        class="form-control" placeholder="Waiver Amount">
                                </th>
                                <th>
                                    <input type="text" name="array[{{ $i }}][waiver_note]"
                                        class="form-control" placeholder="Waiver Note">
                                </th>
                            </tr>
                        @endif
                    @endforeach

                    <tr>
                        <th colspan="2" style="text-align: right;"> Total :</th>
                        <th style="text-align: right;">{{ $TotalAmountOrginal }}</th>
                        <th style="text-align: right;">{{ $TotalDiscountAmount }}</th>
                        <th style="text-align: right;">{{ $TotalfineAmount }}</th>
                        <th style="text-align: right;">
                            {{ $TotalAmountOrginal + $TotalfineAmount - $TotalDiscountAmount }}
                        </th>
                        <th style="text-align: right;">{{ $TotalPaidAmount }}</th>
                        <th style="text-align: right;">{{ $TotalDueAmount }}</th>

                        <th>
                            <input type="date" name="date"
                                class="form-control @error('date') is-invalid @enderror" required>
                            @error('date')
                                <small class="text-danger">

                                </small>
                            @enderror
                        </th>

                        <th colspan="2">
                            <select type="text" name="bank_id"
                                class="form-control form-select @error('bank_id') is-invalid @enderror" required>
                                <option>Select Fund ...</option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <input type="submit" class="btn btn-primary form-control" value="SUBMIT">
                        </th>
                    </tr>

                </tbody>
            </table>
        </form>
    </div>
</div>
</div>
</div>
