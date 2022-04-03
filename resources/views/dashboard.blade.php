<section class="flex max-width max-height">
    @livewire('dashboard.nav')
    @livewire('dashboard.content')
    @livewire('dashboard.subcontentnav')
    @livewire('dashboard.subcontent')
</section>

<html>

    <head>

    </head>

    <body>
        <div id="global-noti-parent" class="flex fill-width">
        </div>
        <header class="flex">
            <nav id="global-nav" class="flex">
                <a id="global-nav-menu-toggle" href="./../../">BACK [<]</a>
                <h1><a class="font-pri font-nohover" href="">mirui</a></h1>
                <div class="container">
                <h4>Welcome</h4>
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td><a href="logout">Logout</a></td>

                        </tr>
                    </tbody>
                </table>
                </div>
            </nav>
        </header>

        <footer class="font-pri flex fill-width">
            <div>
                COPYRIGHT © 2020, MIRUI MEDIA CORPORATION. (ASIA)
            </div>
        </footer>
    </body>

</html>