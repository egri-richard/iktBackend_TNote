<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

use Project\Api\Note;
use Project\Api\Ownership;
use Project\Api\User;
use Project\Api\TTElements;

return function (Slim\App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write("Hello");
        return $response;
    });

    /* #region users */

    $app->get('/users', function (Request $request, Response $response) {
        $users = User::get();
        $kimenet = $users->toJson();

        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get(
        '/users/{id}',
        function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $users = User::find($args['id']);
            if ($users === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű user']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $response->getBody()->write($users->toJson());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    );

    $app->post(
        '/users',
        function (Request $request, Response $response) {
            $input = json_decode($request->getBody(), true);
            $users = User::create($input);
            $users->save();

            $kimenet = $users->toJson();

            $response->getBody()->write($kimenet);
            return $response
                ->withStatus(201) // "Created" status code
                ->withHeader('Content-Type', 'application/json');
        }
    );

    $app->delete(
        '/users/{id}',
        function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $users = User::find($args['id']);
            if ($users === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű user']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $users->delete();
            return $response
                ->withStatus(204);
        }
    );

    $app->put(
        '/users/{id}',
        function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $users = User::find($args['id']);
            if ($users === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű user']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $input = json_decode($request->getBody(), true);
            $users->fill($input);
            $users->save();
            $response->getBody()->write($users->toJson());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    );

    /* #endregion */

    /* #region ttelements */

    $app->get('/ttelements', function (Request $request, Response $response) {
        $ttelements = TTElements::get();
        $kimenet = $ttelements->toJson();

        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/ttelements/{id}', function (Request $request, Response $response, array $args) {
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $ttelements = TTElements::find($args['id']);
        if ($ttelements === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű time table element']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
        $response->getBody()->write($ttelements->toJson());
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });

    $app->post('/ttelements', function (Request $request, Response $response) {
        $input = json_decode($request->getBody(), true);
        $ttelements = TTElements::create($input);
        $ttelements->save();

        $kimenet = $ttelements->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201)
            ->withHeader('Content-Type', 'application/json');
    });

    $app->delete('/ttelements/{id}', function (Request $request, Response $response, array $args) {
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $ttelements = TTElements::find($args['id']);
        if ($ttelements === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű time table element']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
        $ttelements->delete();
        return $response
            ->withStatus(204);
    });

    $app->put('/ttelements/{id}', function (Request $request, Response $response, array $args) {
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $ttelements = TTElements::find($args['id']);
        if ($ttelements === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű time table element']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
        $input = json_decode($request->getBody(), true);
        $ttelements->fill($input);
        $ttelements->save();
        $response->getBody()->write($ttelements->toJson());
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });

    /* #endregion */

    /* #region  ownership */

    $app->get('/ownership', function (Request $request, Response $response) {
        $ownership = Ownership::get();
        $kimenet = $ownership->toJson();

        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/ownership/{id}', function (Request $request, Response $response, array $args) {
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $ownership = Ownership::find($args['id']);
        if ($ownership === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű time ownership element']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
        $response->getBody()->write($ownership->toJson());
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });

    $app->post('/ownership', function (Request $request, Response $response) {
        $input = json_decode($request->getBody(), true);
        $ownership = Ownership::create($input);
        $ownership->save();

        $kimenet = $ownership->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201)
            ->withHeader('Content-Type', 'application/json');
    });

    $app->delete('/ownership/{id}', function (Request $request, Response $response, array $args) {
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $ownership = Ownership::find($args['id']);
        if ($ownership === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű time ownership element']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
        $ownership->delete();
        return $response
            ->withStatus(204);
    });

    $app->put('/ownership/{id}', function (Request $request, Response $response, array $args) {
        if (!is_numeric($args['id']) || $args['id'] <= 0) {
            $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }
        $ownership = Ownership::find($args['id']);
        if ($ownership === null) {
            $ki = json_encode(['error' => 'Nincs ilyen ID-jű time ownership element']);
            $response->getBody()->write($ki);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
        $input = json_decode($request->getBody(), true);
        $ownership->fill($input);
        $ownership->save();
        $response->getBody()->write($ownership->toJson());
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });

    /* #endregion */


    /* #region notes */

    $app->get('/notes', function (Request $request, Response $response) {
        $notes = Note::get();
        $kimenet = $notes->toJson();

        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get(
        '/notes/{id}',
        function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $notes = Note::find($args['id']);
            if ($notes === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű jegyzet']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $response->getBody()->write($notes->toJson());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    );

    $app->post('/notes', function (Request $request, Response $response) {
        $input = json_decode($request->getBody(), true);
        $notes = Note::create($input);
        $notes->save();

        $kimenet = $notes->toJson();

        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201) // "Created" status code
            ->withHeader('Content-Type', 'application/json');
    });

    $app->delete(
        '/notes/{id}',
        function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $notes = Note::find($args['id']);
            if ($notes === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű jegyzet']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $notes->delete();
            return $response
                ->withStatus(204);
        }
    );

    $app->put(
        '/notes/{id}',
        function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $notes = Note::find($args['id']);
            if ($notes === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű jegyzet']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $input = json_decode($request->getBody(), true);
            $notes->fill($input);
            $notes->save();
            $response->getBody()->write($notes->toJson());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    );

    /* #endregion */
};
