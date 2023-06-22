@extends('public')

@section('title')
    @parent
    Home
@stop

@section('content')
<div class="page-content bg-white">
        <!-- Main Slider -->
        <div class="section-area section-sp1 ovpr-dark bg-fix online-cours">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center text-white">
							<span ><h3 style="color: rgb(192, 188, 188);">Tanzania Advocate Management System (TAMS)</h3></span>
							<h2 style="color: white;">Know the advocate</h2>
							<form class="cours-search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search by name or roll number	">
									
								</div>
							</form>
						</div>
					</div>
					<div class="mw800 m-auto justify-content-center">
						<div class="row justify-content-center">
							<div class="col-md-4 justify-content-center">
								<div class="cours-search-bx m-b30">
									<span class="cours-search-text">New Petition!</span>
									<span class="cours-search-text">Window opped on 20/06/2021</span> 
									<span class="cours-search-text">Window closed on 20/07/2021</span> 
									<div class="justify-content-center">
										<a href="{{ url('advocate-registration') }}" class="btn">Apply Nowdd</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
    </div>
@stop
