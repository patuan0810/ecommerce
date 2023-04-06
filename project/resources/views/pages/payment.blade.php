@extends('layout')
@section('title','Thanh toán')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Payment</li>
				</ol>
			</div><!--/breadcrums-->
<div class="review-payment">
				<h2>Xem lại giỏ hàng và thanh toán</h2>
			</div>

			<div class="table-responsive cart_info">
				<?php
					$content = Cart::content(); // hien thi tat ca noi dung
					// echo '<pre>';
					// print_r($content);
					// echo '<pre>';
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình Ảnh</td>
							<td class="description">Mổ Tả Sản Phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Tổng Tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('frontend/images/product/'.$v_content->options->image)}}" width="70" alt="" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Mã Sản Phẩm: {{$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-quantity')}}" method="POST">
										{{csrf_field()}}
										<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}">
										<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
										<input type="submit" value="Cập Nhật" name="update_qty" class="btn btn-default btn-sm">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php
										$subtotal = $v_content->price * $v_content->qty;
										echo number_format($subtotal);
									?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>	
						@endforeach
					</tbody>
				</table>
			</div>
			<h4 style = "margin: 40px 0; font-size: 20px">Chọn hình thức thanh toán:</h4>
			<form action="{{URL::to('/order-place')}}" method="POST">
			{{csrf_field()}}
			<div class="payment-options">
					<span>
						<label><input name="payment_option" type="checkbox" value="1"> Thanh toán khi nhận hàng</label>
					</span>
					{{-- <span>
						<label><input type="checkbox" value="2"> Thanh toán bằng thẻ ngân hàng</label>
					</span> --}}
					<input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm">
			</div>
			</form>
        </div>
    </div>
<section>
@endsection