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
            <th>နှုတ်ထွက်သည့်ရက်</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($foreign_technicians as $key => $foreign_technician)
            <tr>
                <td>{{ ++$key }}</td>
                <td>
                    {{ $foreign_technician->Name }}
                </td>
                <td>
                    {{ $foreign_technician->Gender }}
                </td>
                <td>
                    {{ $foreign_technician->Rank }}
                </td>
                <td>
                    {{ $foreign_technician->Qualification }}
                </td>
                <td>
                    {{ $foreign_technician->address }}
                </td>
                <td>
                    {{ $foreign_technician->phone_no }}
                </td>
                <td>
                    {{ $foreign_technician->PassportNo }}
                </td>
                <td>
                    {{ $foreign_technician->approved_date ? date('d F, Y', strtotime($foreign_technician->approved_date)) : '-' }}
                </td>
                <td>
                    @if ($foreign_technician->Status == 1)
                        Active
                    @elseif ($foreign_technician->Status == 3)
                        Resigned
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>