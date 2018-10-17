<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Partners;
use Illuminate\Http\Request;
/**
* 
*/
class PartnersController extends Controller
{
	
	public function index()
	{
		$partners=Partners::paginate(15);
		return view('admin.partners.index',[
			'partners'=>$partners
			]);
	}
	public function addPartner(){
		return view('admin.partners.add');
	}	
	public function postAddPartner(Request $req){
		$this->validate($req,[
				'title' => 'required|min:6|unique:category,title',
				'slug' => 'required|min:6',
				'file_upload' => 'required',
				'link' => 'required'
			],[
				'title.required' => 'Tên không được để trống !!',
				'title.min' => 'Tiêu đề ít nhất :min ký tự',
				'title.unique' => 'Tiêu đề đã tồn tại',
				'slug.min' => 'Đường dẫn tĩnh ít nhất :min ký tự',
				'slug.required' => 'Đường dẫn không được để trống',
				'link.required' => 'Đường dẫn liên kết không được để trống',
				'file_upload.required' => 'Bạn chưa chọn ảnh'
			]);
		if ($req->hasFile('file_upload')) {
			$img='';
			$file=$req->file_upload;
			$file->move(base_path('uploads/partner'),$file->getClientOriginalName());
			$img=$file->getClientOriginalName();
			$req->merge(['cover_image'=>$img]);
			$addCategory=Partners::create($req->all());
			if($addCategory)
			{
				return redirect()->route('partners')->with('success','Thêm mới hãng sản phẩm thành công');
			}
			else
			{
				return redirect()->route('partners')->with('errors','Có lỗi khi thêm mới');
			}
		}
	}
	public function editPartner($id){
		$partner=Partners::find($id);
		return view('admin.partners.edit',[
			'partner'=>$partner
			]);
	}
	public function postEditPartner($id,Request $req){
		$this->validate($req,[
				'title' => 'required|min:6',
				'slug' => 'required|min:6',
				'file_upload' => 'required',
				'link' => 'required'
			],[
				'title.required' => 'Tên không được để trống !!',
				'title.min' => 'Tiêu đề ít nhất :min ký tự',
				'slug.min' => 'Đường dẫn tĩnh ít nhất :min ký tự',
				'slug.required' => 'Đường dẫn không được để trống',
				'link.required' => 'Đường dẫn liên kết không được để trống'
			]);
		if ($req->hasFile('file_upload')) {
			$editCategory = Partners::find($id);
			$img = $editCategory->file_upload;
			$file = $req->file_upload;
			$file->move(base_path('uploads/partner'),$file->getClientOriginalName());
			$img = $file->getClientOriginalName();
			$req->merge(['cover_image'=>$img]);
			// dd($req->all());
			$update = $editCategory->update($req->all());
			if($update)
			{
				return redirect()->route('partners')->with('success','Cập nhật hãng sản phẩm thành công');
			}
			else
			{
				return redirect()->back()->with('errors','Có lỗi cập nhật');
			}
		}
	}	
	public function deletePartner($id){
		$delete=Partners::find($id)->delete();
		if ($delete)
		{
			return redirect()->back()->with('success','Xóa thành công');
		}
		else
		{
			return redirect()->back()->with('errors','Có lỗi khi xóa');
		}
	}
}
?>