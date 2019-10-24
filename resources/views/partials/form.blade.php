
<form method="GET" action="/admin-rapport"> 
   
@csrf
<label>Udp Database</label>
<input {{ (request('requestmodel') == 'udp') ? 'checked' : ''}} checked type="radio" name="requestmodel" id="udp" value="udp">
<label >Astuce Credit Database</label>
<input {{(request('requestmodel') ==  'astuce') ? 'checked' : '' }} type="radio" name="requestmodel" id="astucecredit" value="astuce">


<select  name="dateFormat">
    <option {{request('dateFormat') == 'Y' ? 'selected' : '' }} name="year" value="Y">Year</option>
    <option {{request('dateFormat') == 'Y-m' ? 'selected' : '' }} name="month" value="Y-m">Year-Month</option>
    <option {{request('dateFormat') == 'Y-m-d' ? 'selected' : '' }} name="day"  value="Y-m-d">Year-Month-Day</option>
</select>
<div>
    <label for="datepicker">From:</label>
    <input name="datepicker" type="text" id="datepicker" value="{{request('datepicker')}}"/>
    <label for="datepicker2">To:</label>
    <input name="datepicker2" type="text" id="datepicker2" value="{{request('datepicker2')}}"/>
    <button type="submit">Rechercher</button>
</div>



<div style="display:flex;">
    <div style="margin: 10px;">
        <a  href="{{ url('/admin/export/csv?requestmodel=' . request('requestmodel') . '&dateFormat=' . request('dateFormat')  . '&datepicker=' . request('datepicker') . '&datepicker2=' . request('datepicker2')) }}" >Télécharger Prospects CSV</a><br>
        <a  href="{{ url('/admin/export/xlsx?requestmodel=' . request('requestmodel') . '&dateFormat=' . request('dateFormat') . '&datepicker=' . request('datepicker') . '&datepicker2=' . request('datepicker2')) }}">Télécharger Prospects EXCEL</a>
    </div>
</div>
</form>
