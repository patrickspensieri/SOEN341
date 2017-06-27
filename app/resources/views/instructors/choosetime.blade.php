@extends('layouts.app')

@section('extra-content')
<!-- INSTRUCTOR TIME -->
<div class="row">
        <div class="profile-content">
          	<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Choose a Meeting Time
                        <div class="pull-right" align="center">
                        <!-- Form for changing the week -->
                        <form method="GET" action="/choosetime">
                        <button type="btn btn-default" name="prevWeek" value="prevWeek" class="btn btn-default btn-sm">Previous Week</button>
                        <button type="btn btn-default" name="nextWeek" value="nextWeek" class="btn btn-default btn-sm">Next Week</button>
                        <input type="hidden" name="instructor" value="{{$instructor->id}}">
                        <input type="hidden" name="weekStart" value="{{$week[0]}}">
                        <input type="hidden" name="weekEnd" value="{{$week[1]}}">
                        </form>
                    </div>
                    </div>
					<div class="panel-body">
                            <h4>{{$instructor->name}}</h4>
							<div class="row">
								<div class="col-md-12">
									<form id="instructor-times" method="POST" action="/instructorMeeting">
										{{csrf_field()}}
										<input type="hidden" name="currentWeek" value="{{$week[0]}}">
										<input type="hidden" name="instructor" value="{{$instructor->id}}">
                                        <div class="table-responsive">
										<?php
											date_default_timezone_set("America/New_York");
											echo "<table class='table'><thread><tr>";

												$i = $week[0];
												if(date("l", $i) != "Sunday"){
													while(date("l", $i) != "Sunday"){
														$i = strtotime("-1 day", $i);
													}
												}

												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

											echo "</tr></thread> <tbody> <tr> <td>";

												$day = "/^Sunday/s";

												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 6);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";

												$day = "/^Monday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 6);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";
											$day = "/^Tuesday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 7);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";
											$day = "/^Wednesday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 9);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";
											$day = "/^Thursday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 8);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";
											$day = "/^Friday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 6);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";
											$day = "/^Saturday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 8);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td></tr> </tbody></table>";
										?>
                                    </div>
										<button class="btn btn-default" type="submit" name="instructor-names-next">Add to Schedule</button>
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
		</div>
</div>
<!-- END INSTRUCTOR TIME -->
@endsection
@include('common')
