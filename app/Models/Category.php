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
		'title','slug','created_by','description','cover_image','status'
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
	public function childs()
		{
			return $this->hasMany('\App\Models\Category','parent_id','id');
		}	
}
 ?>