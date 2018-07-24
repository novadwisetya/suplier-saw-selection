<div id="view-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="box-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Barang</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::label('kode_barang', 'Kode Barang', ['class' => 'col-sm-4 control-label']) !!}
                      <div class="col-md-6 value_kode_barang" style="font-weight: 400;"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::label('nama_barang', 'Nama Barang', ['class' => 'col-sm-4 control-label']) !!}
                      <div class="col-md-6 value_nama_barang" style="font-weight: 400;"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::label('kategori_barang', 'Kategori Barang', ['class' => 'col-sm-4 control-label']) !!}
                      <div class="col-md-8 value_kategori_barang" style="font-weight: 400;"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      {!! Form::label('jenis_barang', 'Jenis Barang', ['class' => 'col-sm-4 control-label']) !!}
                      <div class="col-md-6 value_jenis_barang" style="font-weight: 400;"></div>
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

            var url = "{{route('ajax-get-data-barang-show', ':id')}}";
            url = url.replace(':id', id);

            $.get(url, function(data, status){
                console.log(data);
                $('.value_kode_barang').html(data.data.kode_barang);
                $('.value_nama_barang').html(data.data.nama_barang);
                $('.value_kategori_barang').html(data.data.kategori_barang);
                $('.value_jenis_barang').html(data.data.jenis_barang);
            });
            $('#view-modal').modal('show');
            e.preventDefault();
        });
    });
</script>