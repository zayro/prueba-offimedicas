<!DOCTYPE html>
<html lang="en" ng-app="app">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>informacion</title>
        <!-- CSS only -->
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
            crossorigin="anonymous"
        />

        <link rel="stylesheet" href="style/form.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>

    <body ng-controller="controllerLogin">

        <div class="main-fondo">
            <div class="container">
                <div class="login-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card text-center">
                                <!--                     <div class="card-header">
                        Acceso al sistema
                    </div> -->
                                <div class="login-image">
                                    <img
                                        src="./assets/images/avatar.png"
                                        width="150px"
                                        class="mx-auto d-block img-fluid"
                                        class="card-img-top"
                                        alt="..."
                                    />
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Login</h5>

                                    <form ng-submit="enviar()">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"
                                                >Usuario</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="exampleInputEmail1"
                                                ng-model="form.usuario"

                                            />

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1"
                                                >Contraseña</label
                                            >
                                            <input
                                                type="password"
                                                class="form-control"
                                                ng-model="form.password"
                                                id="exampleInputPassword1"
                                            />
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary btn-lg btn-block"
                                                >
                                                    Cancelar
                                                </button>
                                            </div>
                                            <div class="col-lg-6">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary btn-lg btn-block"
                                                >
                                                    Enviar
                                                </button>
                                            </div>
                                        </div>

                                        <hr />

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <a
                                                    href="./register"
                                                    class="btn btn-primary btn-lg btn-block"
                                                    >Registrarse</a
                                                >
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="controller/app.js"></script>
</html>
