


<table class="table table-hover table-bordered table-responsive" id="test">
    <thead class="bg-info text-white">
        <tr>
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
        </tr>
    </thead>
    <tbody>
        @foreach ($applicants as $key => $applicant)
            {{-- {{ dd($applicant) }} --}}
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $applicant->CompanyName }}</td>
                <td>
                    {{ $applicant->PersonName }}(
                    @if ($applicant->person_type_id == 4)
                        {{ $applicant->PersonTypeName }}({{ $applicant->RelationShipName }})
                    @else
                        {{ $applicant->PersonTypeName }}
                    @endif)
                </td>
                <td>{{ $applicant->NationalityName }}</td>
                <td>{{ $applicant->PassportNo }}</td>
                <td>{{ $applicant->StayAllowDate }}</td>
                <td>{{ $applicant->StayExpireDate }}</td>
                <td>
                    @if ($applicant->visa_type_id)
                        {{ $applicant->VisaTypeNameMM }}
                    @endif
                </td>
                <td>
                    @if ($applicant->stay_type_id)
                        {{ $applicant->StayTypeNameMM }}
                    @endif
                </td>
                <td>
                    @if ($applicant->labour_card_type_id)
                        {{ $applicant->LabourCardTypeMM }}
                    @endif
                    /
                    @if ($applicant->labour_card_duration_id)
                        {{ $applicant->LabourCardDurationMM }}
                    @endif
                </td>
                <td>{{$applicant->RankName == null ? 'CO':$applicant->RankName}}</td>
            </tr>
        @endforeach
    </tbody>
</table>