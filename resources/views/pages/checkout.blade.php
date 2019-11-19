@extends('layout')

@section('content')

<section id="cart_items">
		<div class="container">
		

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
				
					<div class="col-sm-8 clearfix">
						<div class="bill-to">
							<p>Shipping Details</p>
							<div class="form-one">
								<form action="{{url('/save_shipping_details')}}" method="post">
									@csrf
								
									<input type="text" name="shipping_email" placeholder="Email*">
									
									<input type="text" name="shipping_first_name"  placeholder="First Name *">
									
									<input type="text" name="shipping_last_name" placeholder="Last Name *">
									<input type="text" name="shipping_address" placeholder="Address *">
									<input type="text" placeholder="Mobile Number *" name="shipping_mobile_number">
									<input type="text" name="shipping_city" placeholder="City *">
									<input type="submit" value="Done" class="btn btn-warning">
									
								</form>
							</div>
							
						</div>
					</div>
									
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>


			
		</div>
	</section> <!--/#cart_items-->


@endsection