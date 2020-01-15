@extends('admin.admin_layout')
@section('admin_content')


			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Add Category</a>
				</li>
			</ul>
			  @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
       @endif
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Worker Information</h2>

						
                    <!--   <p class="alert-success"> -->
                      	<!-- //message  -->
                     <!--  	@php
                      	$message=Session::get('message');

                      	if($message)
                      	{
                      		echo $message;
                      		Session::put('message',null);
;                      	}

                      	@endphp -->
                 <!--      </p> -->


				<div class="box-icon">
							
					<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
			<form class="form-horizontal" action="{{url('/save-worker')}}" method="post" enctype="multipart/form-data">
					@csrf

						  <fieldset>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Product Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge " name="name" >
							  </div>
							</div>
							


							




						    <div class="control-group">
							  <label class="control-label" for="date01">Title</label>
							  <div class="controls">
								<input type="text" class="input-xlarge " name="title" >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Sub Title</label>
							  <div class="controls">
								<input type="text" class="input-xlarge " name="sub_title" >
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="fileInput">Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="image" id="fileInput" type="file">
							  </div>
							</div>  

							<div class="control-group">
							  <label class="control-label" for="date01">Joining Date</label>
							  <div class="controls">
								<input type="date" class="input-xlarge " name="date" >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Publication Status</label>
							  <div class="controls">
								<input type="checkbox" name="publication_status" value="1" >
							  </div>
							</div>

							



							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Products</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->



@endsection