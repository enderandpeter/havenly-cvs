@extends('layouts.product')

@section('home')
Home
@endsection

@section('body-content')
<div class="container-fluid main">
	@if( session( 'status' ) === 'success' )
		<div class="alert alert-success" role="alert">
		  <strong>Well done!</strong> You successfully imported the CSV data.
		</div>
	@endif
	
	@if( session( 'status' ) === 'error' )
		<div class="alert alert-danger" role="alert">
		  <strong>Attention!</strong> The CSV data was not uploaded
		</div>
	@endif
	<h1 class="mx-auto title">Havenly CSV Uploader</h1>
	@if( $products->isEmpty() )
		<p>There are currently no products</p>
	@else
		<table id="product_table" class="mt-5 mb-5 table">
			<thead>
			<tr>
				<th>SKU</th>
				<th>Title</th>
				<th>Price</th>
				<th>Description</th>
				<th>Availability</th>
				<th>Color</th>
				<th>Dimensions</th>
			</tr>
			</thead>
			<tbody>
			@foreach( $products as $product )
				<tr>
					<td>{{ $product->sku }}</td>
					<td>{{ $product->title }}</td>
					<td>{{ money_format('%n', $product->price) }}</td>
					<td>{{ $product->description }}</td>
					<td>{{ $product->availability }}</td>
					<td>{{ $product->color }}</td>
					<td>{{ $product->dimensions }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>	
	@endif
	<form class="form-inline" id="csv-file-form" enctype="multipart/form-data" method="post" action="{{ route( 'product.upload' ) }}">
		<label id="csv-file-label" class="custom-file">
			<input class="form-control-file" type="file" id="csv-file" name="csv-file" />
			<span class="custom-file-control"></span>
		</label>
		{{ csrf_field() }}
		<button type="submit" name="submit" value="upload" class="btn btn-primary ml-2">Upload</button>
	</form>
	<div class="instructions">
		<h2 class="mt-2">Instructions:</h2>
		<p>Upload a CSV file that contains the following fields in the following order:</p>
		<ul>
			<li>sku: <code>string</code></li>
			<li>title: <code>string</code></li>
			<li>price: <code>float</code></li>
			<li>description: <code>string</code></li>
			<li>availability: <code>boolean</code> (Please use either <strong>1</strong> or <strong>0</strong>)</li>
			<li>color: <code>string</code></li>
			<li>dimensions: <code>string</code></li>
		</ul>
		<p>The file may optionally start with a header row, but it will simply be discarded as the above defined order is required.</p>
		<p>Please only use commas (<code>,</code>) to delimit fields</p>
		<p>All uploaded files will have their data submitted in the database and shown on this page</p>
		<p>A new record is created for all new SKUs</p>
		<p>If uploading records with an existing SKU, the price and availability will be updated</p>
	</div>
</div>
@endsection