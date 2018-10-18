<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User_group;
use Illuminate\Http\Request;
/**
* 
*/
class Account_groupController extends Controller
{
	
	function account_group()
	{
		$user_group=User_group::all();
		// dd($user_group);
		return view('admin.account_group.index',[
			'user_group'=>$user_group
			]);
	}
	public function addUserGroup(Request $req){
		if(User_group::create($req->all()))
		{
			return redirect()->back()->with('success','Tạo mới thành công');
		}
		else
		{
			return redirect()->back()->with('error','Có lỗi khi tạo mới');
		}
	}
	public function deleteGroup($id){
		$delete=User_group::find($id)->delete();
		if ($delete) 
		{
			return redirect()->back()->with('success','Xóa thành công');		
		}
		else
		{
			return redirect()->back()->with('error','Có lỗi khi xóa');	
		}
	}
	public function editGroup($id){
		$group=User_group::find($id);
		return view('admin.account_group.edit',[
			'group'=>$group
			]);
	}
	public function postEditGroup($id,Request $req){
		$this->validate($req,[
			'title'=>'required|min:3|unique:user_group,title,'.$id,
			],[
			'title.required' => 'Tên nhóm không được để trống',
			'title.min' => 'Tên nhóm ít nhất :min ký tự',
			'title.unique' => 'Tên nhóm đã tồn tại'
			]);
		$update=User_group::find($id)->update($req->all());
		if ($update) 
		{
			return redirect()->route('account_group')->with('success','Cập nhật thành công');
		}
		else
		{
			return redirect()->back()->with('error','Lỗi khi cập nhật');
		}
	}	
}
?>