@extends('layouts.app')

@section('content')
	<div class="container" ng-controller="SubjectController">	
		<div class=" col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					New Subject
				</div>
				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')


 					<!-- New Subject Form  -->
					<form action="subject" method="POST" class="form-horizontal">
						{{ csrf_field() }}

						<!--  Subject Name  -->
						<div class="form-group">
							<label for="subject-name" class="col-sm-3 control-label">Subject Name</label>

							<div class="col-sm-6">
								<input type="text" name="name" id="subject-name" class="form-control" value="{{ old('subject') }}">
							</div>
						</div>

						<!--  Subject Visibility --> 
						<div class="form-group">
							<label for="subject-visible" class="col-sm-3 control-label" style="padding-top:0;">Visible</label>
								<input type="radio" name="visible" value="0" /> No
        						&nbsp;
        						<input type="radio" name="visible" value="1" /> Yes							
						</div>

						<!--  Subject Position --> 
						<div class="form-group">
							<label for="subject-position" class="col-sm-3 control-label" style="padding-top:0;">Position</label>
								<select name="position">
									<?php 
										for($count=1; $count <= (count($subjects) + 1); $count++) {
            								echo "<option value=\"{$count}\">{$count}</option>";
          								}    
							        ?>
								</select>			
						</div>

						<!--  Add Subject Button --> 
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-plus"></i>Add Subject
								</button>
							</div>
						</div>
					</form> 
				</div>
			</div>

			<!-- Current Subjects -->
			@if (count($subjects) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						My Subjects
					</div>
					<div class="panel-body">
						<table class="table table-striped page-table">
							<thead>
								<th>Subject</th>
								<th>&nbsp;</th>
							</thead>
							<tbody>
								@foreach ($subjects as $subject) 
									<tr>
										<td class="table-text"><div>{{ $subject->name }}</div></td>

										<!-- Page Edit Button -->
										<td>
											<form action="subject/{{ $subject->id }}/edit" method="GET">
												{{ csrf_field() }}
												{{ method_field('GET') }}

												<button type="submit" id="edit-subject-{{ $subject->id }}" class="btn btn-primary">
													<i class="fa fa-btn fa-pencil"></i>Edit
												</button>
											</form>
										</td>

										<!-- Page Delete Button -->
										<td>
											<form action="subject/{{ $subject->id }}" method="POST">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}

												<button type="submit" id="delete-subject-{{ $subject->id }}" class="btn btn-danger">
													<i class="fa fa-btn fa-trash"></i>Delete
												</button>
											</form>

										</td>
										
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif
		</div>
		<div class=" col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					My Content
				</div>
				<div class="panel-body">
					<table class="table table-striped page-table">
							<tbody>
								@foreach ($subjectsVisible as $subject) 
									<tr>
										<td class="table-text">
											<div>
												<b>{{ $subject->name }}</b>
											</div>
											@foreach ($model->showPages($subject) as $page)
											<div>
												{{ $page->title }}
											</div>
											@endforeach
										</td>	
									</tr>
								@endforeach
							</tbody>
						</table>
				</div>
			</div>
			<a href="./pages" type="button" class="btn btn-success" style="float:right;">My Pages</a>
		</div>
	</div>
@endsection
