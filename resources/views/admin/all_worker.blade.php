@extends('admin.admin_layout')
@section('admin_content')

	<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
				</div>

					   <p class="alert-success"> 
                      	<!-- //message  -->
                     	@php
                      	$message=Session::get('message');

                      	if($message)
                      	{
                      		echo $message;
                      		Session::put('message',null);
                    	}

                      	@endphp 
                    </p> 
				<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Worker Id</th>
								  <th>Worker Name</th>
								 
								  <th>Worker Image</th>
								  <th>Worker Title</th>
								  <th>Category Sub Title</th>
								  <th>Date</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
				  </thead>   
				  <tbody>


					  	@foreach($all_worker as $row)
					  	
						<tr>
							<td class="center">{{ $row->id }}</td>
								<td class="center">{{ $row->name }}</td>
								
                                <td><img src="{{URL::to($row->image)}}" style="height: 80px;width: 80px;"></td>
                                <td class="center">{{ $row->title }}</td>

                                <td class="center">{{ $row->sub_title }}</td>
                                <td class="center">{{ $row->date}}</td>

								<td class="center">
									@if($row->publication_status==1)
									<span class="label label-success"><!-- {{ $row->publication_status}} -->Active</span>
									@else
									<span class="label label-danger"><!-- {{ $row->publication_status}} -->Unactive</span>
									@endif

								</td>
								<td class="center">

									@if($row->publication_status==1)
									<a class="btn btn-danger" href="{{url('/unactive_worker/'.$row->id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
									@else
									<a class="btn btn-success" href="{{url('/active_worker/'.$row->id)}}">
										<i class="halflings-icon white thumbs-up"></i>  
									</a>
									@endif


								
								</td>
							</tr>
							@endforeach
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
@endsection