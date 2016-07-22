@extends('app')

@section('content')

    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">
        function search() {
            var $rows = $('#myTable, #rows');

            var val = $.trim($('#search').val()).replace('/ +/g', '').toLowerCase();

            $rows.show().filter(function () {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        }

    </script>

    <style type="text/css">
        #head { height: 50px; background-color: #4CAF50; color: white; }
        table, td, th { border: 1px solid black; }
        table { border-collapse: collapse; width: 100%; margin: 5px; }
        td { padding: 5px; }
        tr:hover{background-color:#f5f5f5}
        #searchForm { margin: 5px; }

    </style>

    <div id="searchForm">
        <input type="text" id="search" placeholder="Search..." />
        <button id="searchBtn" onclick="search()">Search</button>
    </div>

    <div>
        <table>
            <tr id="head">
                <td>Id</td>
                @foreach($arrayMain as $key => $value)
                    <td id="{{$key}}"><b>{{ $key }}</b></td>
                @endforeach
                <td>Processed Time</td>
            </tr>
            <div id="myTable">
            @foreach($rowsId as $key => $value)
            <tr id="rows">
                <!--ROWS ID's-->
                <td>{{ $value }}</td>

                <!--DATA-->
                @foreach($arrayMain as $key2 => $value2)
                    @if(array_key_exists($value, $value2))
                        <td>{{ $value2[$value] }}</td>
                    @else
                        <td>&nbsp;</td>
                        @endif
                @endforeach

                <!--TIME STAMPS-->
                @if(array_key_exists($value, $arrayProcessedTime))
                    <td>{{ $arrayProcessedTime[$value] }}</td>
                @else
                    <td>&nbsp;</td>
                @endif

            </tr>
            @endforeach
            </div>
        </table>
    </div>
@endsection