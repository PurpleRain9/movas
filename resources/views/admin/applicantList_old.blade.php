@extends('admin.layout')
@section('content')
    <style>
        table td:nth-child(2){
            max-width: 200px;
            word-wrap: break-word;
            white-space: normal;
        }
    </style>

    <div class="d-xl-flex justify-content-between align-items-start" style="border-bottom: 1px solid lightblue;">
        <p class="text-dark mb-2"> Applicant Lists </p>
        </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <a href="{{ route('applicantsExport') }}" class="btn btn-success btn-sm my-3">Export Excel</a>
                    <table class="table table-hover table-bordered table-responsive" id="test">
                        <thead class="bg-info text-white">
                            <th>No</th>
                            <th>ကုမ္ပဏီအမည်</th>
                            <th>အမည်/ရာထူး</th>
                            <th>နိုင်ငံသား</th>
                            <th>နိုင်ငံကူးလက်မှတ်</th>
                            <th>စတင်ခန့်ထားသည့်ရက်စွဲ</th>
                            <th>နေထိုင်ခွင့်သက်တမ်းကုန်ဆုံးမည့်နေ့</th>
                            <th>ပြည်ဝင်ခွင့်</th>
                            <th>နေထိုင်ခွင့်</th>
                            <th>အလုပ်သမားကဒ်/သက်တမ်း</th>
                            <th>စစ်ဆေးနေသူ</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($applicants as $key => $applicant)
                                {{-- {{ dd($applicant->remarks->last()->ToAdminID) }} --}}
                                @foreach ($applicant->visa_details as $person)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        {{ $applicant->profile->CompanyName }}
                                    </td>
                                    <td>
                                        {{ $person->PersonName }}
                                        <hr>
                                        @if ($person->person_type_id == 4)
                                            {{ $person->RelationShipName }}
                                        @else
                                            {{ $person->person_type->PersonTypeName }}
                                        @endif
                                    </td>
                                    <td>{{ $person->nationality->NationalityName }}</td>
                                    <td>{{ $person->PassportNo }}</td>
                                    <td>{{ $person->StayAllowDate }}</td>
                                    <td>{{ $person->StayExpireDate }}</td>
                                    <td>
                                        @if ($person->visa_type)
                                            {{ $person->visa_type->VisaTypeNameMM }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($person->stay_type)
                                            {{ $person->stay_type->StayTypeNameMM }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($person->labour_card_type)
                                            {{ $person->labour_card_type->LabourCardTypeMM }}
                                        @endif
                                        /
                                        @if ($person->labour_card_duration)
                                            {{ $person->labour_card_duration->LabourCardDurationMM }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>

    $(document).ready(function() {
        $('#test').DataTable({
        });
    });
</script>
@endsection




