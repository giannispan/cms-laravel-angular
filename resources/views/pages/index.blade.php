@extends('layouts.app')

@section('content')
	<div class="container" ng-controller="Pages">
		<div class=" col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					New Page
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')


					<!-- New Page Form -->
					<form action="page" method="POST" class="form-horizontal">
						{{ csrf_field() }}

						<!-- Page Title -->
						<div class="form-group">
							<label for="page-name" class="col-sm-3 control-label">Page Title</label>

							<div class="col-sm-6">
								<input type="text" name="title" id="page-name" class="form-control" value="{{ old('page') }}">
							</div>
						</div>

						<!-- Page Subject -->
						<div class="form-group">
							<label for="page-name" class="col-sm-3 control-label">Page Subject</label>
							<div class="col-sm-6">
							<select name="subject_id" class="form-control">
								@foreach ($subjects as $sub)
									<option value="{{ $sub->id }}">{{ $sub->name }}</option>
								@endforeach
							</select>
							</div>
						</div>

						<!-- Page Visibility -->
						<div class="form-group">
							<label for="page-name" class="col-sm-3 control-label" style="padding-top:0;">Visible</label>
								<input type="radio" name="visible" value="0" /> No
        						&nbsp;
        						<input type="radio" name="visible" value="1" /> Yes	
						</div>
						
						<!--  Page Content --> 
						<div class="form-group">
							<label for="page-position" class="col-sm-3 control-label" style="padding-top:0;">Content:</label>
								<div class="col-sm-6">
									<textarea class="form-control" rows="5" id="page-content" name="content" value="{{ old('page') }}"></textarea>				
								</div>
						</div>

						<!-- Add Page Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-plus"></i>Add Page
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<!-- Current Pages -->
			@if (count($pages) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						My Pages
					</div>

					<div class="panel-body">
						<table class="table table-striped page-table">
							<thead>
								<th>Page</th>
								<th>&nbsp;</th>
							</thead>
							<tbody>
								@foreach ($pages as $page)
									<tr>
										<td class="table-text"><div>{{ $page->title }}</div></td>

										<!-- Page Edit Button -->
										<td>
											<form action="page/{{ $page->id }}/edit" method="GET">
												{{ csrf_field() }}
												{{ method_field('GET') }}

												<button type="submit" id="edit-page-{{ $page->id }}" class="btn btn-primary">
													<i class="fa fa-btn fa-pencil"></i>Edit
												</button>
											</form>
										</td>

										<!-- Page Delete Button -->
										<td>
											<form action="page/{{ $page->id }}" method="POST">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}

												<button type="submit" id="delete-page-{{ $page->id }}" class="btn btn-danger">
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
			<a href="./subjects" type="button" class="btn btn-success" style="float:right;">My Subjects</a>
		</div>
	</div>
@endsection
