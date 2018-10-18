<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
* 
*/
class Product extends Model
{
	protected $table='product';
	protected $fillable=['title','slug','created_by','short_description','content','feature','specifications','dimension','catalog','created_by','cover_image','meta_title','meta_description','meta_keywords','status','price','warranty','promotion','category_id','product_code','download_id','is_best_selle','is_promotion','is_new_product'
	];
	public function scopeSearch($query)
	{
		if(empty(request()->search))
		{
			return $query;
		}
		else
		{
			return $query->where('title','like','%'.request()->search.'%');
		}	
	}
	public function category()
		{
			return $this->hasOne('\App\Models\Category','id','category_id');
		}	
}
 ?>