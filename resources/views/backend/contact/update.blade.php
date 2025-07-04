@extends('backend.admin_layout')
@section('content')
    <style>
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white;
        }

        .label-info {
            background-color: #5bc0de;
        }
    </style>
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Thông tin website</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{route('add_infomation')}}">Sửa thông tin website</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Sửa thông tin website</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('update_info',['id'=>$contact->info_id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="Text">Link facebook</label>
                                            <input type="text" class="form-control" name="info_facebook" value="{{ old('info_facebook', $contact->info_facebook) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="Text">Link youtobe</label>
                                            <input type="text" class="form-control" name="info_youtobe" value="{{ old('info_youtobe', $contact->info_youtobe) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="Text">Link instagram</label>
                                            <input type="text" class="form-control" name="info_instagram" value="{{ old('info_instagram', $contact->info_instagram) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="floating-label" for="password">Ảnh Logo</label>
                                            <input type="file" class="form-control" id="basic-default-name" name="image" accept="image/*"/>
                                            @if($contact->info_image)
                                                <img class="input-rounded mt-2" src="{{ asset('upload/info/'.$contact->info_image) }}" height="150" width="150" alt="Logo">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="ckeditor">Thông tin liên hệ</label>
                                            <textarea
                                                id="ckeditor"
                                                class="form-control" name="info_name"
                                                placeholder=""
                                            >{!! $contact->info_contact !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label" for="Text">Bản đồ</label>
                                            <textarea rows="6" cols="60"
                                                      class="form-control" name="info_map"
                                                      placeholder="Mô tả sản phẩm"
                                            >{{ $contact->info_map }}</textarea>
                                        </div>
                                    </div>
                        
                                </div>
                                <button type="submit" class="btn  btn-primary">Sửa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->

        </div>
    </section>
@endsection
