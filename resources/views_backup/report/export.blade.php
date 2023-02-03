<!DOCTYPE html>
<html lang="{{ \Lang::getLocale() }}">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</head>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        text-align: center;
    }

    th {
        width: 100px;
        font-weight: bold;

    }

    td {
        font-size: 15px;
    }

</style>

<body>
    <div class="container-fluid mt-5 ">
       
        <table>
            <thead>
                <tr>
                    <th rowspan="2">???</th>
                    <th rowspan="2">????</th>
                    <th rowspan="2">??????????</th>
                    <th rowspan="2">????</th>
                    <th rowspan="2">??????????????????????</th>
                    {{-- <th rowspan="2">??????????????????????</th> --}}
                    <th rowspan="2">??????????????????????</th>
                    <th rowspan="2">??????????????</th>
                    <th rowspan="2">????????????(???)</th>
                    <th rowspan="2">????????????(??)</th>
                    <th rowspan="2">????????????(????)</th>
                    <th rowspan="2">?????????????????/?????</th>
                    <th rowspan="2">??????????</th>
                    <th rowspan="2">Sector</th>
                    <th rowspan="2">???????????</th>
                      <th rowspan="2">??????</th>
                    <th rowspan="2">?????????????(????)?????????????????</th>
                  
                    <th colspan="3">??????????????</th>
                </tr>
                <tr>
                    <th style="width: 80px;">???</th>
                    <th style="width: 80px;">?</th>
                    <th style="width: 80px;">????</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $row)
                    <tr>
                        @foreach ($row as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>

</html>
