@extends('layouts.admin')
@section('title','Danh sách sản phẩm')
@section('links','Danh mục')    
@section('main')

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="main-pro">
    <div class="row">
        <div class="col-lg-12 margin-tb">


        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="">
                <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">Create New Post</button> -->
                <div class="" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                    <div class="" role="document">

                        <div class="">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>

                                <h4 class="modal-title" id="myModalLabel">Tạo mới sản phẩm</h4>

                            </div>

                            <div class="modal-body">



                                <form data-toggle="validator" action="{{ route('post.store') }}" method="POST">

                                    <ul class="nav nav-tabs">
                                      <li class="active"><a data-toggle="tab" href="#home">Thông tin sản phẩm</a></li>
                                      <li><a data-toggle="tab" href="#menu1">Ảnh, thông tin thẻ</a></li>
                                  </ul>

                                  <div class="tab-content">
                                      <div id="home" class="tab-pane fade in active">
                                        <div class="form-group">

                                            <label class="control-label" for="title">Tên sản phẩm:</label>

                                            <input type="text" name="title" class="form-control" data-error="Please enter title." required />
                                            
                                            <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label" for="title">Đường dẫn tĩnh:</label>

                                            <input type="text" name="slug" class="form-control" data-error="Please enter title." required />

                                            <div class="help-block with-errors"></div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label" for="title">Đặc tính:</label>

                                            <input type="text" name="feature" class="form-control" data-error="Please enter title." required />

                                            <div class="help-block with-errors"></div>

                                        </div>
                                        <div class="form-group">

                                            <label class="control-label" for="title">Thông số kỹ thuật:</label>

                                            <input type="text" name="specifications" class="form-control" data-error="Please enter title." required />

                                            <div class="help-block with-errors"></div>

                                        </div>
                                        <div class="form-group">

                                            <label class="control-label" for="title">catalog:</label>

                                            <input name="catalog" class="form-control" data-error="Please enter details." required>

                                            <div class="help-block with-errors"></div>
                                            <input type="hidden" name="created_by" value="{{Auth::user()->username}}">
                                        </div>
                                        <div class="form-group">

                                            <label class="control-label" for="title">Giá:</label>

                                            <input name="price" class="form-control" value="Liên hệ:" data-error="Please enter details." required>

                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="title">Danh mục:</label>
                                            <select name="category_id" id="inputCategory_id" class="form-control" required>
                                                <option value="">Chọn danh mục</option>

                                                <option value="1111">1</option>
                                                
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <h3>Thông tin các thẻ</h3>
                                        <div class="form-group">
                                            <label class="control-label" for="title">Ảnh</label>
                                            <input type="file" name="upload_file" class="form-control" data-error="Please enter details." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="title">Meta Title</label>
                                            <input type="" name="meta_title" class="form-control" data-error="Please enter details." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="title">Meta Description</label>
                                            <input type="" name="meta_description" class="form-control" data-error="Please enter details." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="title">Meta Keywords</label>
                                            <input type="" name="meta_keywords" class="form-control" data-error="Please enter details." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">

                                            <label class="control-label" for="title">Bảo hành:</label>

                                            <input name="warranty" class="form-control" value="12 tháng" data-error="Please enter details." required>

                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>

                                
                                
                                <div class="form-group">
                                    <button type="submit" class="btn crud-submit btn-success">Submit</button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>
        </div>   
    </div>
    <div class="col-md-8">
        <div class="pull-left">
            <h2>Danh sách sản phẩm</h2>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Đường dẫn tĩnh</th>
                    <th>Danh mục</th>
                    <th>Người tạo</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <ul id="pagination" class="pagination-sm"></ul>
    </div>
</div>




<!-- Create Item Modal -->

<!-- Edit Item Modal -->



<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                <h4 class="modal-title" id="myModalLabel">Sửa thông tin sản phẩm</h4>

            </div>

            <div class="modal-body">



                <form data-toggle="validator" action="/item-ajax/14" method="put">
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#edit-pages1">Sửa thông nhanh</a></li>
                      <li><a data-toggle="tab" href="#edit-pages2">Chi tiết</a></li>
                  </ul>

                  <div class="tab-content">
                      <div id="edit-pages1" class="tab-pane fade in active">
                        <div class="form-group">

                    <label class="control-label" for="title">Tên sản phẩm:</label>

                    <input type="text" name="title" class="form-control" data-error="Tên sản phẩm không được để trống." required />

                    <div class="help-block with-errors"></div>

                </div>

                <div class="form-group">
                    <label class="control-label" for="title">Đường dẫn tĩnh:</label>
                    <input name="slug" class="form-control" data-error="Đường dẫn không được để trống." required>
                    <div class="help-block with-errors"></div>
                </div>
<div class="form-group">
                    <label class="control-label" for="title">Giá:</label>
                    <input name="price" class="form-control" data-error="Đường dẫn không được để trống." required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Meta Title</label>
                    <input name="meta_title" class="form-control" data-error="Đường dẫn không được để trống." required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Meta Description</label>
                    <input name="meta_description" class="form-control" data-error="Đường dẫn không được để trống." required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Meta Keywords</label>
                    <input name="meta_keywords" class="form-control" data-error="Đường dẫn không được để trống." required>
                    <div class="help-block with-errors"></div>
                </div>
                    </div>
                    <div id="edit-pages2" class="tab-pane fade">
                       <div class="form-group">
                    <label class="control-label" for="title">Đặc tính:</label>
                    <input name="feature" class="form-control" data-error="Đường dẫn không được để trống." required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Thông số kỹ thuật:</label>
                    <input name="specifications" class="form-control" data-error="Đường dẫn không được để trống." required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Catalog:</label>
                    <input name="catalog" class="form-control" data-error="Đường dẫn không được để trống." required>
                    <div class="help-block with-errors"></div>
                    <input type="hidden" name="created_by" value="{{Auth::user()->username}}">
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="title">Bảo hành:</label>
                    <input name="warranty" class="form-control" data-error="Đường dẫn không được để trống." required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Danh mục</label>
                    <input name="warranty" class="form-control" data-error="Đường dẫn không được để trống." required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Ảnh</label>
                    <input name="cover_image" type="file" class="form-control" data-error="Đường dẫn không được để trống." required>
                    <div class="help-block with-errors"></div>
                </div>
                    </div>
                </div>
                
                
                
                <div class="form-group">

                    <button type="submit" class="btn btn-success crud-submit-edit">Submit</button>

                </div>

            </form>
        </div>

    </div>

</div>

</div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<script type="text/javascript">
    var url = "<?php echo route('post.index')?>";
</script>
<script src="{{url('public/js/posts-ajax.js')}}"></script> 
<script>
    $(document).ready(function(){
        $(".nav-tabs a").click(function(){
            $(this).tab('show');
        });
    });
</script>
@stop()
