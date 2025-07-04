@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Nhận xét</li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách nhận xét</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Danh sách nhận xét</h5>
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
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
                                @forelse ($comments as $comment)
                                    <tr>
                                        <td>
                                            @if ($comment->comment_status == 1)
                                                <a href="{{ route('unactive_comment',['id'=>$comment->comment_id]) }}" class="badge bg-warning text-dark text-decoration-none">Bỏ Duyệt</a>
                                            @else
                                                <a href="{{ route('active_comment',['id'=>$comment->comment_id]) }}" class="badge bg-primary text-decoration-none">Duyệt</a>
                                            @endif
                                        </td>
                                        <td><strong>{{$comment->comment_name}}</strong></td>
                                        <td>
                                            {{$comment->comment}}
                                            <br>
                                            <span class="text-primary fw-semibold">Trả lời:</span>
                                            <ul class="mb-2">
                                                @foreach($replycoments as $replycom)
                                                    @if($replycom->comment_parent == $comment->comment_id)
                                                        <li style="list-style-type: decimal; color: #0d6efd;margin: 5px ;">
                                                            {{$replycom->comment}}
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            @if($comment->comment_status == 1)
                                                <form>
                                                    @csrf
                                                    <textarea class="form-control mb-2" name="" id="reply_comment_{{$comment->comment_id}}" cols="30" rows="2" placeholder="Nhập nội dung trả lời..."></textarea>
                                                    <button type="button" data-product_id="{{$comment->product_id}}" data-comment_id="{{$comment->comment_id}}" class="btn-reply_comment btn btn-sm btn-warning"><i class="bi bi-reply"></i> Trả lời</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>{{$comment->comment_date}}</td>
                                        <td>
                                            <a href="{{route('detailProduct',['id' => $comment->product_id])}}" target="_blank">
                                                {{$comment->product->product_name}}
                                            </a>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('deleteComment',['id'=>$comment->comment_id]) }}" onsubmit="return confirm('Bạn có muốn xóa nhận xét này không?')">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Xóa">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('backend.components.pagination', ['paginator' => $comments])
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        $('#reply_comment_'+comment_id).val('');
                        location.reload();
                        $('.notify').html('<div class="alert alert-success">Trả lời bình luận thành công</div>')
                    }
                });
            })
        });
    </script>
@endsection
