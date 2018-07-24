<div id="view-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="box-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Supplier</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::label('kode_supplier', 'Kode Supplier', ['class' => 'col-sm-4 control-label']) !!}
                      <div class="col-md-6 value_kode_supplier" style="font-weight: 400;"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::label('name_supplier', 'Nama Supplier', ['class' => 'col-sm-4 control-label']) !!}
                      <div class="col-md-8 value_name_supplier" style="font-weight: 400;"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::label('alamat', 'Alamat', ['class' => 'col-sm-4 control-label']) !!}
                      <div class="col-md-6 value_alamat" style="font-weight: 400;"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::label('phone', 'No. Telepon', ['class' => 'col-sm-4 control-label']) !!}
                      <div class="col-md-6 value_phone" style="font-weight: 400;"></div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::label('email', 'Email', ['class' => 'col-sm-4 control-label']) !!}
                      <div class="col-md-6 value_email" style="font-weight: 400;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="delete-modal-cancel" href="#" class="btn btn-default" data-dismiss="modal">Batal</a>&nbsp;
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('[data-tables=true]').on('click', '[data-button=show]', function(e) {
            var id = $(this).data('id');

            var url = "{{route('ajax-get-data-supplier', ':id')}}";
            url = url.replace(':id', id);

            $.get(url, function(data, status){
                $('.value_kode_supplier').html(data.data.kode_supplier);
                $('.value_name_supplier').html(data.data.nama_supplier);
                $('.value_alamat').html(data.data.alamat);
                $('.value_phone').html(data.data.phone);
                $('.value_email').html(data.data.email);
            });

            // $('.name-view').html(name);
            // $('.periode-view').html(periode);
            // $('.image-view').html(image);
            $('#view-modal').modal('show');
            e.preventDefault();
        });
    });
</script>