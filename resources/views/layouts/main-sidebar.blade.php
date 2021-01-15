<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
                            <img alt="user-img" class="avatar avatar-xl brround"
                            @if(empty(Auth::user()->user_image) and Auth::user()->user_gender === 'ذكر')
                                src="{{asset('images/users/avatar.png')}}"
                            @elseif(empty(Auth::user()->user_image) and Auth::user()->user_gender === 'أنثي')
                                src="{{asset('images/users/avtar-female.png')}}"
                            @else
                                src="{{asset('images/users')}}/{{Auth::user()->user_image}}"
                            @endif
                            ><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
                        <h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->user_fname}} {{Auth::user()->user_lname}}</h4>
							<span class="mb-0 text-muted">{{Auth::user()->email}}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">الرئيسية</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='home') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">لوحة القيادة</span><span class="badge badge-success side-badge">1</span></a>
					</li>
					<li class="side-item side-item-category">عام</li>
                    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">الاون لاين</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='chart-morris') }}">إنشاء فاتورة</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='chart-flot') }}">أضافة عميل جديد</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='chart-chartjs') }}">الفواتير الخاصه بي</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='chart-peity') }}">فواتير مدفوعه</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='chart-echart') }}">فواتير تم شحنها</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='chart-sparkline') }}">فواتير مؤجلة</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='chart-peity') }}">فواتير مدفوعه</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='chart-peity') }}">طلب ارنجاع</a></li>
						</ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">الفواتير</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="{{ url('/' . $page='invoices') }}">قائمة الفواتير</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='chart-flot') }}">الفواتير المدفوعة</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='chart-chartjs') }}">الفواتير الغير مدفوعه</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='chart-echart') }}">الفواتير المدفوعة جزئيا</a></li>
                        </ul>
                    </li>
                    <li class="side-item side-item-category">الحسابات</li>
                    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><i class="fas fa-hand-holding-usd side-menu__icon text-center" style="height: 35px; font-size:18px"></i><span class="side-menu__label">رواتب و سلف الموظفين</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='advancePayment') }}">قائمة السلف</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='advancePayment/create') }}">أضافة سلفة</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='ClosingSalary') }}">تقفيل الراتب</a></li>
						</ul>
                    </li>
                    <li class="side-item side-item-category">الاعدادات</li>

                    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><i class="fas fa-box-open side-menu__icon text-center" style="height: 35px; font-size:18px"></i><span class="side-menu__label">المخازن</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='storesMaterials') }}">مخازن خامات</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='materials') }}">الخامات</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='storesGoods') }}">مخازن منتجات</a></li>

							<li><a class="slide-item" href="{{ url('/' . $page='products') }}">المنتجات</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='products/create') }}">اضافة منتج</a></li>
						</ul>
                    </li>
                    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><i class="si si-layers side-menu__icon text-center" style="height: 35px; font-size:18px"></i><span class="side-menu__label">الاقسام</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            <li><a class="slide-item" href="{{ url('/' . $page='sectionUsers') }}">أقسام الموظفين</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='sections') }}">اقسام المنتجات</a></li>
						</ul>
                    </li>
                    @can('المستخدمين')
                    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><i class="fas fa-users side-menu__icon text-center" style="height: 35px; font-size:18px"></i><span class="side-menu__label">المستخدمين</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            @can('قائمةالمستخدمين')
                            <li><a class="slide-item" href="{{ url('/' . $page='users') }}">قائمة المستخدمين</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='users/active') }}">قائمة المستخدمين المفعلين</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='users/notactive') }}">قائمة المستخدمين الموقوفين</a></li>
                            @endcan
                            @can("اضافةمستخدم")
                            <li><a class="slide-item" href="{{ url('/' . $page='users/create') }}">أضافة مستخدم</a></li>
                            @endcan
                            @can('مستخدمين محذوفين')
                            <li><a class="slide-item" href="{{ url('/' . $page='users/trashUser') }}">مستخدمين محذوفين</a></li>
                            @endcan
                            @can('قائمة الصلاحيات')
                            <li><a class="slide-item" href="{{ url('/' . $page='roles') }}">صلاحيات المستخدمين</a></li>
                            @endcan
                            @can('اضافة صلاحية')
                            <li><a class="slide-item" href="{{ url('/' . $page='roles/create') }}">اضافة صلاحية</a></li>
                            @endcan
						</ul>
                    </li>
                    @endcan
                    @can('الموردين')
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><i class="si si-briefcase side-menu__icon text-center" style="height: 35px; font-size:18px"></i><span class="side-menu__label">الموردين</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            @can('قائمةالموردين')
                            <li><a class="slide-item" href="{{ url('/' . $page='suppliers') }}">قائمة الموردين</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='suppliers/active') }}">قائمة الموردين المفعلين</a></li>
                            <li><a class="slide-item" href="{{ url('/' . $page='suppliers/notactive') }}">قائمة الموردين الموقوفين</a></li>
                            @endcan
                            @can('اضافةمورد')
                            <li><a class="slide-item" href="{{ url('/' . $page='suppliers/create') }}">اضافة مورد</a></li>
                            @endcan
                            @can('موردين محذوفين')
                            <li><a class="slide-item" href="{{ url('/' . $page='suppliers/trashEmployees') }}">موردين محذوفين</a></li>
                            @endcan
						</ul>
                    </li>
                    @endcan
                    @can('العملاء')
                    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><i class="si si-bag side-menu__icon text-center" style="height: 35px; font-size:18px"></i><span class="side-menu__label">العملاء</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            @can('قائمةالعملاء')
                            <li><a class="slide-item" href="{{ url('/' . $page='customers') }}">قائمة العملاء</a></li>
                            @endcan
                            @can('اضافةعميل')
                            <li><a class="slide-item" href="{{ url('/' . $page='customers/create') }}">اضافة عميل</a></li>
                            @endcan
                            @can('عملاء محذوفين')
                            <li><a class="slide-item" href="{{ url('/' . $page='customers/trashedCustomers') }}">عملاء محذوفين</a></li>
                            @endcan
						</ul>
                    </li>
                    @endcan
                    @can('الموظفين')
                    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><i class="fas fa-user-tie side-menu__icon text-center" style="height: 35px; font-size:18px"></i><span class="side-menu__label">الموظفين</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            @can("قائمةالموظفين")
                                <li><a class="slide-item" href="{{ url('/' . $page='employees') }}">قائمةالموظفين</a></li>
                            @endcan
                            @can('أضافة موظف')
                                <li><a class="slide-item" href="{{ url('/' . $page='employees/create') }}">أضافة موظف</a></li>
                            @endcan
                            @can('قائمةالموظفين')
                                <li><a class="slide-item" href="{{ url('/' . $page='employees/active') }}">موظفين مفعلين</a></li>
                            @endcan
                            @can('قائمةالموظفين')
                                <li><a class="slide-item" href="{{ url('/' . $page='employees/notactive') }}">موظفين موقوفين</a></li>
                            @endcan
                            @can('موظفين محذوفين')
                                <li><a class="slide-item" href="{{ url('/' . $page='employees/trashEmployees') }}">موظفين محذوفين</a></li>
                            @endcan
						</ul>
                    </li>
                    @endcan
                    <li class="side-item side-item-category">خروج</li>
					<li class="slide">
                        <a class="side-menu__item" href="{{ route('locked')}}"><i class="fas fa-lock side-menu__icon text-center" style="height: 35px; font-size:18px"></i><span class="side-menu__label">شاشة القفل</span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" ><i class="bx bx-log-out side-menu__icon text-center" style="height: 35px; font-size:18px"></i><span class="side-menu__label">تسجيل خروج</span></a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none">
                            @csrf
                        </form>
					</li>
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
