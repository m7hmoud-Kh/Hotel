@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    Edit Room
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Room</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Edit Room</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    @if ($errors->any())
        @foreach ($errors->all() as $err)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $err }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif


    @if (Session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session()->get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif




    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">

            <div class="card">
                <div class="card-header pb-0">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="btn btn-outline-primary btn-block" href="/room/all">Back All Room</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/admin/room/update" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="room_id" value="{{ $all_info_about_room->id }}">
                                <input type="hidden" name='image_id' value="{{ $all_info_about_room->images_id }}">
                                <label for="inputName" class="control-label">Room Type</label>
                                <select name="roomtype" id="roomtype" class="form-control SlectBox" required>
                                    <!--placeholder-->
                                    <option value="" selected disabled>select Room Type</option>
                                    @foreach ($roomTypes as $roomType)
                                        <option value="{{ $roomType->id }}" @if ($roomType->id == $all_info_about_room->type_id)
                                            selected
                                    @endif
                                    >{{ $roomType->type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Price</label>
                                <input type="text" class="form-control form-control-lg" id="price" name="price"
                                    value=" {{ $all_info_about_room->roomtype->price }}" readonly
                                    title="please enter price"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">


                        </div>

                        <div class="row">

                            <div class="col">
                                <label for="exampleTextarea">description</label>
                                <textarea class="form-control" id="exampleTextarea" name="description" rows="3"
                                    readonly> {{ $all_info_about_room->roomtype->description }} </textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <p class="text-danger">* Allowed Extension jpeg ,.jpg , png </p>
                                <p class="text-danger">can't upload more than 3 images</p>
                                <p class="text-success">if you not upload image old image is saved</p>
                                <h5 class="card-title">Image</h5>
                                <div class="col-sm-12 col-md-12">
                                    <input type="file" name="images[]" class="myfrm dropify" multiple accept="jpg,png,jpeg"
                                        data-height=" 70" />
                                </div><br>

                            </div>

                        </div>

                        <br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success btn-block">Update</button>
                        </div>


                    </form>
                </div>
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
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#roomtype').on('change', function() {
                var id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ URL::to('/admin/room/type_info') }}/" + id,
                    data: "json",
                    success: function(response) {
                        $('#price').val(response['price']);
                        $('#exampleTextarea').val(response['description']);
                    }
                });

            });
        });
    </script>
@endsection
