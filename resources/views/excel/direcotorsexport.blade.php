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
        @foreach ($directors as $key => $directors)
            <tr>
                <td>{{ ++$key }}</td>
                <td>
                    {{ $directors->name }}
                </td>
                <td>
                    {{ $directors->gender }}
                </td>
                <td>
                    {{ $directors->rank }}
                </td>
                <td>
                    {{ $directors->qualification }}
                </td>
                <td>
                    {{ $directors->permanent_address }}
                </td>
                <td>
                    {{ $directors->phone_no }}
                </td>
                <td>
                    {{ $directors->passport_no }}
                </td>
                <td>
                    @if ($directors->status == 1)
                        Active
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>