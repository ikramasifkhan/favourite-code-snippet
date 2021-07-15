@extends('development.layout.app')

@section('title', 'Employee list')

@section('breardcrumb')
    @php
    $item = [
        'Home' => route('home', ['token' => session('token')]),
        'Employee List' => '',
    ];
    @endphp
    <x-breadcrumb-component icon="fas fa-tachometer-alt" title="Employee Management" :item="$item" />
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="d-flex justify-content-between">
                    <div>
                        <p>
                            {{-- <button type="button" class="btn btn-primary icon-btn" data-toggle="modal" data-target="#myModal">
                                <i class="{{ bladeIcon('add') }} mr-1"></i>Add new
                            </button> --}}
                            <a type="button" class="btn btn-primary icon-btn modal-button"
                                data-route="{{ route('emp_add_modal_show', ['token' => session('token')]) }}"
                                data-title="Add Employee">
                                <i class="{{ bladeIcon('add') }} mr-1"></i>Add new
                            </a>
                        </p>
                    </div>
                    <div>

                    </div>
                    <div>
                        <form>
                            <div class="row">
                                <div class="form-group col-4">
                                    <input class="form-control" id="demoDate" name="date" type="date"
                                        placeholder="Select Date" title="Select a date">
                                </div>
                                <div class="form-group col-6">
                                    <input class="form-control" name="searchText" type="text" placeholder="Search">
                                </div>
                                <div class="form-group col-2 align-self-end">
                                    <button class="btn btn-primary btn-block" type="submit"><i
                                            class="fa fa-fw fa-lg fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-success">
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Name</th>
                                    <th style="text-align: center">Designation</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Contact Info</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userList as $user)
                                    <tr>
                                        <td style="text-align: center;">{{ $loop->iteration }}.</td>
                                        <td style="text-align: center;">{{ $user->name }}</td>
                                        <td style="text-align: center;">{{ $user->designation_id }}</td>
                                        <td style="text-align: center;">
                                            {{ $user->status == 'active' ? 'Active' : 'Inactive' }}
                                        </td>
                                        <td style="text-align: center">
                                            <p>
                                                <strong>Email: </strong><a
                                                    href="mailTo:{{ $user->email }}">{{ $user->email }}</a><br>
                                                <strong>Phone: </strong>{{ $user->phone }}
                                            </p>
                                        </td>
                                        <td style="text-align: center; padding-top: 10px">
                                            @php
                                                $items = [
                                                    'edit' => route('emp_edit_modal_show', [$user->id, 'token' => session('token')]),
                                                    'active' => route('employee.active', [$user->id, 'token' => session('token')]),
                                                    'inactive' => route('employee.inactive', [$user->id, 'token' => session('token')]),
                                                ];
                                            @endphp
                                            <x-action-btn-component :items="$items" status="{{ $user->status }}"
                                                type="ajax" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <ul class="pagination float-right">
                                <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">»</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

{{-- @push('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').dataTable({
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{{ route('employee.index', ['token' => session('token')]) }}',
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        title: 'Sl no',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "name",
                        searchable: true,
                        title: 'Employee name',
                        orderable: true
                    },
                    {
                        data: "email",
                        searchable: true,
                        title: 'Employee email',
                        orderable: true
                    },

                ],
            });
        })
    </script>
@endpush --}}
