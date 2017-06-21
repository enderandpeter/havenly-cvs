<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller {
	public function home() {
		setlocale(LC_MONETARY, 'en_US');
		
		$data = [ 
				'products' => Product::all () 
		];
		
		return view ( 'product.home', $data );
	}
	public function upload(Request $request) {
		$headings = [ 
				'sku',
				'title',
				'price',
				'description',
				'availability',
				'color',
				'dimensions' 
		];
		$status = [
				'status' => 'error'
		];
		if ($request->hasFile ( 'csv-file' ) && $request->file('csv-file')->isValid ( )) {
			$product_csv = $request->file ( 'csv-file' );
			
			$product_csv_file = $product_csv->openFile('r');
			
			$product_csv_file->setFlags ( \SplFileObject::READ_CSV | \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE );
			foreach ( $product_csv_file as $row ) {
				// Ignore the row if it doesn't have the expected number of fields
				if (count ( $row ) !== count ( $headings )) {
					continue;
				}
				
				$price_key = array_search ( 'price', $headings );
				$availability_key = array_search ( 'availability', $headings );
				/*
				 * Ignore the row if the price field is not numeric or
				 * the availability field is not 1 or 0.
				 */
				if ( !(isset ( $row [$price_key] ) && is_numeric ( $row [$price_key] )) || !(isset ( $row [$availability_key] ) && ($row [$availability_key] === '1' || $row [$availability_key] === '0'))) {
					continue;
				}
				$headings_column = 0;
				foreach ( $row as $column ) {
					$columnData [$headings [$headings_column ++]] = $column;
				}
				if( isset( $columnData['sku'] ) ){
					$exiting_product = Product::where( 'sku', $columnData['sku'] );
					if( $exiting_product->get()->isEmpty() ){
						Product::create ( $columnData );
					} else {
						$exiting_product->update( [
							'price' => $columnData['price'],
							'availability' => $columnData['availability']
						]);
					}
				}
			}
			$status = [
				'status' => 'success'	
			];
		}
		
		return redirect ( route ( 'product.home' ) )->with( $status );
	}
}
