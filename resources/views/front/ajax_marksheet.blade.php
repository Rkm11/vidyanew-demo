
                      @if(!empty($marksDetails))
                      <br><br>
                      @foreach ($marksDetails as $subject => $marks)
                      <tr style="border: 3px solid #d1d4e8;">
                        <th>Subject :</th>
                        <th> {{$subject}}</th>
                        <th></th>
                      </tr>

                       <tr>
                        <th><b>Exams</b></th>
                        <th><b>Date</b></th>
                        <th><b>Marks</b></th>
                      </tr>
                      @foreach ($marks as $key => $value)

                    <tr>
                      @php
                      $test_name=explode('-',$value->test_name);
                      @endphp
                      <th>{{$test_name[0]}}</th>
                      <td>{{$value->test_date}}</td>
                      <td>{{$value->mark_total}}/{{$value->test_outof}}</td>
                    </tr>
                    @endforeach

                      @endforeach
                      @else
                      <br>
                      <br>
                      <tr>
                        <th>Subject</th>
                        <th>Marks</th>
                        <th>Date</th>
                      </tr>
                      <tr style="border: 3px solid #d1d4e8;">
                        <th colspan="3">No records Found</th>
                      </tr>
                      @endif
