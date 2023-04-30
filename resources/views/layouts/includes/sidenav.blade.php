<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href= {{ route('customer.index' )}}>
                    <span data-feather="home"></span>
                   Customer List
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href={{ route('loan.index') }}>
                    <span data-feather="home"></span>
                    Loan List
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href={{ route('payment.index') }}>
                    <span data-feather="home"></span>
                   payments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="">
                    <span data-feather="home"></span>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
