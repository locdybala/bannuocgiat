@extends('backend.admin_layout')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">Tài khoản hệ thống</li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách tài khoản</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách tài khoản</h5>
                    <a href="{{ route('add_user') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Thêm tài khoản
                    </a>
                </div>
                <div class="card-body">
                    @include('backend.components.notification')
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:20px;">
                                        <input type="checkbox"/>
                                    </th>
                                    <th>STT</th>
                                    <th>Tên user</th>
                                    <th>Email</th>
                                    <th>Author</th>
                                    <th>Admin</th>
                                    <th>User</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @forelse ($users as $user)
                                    @php $i++; @endphp
                                    <form action="{{ route('assign_roles') }}" method="POST">
                                        @csrf
                                        <tr>
                                            <td><input type="checkbox" name="post[]"/></td>
                                            <td>{{$i}}</td>
                                            <td>{{ $user->name }}</td>
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <td>{{ $user->email }} <input type="hidden" name="admin_email" value="{{ $user->email }}"></td>
                                            <td><input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}}></td>
                                            <td><input type="checkbox" name="admin_role" {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                                            <td><input type="checkbox" name="user_role" {{$user->hasRole('user') ? 'checked' : ''}}></td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <input type="submit" value="Phân quyền" class="btn btn-outline-secondary btn-sm">
                                                    <a onclick="return confirm('Bạn có muốn xóa user này không?')" href="{{ url('/admin/deleteUser_role/'.$user->id) }}" class="btn btn-outline-dark btn-sm">Xóa</a>
                                                    <a href="{{ route('editUser', ['id' => $user->id]) }}" class="btn btn-outline-warning btn-sm">Sửa</a>
                                                    <a href="{{ url('/admin/impersonate/'.$user->id) }}" class="btn btn-outline-primary btn-sm">Chuyển quyền</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </form>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('backend.components.pagination', ['paginator' => $users])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
