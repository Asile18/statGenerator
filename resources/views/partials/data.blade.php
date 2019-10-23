{{-- @if ($statsView !== null)
    @foreach ($statsView as $date  => $relations)
    <button class="accordion"><b>{{$date}}</b></button>
    <div class="panel">
        @foreach ($relations as $relationName => $relationValues)
                <h3>{{$relationName}}</h3>
                    @foreach ($relationValues as $relationValueKey=>$relationValue )
                        <p>{{$relationValueKey }}: {{$relationValue }}</p>
                    @endforeach
                    <p style="text-align: right !important; text-decoration:underline;">{{$relationName }} total: {{$relationValues->sum()}}</p>
        @endforeach
    </div>
    @endforeach 
@endif --}}

@if ($statsView !== null)
@foreach ($statsView as $date  => $relations)
<table class="statTable">

    <thead class="accordion">
        <tr>
            <th class="statDate"><b>{{$date}}</b></th>
        </tr>
    </thead>
    <tbody class="panel">
    @foreach ($relations as $relationName => $relationValues)
        <tr>
            <td class="statRelation"><b>{{$relationName}}</b></td>
        </tr>
        @foreach ($relationValues as $relationValueKey=>$relationValue )
        <tr>
            <td>{{$relationValueKey}}:</td>
            <td>{{$relationValue}}</td>
        </tr>
        @endforeach
        <tr class="totalRow">
            <td class="totalName">{{$relationName }} total:</td>
            <td class="totalValue">{{$relationValues->sum()}}</td>
        </tr>
    @endforeach
    </tbody>

</table>
@endforeach 
@endif