<aside
    class="sidebar navbar navbar-expand-lg bg-dark d-flex flex-column gap-4 align-content-lg-center mx-2 my-2 rounded">
    <h5 class="navbar-brand">Toko Online Kita</h5>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarNavDropdown">
        <ul class="navbar-nav flex-column gap-3 px-2">
            <li class="navbar-item rounded {{ Request::path() === 'admin/dashboard' ? 'bg-warning' : '' }} ">
                <a href="dashboard" class="text-white">
                    <div class="d-flex gap-3">
                        <span class="material-icons">dashboard</span>
                        <p class="m-0 p-0">Dashboard</p>
                    </div>
                </a>
            </li>
            <li class="navbar-item rounded {{ Request::path() === 'admin/product' ? 'bg-warning' : '' }} ">
                <a href="product">
                    <div class="d-flex gap-3">
                        <span class="material-icons">inventory</span>
                        <p class="m-0 p-0">Product</p>
                    </div>
                </a>
            </li>
            </li>
            <li class="navbar-item rounded {{ Request::path() === 'admin/pembayaran' ? 'bg-warning' : '' }} ">
                <a href="pembayaran">
                    <div class="d-flex gap-3">
                        <span class="material-icons">account_balance_wallet</span>
                        <p class="m-0 p-0">Metode Pembayaran</p>
                    </div>
                </a>
            </li>
            <li class="navbar-item rounded {{ Request::path() === 'admin/ekspedisi' ? 'bg-warning' : '' }} ">
                <a href="ekspedisi">
                    <div class="d-flex gap-3">
                        <span class="material-icons">airport_shuttle</span>
                        <p class="m-0 p-0">Expedisi</p>
                    </div>
                </a>
            </li>
            <li class="navbar-item">
                <a href="logout">
                    <div class="d-flex gap-3">
                        <span class="material-icons">logout</span>
                        <p class="m-0 p-0">Logout</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</aside>
