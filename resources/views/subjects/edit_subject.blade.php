@extends('layouts.app')

@section('content')
	<div class="container" ng-controller="EditSubject">
		<div class=" col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Edit Subject
				</div>
				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					
 					<!-- Edit Subject Form  -->
					<form action="update" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<!--  Subject Name  -->
						<div class="form-group">
							<label for="subject-name" class="col-sm-3 control-label">Subject Name</label>

							<div class="col-sm-6">
								<input type="text" name="name" id="subject-name" class="form-control" value="{{ $subject->name }}">
							</div>
						</div>

						<!--  Subject Visibility --> 
						<div class="form-group">
							<label for="subject-visible" class="col-sm-3 control-label" style="padding-top:0;">Visible</label>
								<input type="radio" name="visible" value="0" <?php if ($subject->visible == 0) {echo "checked"; } ?> /> No
        						&nbsp;
        						<input type="radio" name="visible" value="1" <?php if ($subject->visible == 1) {echo "checked"; } ?> /> Yes							
						</div>

						<!--  Subject Position --> 
						<div class="form-group">
							<label for="subject-position" class="col-sm-3 control-label" style="padding-top:0;">Position</label>
								<select name="position">
									<?php 
										for($count=1; $count <= count($subjects); $count++) {
            								echo "<option value=\"{$count}\"";
								            if ($subject->position == $count) {
								              echo " selected";  
								            }
								            
								            echo ">{$count}</option>";
          								}    
							        ?>		         
								</select>				
						</div>

						<!--  Add Subject Button --> 
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-primary">
									Save
								</button>
								<a href="<?php echo url('/subjects'); ?>" type="button" class="btn btn-default">Back to Subjects</a>

							</div>
						</div>
					</form> 					
				</div>
			</div>
		</div>		
	</div>
@endsection
