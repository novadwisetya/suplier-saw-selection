<style type="text/css">
	table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
	}

	td, th {
    	border: 1px solid #dddddd;
    	text-align: left;
    	padding: 8px;
	}

	tr:nth-child(even) {
    	background-color: #dddddd;
	}
</style>

<div class="container">
	<table>
		<tr>
			<th>No</th>
			<th>Kode Supplier</th>
			<th>Nama Supplier</th>
			<th>Alamat</th>
			<th>Phone</th>
			<th>Email</th>
		</tr>
		@foreach ($suppliers as $key => $supplier)
		<tr>
			<td>{{ ++$key }}</td>
			<td>{{ $supplier->kode_supplier }}</td>
			<td>{{ $supplier->nama_supplier }}</td>
			<td>{{ $supplier->alamat }}</td>
			<td>{{ $supplier->phone }}</td>
			<td>{{ $supplier->email }}</td>
		</tr>
		@endforeach

	</table>
</div>