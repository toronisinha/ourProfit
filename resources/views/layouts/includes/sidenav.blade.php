<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item" >
                <a class="nav-link" aria-current="page" href={{ route('dashboard') }}>
                    <span data-feather="home"></span><i class="fa fa-tachometer" aria-hidden="true"></i>
                    Dashbord
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href= {{ route('customer.index' )}}>
                    <span data-feather="home"></span><i class="fa fa-user-plus" aria-hidden="true"></i>
                   Customer List
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href={{ route('loan.index') }}>
                    <span data-feather="home"></span><i class="fa fa-address-card" aria-hidden="true"></i>
                    Loan List
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href={{ route('payment.index') }}>
                    <span data-feather="home"></span><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                   payments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="">
                    <span data-feather="home"></span><i class="fa fa-sign-out" aria-hidden="true"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
