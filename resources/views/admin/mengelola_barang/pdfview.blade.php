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
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Nama Supplier</th>
			<th>Kategori Barang</th>
			<th>Jenis</th>
		</tr>
		@foreach ($products as $key => $product)
		<tr>
			<td>{{ ++$key }}</td>
			<td>{{ $product['kode_barang'] }}</td>
			<td>{{ $product['nama_barang'] }}</td>
			<td>{{ (isset($product['nama_supplier'])) ? $product['nama_supplier'] : ''}}</td>
			<td>{{ $product['kategori_barang'] }}</td>
			<td>{{ $product['jenis_barang'] }}</td>
		</tr>
		@endforeach

	</table>
</div>