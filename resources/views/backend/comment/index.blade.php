@extends('backend.admin_layout')
@section('content')
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Quản lý nhận xét</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Nhận xét</a></li>
                                <li class="breadcrumb-item"><a href="#!">Danh sách nhận xét</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">

                <!-- [ stiped-table ] start -->
                <div class="col-xl-12">
                    <div class="card">
                        @include('backend.components.notification')
                        <div class="card-header">
                            <h5>Danh sách nhận xét</h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Duyệt</th>
                                        <th>Tên người gửi</th>
                                        <th>Bình luận</th>
                                        <th>Ngày gửi</th>
                                        <th>Sản phẩm</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if ($comments)
                                        @foreach ($comments as $comment)
                                            <tr>
                                                @if ($comment->comment_status == 1)

                                                    <td>
                                                        <a href="{{ route('unactive_comment',['id'=>$comment->comment_id]) }}"
                                                           class="badge badge-warning">Bỏ Duyệt</a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="{{ route('active_comment',['id'=>$comment->comment_id]) }}"
                                                           class="badge badge-primary">Duyệt</a>
                                                    </td>

                                                @endif
                                                    <td><strong>{{$comment->comment_name}}</strong></td>
                                                    <td>{{$comment->comment}}
                                                        <br>
                                                        <span style="color: #9853fd;">Trả lời:</span>
                                                        <ul>
                                                            @foreach($replycoments as $replycom)
                                                                @if($replycom->comment_parent == $comment->comment_id)
                                                                    <li style="list-style-type: decimal; color: #9853fd;margin: 5px ;">
                                                                        {{$replycom->comment}}
                                                                    </li>
                                                                @endif
                                                            @endforeach

                                                        </ul>
                                                        <br>
                                                        @if($comment->comment_status == 1)
                                                            <form >
                                                                @csrf
                                                                <textarea class="form-control mb-2" name="" id="reply_comment_{{$comment->comment_id}}" cols="30"
                                                                          rows="2"></textarea>
                                                                <button type="button" data-product_id="{{$comment->product_id}}"
                                                                        data-comment_id="{{$comment->comment_id}}"
                                                                        class="btn-reply_comment btn btn-xs btn-warning">Trả lời
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                    <td>{{$comment->comment_date}}</td>
                                                    <td><a href="{{route('detailProduct',['id' => $comment->product_id])}}"
                                                           target="_blank">{{$comment->product->product_name}}</a></td>
                                                <td>

                                                    <div style="display: flex">
                                                        <form method="POST" action="">
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="return confirm('Bạn có muốn xóa nhận xét này không?')"
                                                               href="{{ route('deleteComment',['id'=>$comment->comment_id]) }}"
                                                               class="btn btn-sm btn-danger ml-2"><i class="fa fa-trash">
                                                                </i></a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td>Không có dữ liệu</td>
                                    @endif
                                    </tbody>
                                </table>
                                @include('backend.components.pagination', ['paginator' => $comments]);
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ stiped-table ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.btn-reply_comment').click(function () {

                var comment_id = $(this).data('comment_id');
                var reply_comment = $('#reply_comment_'+comment_id).val();
                var product_id = $(this).data('product_id');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{ route('reply_comment')}}",
                    method:"POST",
                    data:{reply_comment:reply_comment,comment_id:comment_id,product_id:product_id,_token:_token},
                    success:function(){
                        $('#reply_comment_'+comment_id).val(' ');
                        location.reload();
                        $('.notify').html('<div class="alert alert-success">Trả lời bình luận thành công</div>')
                    }

                });

            })
        });
    </script>

@endsection
