@extends('admin.layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <div class="container">
        <div>
            <h2 class="fw-bold">Mail Send</h2>
        </div>
        @if (session()->has('success'))
            <div class="bg-success">
                <span class="text-light">
                    {{ session()->get('success') }}
                </span>
            </div>
        @else
            <div class="bg-danger">
                <span class="text-light">
                    {{ session()->get('error') }}
                </span>
            </div>
        @endif
        <div>
            <form action="{{ route('contact.mailsent') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Modal -->
                <div class="modal fade" id="tosendModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    <div class="pagination-blog fw-bold text-center">
                                        {{ $profiles->links('pagination::bootstrap-4') }}
                                    </div>
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="" style="position: relative;">
                                    <table class="table table-striped table-responsive table-bordered table-hover" id="tblData">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <input  type="checkbox" id="chkAll" class="form-check-input ms-2">
                                                </th>
                                                <th class="fw-bold" style="font-size: 1.5rem;">Company Name</th>
                                                <th class="fw-bold" style="font-size: 1.5rem;">Email</th>
                                                <th class="fw-bold " style="font-size: 1.5rem;">User Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        {{-- <tr>
                                        <td>
                                            <input class="form-check-input tblChk" name="email[]" type="checkbox" data-id="" value="zwemaan881@gmail.com">
                                        </td>
                                        <td>one</td>
                                        <td>one</td>
                                        <td>adfasfa</td>
                                        </tr>
                                        <tr>
                                        <td>
                                            <input class="form-check-input tblChk" name="email[]" type="checkbox" data-id="" value="purplerain99h@gmail.com">
                                        </td>
                                        <td>one</td>
                                        <td>one</td>
                                        <td>adfasfa</td>
                                        </tr> --}}
                                            @foreach ($profiles as $profile)
                                                <tr>

                                                    @if ($profile->user)
                                                        <td class="text-end">
                                                            <input class="form-check-input tblChk" name="email[]"
                                                                type="checkbox" data-id="{{ $profile->user->id }}"
                                                                value="{{ $profile->user->email }}">
                                                        </td>
                                                        <td>{{ $profile->CompanyName }}</td>
                                                        <td>{{ $profile->user->email }}</td>
                                                        <td>{{ $profile->user->name }}</td>
                                                    @else
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- TO button --}}
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tosendModal">
                        To  <i class="fa-solid fa-envelope"></i>
                    </button>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control fw-bold" readonly id="selectOneTouchInput">
                </div>
                <div class="form-group">
                    <label for="" class="fw-bold">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control form-control-lg">
                </div>
                {{-- <div class="form-group w-25">
                    <label for="" class="fw-bold" >Attch Files <i class="fa-solid fa-file-import"></i></label>
                    <input type="file" name="file" id="file" class="form-control">
                </div> --}}
                <div class="form-group">
                    <label for="" class="fw-bold">Message <i class="fa-solid fa-comment"></i></label>
                    <textarea id="summernote" cols="30" rows="10" name="message" ng-model="blog.content" class="form-control"></textarea>
                </div>


                <button class="btn btn-primary" style="width: 100px;" type="submit">Send <i class="fa-solid fa-paper-plane"></i></button>

            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Enter your message...',
                tabsize: 2,
                height: 180,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'file']]
                ]
            });
            // $('#summernote').attr('name', 'body').html('{{ old('body') }}');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tblData').on('change', '.tblChk', function() {
                // debugger;
                if ($('.tblChk:checked').length == $('.tblChk').length) {
                    $('#chkAll').prop('checked', true);

                } else {
                    $('#chkAll').prop('checked', false);
                }

            });
            var selectAll = new Array();
            $("#chkAll").change(function() {
                if ($(this).prop('checked')) {
                    $('.tblChk').not(this).prop('checked', true);

                    // ALL CHECKED VALUES LOOP
                    $('input[name="email[]"]:checked').each(function() {
                        console.log(this.value);
                        selectAll.push(" " + this.value);
                        console.log(selectAll);
                        $('#selectOneTouchInput').val(selectAll);
                    });

                } else {
                    $('.tblChk').not(this).prop('checked', false);
                    $('#selectOneTouchInput').val('');
                }
            });

            // ONE CHECKED VALUES FUNCTION
            var myarray = new Array();
            $(".tblChk").change(function() {
                if ($(this).prop('checked')) {
                    let selectOneTouch = $(this).val();
                    myarray.push(" " + selectOneTouch);
                    console.log(myarray);
                    $('#selectOneTouchInput').val(myarray);
                } else {
                    let selectOneTouch = $(this).val();
                    myarray = myarray.filter(function(item) {
                        return item !== " " + selectOneTouch;
                    });
                    $('#selectOneTouchInput').val(myarray);
                    console.log(myarray);
                }
            });
        });
    </script>
    <script src="{{ asset('js/toastr.js') }}"></script>
@endsection
