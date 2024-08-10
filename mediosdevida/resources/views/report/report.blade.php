@extends('layout.page_layout')
@section('title', 'Home')
@section('content')
<!-- Page-header opened -->
<div class="page-header" >
	<div class="page-leftheader">
		<!--<h4 class="page-title mb-0">Overview</h4>-->
		<!--<small class="text-muted mt-0 fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</small>-->
	</div>
</div>


<div class="row">
	<div class="col-xl-12 col-lg-12 col-md-12 ">
			<div class="card" >
								<div class="card-header  " style="background: transparent;border:0px;" >
				<h2 class="card-title   ">{{ 'LISTA DE GRUPOS '}}</h2>
				<div class="card-options">
					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up   "></i></a>
					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize   "></i></a>
				</div>
			</div>
			<div class="card-body" style="padding-top: 0px;">
				<div class="">
					<div class="item2-gl table_r">
						<div class="table-responsive">
			 	<table class="table card-table border table-vcenter text-nowrap ">
				<thead>
					<tr>
						<th>Grupo</th>
						<th>Categoria 1</th>
						<th>Categoria 2</th>
						<th>Categoria 3</th>
						<th>Categoria 4</th>
						<th>Categoria 5</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody class="table_content">
					@isset($grupo)
					@forelse($grupo as $item )
					<tr>
						
						<th scope="row">
							{{ $item->TITULO }}  
						</th>
						<th scope="row">
							{{ $item->NOM_GRUPO_1 == null ? "" : $item->NOM_GRUPO_1  }}  
						</th>
						<th scope="row">
							{{ $item->NOM_GRUPO_2 == null ? "" : $item->NOM_GRUPO_2  }}  
						</th>
						<th scope="row">
							{{ $item->NOM_GRUPO_3 == null ? "" : $item->NOM_GRUPO_3  }}  
						</th>
						<th scope="row">
							{{ $item->NOM_GRUPO_4 == null ? "" : $item->NOM_GRUPO_4  }} 
						</th>
						<th scope="row">
							{{ $item->NOM_GRUPO_5 == null ? "" : $item->NOM_GRUPO_5  }} 
						</th>
						<th scope="row">
							<form method="POST" action="{{ route('report_1') }}" >
							@csrf
							<input type="hidden" name="id_grupo" value="{{ $item->ID_GRUPO }}"/>
							<button type="submit" class="btn btn-secondary btn-block bg-gradient-secondary btn-pill"> VER DETALLES </button>
							</form>
						</th>
						
					</tr>
					@empty
						<tr>
						    <td style="text-align:center;" colspan="100" class="text-warning">No se encontraron resultados</td>
						</tr>
			      @endforelse
			      @endisset
				</tbody>
			</table>
		 </div>
					</div>
		     </div>
			</div>
		        </div>
   </div>
</div>




<!--<div class="row">-->
<!--	<div class="col-md-4">-->
<!--		<div class="card overflow-hidden">-->
<!--			<div class="card-body">-->
<!--				<div class="d-flex">-->
<!--					<div class="">-->
<!--						<p class="mb-2 h6">Active Client</p>-->
<!--						<h2 class="mb-1 ">253</h2>-->
<!--						<p class="mb-0 text-muted"><span class="text-success">(+0.35%)<i class="fe fe-arrow-up text-success"></i></span>Increase</p>-->
<!--					</div>-->
<!--					<div class=" my-auto ml-auto">-->
<!--						<div class="chart-wrapper text-center">-->
<!--							<canvas id="areaChart1" class="areaChart2 chartjs-render-monitor chart-dropshadow-primary overflow-hidden mx-auto"></canvas>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col-md-4">-->
<!--		<div class="card overflow-hidden">-->
<!--			<div class="card-body">-->
<!--				<div class="d-flex">-->
<!--					<div class="">-->
<!--						<p class="mb-2 h6">Total Revenue</p>-->
<!--						<h2 class="mb-1 ">$365</h2>-->
<!--						<p class="mb-0 text-muted"><span class="text-danger">(+0.54%)</span><i class="fe fe-arrow-down text-danger"></i>Decrease</p>-->
<!--					</div>-->
<!--					<div class=" my-auto ml-auto">-->
<!--						<div class="chart-wrapper">-->
<!--							<canvas id="areaChart2" class="areaChart2 chartjs-render-monitor chart-dropshadow-secondary overflow-hidden"></canvas>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col-md-4">-->
<!--		<div class="card overflow-hidden">-->
<!--			<div class="card-body">-->
<!--				<div class="d-flex">-->
<!--					<div class="">-->
<!--						<p class="mb-2 h6">Sales</p>-->
<!--						<h2 class="mb-1 ">15,89</h2>-->
<!--						<p class="mb-0 text-muted"><span class="text-success">(+0.96%)<i class="fe fe-arrow-up text-success"></i></span>Increase</p>-->
<!--					</div>-->
<!--					<div class="my-auto ml-auto">-->
<!--						<div class="chart-wrapper">-->
<!--							<canvas id="areaChart3" class="areaChart3 chartjs-render-monitor chart-dropshadow-info overflow-hidden"></canvas>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--<div class="row">-->
<!--	<div class="col-xl-12 product">-->
<!--		<div class="card">-->
<!--			<div class="card-header">-->
<!--				<h3 class="card-title">Revenue</h3>-->
<!--				<div class="card-options ">-->
<!--					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>-->
<!--							<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>-->
<!--					<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="card-body">-->
<!--				<div class="row">-->
<!--					<div class="col-lg-12 col-xl-8">-->
<!--						<div class="chart-wrapper">-->
<!--							<canvas id="line-chart" class=" chartjs-render-monitor chart-dropshadow2 overflow-hidden"></canvas>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="col-lg-12 col-xl-4 lg-mt-5">-->
<!--						<div class="row">-->
<!--							<div class="col-6">-->
<!--								<div class="card box-shadow-0 overflow-hidden">-->
<!--									<div class="card-body p-4">-->
<!--										<div class="text-center">-->
<!--										   <i class="fa fa-tasks fa-2x text-primary text-primary-shadow"></i>-->
<!--										   <h3 class="mt-3 mb-0 ">07</h3>-->
<!--										   <small class="text-muted">Progress Tasks</small>-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--							 <div class="col-6">-->
<!--								<div class="card box-shadow-0 overflow-hidden">-->
<!--									<div class="card-body p-4">-->
<!--										<div class="text-center">-->
<!--										   <i class="fa fa-ticket fa-2x text-secondary text-secondary-shadow"></i>-->
<!--											<h3 class="mt-3 mb-0 ">03</h3>-->
<!--										   <small class="text-muted">Open Ticket</small>-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="col-6">-->
<!--								<div class="card box-shadow-0 mb-0 overflow-hidden">-->
<!--									<div class="card-body p-4">-->
<!--										<div class="text-center">-->
<!--										   <i class="fa fa-bug fa-2x text-success text-success-shadow"></i>-->
<!--										   <h3 class="mt-3 mb-0 ">02</h3>-->
<!--										   <small class="text-muted">In Progress Bugs</small>-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="col-6 ">-->
<!--								<div class="card box-shadow-0 mb-0 overflow-hidden">-->
<!--									<div class="card-body p-4">-->
<!--										<div class="text-center">-->
<!--										   <i class="fa fa-folder-open-o fa-2x text-info text-info-shadow"></i>-->
<!--										   <h3 class="mt-3 mb-0 ">04</h3>-->
<!--										   <small class="text-muted">Progress Projects</small>-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--<div class="row">-->
<!--	<div class="col-xl-4 col-lg-6 col-md-12">-->
<!--		<div class="card overflow-hidden">-->
<!--			<div class="card-header">-->
<!--				<h3 class="card-title">Activity</h3>-->
<!--				<div class="card-options ">-->
<!--					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>-->
<!--							<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>-->
<!--					<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="card-body">-->
<!--				<div class="latest-timeline-1 activity-scroll mh-300">-->
<!--					<ul class="timeline-1 mb-0">-->
<!--						<li class="mt-0">-->
<!--							<i class="fe fe-check bg-primary text-white product-icon primary-dropshadow"></i>-->
<!--							<a target="_blank" href="#" class="font-weight-semibold mb-4 fs-15">Task finished</a>-->
<!--							<a href="#" class="float-right fs-12 text-muted">01 Jun, 2019</a>-->
<!--							<p class="mb-0 mt-2 text-muted"><span class="text-primary font-weight-semibold">Adam	Berry</span>  finished task on<a href="#" class="text-info font-weight-semibold"> Project Management</a></p>-->
<!--							<div class="mt-2">-->
<!--								<span class="badge badge-success-light">Bootstrap</span>-->
<!--								<span class="badge badge-danger-light">HTML</span>-->
<!--								<span class="badge badge-warning-light">Css</span>-->
<!--							</div>-->
<!--						</li>-->
<!--						<li class="mt-0">-->
<!--							<i class="fe fe-message-square bg-secondary text-white product-icon secondary-dropshadow"></i>-->
<!--							<a target="_blank" href="#" class="font-weight-semibold mb-4 fs-15">New Comment</a>-->
<!--							<a href="#" class="float-right fs-12 text-muted">05 Jun, 2019</a>-->
<!--							<p class="mb-0 mt-2 text-muted"><span class="text-primary font-weight-semibold">Victoria</span> commented on Project <a href="#" class="text-info font-weight-semibold"> AngularJS Template</a></p>-->
<!--						</li>-->
<!--						<li class="mt-0">-->
<!--							<i class="fe fe-alert-triangle bg-danger text-white product-icon danger-dropshadow"></i>-->
<!--							<a target="_blank" href="#" class="font-weight-semibold mb-4 fs-15">Task Overdue</a>-->
<!--							<a href="#" class="float-right fs-12 text-muted">01 Jun, 2019</a>-->
<!--							<p class="mb-0 mt-2"> Task the <span class="text-info font-weight-semibold">Wordpress Project</span> is on hold its takes longer than usual.</p>-->
<!--							<div class="mt-2">-->
<!--								<span class="badge badge-success-light">Bootstrap</span>-->
<!--								<span class="badge badge-danger-light">HTML</span>-->
<!--								<span class="badge badge-warning-light">Css</span>-->
<!--							</div>-->
<!--						</li>-->
<!--						<li class="mt-0">-->
<!--							<i class="fe fe-check bg-success text-white product-icon success-dropshadow"></i>-->
<!--							<a target="_blank" href="#" class="font-weight-semibold mb-4 fs-15">Task finished</a>-->
<!--							<a href="#" class="float-right fs-12 text-muted">01 Jun, 2019</a>-->
<!--							<p class="mb-0 mt-2"><span class="text-primary font-weight-semibold">Petey Cruiser</span> finished task <a href="#" class="text-info font-weight-semibold"> Integrated management</a></p>-->
<!--							<div class="mt-2">-->
<!--								<span class="badge badge-success-light">Bootstrap</span>-->
<!--								<span class="badge badge-danger-light">HTML</span>-->
<!--								<span class="badge badge-warning-light">Css</span>-->
<!--							</div>-->
<!--						</li>-->
<!--						<li class="mt-0">-->
<!--							<i class="fe fe-check bg-success text-white product-icon success-dropshadow"></i>-->
<!--							<a target="_blank" href="#" class="font-weight-semibold mb-4 fs-15">Task finished</a>-->
<!--							<a href="#" class="float-right fs-12 text-muted">01 Jun, 2019</a>-->
<!--							<p class="mb-0 mt-2"><span class="text-primary font-weight-semibold">Manuel Labor</span> finished task <a href="#" class="text-info font-weight-semibold"> Program Management</a></p>-->
<!--							<div class="mt-2">-->
<!--								<span class="badge badge-success-light">Bootstrap</span>-->
<!--								<span class="badge badge-danger-light">HTML</span>-->
<!--								<span class="badge badge-warning-light">Css</span>-->
<!--							</div>-->
<!--						</li>-->
<!--						<li class="mt-0 mb-0">-->
<!--							<i class="fe fe-message-square bg-info text-white product-icon info-dropshadow"></i>-->
<!--							<a target="_blank" href="#" class="font-weight-semibold mb-4 fs-15">Warren Peace</a>-->
<!--							<a href="#" class="float-right fs-12 text-muted">01 Jun, 2019</a>-->
<!--							<p class="mb-0 mt-2"><span class="text-primary font-weight-semibold">Adam	Berry</span> commented on task <a href="#" class="text-info font-weight-semibold"> AngularJS Template</a></p>-->
<!--						</li>-->
<!--					</ul>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col-xl-4 col-lg-6">-->
<!--		<div class="card">-->
<!--			<div id="carousel-indicator" class="carousel slide dashboard-carousel" data-ride="carousel">-->
<!--				<div class="carousel-inner">-->
<!--					<div class="carousel-item active">-->
<!--						<div class="card-body">-->
<!--							<h4 class="card-title mb-4">Open Payements</h4>-->
<!--							<small class=""> Since last month</small>-->
<!--							<div class="d-flex  align-items-center">-->
<!--								<h2 class=" mb-0">$3500.00<span class="font-weight-normal text-muted fs-13">/ per month</span></h2>-->
<!--								<div class="text-success mt-0 mb-2  ml-auto">-->
<!--									<i class="mdi mdi-chevron-down mdi-24px"></i> <span class=" ">23.8%</span>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="carousel-item carousel slide dashboard-carousel" data-ride="carousel">-->
<!--						<div class="card-body">-->
<!--							<h4 class="card-title mb-4">Open Tasks</h4>-->
<!--							<small class=""> Since last month</small>-->
<!--							<div class="d-flex  align-items-center">-->
<!--								<h2 class=" mb-0">23<span class="font-weight-normal text-muted fs-13">/ per month</span></h2>-->
<!--								<div class="text-danger mt-0 mb-2  ml-auto">-->
<!--									<i class="mdi mdi-chevron-down mdi-24px"></i> <span class=" ">12.8%</span>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<a class="carousel-control-prev" href="#carousel-indicator" role="button" data-slide="prev">-->
<!--					<span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--					<span class="sr-only">Previous</span>-->
<!--				</a>-->
<!--				<a class="carousel-control-next" href="#carousel-indicator" role="button" data-slide="next">-->
<!--					<span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--					<span class="sr-only">Next</span>-->
<!--				</a>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="card overflow-hidden">-->
<!--			<div class="card-header border-bottom-0">-->
<!--				<div class="card-title d-block">Earnings</div>-->
<!--				<div class="card-options">-->

<!--				</div>-->
<!--			</div>-->
<!--			<div class="card-body pt-0 pb-0">-->
<!--				<small class="">Weekly Earning Report</small>-->
<!--				<div class="d-flex mb-4">-->
<!--					<div class="d-flex  align-items-center">-->
<!--						<h2 class="">$7450.40<span class="font-weight-normal text-muted fs-13">/ per month</span></h2>-->
<!--					</div>-->
<!--					<span class="text-success ml-auto"><i class="fe fe-arrow-up mr-2"></i>24.05%</span>-->
<!--				</div>-->

<!--			</div>-->
<!--			<div class="chart-wrapper ">-->
<!--				<canvas id="earning" class="earning chart-dropshadow-primary mb-3 mt-2 h-50"></canvas>-->
<!--			</div>-->
<!--			<div class="row mb-5">-->
<!--				<div class="col-6 text-center border-right">-->
<!--					<div class="text-muted fs-14">Daily Profit</div>-->
<!--					<div class="h3 mt-1 mb-0">$540</div>-->
<!--					<span class="text-muted mb-0 fs-14"><span class="text-success mr-1"><i class="fe fe-arrow-up ml-1"></i>34.5%</span>increase</span>-->
<!--				</div>-->
<!--				<div class="col-6 text-center">-->
<!--					<div class="text-muted fs-14">Last Month Profit</div>-->
<!--					<div class="h3 mt-1 mb-0">36</div>-->
<!--					<span class="text-muted mb-0 fs-14"><span class="text-danger mr-1"><i class="fe fe-arrow-down ml-1"></i>34.5%</span>Decrease</span>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col-xl-4 col-lg-12 col-md-12">-->
<!--		<div class="card">-->
<!--			<div id="carousel-indicator1" class="carousel slide dashboard-carousel" data-ride="carousel">-->
<!--				<div class="carousel-inner">-->
<!--					<div class="carousel-item active">-->
<!--						<div class="card-body">-->
<!--							<h4 class="card-title mb-4">Open Invoice</h4>-->
<!--							<small class=""> Since last month</small>-->
<!--							<div class="d-flex  align-items-center">-->
<!--								<h2 class=" mb-0">45,981<span class="font-weight-normal text-muted fs-13">/ per month</span></h2>-->
<!--								<div class="text-success mt-0 mb-2  ml-auto">-->
<!--									<i class="mdi mdi-chevron-down mdi-24px"></i> <span class=" ">38.5%</span>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="carousel-item carousel slide dashboard-carousel" data-ride="carousel">-->
<!--						<div class="card-body">-->
<!--							<h4 class="card-title mb-4">Paid Invoices</h4>-->
<!--							<small class=""> Since last month</small>-->
<!--							<div class="d-flex  align-items-center">-->
<!--								<h2 class=" mb-0">32,579<span class="font-weight-normal text-muted fs-13">/ per month</span></h2>-->
<!--								<div class="text-danger mt-0 mb-2  ml-auto">-->
<!--									<i class="mdi mdi-chevron-down mdi-24px"></i> <span class=" ">22.8%</span>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<a class="carousel-control-prev" href="#carousel-indicator1" role="button" data-slide="prev">-->
<!--					<span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--					<span class="sr-only">Previous</span>-->
<!--				</a>-->
<!--				<a class="carousel-control-next" href="#carousel-indicator1" role="button" data-slide="next">-->
<!--					<span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--					<span class="sr-only">Next</span>-->
<!--				</a>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="card">-->
<!--			<div class="card-header">-->
<!--				<h3 class="card-title">Project Status</h3>-->
<!--				<div class="card-options ">-->
<!--					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>-->
<!--					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>-->
<!--					<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="card-body">-->
<!--				<div class="mb-4">-->
<!--					<div class="clearfix mb-4">-->
<!--						<div class="float-left">-->
<!--							<strong class="fs-15 font-weight-semibold">Project1</strong>-->
<!--						</div>-->
<!--						<div class="float-right">-->
<!--							<small class="badge badge-success-light">Completed</small>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="progress progress-xs mt-2">-->
<!--						<div class="progress-bar   bg-primary w-95"></div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="mb-4">-->
<!--					<div class="clearfix mb-4">-->
<!--						<div class="float-left">-->
<!--							<strong class="fs-15 font-weight-semibold">Project2</strong>-->
<!--						</div>-->
<!--						<div class="float-right">-->
<!--							<small class="badge badge-warning-light">On-going</small>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="progress progress-xs mt-2">-->
<!--						<div class="progress-bar  bg-warning w-65"></div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="mb-4">-->
<!--					<div class="clearfix mb-4">-->
<!--						<div class="float-left">-->
<!--							<strong class="fs-15 font-weight-semibold">Project3</strong>-->
<!--						</div>-->
<!--						<div class="float-right">-->
<!--							<small class="badge badge-danger-light">Pending</small>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="progress progress-xs mt-2">-->
<!--						<div class="progress-bar   bg-danger w-45"></div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="mb-4">-->
<!--					<div class="clearfix mb-4">-->
<!--						<div class="float-left">-->
<!--							<strong class="fs-15 font-weight-semibold">Project4</strong>-->
<!--						</div>-->
<!--						<div class="float-right">-->
<!--							<small class="badge badge-success-light">Completed</small>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="progress progress-xs mt-2">-->
<!--						<div class="progress-bar   bg-success w-95"></div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="mb-2">-->
<!--					<div class="clearfix mb-3">-->
<!--						<div class="float-left">-->
<!--							<strong class="fs-15 font-weight-semibold">Project5</strong>-->
<!--						</div>-->
<!--						<div class="float-right">-->
<!--							<small class="badge badge-warning-light">Ongoing</small>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="progress progress-xs mt-2">-->
<!--						<div class="progress-bar   bg-info w-65"></div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--<div class="row">-->
<!--	<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">-->
<!--		<div class="card overflow-hidden">-->
<!--			<div class="card-header">-->
<!--				<div class="card-title">Lead Stats</div>-->
<!--				<div class="card-options">-->
<!--					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>-->
<!--					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>-->
<!--					<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="card-body pt-0 overflow-hidden">-->
<!--				<div class="chart-wrapper">-->
<!--					<canvas id="leads" class="h-300"></canvas>-->
<!--				</div>-->
<!--				<div class="mt-4">-->
<!--					<div class="row">-->
<!--						<div class="col-xl-4 col-sm-12">-->
<!--							<small class="">Total Leads</small>-->
<!--							<div class="clearfix mt-2">-->
<!--								<div class="float-left">-->
<!--									<div class="align-items-center">-->
<!--										<h3 class=" mb-0">2154<span class="font-weight-normal text-muted fs-13"> / per month</span></h3>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="float-right">-->
<!--									<small class="badge badge-info-light">75%</small>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="progress progress-xs mt-2">-->
<!--								<div class="progress-bar  bg-info w-75"></div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="col-xl-4 col-sm-12 mt-3 mt-md-0">-->
<!--							<small class="">Open Leads</small>-->
<!--							<div class="clearfix mt-2">-->
<!--								<div class="float-left">-->
<!--									<div class="align-items-center">-->
<!--										<h3 class=" mb-0">950<span class="font-weight-normal text-muted fs-13"> / active</span></h3>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="float-right">-->
<!--									<small class="badge badge-primary-light">65%</small>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="progress progress-xs mt-2">-->
<!--								<div class="progress-bar  bg-primary w-65"></div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="col-xl-4 col-sm-12 mt-3 mt-md-0">-->
<!--							<small class="">Closed Leads</small>-->
<!--							<div class="clearfix mt-2">-->
<!--								<div class="float-left">-->
<!--									<div class="align-items-center">-->
<!--										<h3 class=" mb-0">480<span class="font-weight-normal text-muted fs-13"> / active</span></h3>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="float-right">-->
<!--									<small class="badge badge-secondary-light">40%</small>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="progress progress-xs mt-2">-->
<!--								<div class="progress-bar  bg-secondary w-40"></div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">-->
<!--		<div class="card ">-->
<!--			<div class="card-header">-->
<!--				<div class="card-title">Upcoming Events</div>-->
<!--				<div class="card-options">-->
<!--					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>-->
<!--								<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>-->
<!--					<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="card-body coming-events p-0">-->
<!--				<div class="list-group list-group-flush ">-->
<!--					<div class="list-group-item d-flex pt-3 pb-3 align-items-center">-->
<!--						<div class="mr-3 mr-xs-0">-->
<!--							<div class="calendar-icon icons">-->
<!--								<div class="icon">-->
<!--									<span class="month">Thu</span>-->
<!--									<span class="date">25</span>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="">-->
<!--							<div class="h5 fs-15 mb-1">Strategy Planning</div>-->
<!--							<small class="text-muted">25th sept,Delhi-->
<!--							</small>-->
<!--						</div>-->
<!--						<div class="ml-auto">-->
<!--							<a href="#" class="btn btn-sm btn-primary">Email</a>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="list-group-item d-flex pt-3 pb-3 align-items-center">-->
<!--						<div class="mr-3 mr-xs-0">-->
<!--							<div class="calendar-icon icons">-->
<!--								<div class="icon">-->
<!--									<span class="month bg-info">Wed</span>-->
<!--									<span class="date">31</span>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="">-->
<!--							<div class="h5 fs-15 mb-1">Hiring Employees</div>-->
<!--							<small class="text-muted">31st jan,Mumbai-->
<!--							</small>-->
<!--						</div>-->
<!--						<div class="ml-auto">-->
<!--							<a href="#" class="btn btn-sm btn-info">Skype</a>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="list-group-item d-flex pt-3 pb-3 align-items-center">-->
<!--						<div class="mr-3 mr-xs-0">-->
<!--							<div class="calendar-icon icons">-->
<!--								<div class="icon">-->
<!--									<span class="month bg-success">Mon</span>-->
<!--									<span class="date">05</span>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="">-->
<!--							<div class="h5 fs-15 mb-1">Traning</div>-->
<!--							<small class="text-muted">5th feb,Pune-->
<!--							</small>-->
<!--						</div>-->
<!--						<div class="ml-auto">-->
<!--							<a href="#" class="btn btn-sm btn-success">Mobile</a>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="list-group-item d-flex pt-3 pb-3 align-items-center">-->
<!--						<div class="mr-3 mr-xs-0">-->
<!--							<div class="calendar-icon icons">-->
<!--								<div class="icon">-->
<!--									<span class="month bg-warning">Sat</span>-->
<!--									<span class="date">12</span>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="">-->
<!--							<div class="h5 fs-15 mb-1">Finance policy </div>-->
<!--							<small class="text-muted">12th mar,Banglore-->
<!--							</small>-->
<!--						</div>-->
<!--						<div class="ml-auto">-->
<!--							<a href="#" class="btn btn-sm btn-warning">Phone</a>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="list-group-item pt-3 pb-3 d-flex align-items-center">-->
<!--						<div class="mr-3 mr-xs-0">-->
<!--							<div class="calendar-icon icons">-->
<!--								<div class="icon">-->
<!--									<span class="month bg-danger">Tue</span>-->
<!--									<span class="date">17</span>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="">-->
<!--							<div class="h5 fs-15 mb-1">Marketing Policy</div>-->
<!--							<small class="text-muted">17th Mar,Spain-->
<!--							</small>-->
<!--						</div>-->
<!--						<div class="ml-auto">-->
<!--							<a href="#" class="btn btn-sm btn-primary">Skype</a>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="list-group-item pt-3 pb-3 d-flex align-items-center">-->
<!--						<div class="mr-3 mr-xs-0">-->
<!--							<div class="calendar-icon icons">-->
<!--								<div class="icon">-->
<!--									<span class="month bg-dark">Fri</span>-->
<!--									<span class="date">19</span>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="">-->
<!--							<div class="h5 fs-15 mb-1">Accounting Policy</div>-->
<!--							<small class="text-muted">19th may,Australia-->
<!--							</small>-->
<!--						</div>-->
<!--						<div class="ml-auto">-->
<!--							<a href="#" class="btn btn-sm btn-pink">Email</a>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--<div class="row">-->
<!--	<div class="col-xl-4 col-lg-6">-->
<!--		<div class="card recent-leads">-->
<!--			<div class="card-header">-->
<!--				<h4 class="card-title">Recent Leads</h4>-->
<!--			</div>-->
<!--			<div class="card-body">-->
<!--				<div class="media mt-0 pt-0 mb-5">-->
<!--					<img class="mr-3 avatar avatar-lg brround default-shadow" src="{{ asset('images_theme/users/2.jpg')}}" alt="image">-->
<!--					<div class="media-body">-->
<!--						<h5 class="mt-0 mb-0">Petey Cruiser</h5>-->
<!--						<span class="fs-14 text-muted">PeteyCruiser@gmail.com</span>-->
<!--					</div>-->
<!--					<span class="badge badge-warning-light fs-12">Cold lead</span>-->
<!--				</div>-->
<!--				<div class="media mb-5">-->
<!--					<img class="mr-3 avatar avatar-lg brround default-shadow" src="{{ asset('images_theme/users/11.jpg')}}" alt="image">-->
<!--					<div class="media-body">-->
<!--						<h5 class="mt-0 mb-0">Paul Molive</h5>-->
<!--						<span class="fs-14 text-muted">PaulMolive65@gmail.com</span>-->
<!--					</div>-->
<!--					<span class="badge badge-success-light fs-12">Won lead</span>-->
<!--				</div>-->
<!--				<div class="media mb-5">-->
<!--					<img class="mr-3 avatar avatar-lg brround default-shadow" src="{{ asset('images_theme/users/5.jpg')}}" alt="image">-->
<!--					<div class="media-body">-->
<!--						<h5 class="mt-0 mb-0">Barney Cull</h5>-->
<!--						<span class="fs-14 text-muted">BarneyCull@gmail.com</span>-->
<!--					</div>-->
<!--					<span class="badge badge-danger-light fs-12">Lost lead</span>-->
<!--				</div>-->
<!--				<div class="media mb-5">-->
<!--					<img class="mr-3 avatar avatar-lg brround default-shadow" src="{{ asset('images_theme/users/12.jpg')}}" alt="image">-->
<!--					<div class="media-body">-->
<!--						<h5 class="mt-0 mb-0">Manuel Labor</h5>-->
<!--						<span class="fs-14 text-muted">ManuelLabor@gmail.com</span>-->
<!--					</div>-->
<!--					<span class="badge badge-warning-light fs-12">Cold lead</span>-->
<!--				</div>-->
<!--				<div class="media">-->
<!--					<img class="mr-3 avatar avatar-lg brround default-shadow" src="{{ asset('images_theme/users/6.jpg')}}" alt="image">-->
<!--					<div class="media-body">-->
<!--						<h5 class="mt-0 mb-0">Risa Pearson</h5>-->
<!--						<span class="fs-14 text-muted">richardjohn@mail.com</span>-->
<!--					</div>-->
<!--					<span class="badge badge-success-light fs-12">Won lead</span>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col-lg-6 col-xl-4 col-sm-12">-->
<!--		<div class="card overflow-hidden">-->
<!--			<div class="">-->
<!--				<div class="text-center">-->
<!--					<img src="{{asset('images_theme/media/project-1.jpg')}}" alt="img" class="h-200 w-100">-->
<!--				</div>-->
<!--				<div class="mt-3">-->
<!--					<div class="row pt-2 pb-2 pl-5 pr-5 mt-0 ">-->
<!--						<div class="col">-->
<!--							<span class="mb-0 mt-1 fs-15">Project name:</span>-->
<!--						</div>-->
<!--						<div class="col col-auto text-muted fs-15">Project Management</div>-->
<!--					</div>-->

<!--					<div class="row pt-2 pb-2 pl-5 pr-5">-->
<!--						<div class="col">-->
<!--							<span class="mb-0 mt-1 fs-15">Duration:</span>-->
<!--						</div>-->
<!--						<div class="col col-auto text-muted fs-15">5months</div>-->
<!--					</div>-->
<!--					<div class="row pt-2 pb-2 pl-5 pr-5">-->
<!--						<div class="col">-->
<!--							<span class="mb-0 mt-1 fs-15">Budget:</span>-->
<!--						</div>-->
<!--						<div class="col col-auto text-muted fs-15">$35,7364</div>-->
<!--					</div>-->
<!--					<div class="mb-2 mt-3 pl-5 pb-5 pr-5">-->
<!--						<div class="clearfix mb-3">-->
<!--							<div class="float-left">-->
<!--								<strong class="fs-15 font-weight-semibold">Project5</strong>-->
<!--							</div>-->
<!--							<div class="float-right">-->
<!--								<small class="badge badge-success-light">ongoing</small>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="progress progress-xs mt-2">-->
<!--							<div class="progress-bar   bg-primary w-65"></div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col-lg-12 col-xl-4 col-sm-12">-->
<!--		<div class="card">-->
<!--			<div class="card-header custom-header">-->
<!--				<div>-->
<!--					<h3 class="card-title">Top Ongoing Projects</h3>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="card-body p-0 m-scroll mh-350">-->
<!--				<div class="list-group projects-list">-->
<!--					<a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-top-0">-->
<!--						<div class="d-flex w-100 justify-content-between">-->
<!--							<h5 class="mb-1 font-weight-semibold">PSD Projects</h5>-->
<!--							<small class="text-danger"><i class="fa fa-caret-down mr-1"></i>5 days ago</small>-->
<!--						</div>-->
<!--						<p class="mb-0 text-muted mb-1">Started:17-02-2019</p>-->
<!--						<small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit...</small>-->
<!--					</a>-->
<!--					<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">-->
<!--						<div class="d-flex w-100 justify-content-between">-->
<!--							<h5 class="mb-1 font-weight-semibold">Wordpress Projects</h5>-->
<!--							<small class="text-success"><i class="fa fa-caret-up mr-1"></i>2 days ago</small>-->
<!--						</div>-->
<!--						<p class="mb-0 text-muted mb-1">Started:15-02-2019</p>-->
<!--						<small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit..</small>-->
<!--					</a>-->
<!--					<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">-->
<!--						<div class="d-flex w-100 justify-content-between">-->
<!--							<h5 class="mb-1 font-weight-semibold">HTML &amp; CSS3 Projects</h5>-->
<!--							<small class="text-danger"><i class="fa fa-caret-down mr-1"></i>1 days ago</small>-->
<!--						</div>-->
<!--						<p class="mb-0 text-muted mb-1">Started:26-02-2019</p>-->
<!--						<small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit..</small>-->
<!--					</a>-->
<!--					<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">-->
<!--						<div class="d-flex w-100 justify-content-between">-->
<!--							<h5 class="mb-1 font-weight-semibold">HTML &amp; CSS3 Projects</h5>-->
<!--							<small class="text-danger"><i class="fa fa-caret-down mr-1"></i>1 days ago</small>-->
<!--						</div>-->
<!--						<p class="mb-0 text-muted mb-1">Started:26-02-2019</p>-->
<!--						<small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit..</small>-->
<!--					</a>-->
<!--					<a href="#" class="list-group-item list-group-item-action flex-column align-items-start br-br-7 br-bl-7">-->
<!--						<div class="d-flex w-100 justify-content-between">-->
<!--							<h5 class="mb-1 font-weight-semibold">Java Projects</h5>-->
<!--							<small class="text-success"><i class="fa fa-caret-up mr-1"></i>10 days ago</small>-->
<!--						</div>-->
<!--						<p class="mb-1">Started:06-02-2019</p>-->
<!--						<small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit..</small>-->
<!--					</a>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--><!-->
@endsection
