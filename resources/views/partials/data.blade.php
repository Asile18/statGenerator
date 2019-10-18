@if ($statsView !== null)
    @foreach ($statsView as $date  => $relations)
    <button class="accordion"><b>{{$date}}</b></button>
    <div class="panel">
        @foreach ($relations as $relationName => $relationValues)
            <div>
                <h3>{{$relationName}}</h3>
                    @foreach ($relationValues as $relationValueKey=>$relationValue )
                        <p>{{$relationValueKey }}: {{$relationValue }}</p>
                    @endforeach
                    <p style="text-align: right !important; text-decoration:underline;">{{$relationName }} total: {{$relationValues->sum()}}</p>
            </div>
        @endforeach
    </div>
    <hr style="border-top: 2px solid #dee2e6;">
    @endforeach 
@endif
