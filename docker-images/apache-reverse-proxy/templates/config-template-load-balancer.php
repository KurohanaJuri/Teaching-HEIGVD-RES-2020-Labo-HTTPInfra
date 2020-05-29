<?php
    $static_app_1 = getenv('STATIC_APP_1');
    $static_app_2 = getenv('STATIC_APP_2');
    $static_app_3 = getenv('STATIC_APP_3');

    $dynamic_app_1 = getenv('DYNAMIC_APP_1');
    $dynamic_app_2 = getenv('DYNAMIC_APP_2');
    $dynamic_app_3 = getenv('DYNAMIC_APP_3');

?>

<VirtualHost *:80>
    # Website url
    ServerName demo.res.ch
    
    # Balancer for the dynamic server with a name
    # The name is used for the sticky session
    <Proxy balancer://dynamic-balancer>
        # Server 1
        BalancerMember http://<?php print "$dynamic_app_1"?> route=dynamic_1
        # Server 2
        BalancerMember http://<?php print "$dynamic_app_2"?> route=dynamic_2
        # Server 3
        BalancerMember http://<?php print "$dynamic_app_3"?> route=dynamic_3
        # Balance by requests same as a round robin
        # Ensure that each get their configured share og the number of requests
        ProxySet lbmethod=byrequests
        ProxySet stickysession=ROUTEID
    </Proxy>

    # Balancer for the static server
    <Proxy balancer://static-balancer>
        # Server 1
        BalancerMember http://<?php print "$static_app_1"?>/
        # Server 2
        BalancerMember http://<?php print "$static_app_2"?>/
        # Server 3
        BalancerMember http://<?php print "$static_app_3"?>/
        # Balance by requests
        ProxySet lbmethod=byrequests
    </Proxy>

    # Add cookie in the request
    Header add Set-Cookie "ROUTEID=.%{BALANCER_WORKER_ROUTE}e; path=/" env=BALANCER_ROUTE_CHANGED

    # Prevet that the acces to the manger isn't routed to the backend server
    ProxyPass /balancer-manager !

    ProxyPass '/api/students/' 'balancer://dynamic-balancer/'
    ProxyPassReverse '/api/students/' 'balancer://dynamic-balancer/'

    ProxyPass '/' 'balancer://static-balancer/'
    ProxyPassReverse '/' 'balancer://static-balancer/'

    # Enable the manager
    <Location "/balancer-manager">
        SetHandler balancer-manager
        Order Deny,Allow
        Deny from all
        Allow from all
    </Location>

</VirtualHost>