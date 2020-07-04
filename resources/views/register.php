<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>informacion</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="style/form.css">

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body ng-controller="controllerRegistro">

    <div class="main-fondo">

        <div class="container">

            <div class="login-center">

                <div class="row">
                    <div class="col-lg-12">


                        <div class="card text-center">
                            <div class="card-header">
                                Registro al sistema
                            </div>

                            <div class="card-body">


                                <form ng-submit="enviar()">

                                    <div class="form-group">
                                        <label for="usuario">Usuario</label>
                                        <input type="text" class="form-control" id="usuario" minlength="5" ng-model="form.usuario" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="nombres">Nombres</label>
                                        <input type="text" class="form-control" id="nombres" minlength="3" ng-model="form.nombres" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidos" minlength="5" ng-model="form.apellidos" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" ng-model="form.email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="identificacion">Nro. Identificacion</label>
                                        <input type="number" class="form-control" id="identificacion"  ng-model="form.identificacion" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password" ng-model="form.password" required>
                                    </div>

                                   <p style="color:red">  {{ error }} </p>




                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a
                                                class="btn btn-secondary  btn-lg btn-block" href="/">Cancelar</a>
                                        </div>
                                        <div class="col-lg-6">
                                            <button type="submit"
                                                class="btn btn-primary btn-lg btn-block">Enviar</button>
                                        </div>
                                    </div>

                                    <hr>


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
<script src="controller/register.js"></script>

</html>
