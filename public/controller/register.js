app.controller('controllerRegistro', function ($scope, $http, $location) {

            $scope.form = {};
            $scope.error = null;

            $scope.buscar = function (id) {

                return $http({
                    method: "GET",
                    url: "./offimedicas/filters/grupo_familiar/identificacion/" + id
                })

            }

            $scope.enviar = function () {


                const validar = $scope.buscar($scope.form.identificacion);

                validar.then(function (response) {



                        if (response.data.count > 0) {


                            swal({
                                title: "Ocurrio un problema",
                                text: 'grupo familiar ya existe con esa identificacion',
                                icon: "error",
                                button: "Cerrar",
                            });

                            return false;

                        }

                        const regx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;


                        if (!regx.test($scope.form.password)) {
                            $scope.error = 'Error: contraseña debe tener mínimo 8 caracteres - mínimo 1 mayúscula - mínimo 1 número ';
                            return false;
                        }


                        $http({
                            method: "POST",
                            url: "./auth/register",
                            data: $scope.form

                        }).then(function (response) {

                            $scope.error = "";
                            if (response.data.status === true) {

                                swal({
                                    title: "Usuario Agregado",
                                    icon: "success",
                                    button: "Cerrar",
                                });

                                window.location.href = "./";
                            } else {

                                swal({
                                    title: "ocurrio un error",
                                    text: "ya existe datos de este usuario",
                                    icon: "error",
                                    button: "Cerrar",
                                });

                            }

                        }).catch(function (error) {
                            console.log(error);

                        })

                    }



                )}


            });
