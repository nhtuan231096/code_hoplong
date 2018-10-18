<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
/**
* 
*/
class ProductController extends Controller
{
	public function index()
	{	
		$products=Product::paginate(15);
		return view('admin.product.index',[
				'products'=>$products,
		]);
	}
}
 ?>