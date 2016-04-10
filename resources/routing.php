<?php
return [
    ['GET', '/users/{id:me|\d+}', [\tomasz\legacy\actions\UsersEndpoint::class, 'getUser']],
];