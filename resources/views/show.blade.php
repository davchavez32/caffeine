@extends('layouts.default')
@section('content')
    <div class="container mt-3">
        <h1>Selected Beverage Was: {{ $selectedBeverageWas[1] }} = {{$selectedBeverageWas[0]}}mg</h1>
        <br>
        <h3>Best Possible Combination of Beverages you can consume:</h3>
        <?php $priority = 1;?>
        @if($priority == 2)
            <br>
        @endif
        @foreach($data as $key => $array)
            @if($priority == 2)
                <br>
                <br>
                <h3>Other Combination:</h3>
            @endif
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Beverage Name</th>
                    <th>Consumption</th>
                    <th>Priority</th>
                </tr>
                </thead>
                <tbody>
                <?php $levelSum = 0;?>
                @foreach($array['data'] as $level => $beverageName)
                    <tr>
                        <td class="w-50">{{$beverageName}}</td>
                        <td>{{$level}}mg</td>
                        <td>{{$priority}}</td>
                    </tr>
                    <?php $levelSum += $level;?>
                @endforeach
                </tbody>
                <tfoot class="fw-bold">
                <tr>
                    <td>TOTAL</td>
                    <td>{{$levelSum}}mg + {{$selectedBeverageWas[0]}}mg = {{$levelSum+$selectedBeverageWas[0]}}mg </td>
                    @if($priority == 1)
                        <td class="bg-success">
                            <span>SAFE</span>
                        </td>
                    @else
                        <td class="bg-warning">
                            <span>LOW</span>
                        </td>
                    @endif
                </tr>
                </tfoot>
            </table>
            <?php $priority++;?>
        @endforeach
    </div>
@stop