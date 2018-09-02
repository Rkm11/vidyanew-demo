								@php
use App\Models\Certification;
@endphp
									<?php if (!empty($stu)) {?>
									@foreach ($stu as $details)
									<tr>
										<td>{{$details->stu_name}}</td>
										<td>
										@foreach($details->courses as $courses)
										<!-- <div class="col-md-4"> -->
											@php
											$course = Certification::select(['*'])->where('cer_cid', $courses->std_id)
											->where('cer_sid', $details->stu_id)->first();
											$isChecked=(1==$course->cer_issued)?'checked=""':'';
											@endphp
											&nbsp;&nbsp;<input {{$isChecked}} type="checkbox" onclick="updateData('{{$courses->std_id}}','{{$details->stu_id}}')" value="{{$courses->std_id}}">&nbsp;&nbsp;{{$courses->std_name}}
										<!-- </div> -->
										@endforeach
										</td>
									</tr>
									@endforeach
									<?php } else {?>
									<tr>
										<td colspan="2">No Records Found</td>
									</tr>
									<?php }?>
