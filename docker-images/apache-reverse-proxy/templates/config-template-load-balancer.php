<?php
    $static_app_1 = getenv('STATIC_APP_1');
    $static_app_2 = getenv('STATIC_APP_2');
    $static_app_3 = getenv('STATIC_APP_3');

    $dynamic_app_1 = getenv('DYNAMIC_APP_1');
    $dynamic_app_2 = getenv('DYNAMIC_APP_2');
    $dynamic_app_3 = getenv('DYNAMIC_APP_3');

?>

<VirtualHost *:80>
    ServerName demo.res.ch

    ProxyRequests Off
    ProxyPreserveHost On

    <Proxy balancer://dynamic-balancer>
        BalancerMember http://<?php print "$dynamic_app_1"?> route=dynamic_1
        BalancerMember http://<?php print "$dynamic_app_2"?> route=dynamic_2
        BalancerMember http://<?php print "$dynamic_app_3"?> route=dynamic_3
        ProxySet lbmethod=byrequests
        ProxySet stickysession=ROUTEID
    </Proxy>

    <Proxy balancer://static-balancer>
        BalancerMember http://<?php print "$static_app_1"?> route=static_1
        BalancerMember http://<?php print "$static_app_2"?> route=static_2
        BalancerMember http://<?php print "$static_app_3"?> route=static_3
        ProxySet lbmethod=byrequests
        ProxySet stickysession=ROUTEID
    </Proxy>

    Header add Set-Cookie "ROUTEID=.%{BALANCER_WORKER_ROUTE}e; path=/" env=BALANCER_ROUTE_CHANGED

    ProxyPass /balancer-manager !

    ProxyPass '/api/students/' 'balancer://dynamic-balancer/'
    ProxyPassReverse '/api/students/' 'balancer://dynamic-balancer/'

    ProxyPass '/' 'balancer://static-balancer/'
    ProxyPassReverse '/' 'balancer://static-balancer/'

    <Location "/balancer-manager">
        SetHandler balancer-manager
        Order Deny,Allow
        Deny from all
        Allow from all
    </Location>

</VirtualHost>