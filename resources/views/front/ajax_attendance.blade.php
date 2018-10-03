
                  @if(!empty($attendanceDetails))
                  @foreach($attendanceDetails as $value)
                 <tr>
                    <td>{{$value->att_added}}</td>
                    @php
                    $attendance=($value->att_result)?'PRESENT':'ABSENT';
                    @endphp
                    <td>{{$attendance}}</td>
                  </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="2">No records Found</td>
                    </tr>
                  @endif