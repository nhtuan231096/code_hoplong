<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
* 
*/
class Category extends Model
{
	protected $table='category';
	protected $fillable=[
		'title','slug','created_by','description','cover_image','status','parent_id'
	];
	public function scopeSearch($query)
		{
			if(empty(request()->search))
			{
				return $query;
			}
			if(!empty(request()->search) && empty(request()->created_by))
			{
				return $query->where('title','like','%'.request()->search.'%');
			}	
			// if(!empty(request()->created_by) && empty(request()->search))
			// {
			// 	return $query->where('created_by','=',request()->created_by);
			// }

	}
	public function childs()
		{
			return $this->hasMany('\App\Models\Category','parent_id','id');
		}	
}
 ?>