@extends('layouts.default')
@section('content')
    <?php
//    echo Form::open(array('url' => '/checkConsuming'));
//
//    echo Form::label('beverage', 'Beverage');
//    echo Form::select('beverage', array('75' => 'Monster Ultra Sunrise', '95' => 'Black Coffee', '77' => 'Americano', '130' => 'Sugar free NOS', '200' => '5 Hour Energy'));
//    echo '<br/>';
//
//    echo Form::submit('Check');
//    echo Form::close();
    ?>

    <form action="{{route('checkBeveragesConsumption')}}" method="post">
        @csrf
        <div class="mb-3 mt-3">
            <label for="beverage" class="form-label">Select Beverage:</label>
            {{--<select name="beverage"class="form-select" required>--}}
                {{--<option value="">Select</option>--}}
                {{--<option value="75">Monster Ultra Sunrise</option>--}}
                {{--<option value="95">Black Coffee</option>--}}
                {{--<option value="77">Americano</option>--}}
                {{--<option value="130">Sugar free NOS</option>--}}
                {{--<option value="200">5 Hour Energy</option>--}}
            {{--</select>--}}
            <select name="beverage"class="form-select" required>
                <option value="">Select</option>
                @foreach($data as $row => $detail)
                    <option value="{{$detail['level']}}">{{$detail['name']}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Check</button>
    </form>
@stop