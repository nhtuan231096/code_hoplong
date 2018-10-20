<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
/**
* 
*/
class CategoryController extends Controller
{
	
	public function index()
	{	
		// $parents=[];
		// $parentid=Category::all();
		// for($i=1;$i<=count($parentid);$i++){
		// 	if(($parentid->parent_id)==null){
		// 		$parents=$parentid;
		// 	}
		// }
		$category=Category::orderBy('id','DESC')->paginate(15);
		$parent=Category::all();
		// dd($category);
		return view('admin.category.index',[
				'cates'=>$category,
				'parent'=>$parent
			]);
	}
	public function postCategory(Request $req){
		// $this->validate($req,[
		// 		'title' => 'required|min:6|unique:category,title',
		// 		'slug' => 'required|min:6',
		// 		'upload_file' => 'required'
		// 	],[
		// 		'title.required' => 'Tiêu đề không được để trống !!',
		// 		'title.min' => 'Tiêu đề ít nhất :min ký tự',
		// 		'title.unique' => 'Tiêu đề đã tồn tại',
		// 		'slug.min' => 'Đường dẫn tĩnh ít nhất :min ký tự',
		// 		'slug.required' => 'Đường dẫn không được để trống',
		// 	]);
		$img='';
		$file=$req->upload_file;
		$file->move(base_path('uploads/category'),$file->getClientOriginalName());
		$img=$file->getClientOriginalName();
		$req->merge(['cover_image'=>$img]);
		$addCategory=Category::create($req->all());
		// dd($req->all());
		if ($addCategory) {
			return redirect()->route('category')->with('success','Thêm mới danh mục thành công');
		}
		else
		{
			return redirect()->back()->with('error','Thêm mới danh mục không thành công');
		}
	}
		public function search(Request $req){
			$category=where('title','like','%'.request()->search.'%')->get();
			return view('admin.category.index',[
					'cates'=>$category
				]);
		}
		public function deleteCategory($id){
			$deleteCate=Category::find($id)->delete();
			if ($deleteCate) 
			{
				return redirect()->back()->with('success','Xóa danh mục thành công');
			}
			else
			{
				return redirect()->back()->with('errors','Có lỗi khi xóa');
			}
		}
		public function editCategory($id){
			$cate=Category::find($id);
			return view('admin.category.edit',[
				'cate'=>$cate
			]);
		}
		public function postedit($id,Request $req){
		$this->validate($req,[
			'title' => 'required|min:5',
			'slug' => 'required|min:5'
		],[
			'title.required' => 'Tiêu đề không được để trống !!',
			'title.min' => 'Tiêu đề ít nhất :min ký tự',
			'slug.min' => 'Đường dẫn tĩnh ít nhất :min ký tự',
			'slug.required' => 'Đường dẫn không được để trống',
		]);

		$editCategory=Category::find($id);
		$img=$editCategory->cover_image;
		if($req->hasFile('cover_image')) {
			$file=$req->upload_file;
			$file->move(base_path('uploads/category'),$file->getClientOriginalName());
			$img=$file->getClientOriginalName();
			$req->merge(['cover_image'=>$img]);
		}
		$editCategory->update($req->all());	
		if($editCategory)
		{
			return redirect()->route('category')->with('success','Cập nhật danh mục thành công');
		}
		else
		{
			return redirect()->route('category')->with('error','Có lỗi khi cập nhật');
		}
	}
}
 ?>