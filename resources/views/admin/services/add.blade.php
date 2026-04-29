@extends('admin.layouts.main')
@section('header_scripts')
<script src="{{ ASSETS }}ckeditor/ckeditor.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-end">
                        <div class="card-title pull-right">
                            <a href="{{ url('admin/services')}}" class="btn btn-success"><i class="fa fa-list"></i>Service Lists</a>
                        </div>
                    </div>
                    <form id="servicesForm" method="post" action="{{ url('admin/services') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name<i class="text-danger">*</i></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" placeholder="Enter  name">
                                        <label class="error">{{ $errors->first('name') }}</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="meta_title">meta title<i class="text-danger">*</i></label>
                                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}" id="meta_title" placeholder="Enter  meta_title">
                                        <label class="error">{{ $errors->first('meta_title') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="price">price<i class="text-danger">*</i></label>
                                        <input type="text" name="price" class="form-control" value="{{ old('price') }}" id="price" placeholder="Enter  price">
                                        <label class="error">{{ $errors->first('price') }}</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="sort_order">Sort Order<i class="text-danger">*</i></label>
                                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order') }}" id="sort_order" placeholder="Enter Sort Order">
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
                                        <label class="error">{{ $errors->first('icon') }}</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                        <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                                        <input type="hidden" name="old_image" value="<?php echo html_escape(@$data->image); ?>">
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
                                        <label class="error">{{ $errors->first('brochure') }}</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="short_description">short_description<i class="text-danger">*</i></label>
                                        <textarea type="text" name="short_description" class="form-control" id="short_description" placeholder="Enter short description">
                                            {{ old('short_description') }}
                                        </textarea>
                                        <label class="error">{{ $errors->first('short_description') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="meta_keyword">meta keyword<i class="text-danger">*</i></label>
                                        <input type="text" name="meta_keyword" class="form-control" value="{{ old('meta_keyword') }}" id="meta_keyword" placeholder="Enter  meta_keyword">
                                        <label class="error">{{ $errors->first('meta_keyword') }}</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="meta_description">meta description<i class="text-danger">*</i></label>
                                        <textarea id="meta_description" name="meta_description" class="form-control" id="meta_description">{{ old('meta_description') }} </textarea>
                                        <label class="error">{{ $errors->first('meta_description') }}</label>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="description">description<i class="text-danger">*</i></label>
                                        <textarea id="description" name="description" class="form-control ckeditor"  id="description">{{ old('description') }} </textarea>
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
                slug: "required",
                name: "required",
                price: "required",
                sort_order: "required",
                icon: {
                    required: true,
                    extension: "jpg|png|gif|jpeg",
                },
                image: {
                    required: true,
                    extension: "jpg|png|gif|jpeg",
                },
                brochure: {
                    required: true,
                    extension: "gif,png,jpg,jpeg,text,rtf,doc,pdf",
                },
                short_description: "required",
                description: "required",
                meta_title: "required",
                meta_keyword: "required",
                meta_description: "required",
            },
            messages: {
                slug: "Please Enter  Slug",
                name: "Please Enter  Name",
                price: "Please Enter  Price",
                sort_order: "Please Enter  Order",
                icon: {
                    required: "Please Select Photo",
                    extension: "Please upload file in these format only (jpg, jpeg, png, gif)",
                },
                image: {
                    required: "Please Select Photo",
                    extension: "Please upload file in these format only (jpg, jpeg, png, gif)",
                },
                brochure: {
                    required: "Please Select Pdf",
                    extension: "Please upload file in these format only (gif,png,jpg,jpeg,text,rtf,doc,pdf)",
                },
                short_description: "Please Enter  Short Description",
                description: "Please Enter  Description",
                meta_title: "Please Enter  Meta Title",
                meta_keyword: "Please Enter  Meta Keyword",
                meta_description: "Please Enter Meta Description",
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