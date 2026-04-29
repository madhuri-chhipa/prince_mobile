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
              <a href="{{ url('admin/news')}}" class="btn btn-success"><i class="fa fa-list"></i> Testimonial Lists</a>
            </div>
          </div>
          <form id="newsForm" method="post" action="{{ url('admin/news') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="title">Title<i class="text-danger">*</i></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" id="title" placeholder="Enter  title">
                    <label class="error">{{ $errors->first('title') }}</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="short_description">Short Description<i class="text-danger">*</i></label>
                    <textarea type="text"  name="short_description" class="form-control" id="short_description" placeholder="Enter  short description">
                    {{ old('short_description') }}
                    </textarea>
                    <label class="error">{{ $errors->first('short_description') }}</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="description">Description<i class="text-danger">*</i></label>
                    <textarea id="description" name="description" class="form-control ckeditor" rows="5">{{ old('description') }}</textarea>
                    <label class="error">{{ $errors->first('description') }}</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="date">Date<i class="text-danger">*</i></label>
                    <input type="datetime-local" name="date" class="form-control" value="{{ old('date') }}" id="date" placeholder="Enter Sort Order">
                    <label class="error">{{ $errors->first('date') }}</label>
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
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                    <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                    <input type="hidden" name="old_image" value="<?php echo html_escape(@$data->image); ?>">
                    <label class="error">{{ $errors->first('image') }}</label>
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
    $("#newsForm").validate({
      rules: {
        title: "required",
        short_description: "required",
        date: "required",
        description: {
          required: true,
          minlength: 5,
        },
        sort_order: "required",
        image: {
          required: true,
          extension: "jpg|png|gif|jpeg",
        },

      },
      messages: {
        title: "Please Enter Title",
        short_description: "Please Enter Short Description",
        date: "Please Enter Date",
        description: "Please Enter Description",
        sort_order: "Please Enter Order",
        image: {
          required: "Please Select Photo",
          extension: "Please upload file in these format only (jpg, jpeg, png, gif)",
        },

      }
    });
    $("body").on("click", ".btn-submit", function(e) {
      if ($("#newsForm").valid()) {
        $("#newsForm").submit();
      }
    });
  });
</script>
@endsection