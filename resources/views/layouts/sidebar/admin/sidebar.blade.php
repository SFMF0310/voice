{{-- <div class="sidebar-wrapper">
        <ul class="nav">
          <!-- <li class="nav-item active  ">
            <a class="nav-link" href="admin/dashboard">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li> -->

          <li class="nav-item active">
            <a class="nav-link" href="/admin">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item  active">
            <a class="nav-link" href="/admin/utilisateur" >
              <i class="material-icons">settings</i>
              <p>Paramétrage</p>
            </a>
          </li>

          <li class="nav-item  active">
            <a class="nav-link" href="/admin/utilisateur" >
              <i class="material-icons">mic</i>
              <p>Message</p>
            </a>
          </li>

          <li class="nav-item  active">
            <a class="nav-link" href="/admin/utilisateur" >
              <i class="material-icons">history</i>
              <p>Historique</p>
            </a>
          </li>

        </ul>
</div> --}}
<header class="header" id="header">

    <div class="row">
        <div class="">

            <div class="">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="header_toggle">
                        <i class='bx bx-menu ' id="header-toggle"></i>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarNav">
                      <ul class="navbar-nav">
                        <li class="nav-item active">
                          <a class="nav-link text-dark" href="#"><b>Creer une nouvelle campagne |</b> <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Features</a>
                        </li>
                        <!-- <li class="nav-item">
                          <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link disabled" href="#">Disabled</a>
                        </li> -->
                      </ul>
                    </div>
                  </nav>
            </div>

        </div>
        <!-- <div class="d-inline">

        </div> -->
    </div>
    <div class="">
        <!-- <img src="https://i.imgur.com/hczKIze.jpg" alt="">  -->
        <span><i class='material-icons nav_icon'>account_balance_wallet</i><b>SOLDE |</b>2000 mn</span>
    </div>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <div>
            <a href="#" class="nav_logo">
                <i class='bx bx-layer nav_logo-icon'></i>
                <span class="nav_logo-name">MLOUMA <br/>PUSH VOCAL</span> </a>
            </div>
            <div class="nav_list">
                <!-- <a href="#" class="nav_link active">
                    <i class='bx bx-grid-alt nav_icon'></i>
                    <span class="nav_name">Dashboard</span>
                </a> -->
                <a href="admin/dashboard" class="nav_link bs-tooltip-right" data-toggle="tooltip" data-placement="right" title="Messages">
                    <i class='material-icons nav_icon'>dashboard</i>
                    <span class="nav_name">Dashboard</span>
                </a>
                <a href="/message" class="nav_link" data-toggle="tooltip" data-placement="right" title="Contacts">
                    <i class='material-icons nav_icon'>mic</i>
                    <span class="nav_name">Message</span>
                </a>
                <a href="/contact" class="nav_link" data-toggle="tooltip" data-placement="right" title="Contacts">
                    <i class='material-icons nav_icon'>groups</i>
                    <span class="nav_name">Contacts</span>
                </a>
                 <a href="admin/utilisateur" class="nav_link" data-toggle="tooltip" data-placement="right" title="Paramétre">
                        <i class='material-icons nav_icon'>settings</i>
                        <span class="nav_name">Paramétre</span>
                </a>
                <!-- <a href="#" class="nav_link">
                        <i class='bx bx-bar-chart-alt nav_icon'></i>
                        <span class="nav_name">Files</span> </a> -->
                {{-- <a href="/admin" class="nav_link" data-toggle="tooltip" data-placement="right" title="Stats">
                            <i class='material-icons nav_icon'>leaderboard</i>
                            <span class="nav_name">Stats</span>
                </a>  --}}
                <a href="/historique" class="nav_link" data-toggle="tooltip" data-placement="right" title="Historique">
                    <i class='material-icons nav_icon'>history</i>
                    <span class="nav_name">historique</span>
                </a>

            </div>
        </div>
        <div>
        <a href="#" class="nav_link" data-toggle="tooltip" title="Some tooltip text!">
            <i class='material-icons nav_icon'>notifications</i>
            <span class="nav_name">SignOut</span>
        </a>
        <!-- <div class="tooltip bs-tooltip-top bg-success" role="tooltip">
            <div class="arrow "></div>
            <div class="tooltip-inner ">
              Some tooltip text!
            </div>
          </div> -->
          <div class="card tooltip bs-tooltip-top bg-success" role="tooltip" style="width: 18rem;">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Vestibulum at eros</li>
            </ul>
          </div>
        <a href="#" class="nav_link">
            <i class='material-icons nav_icon'>account_circle</i>
            <span class="nav_name">Compte</span>
        </a>
        </div>
    </nav>
</div>
