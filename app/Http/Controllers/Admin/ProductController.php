<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Validator;
use Response;
use Illuminate\Http\Request;
use App\Models\Product;
use App\User;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myPost()
    {
        $cates=Category::where('status','enable')->get();
        $users=User::all();
        return view('admin.product.index',[
            'cates'=>$cates,
            'users'=>$users,
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Product::Where('status','enable')->orWhere('status','disable')->latest()->paginate(12);
        return response()->json($post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return response()->json($request->upload_file);die;
       // return response()->json($request->all());die;

        // $this->validate($request,[
        //     'title'=>'required|unique:product,title',
        //     'slug'=>'required|unique:product,slug'
        // ],[
        //     'title.required'=>'Ten khong duoc de trong',
        //     'slug.required'=>'Duong dan khong duoc de trong',
        //     'slug.unique'=>'Duong dan da ton tai',
        //     'title.unique'=>'Ten da ton tai'
        // ]);
        $validator = \Validator::make($request->all(), [
            'title' => 'required|unique:product,title',
            'slug' => 'required|unique:product,slug',
            'category_id' => 'required',
            'meta_title' => 'max:70',
            'meta_description' => 'max:170'
        ],[
             'title.required'=>'Tên không được để trống',
             'category_id.required'=>'Bạn chưa chọn danh mục',
            'slug.required'=>'Đường dẫn không được để trống',
            'slug.unique'=>'Đường dẫn đã tồn tại',
            'title.unique'=>'Tên đã tồn tại',
            'meta_title.max' => 'Meta Title vượt quá :max ký tự',
            'meta_description.max' => 'Meta Description vượt quá :max ký tự'
        ]);
        
        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()]);
        }
        if ($validator->passes()) 
        {
            $posts = Product::create($request->all());
            return response()->json($posts);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $posts = Product::find($id)->update($request->all());
        return response()->json($posts);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return response()->json(['done']);
    }

    public function edit($id){
        $data = Product::find($id);
         return response()->json($data);
    }
<<<<<<< HEAD
    public function trash(){
        $posts = Product::where('status','delete')->latest()->paginate(14);
        return view('admin.product.trash',[
            'posts'=>$posts
            ]);
    }
    public function undo($id){
        $product=Product::find($id);
        if($product->status=='delete'){
            $product->status='enable';
        }
             // dd($product->status);
        $undo=$product->update();
        if ($undo) 
        {
            return redirect()->back()->with('success','Khôi phục sản phẩm thành công');
        }
        else
        {
           return redirect()->back()->with('error','Có lỗi'); 
        }
        
    }
    public function deletePro($id){
        $deletePro=Product::destroy($id);
        if ($deletePro) {
            return redirect()->back()->with('success','Đã xóa sản phẩm');
        }
        else
        {
            return redirect()->back()->with('error','Lỗi khi xóa');
        }
    }
=======
>>>>>>> 210b3751eabcf488de0c6345936acdf8eb2baf02
}
 ?>