var app = angular.module('app', []);

app.controller('controllerLogin', function ($scope, $http, $location) {


    $scope.form = {};

    $scope.enviar = function () {


        $http({
            method: "POST",
            url: "./auth/login",
            data: $scope.form

        }).then(function (reponse) {
            console.log(reponse);
            if (reponse.data.status === true) {
                swal({
                    title: "Authenticacion exitosa",
                    icon: "success",
                    button: "Cerrar",
                });

                window.location.href = "./api/informacion";
            } else {

                swal({
                    title: "Ocurrio un problema",
                    text: "verificar las credencias de auntenticacion",
                    icon: "error",
                    button: "Cerrar",
                });
            }

        }).catch(function (response) {
            swal({
                title: "Ocurrio un problema",
                text: "verificar las credencias de auntenticacion",
                icon: "error",
                button: "Cerrar",
            });
        });


        console.log($scope.form);
    }




});



app.controller('controllerInformacion', function ($scope, $http, $location) {

    $scope.active_form = false;
    $scope.tipo_envio = null;
    $scope.form = {};

    $scope.cancelar = function () {
        $scope.form = {};
        $scope.active_form = false;

    }

    $scope.toggle = function () {
        $scope.active_form = !$scope.active_form;
    };

    $scope.enviar = function (dato) {

        switch (dato) {
            case 'add':
                $scope.crear();
                break;
            case 'edit':
                $scope.actualizar();
                break;
            default:
                console.log('no se reconoce');
                break;
        }

    }

    $scope.select_grupo_familiar = function () {

        if ($.fn.dataTable.isDataTable('#TableInfo')) {
            console.log('se cargo');
        } else {
            console.log('cargando');
        }

        $scope.table_user = $('#TableInfo').DataTable({

            ajax: 'offimedicas/filters/grupo_familiar/id_usuario/' + id_usuario,
            deferRender: true,
            columns: [{
                    visible: true,
                    searchable: false,
                    render: function (data, type, full) {
                        return `
                        <div class="text-center">
                        <button class="btn btn-outline-primary btn-sm edit"><i  class="fa fa-edit"></i></button>
                        <button class="btn btn-outline-danger btn-sm delete"><i  class="fa fa-close"></i></button>
                        </div>
                        `;
                    }
                },
                {
                    data: 'nombres'
                },
                {
                    data: 'apellidos'
                },
                {
                    data: 'edad'
                },
                {
                    data: 'parentesco'
                },
                {
                    data: 'identificacion'
                }
            ],
            dom: `<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>
            <'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-4 text-center'l><'col-sm-12 col-md-4'p>>`,
            buttons: [{
                text: '<button class="btn btn-outline-secondary"> Agregar <i  class="fa fa-plus"></i> </button> ',
                className: 'btn btn-default btn-xs',
                action: function (dt) {
                    $scope.title_form = "Agregar";
                    $scope.tipo_envio = 'add';
                    $scope.active_form = !$scope.active_form;
                    $scope.form = {};
                    $scope.$apply();


                }
            }, ],
            rowCallback: function (row, data, index) {

                $('button.edit', row).bind('click', () => {
                    $scope.title_form = "Editar";
                    $scope.tipo_envio = 'edit';
                    $scope.active_form = true;
                    $scope.form.edad = parseInt(data.edad);
                    $scope.form.identificacion = parseInt(data.identificacion);
                    $scope.form.nombres = data.nombres;
                    $scope.form.apellidos = data.apellidos;
                    $scope.form.parentesco = data.parentesco;
                    $scope.form.id_grupo_familiar = data.id_grupo_familiar;

                    $scope.$apply();
                });

                $('button.delete', row).bind('click', () => {
                    $scope.eliminar(data.id_grupo_familiar);
                });

                return row;

            }

        });
    };

    $scope.select_load_grupo_familiar = function () {
        $scope.table_user.ajax.url('offimedicas/filters/grupo_familiar/id_usuario/' + id_usuario).load();
    };



    $scope.buscar = function (id) {

        return $http({
            method: "GET",
            url: "./offimedicas/filters/usuarios/identificacion/" + id
        })

    }

    $scope.crear = function () {
        console.log('enviando form');

        $scope.form.id_usuario = id_usuario;

        const validar = $scope.buscar($scope.form.identificacion);

        validar.then(function (response) {

            console.log('buscando si existe el usuario', response.data.count);

            if (response.data.count > 0) {


                swal({
                    title: "Ocurrio un problema",
                    text: 'usuario ya existe con esa identificacion',
                    icon: "error",
                    button: "Cerrar",
                });

                return false;

            }

            const send = {
                "insert": "grupo_familiar",
                "values": [$scope.form]
            };


            $http({
                method: "POST",
                url: "./offimedicas/createAutoincrement",
                data: send

            }).then(function (reponse) {
                console.log(reponse);
                if (reponse.data.status === true) {

                    swal({
                        title: "Registro Creado",
                        icon: "success",
                        button: "Cerrar",
                    });

                    $scope.select_load_grupo_familiar();

                    $scope.active_form = false;

                    $scope.form = {};

                } else {
                    swal({
                        title: "Ocurrio un problema",
                        text: 'identificacion ya existe',
                        icon: "error",
                        button: "Cerrar",
                    });
                }

            });


        });





    }

    $scope.eliminar = function (id) {


        const send = {
            delete: "grupo_familiar",
            where: {
                "id_grupo_familiar": id
            }
        }

        $http({
            method: "post",
            url: "./offimedicas/destroy",
            data: send

        }).then(function (reponse) {
            console.log(reponse);
            if (reponse.data.status === true) {

                swal({
                    title: "Registro Eliminado",
                    icon: "success",
                    button: "Cerrar",
                });

                $scope.select_load_grupo_familiar();

            }

        });



    }

    $scope.actualizar = function () {

        const id = $scope.form.id_grupo_familiar;
        delete $scope.form.id_grupo_familiar;


        const send = {
            update: "grupo_familiar",
            set: $scope.form,
            where: {
                "id_grupo_familiar": id
            }
        }

        $http({
            method: "put",
            url: "./offimedicas/edit",
            data: send

        }).then(function (reponse) {
            console.log(reponse);
            if (reponse.data.status === true) {

                swal({
                    title: "Registro Actualizado",
                    icon: "success",
                    button: "Cerrar",
                });

                $scope.select_load_grupo_familiar();

                $scope.active_form = false;

                $scope.form = {};

            }

        });



    }


    $scope.select_grupo_familiar();

});
