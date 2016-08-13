@extends('layouts.app')

@section('content')
	<div class="container" ng-controller="EditPage">
		<div class=" col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Edit Page
				</div>
				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					
 					<!-- Edit Page Form  -->
					<form action="update" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<!--  Page Title  -->
						<div class="form-group">
							<label for="page-name" class="col-sm-3 control-label">Page Title</label>

							<div class="col-sm-6">
								<input type="text" name="title" id="page-name" class="form-control" value="{{ $page->title }}">
							</div>
						</div>
						<!-- Page Subject -->
						<div class="form-group">
							<label for="page-name" class="col-sm-3 control-label">Page Subject</label>
							<div class="col-sm-6">
							<select name="subject_id" class="form-control">
								@foreach ($subjects as $sub)																								 
									<option {{{ $sub->id == $model->getSubjectId($page)->implode('id', ', ') ? 'selected="selected"' :'' }}}  value="{{ $sub->id }}">{{ $sub->name }}</option>
								@endforeach
							</select>
							</div>
						</div>

						<!--  Page Visibility --> 
						<div class="form-group">
							<label for="page-visible" class="col-sm-3 control-label" style="padding-top:0;">Visible</label>
								<input type="radio" name="visible" value="0" <?php if ($page->visible == 0) {echo "checked"; } ?> /> No
        						&nbsp;
        						<input type="radio" name="visible" value="1" <?php if ($page->visible == 1) {echo "checked"; } ?> /> Yes							
						</div>

						<!--  Page Content --> 
						<div class="form-group">
							<label for="page-position" class="col-sm-3 control-label" style="padding-top:0;">Content:</label>
								<div class="col-sm-6">
									<textarea class="form-control" rows="5" id="page-content" name="content" value="{{ $page->content }}">{{$page->content}}</textarea>				
								</div>
						</div>

						<!--  Add Page Button --> 
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-primary">
									Save
								</button>
								<a href="<?php echo url('/pages'); ?>" type="button" class="btn btn-default">Back to Pages</a>

							</div>
						</div>
					</form> 					
				</div>
			</div>
		</div>		
	</div>
@endsection
