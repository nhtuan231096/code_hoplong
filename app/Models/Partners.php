<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
* 
*/
class Partners extends Model
{
	protected $table='partners';
	protected $fillable=[
		'title','slug','created_by','cover_image','cover_image','status','link'
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
}
 ?>