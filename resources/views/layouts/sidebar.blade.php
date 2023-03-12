<!-- Sidebar-right-->
		<div class="sidebar sidebar-left sidebar-animate">
			<div class="panel panel-primary card mb-0 box-shadow">
				<div class="tab-menu-heading border-0 p-3">
					<div class="card-title mb-0">الاشعارات</div>
					<div class="card-options mr-auto">
						<a href="#" class="sidebar-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
					<div class="tabs-menu ">
						<!-- Tabs -->
						<ul class="nav panel-tabs">
							<li class=""><a href="#side1" class="active" data-toggle="tab"><i class="ion ion-md-notifications tx-18  ml-2"></i> الكل</a></li>
							<li><a href="#side2" data-toggle="tab"><i class="ion ion-md-notifications tx-18  ml-2"></i>المقروءة</a></li>
							<li><a href="#side3" data-toggle="tab"><i class="las la-bell-slash tx-18  ml-2"></i> الغير مقروءة</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane active " id="side1">
                            @foreach (Auth::user()->notifications as $notification)
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">{{substr(($notification->data['by_user']),0,2)}}</span>
                                    </div>
                                    <a class="wrapper w-100 mr-3" href="{{url('/showNotification/'.$notification->data['invoice_id'])}}" >
                                        <p class="mb-0 d-flex ">
                                            <b>{{$notification->data['title']}}</b>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="las la-user text-muted ml-1"></i>
                                                <small class="text-muted ml-auto">تمت بواسطة {{$notification->data['by_user']}}</small>
                                                <p class="mb-0"></p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-clock text-muted ml-1"></i>
                                                <small class="text-muted ml-auto">{{$notification->created_at->format('H:i:s')}}</small>
                                                <p class="mb-0"></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
						</div>
						<div class="tab-pane  " id="side2">
							@foreach (Auth::user()->readNotifications as $notification)
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">{{substr(($notification->data['by_user']),0,2)}}</span>
                                    </div>
                                    <a class="wrapper w-100 mr-3" href="{{url('/showNotification/'.$notification->data['invoice_id'])}}" >
                                        <p class="mb-0 d-flex ">
                                            <b>{{$notification->data['title']}}</b>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="las la-user text-muted ml-1"></i>
                                                <small class="text-muted ml-auto">تمت بواسطة {{$notification->data['by_user']}}</small>
                                                <p class="mb-0"></p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-clock text-muted ml-1"></i>
                                                <small class="text-muted ml-auto">{{$notification->created_at->format('H:i:s')}}</small>
                                                <p class="mb-0"></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
						</div>
						<div class="tab-pane  " id="side3">
							@foreach (Auth::user()->unreadNotifications as $notification)
                                <div class="list d-flex align-items-center border-bottom p-3">
                                    <div class="">
                                        <span class="avatar bg-primary brround avatar-md">{{substr(($notification->data['by_user']),0,2)}}</span>
                                    </div>
                                    <a class="wrapper w-100 mr-3" href="{{url('/showNotification/'.$notification->data['invoice_id'])}}" >
                                        <p class="mb-0 d-flex ">
                                            <b>{{$notification->data['title']}}</b>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="las la-user text-muted ml-1"></i>
                                                <small class="text-muted ml-auto">تمت بواسطة {{$notification->data['by_user']}}</small>
                                                <p class="mb-0"></p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-clock text-muted ml-1"></i>
                                                <small class="text-muted ml-auto">{{$notification->created_at->format('H:i:s')}}</small>
                                                <p class="mb-0"></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
<!--/Sidebar-right-->
