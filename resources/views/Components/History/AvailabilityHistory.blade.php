@if ($Date === date('Y-m-d'))
<tr class="today history Hide">
   <td>Today :: {{ $availabilityHistoryCounts['today'] }}</td>
</tr>
@elseif (
   $Date >= date('Y-m-d', strtotime('last Sunday')) AND
   !($Date > date('Y-m-d'))
)
<tr class="this-week history Hide">
   <td>This week :: {{ $availabilityHistoryCounts['thisWeek'] }}</td>
</tr>
@elseif (
   $Date >= date('Y-m-d', strtotime('last week Monday')) AND
   $Date < date('Y-m-d', strtotime('last Sunday'))
)
<tr class="last-week history Hide">
   <td>Last week :: {{ $availabilityHistoryCounts['lastWeek'] }}</td>
</tr>
@elseif ($Date < date('Y-m-d', strtotime('last week Monday')))
<tr class="older history Hide">
   <td>Older :: {{ $availabilityHistoryCounts['older'] }}</td>
</tr>
@endif
