@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    Rooms Not Reservations
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Rooms</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Not Reservations

                </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        @if (Session()->has('delete'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session()->get('delete') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <!--table section-->
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="btn btn-outline-primary btn-block" href="/room/add">Add Room</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Room Id</th>
                                    <th class="border-bottom-0">Room Type</th>
                                    <th class="border-bottom-0">description</th>
                                    <th class="border-bottom-0">Price</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">opertions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($all_room as $room)
                                    <tr>
                                        <td>{{ ++$count }}</td>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->roomtype->type }}</td>
                                        <td>{{ $room->roomtype->description }}</td>
                                        <td>{{ $room->roomtype->changeFormatPrice() }}</td>
                                        <td>{!! $room->status !!}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">Operation<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">

                                                    <a class="dropdown-item" href="/room/edit/{{ $room->id }}">
                                                        <i class="fas fa-edit text-primary"></i>
                                                        Edit Room</a>

                                                    <a class="dropdown-item" href="#delete_room" data-toggle="modal"
                                                        data-id="{{ $room->id }}"
                                                        data-room_type_id="{{$room->roomtype->id}}"
                                                        >
                                                        <i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;
                                                        Delete Room</a>


                                                    <a class="dropdown-item" data-toggle="modal"
                                                    data-id="{{ $room->id }}"
                                                        data-target="#room_status"><i
                                                            class=" text-success fas fa-money-bill"></i>&nbsp;&nbsp;
                                                        Room Status
                                                    </a>


                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->




        <!-- Delete Employee  -->
        <div class="modal fade" id="delete_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Delete Room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/room/delete" method="post">
                        @csrf
                        <div class="modal-body">
                            Are You Sure for Delete Room With RoomId:
                            <input type="text" name="room_id" id="room_id" value="" readonly>
                            <input type="hidden" name="room_type_id" id="room_type_id" value="">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="room_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Room Status </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/room/change_status_room" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="" id="room_id" name="room_id">
                        <label for="inputName" class="control-label">Select Room Status</label>
                        <select name="payment_status" class="form-control SlectBox" required>
                            <option value="" selected disabled>select Status</option>
                            <option value="1">Not Reservation</option>
                            <option value="2">Reservation</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>















    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>


    <script>
        $('#delete_room').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var room_id = button.data('id');
            var room_type_id = button.data('room_type_id');

            var modal = $(this);
            modal.find('.modal-body #room_id').val(room_id);
            modal.find('.modal-body #room_type_id').val(room_type_id);

        });


        $('#room_status').on('show.bs.modal',function(e){
            var button = $(e.relatedTarget);
            var room_id = button.data('id');

            var modal = $(this);
            modal.find('.modal-body #room_id').val(room_id);
        });


    </script>

@endsection
