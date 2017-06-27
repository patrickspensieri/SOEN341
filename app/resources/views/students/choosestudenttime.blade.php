@extends('layouts.app')

@section('extra-content')
<div class="row">
        <div class="profile-content">
          	<div class="col-md-12">
				<div class="panel panel-default">
                    <div class="panel-heading">Find a Study Buddy
                        <div class="pull-right" align="center">
                            <!-- Form for changing the week -->
                            <form method="GET" action="/requests/create">
                            <button type="btn btn-default" name="prevWeek" value="prevWeek" class="btn btn-default btn-sm">Previous Week</button>
                            <button type="btn btn-default" name="nextWeek" value="nextWeek" class="btn btn-default btn-sm">Next Week</button>
                            <input type="hidden" name="course" value="{{$course->id}}">
                            <input type="hidden" name="weekStart" value="{{$week[0]}}">
                            <input type="hidden" name="weekEnd" value="{{$week[1]}}">
                            </form>
                        </div>
                    </div>
                        <div class="panel-body">
                        <!-- Form for selecting a meeting time -->
						<form method="POST" action="/requests/create">
							<input type="hidden" name="course_id" value="{{$course->id}}">
                            <input type="hidden" name="currentWeek" value="{{$week[0]}}">
                            {{csrf_field()}}
                            <div class="table-responsive">
                            <table id="dataTable" class="table">
                                <!-- Create table headers, with dates for current week-->
                                <tr>
                                    <th>
                                        <label>Student</label></br>
                                    </th>
                                    @php
                                        $sunday = $week[0];
                                        while(date("l", $sunday) != "Sunday"){
                                            $sunday = strtotime("-1 day", $sunday);
                                        }
                                        $date = $sunday;
                                    @endphp
                                    @for($i = 0; $i < 7; $i++)
                                    <th>
                                    @php
                                        $display = date("D, M j", $date);
                                        $date = strtotime("+1 day", $date);
                                    @endphp
                                    <label>{{$display}}</label></br>
                                </th>
                                @endfor
                              </tr>
                              <!-- Add availabilities for each matched student-->
                              @php
                                $daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                              @endphp
                              <div class = "radio">
                              @if(!$students->isEmpty())
                                @foreach ($students as $student)
                                <tr>
                                    <td><h4>{{$student->name}}</h4></td>
                                    @for($i = 0; $i < 7; $i++)
                                        <td>
                                        @foreach ($matches[$student->id] as $match)
                                            @if (str_contains($match, $daysOfWeek[$i]))
                                            <label><input name="time" value="{{serialize(array($match, $student->id))}}" type="radio">{{ str_after($match, $daysOfWeek[$i]) }}</label></br>
                                            @endif
                                        @endforeach
                                    </td>
                                    @endfor
                                @endforeach
                                </tr>
                            @else
                                <p><Label>No student matches</Label></p>
                            @endif
                            </div>
                        </table></div>
							<button class="btn btn-default" type="submit" value="selection">Next</button>
							@if (count($errors))
								<div class='form-group'>
									<div class='alert alert-danger'>
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								</div>
							@endif
						</form>
					</div>
			</div>
		</div>
	</div>
</div>
@endsection
@include('common')
