

<div class="l-navbar" id="nav-bar">
    <nav class="nav" id="nav1">
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
                <a href="/client" class="nav_link bs-tooltip-right" data-toggle="tooltip" data-placement="right" title="Messages">
                    <i class='material-icons nav_icon'>dashboard</i>
                    <span class="nav_name">Dashboard</span>
                </a>
                <a href="/client/message" class="nav_link" data-toggle="tooltip" data-placement="right" title="Contacts">
                    <i class='material-icons nav_icon'>mic</i>
                    <span class="nav_name">Messages</span>
                </a>
                <a href="/client/campagne" class="nav_link" data-bs-toggle="tooltip" data-placement="right" title="Campagnes">
                    <i class='material-icons nav_icon'>campaign</i>
                    <span class="nav_name">Campagnes</span>
                </a>
                <a href="/client/contact" class="nav_link" data-toggle="tooltip" data-placement="right" title="Contacts">
                    <i class='material-icons nav_icon'>groups</i>
                    <span class="nav_name">Contacts</span>
                </a>
                @if ($_SESSION['profil'] == 3)
                    <a href="/client/utilisateur" class="nav_link" data-toggle="tooltip" data-placement="right" title="Paramétre">
                        <i class='material-icons nav_icon'>settings</i>
                        <span class="nav_name">Paramétres</span>
                    </a>
                @endif

                <!-- <a href="#" class="nav_link">
                        <i class='bx bx-bar-chart-alt nav_icon'></i>
                        <span class="nav_nlame">Files</span> </a> -->
                {{-- <a href="/client" class="nav_link" data-toggle="tooltip" data-placement="right" title="Stats">
                            <i class='material-icons nav_icon'>leaderboard</i>
                            <span class="nav_name">Stats</span>
                </a>  --}}
                <a href="/client/historique" class="nav_link" data-toggle="tooltip" data-placement="right" title="Historique">
                    <i class='material-icons nav_icon'>history</i>
                    <span class="nav_name">historique</span>
                </a>

            </div>
        </div>
        <div>
        @if ($_SESSION['profil'] == 3)

        <a href="/client/notifications" class="nav_link" data-toggle="tooltip" title="Some tooltip text!">
            <i class='material-icons nav_icon'>notifications</i>
            <span class="nav_name">Notifications</span>
        </a>
        @endif
        <!-- <div class="tooltip bs-tooltip-top bg-success" role="tooltip">
            <div class="arrow "></div>
            <div class="tooltip-inner ">
              Some tooltip text!
            </div>
          </div> -->
          {{-- <div class="card tooltip bs-tooltip-top bg-success" role="tooltip" style="width: 18rem;">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Vestibulum at eros</li>
            </ul>
          </div> --}}
        <a href="/logout" class="nav_link " >
            <i class='material-icons nav_icon' >logout</i>
            <span class="nav_name">Déconnexion</span>
        </a>
        </div>
    </nav>
</div>
