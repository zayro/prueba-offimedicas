app.controller('controllerRegistro', function ($scope, $http, $location) {

    $scope.form = {};
    $scope.error = null;

    $scope.enviar = function () {


        const regx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;


        if (!regx.test($scope.form.password)) {
            $scope.error ='Error: contraseña debe tener mínimo 8 caracteres - mínimo 1 mayúscula - mínimo 1 número ';
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
            }else{

                swal({
                    title: "ocurrio un error",
                    text: "ya existe esta identificacion en un grupo familiar",
                    icon: "error",
                    button: "Cerrar",
                });

            }

        }).catch(function (error){
            console.log(error);

        })



    }


});


