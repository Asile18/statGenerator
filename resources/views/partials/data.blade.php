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