@extends('admin.layouts.main')
@section('header_scripts')
<script src="{{VENDOR}}ckeditor/ckeditor/ckeditor.js"></script>
@stop
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-end">
                        <div class="card-title pull-right">
                            <a href="{{ url('admin/services') }}" class="btn btn-success"><i class="fa fa-list"></i>Services Lists</a>
                        </div>
                    </div>
                    <form id="servicesForm" method="post" action="{{ url('admin/services', ['id' => $data->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name<i class="text-danger">*</i></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name',$data->name) }}" id="name" placeholder="Enter  name">
                                        <label class="error">{{ $errors->first('name') }}</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="meta_title">meta title<i class="text-danger">*</i></label>
                                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title',$data->meta_title) }}" id="meta_title" placeholder="Enter  meta_title">
                                        <label class="error">{{ $errors->first('meta_title') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="price">price<i class="text-danger">*</i></label>
                                        <input type="text" name="price" class="form-control" value="{{ old('price',$data->price) }}" id="price" placeholder="Enter  price">
                                        <label class="error">{{ $errors->first('price') }}</label>
                                    </div>
                                </div>                                  
                                <div class="col">
                                    <div class="form-group">
                                        <label for="sort_order">Sort Order<i class="text-danger">*</i></label>
                                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$data->sort_order) }}" id="sort_order" placeholder="Enter Sort Order">
                                        <label class="error">{{ $errors->first('sort_order') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="icon">icon</label>
                                        <input type="file" class="form-control" name="icon" id="icon">
                                        <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                                        <input type="hidden" name="old_icon_image" value="<?php echo html_escape(@$data->icon); ?>">
                                        @if($data->icon)
                                        <p><img src="{{asset($data->icon)}}" class="image logosmallimg"></p>
                                        @endif
                                        <label class="error">{{ $errors->first('icon') }}</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                        <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                                        <input type="hidden" name="old_image" value="<?php echo html_escape(@$data->image); ?>">
                                        @if($data->image)
                                        <p><img src="{{asset($data->image)}}" class="image logosmallimg"></p>
                                        @endif
                                        <label class="error">{{ $errors->first('image') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="brochure">brochure</label>
                                        <input type="file" class="form-control" name="brochure" id="brochure">
                                        <p><small class="text-success">Allowed Types: gif, png, jpg, jpeg, text ,rtf, doc, pdf</small></p>
                                        <input type="hidden" name="old_brochure_image" value="<?php echo html_escape(@$data->brochure); ?>">
                                        @if($data->brochure)
                                        <p><img src="{{asset($data->brochure)}}" class="image logosmallimg"></p>
                                        @endif
                                        <label class="error">{{ $errors->first('brochure') }}</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="short_description">short_description<i class="text-danger">*</i></label>
                                        <textarea type="text" name="short_description" class="form-control" id="short_description" placeholder="Enter short description">
                                            {{ old('short_description',$data->short_description) }}
                                        </textarea>
                                        <label class="error">{{ $errors->first('short_description') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="meta_keyword">meta keyword<i class="text-danger">*</i></label>
                                        <input type="text" name="meta_keyword" class="form-control" value="{{ old('meta_keyword',$data->meta_keyword) }}" id="meta_keyword" placeholder="Enter  meta_keyword">
                                        <label class="error">{{ $errors->first('meta_keyword') }}</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="meta_description">meta description<i class="text-danger">*</i></label>
                                        <textarea id="meta_description" name="meta_description" class="form-control" rows="4" id="meta_description">{{ old('meta_description',$data->meta_description) }} </textarea>
                                        <label class="error">{{ $errors->first('meta_description') }}</label>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="description">description<i class="text-danger">*</i></label>
                                        <textarea id="description" name="description" class="form-control ckeditor" id="description">{{ old('description',$data->description) }} </textarea>
                                        <label class="error">{{ $errors->first('description') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="submit" value="Submit" class="btn btn-submit btn-primary pull-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function() {


        // jquery validation    
        $("#servicesForm").validate({
            rules: {
                name: "required",
                designation: "required",
                message: {
                    required: true,
                    minlength: 5,
                },
                sort_order: "required",
                image: {
                    required: false,
                    extension: "jpg|png|gif|jpeg",
                },

            },
            messages: {
                name: "Please Enter  Name",
                designation: "Please Enter  Designation",
                message: "Please Enter  Message",
                sort_order: "Please Enter  Order",
                image: {
                    required: "Please Select Photo",
                    extension: "Please upload file in these format only (jpg, jpeg, png, gif)",
                },

            }
        });
        $("body").on("click", ".btn-submit", function(e) {
            if ($("#servicesForm").valid()) {
                $("#servicesForm").submit();
            }
        });
    });
</script>
@endsection