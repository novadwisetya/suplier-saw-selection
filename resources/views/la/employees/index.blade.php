@extends("la.layouts.app")

@section("contentheader_title", "Pengguna")
@section("contentheader_description", "")
@section("section", "Pengguna")
@section("sub_section", "")
@section("htmlheader_title", "Daftar Pengguna")

@section("headerElems")

	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Tambah Pengguna</button>

@endsection

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

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
            <th width="4%" class="center-align">Id</th>
            <th class="center-align" width="20%">Nama</th>
            <th class="center-align" width="21%">Alamat</th>
            <th class="center-align" width="26%">Email</th>
            <th class="center-align" width="9%">Aksi</th>
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>


<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Tambah Pengguna</h4>
			</div>
			{!! Form::open(['action' => 'LA\EmployeesController@store', 'id' => 'employee-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
              <div class="box-body">
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
                   		<label for="mobile">No. Telepon* :</label>
                   			<input class="form-control" placeholder="No. Telepon" data-rule-minlength="10" data-rule-maxlength="20" required="1" name="mobile" type="text" value="" aria-required="true">
                   	</div>
                   	<div class="form-group" style="display: none">
                   		<label for="mobile2">Alternative Mobile :</label>
                   		<input class="form-control" placeholder="Enter Alternative Mobile" data-rule-minlength="10" data-rule-maxlength="20" name="mobile2" type="text" value="">
                   	</div>
                   	<div class="form-group">
                   		<input type="hidden" name="_token_21" value="BJD4yarQDMzXtubfBBqiuWYS3kTuGiTFOMiNp2Zz">
                   			<label for="email">Email* :</label>
                   			<input class="form-control" placeholder="Email" data-rule-minlength="5" data-rule-maxlength="250"p field_id="21" adminroute="admin" row_id="0" required="1" data-rule-email="true" name="email" type="email" value="" aria-required="true">
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
                   		<textarea class="form-control" placeholder="Enter Address" data-rule-maxlength="1000" cols="30" rows="3" name="address">
                   			
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
					<div class="form-group" style="display: none;">
						<label for="role">Role* :</label>
						<select class="form-control select2-hidden-accessible" required="1" data-placeholder="Select Role" rel="select2" name="role" tabindex="-1" aria-hidden="true" aria-required="true">																											</select>
						<span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100px;">
						<span class="selection">
						<span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-role-10-container"><span class="select2-selection__rendered" id="select2-role-10-container" title="BAGIAN_PEMBELIAN">BAGIAN_PEMBELIAN</span>
						<span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span>
						</span>
						<span class="dropdown-wrapper" aria-hidden="true"></span></span>
					</div>
					<div class="form-group">
                   		<label for="dept">Bagian* :</label>
                   		<select class="form-control select2-hidden-accessible" required="1" data-placeholder="Enter Department" rel="select2" name="bagian" tabindex="-1" aria-hidden="true" aria-required="true">
                   			<option value="manager" selected>Manager</option>
                   			<option value="bagian_pembelian" selected>Bagian Pembelian</option>
                   		</select>
                   	</div>
                              <div class="form-group">
              <label for="password">Kata sandi :</label>
              <input class="form-control" id="password" placeholder="Kata Sandi" data-rule-maxlength="50" name="password" type="password" value="" required>
          </div>
          <div class="form-group">
              <label for="password">Konfirmasi Kata Sandi :</label>
              <input class="form-control" placeholder="Konfirmasi kata sandi" data-rule-maxlength="50" name="c_password" type="password" value="" required equalTo="#password">
          </div>
				</div>
					<div class="form-group" style="display: none">
						<label for="role">Role* :</label>
						<select class="form-control" required="1" data-placeholder="Select Role" rel="select2" name="role">
							<?php $roles = App\Role::all(); ?>
							@foreach($roles as $role)
								@if($role->id != 1)
									<option value="{{ $role->id }}">{{ $role->name }}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				{!! Form::submit( 'Simpan', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>


@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/employee_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#employee-add-form").validate({
		
	});
});
</script>
@endpush