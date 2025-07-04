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
                                <h5 class="m-b-10">Quản lý tài khoản user</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i
                                            class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Tài khoản hệ thống</a></li>
                                <li class="breadcrumb-item"><a href="#!">Danh sách tài khoản</a></li>
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
                        @include('backend.components.notification');
                        <div class="card-header">
                            <h5>Danh sách tài khoản</h5>
                            <div>
                                <a href="{{ route('add_user') }}"
                                   class="btn btn-sm mt-2 btn-primary">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm tài khoản</a>
                            </div>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width:20px;">
                                            <label class="i-checks m-b-none">
                                                <input type="checkbox"><i></i>
                                            </label>
                                        </th>
                                        <th>STT</th>
                                        <th>Tên user</th>
                                        <th>Email</th>
                                        <th>Author</th>
                                        <th>Admin</th>
                                        <th>User</th>
                                        <th style="width:30px;"></th>
                                        <th style="width:30px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=0; @endphp
                                    @if ($users)
                                        @foreach($users as $key => $user)
                                            @php $i++; @endphp
                                            <form action="{{ route('assign_roles') }}" method="POST">
                                                @csrf
                                                <tr>
                                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                                                                name="post[]"><i></i></label>
                                                    </td>
                                                    <td>{{$i}}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <td>{{ $user->email }} <input type="hidden" name="admin_email"
                                                                                  value="{{ $user->email }}"></td>
                                                    <td><input type="checkbox"
                                                               name="author_role" {{$user->hasRole('author') ? 'checked' : ''}}>
                                                    </td>
                                                    <td><input type="checkbox"
                                                               name="admin_role" {{$user->hasRole('admin') ? 'checked' : ''}}>
                                                    </td>
                                                    <td><input type="checkbox"
                                                               name="user_role" {{$user->hasRole('user') ? 'checked' : ''}}>
                                                    </td>

                                                    <td>
                                                        <input type="submit" value="Phân quyền"
                                                               class="btn btn-sm btn-outline-secondary">
                                                        <a onclick="return confirm('Bạn có muốn xóa user này không')"
                                                           href="{{ url('/admin/deleteUser_role/'.$user->id) }}"
                                                           class="btn btn-sm btn-outline-dark">Xóa</a>
                                                        <br>
                                                        <a href="{{ route('editUser', ['id' => $user->id]) }}"
                                                           class="btn btn-sm mt-2 btn-outline-warning">Sửa</a>
                                                        <a href="{{ url('/admin/impersonate/'.$user->id) }}"
                                                           class="btn btn-sm mt-2 btn-outline-primary">Chuyển quyền</a>
                                                    </td>

                                                </tr>
                                            </form>
                                        @endforeach
                                    @else
                                        <td>Không có dữ liệu</td>
                                    @endif
                                    </tbody>
                                </table>
                                @include('backend.components.pagination', ['paginator' => $users]);
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
