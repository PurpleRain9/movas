<table class="table table-hover table-bordered table-responsive" id="test">
    <thead class="bg-info text-white">
        <tr>
            <th>No</th>
            <th>အမည်</th>
            <th>လိင်အမျိုးအစား</th>
            <th>ရာထူး</th>
            <th>အရည်အချင်း</th>
            <th>လိပ်စာ</th>
            <th>ဖုန်းနံပါတ်</th>
            <th>နိုင်ငံကူးလက်မှတ်</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dependants as $key => $dependants)
            <tr>
                <td>{{ ++$key }}</td>
                <td>
                    {{ $dependants->name }}
                </td>
                <td>
                    {{ $dependants->gender }}
                </td>
                <td>
                    {{ $dependants->rank }}
                </td>
                <td>
                    {{ $dependants->qualification }}
                </td>
                <td>
                    {{ $dependants->permanent_address }}
                </td>
                <td>
                    {{ $dependants->phone_no }}
                </td>
                <td>
                    {{ $dependants->passport_no }}
                </td>
                <td>
                    @if ($dependants->status == 1)
                        Active
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>