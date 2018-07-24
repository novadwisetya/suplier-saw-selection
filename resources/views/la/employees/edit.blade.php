@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/employees') }}">Pengguna</a> 
@endsection
@section("contentheader_description", '')
@section("section", "Pengguna")
@section("section_url", url(config('laraadmin.adminRoute') . '/employees'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Ubah Pengguna")

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($employee, ['route' => [config('laraadmin.adminRoute') . '.employees.update', $employee->id ], 'method'=>'PUT', 'id' => 'employee-edit-form']) !!}
					<div class="form-group">
                    	<label for="name">Nama* :</label>
                    		<input class="form-control" placeholder="Nama" data-rule-minlength="5" data-rule-maxlength="250" required="1" name="name" type="text" value="" aria-required="true">
                    </div>
                    <div class="form-group" style="display: none">
                    	<label for="designation">Designation* :</label>
                    	<input class="form-control" placeholder="Enter Designation" data-rule-maxlength="50" required="1" name="designation" type="text" value="abaadsfasdfa" aria-required="true">
                    </div>
                    <div class="form-group">
                    	<label for="gender">Jenis Kelamin* : </label>
                    	<br>
                    	<div class="radio">
	                    	<label>
	                    		<input checked="checked" name="gender" type="radio" value="Male">
	                    		Laki-laki 
	                    	</label>
	                    	<label>
	                    		<input name="gender" type="radio" value="Female"> Perempuan </label>
                   		</div>
                   	</div>
                   	<div class="form-group">
                   		<label for="mobile">Telp* :</label>
                   			<input class="form-control" placeholder="Telepon" data-rule-minlength="10" data-rule-maxlength="20" required="1" name="mobile" type="text" value="" aria-required="true">
                   	</div>
                   	<div class="form-group" style="display: none">
                   		<label for="mobile2">Alternative Mobile :</label>
                   		<input class="form-control" placeholder="Enter Alternative Mobile" data-rule-minlength="10" data-rule-maxlength="20" name="mobile2" type="text" value="">
                   	</div>
                   	<div class="form-group">
                   		<input type="hidden" name="_token_21" value="BJD4yarQDMzXtubfBBqiuWYS3kTuGiTFOMiNp2Zz">
                   			<label for="email">Email* :</label>
                   			<input class="form-control" placeholder="Email" data-rule-minlength="5" data-rule-maxlength="250" data-rule-unique="true" field_id="21" adminroute="admin" row_id="0" required="1" data-rule-email="true" name="email" type="email" value="" aria-required="true">
                   	</div>
                   	<div class="form-group" style="display: none;">
                   		<label for="dept">Department* :</label>
                   		<select class="form-control select2-hidden-accessible" required="1" data-placeholder="Enter Department" rel="select2" name="dept" tabindex="-1" aria-hidden="true" aria-required="true">
                   			<option value="1" selected>Administration</option>
                   		</select>
                   			<span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100px;">
                   			<span class="selection">
                   			<span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-dept-rr-container">
                   			<span class="select2-selection__rendered" id="select2-dept-rr-container" title="Administration">Administration</span>
                   			<span class="select2-selection__arrow" role="presentation">
                   			<b role="presentation"></b>
                   			</span>
                   			</span>
                   			</span>
                   			<span class="dropdown-wrapper" aria-hidden="true">
                   				
                   			</span>
                   			</span>
                   	</div>
                   	<div class="form-group">
                   		<label for="city">Kota :</label>
                   		<input class="form-control" placeholder="Kota" data-rule-maxlength="50" name="city" type="text" value="">
                   	</div>
                   	<div class="form-group">
                   		<label for="address">Alamat :</label>
                   		<textarea class="form-control" placeholder="Alamat" data-rule-maxlength="1000" cols="30" rows="3" name="address">
                   			
                   		</textarea>
                   	</div>
                   	<div class="form-group" style="display: none">
                   		<label for="about">About :</label>
                   		<input class="form-control" placeholder="Enter About" name="about" type="text" value="">
                   	</div>
                   	<div class="form-group" style="display: none;">
                   		<label for="date_birth">Date of Birth :</label>
                   		<div class="input-group date">
                   			<input class="form-control" placeholder="Enter Date of Birth" name="date_birth" type="text" value="01/01/1990">
                   		<span class="input-group-addon">
                   		<span class="fa fa-calendar"></span>
                   		</span>
                   		</div>
                   	</div>
                   	<div class="form-group" style="display: none">
                   		<label for="date_hire">Hiring Date :</label>
                   		<div class="input-group date">
                   		<input class="form-control" placeholder="Enter Hiring Date" name="date_hire" type="text" value="01/01/1970">
                   		<span class="input-group-addon">
                   		<span class="fa fa-calendar">
                   			
                   		</span>
                   		</span>
                   	</div>
                   	</div> 
                   	<div class="form-group" style="display: none">
                   		<label for="date_left">Resignation Date :</label>
                   		<div class="input-group date">
                   			<input class="form-control" placeholder="Enter Resignation Date" name="date_left" type="text" value="01/01/1990">
                   			<span class="input-group-addon">
                   			<span class="fa fa-calendar">
                   				
                   			</span>
                   			</span>
                   		</div>
                   	</div>
                   	<div class="form-group" style="display: none">
                   		<label for="salary_cur">Current Salary :</label>
                   		<input class="form-control" placeholder="Enter Current Salary" name="salary_cur" type="number" value="0.0">
                   	</div>		

                    <div class="form-group" style="display: none">
          						<label for="role">Role* :</label>
          						<select class="form-control" required="1" data-placeholder="Select Role" rel="select2" name="role">
          							<?php $roles = App\Role::all(); ?>
          							@foreach($roles as $role)
          								@if($role->id != 1 || Entrust::hasRole("SUPER_ADMIN"))
          									@if($user->hasRole($role->name))
          										<option value="{{ $role->id }}" selected>{{ $role->name }}</option>
          									@else
          										<option value="{{ $role->id }}">{{ $role->name }}</option>
          									@endif
          								@endif
          							@endforeach
          						</select>
          					</div>

					<br>
					<div class="form-group">
						{!! Form::submit( 'Perbaharui', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/employees') }}">Batal</a></button>
					</div>
				{!! Form::close() !!}
				
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#employee-edit-form").validate({
		
	});
});
</script>
@endpush
