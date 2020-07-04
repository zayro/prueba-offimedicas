var app = angular.module('app', []);

app.controller('controllerLogin', function ($scope, $http, $location) {

    $scope.buscar = function(){

        $http({
            method: "GET", url: "./unsafe/offimedicas/all/informacion/",
            //params: data

        }).then(function (reponse) {
            console.log(reponse);
            if (reponse.data.success === true) {
                console.log('execute select_load_user: ', data.request.patient_data_pid);
                // $scope.select_load_user(data.request.patient_data_pid);
             }

        });


    }

    $scope.form = {};

    $scope.enviar = function () {


        $http({
            method: "POST", url: "./auth/login",
            data: $scope.form

        }).then(function (reponse) {
            console.log(reponse);
            if (reponse.data.status === true) {
                swal({
                    title: "Authenticacion exitosa",
                    icon: "success",
                    button: "Cerrar",
                  });

                  window.location.href = "./informacion";
             }

        });


        console.log($scope.form);
    }




});

app.controller('controllerRegistro', function ($scope, $http, $location) {

    $scope.form = {};

    $scope.enviar = function () {


        $http({
            method: "POST", url: "./auth/register",
            data: $scope.form

        }).then(function (data) {
            console.log(data);
            if (data.success === true) {
                console.log('execute select_load_user: ', data.request.patient_data_pid);
                // $scope.select_load_user(data.request.patient_data_pid);
             }

        });


        console.log($scope.form);
    }


});


app.controller('controllerInformacion', function ($scope, $http, $location) {

    $scope.buscar = function(){

        $http({
            method: "GET", url: "./api/offimedicas/all/grupo_familiar/"
        }).then(function (reponse) {
            console.log(reponse);
            if (reponse.data.success === true) {
                console.log('execute select_load_user: ', data.request.patient_data_pid);
                // $scope.select_load_user(data.request.patient_data_pid);
             }

        });


    }

    $scope.select_grupo_familiar = function ()
    {

        if ($.fn.dataTable.isDataTable('#TableInfo')) {
            console.log('se cargo');
        }
        else {
            console.log('cargando');
        }

        $('#TableInfo').DataTable({

            ajax: 'offimedicas/all/grupo_familiar',
            deferRender: true,
            columns: [
                {
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
                {data: 'nombres'},
                {data: 'apellidos'},
                {data: 'edad'},
                {data: 'parentesco'},
                {data: 'identificacion'}
            ],
            dom: `<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>
            <'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-4 text-center'l><'col-sm-12 col-md-4'p>>`,
            buttons: [
                {
                  text: '<button class="btn btn-outline-secondary"> Agregar <i  class="fa fa-plus"></i> </button> ',
                  className: 'btn btn-default btn-xs',
                  action: function (dt) {
                    redirect();
                    console.log('My custom button!');
                  }
                },
              ],
            rowCallback: function (row, data, index) {

                $('i.fa-plus', row).bind('click', function () {
                    console.log('data patient', data);
                    $scope.data_patient = data;
                    $scope.$apply();
                    $scope.select_load_user(data.pid);
                    $("#myModal").modal();
                    return row;
                });

                $('i.fa-eye', row).bind('click', function () {
                    console.log('data patient', data);
                    $scope.select_load_patient_care_team(data.pid);

                    $("#modalViewTeam").modal();

                    return row;
                });

                return row;

            }

        });
    };


    $scope.select_grupo_familiar();

    $scope.select_load_user = function (pid)
    {
        $scope.table_user.ajax.url('php/select_users.php?pid=' + pid).load();
    };


    $scope.form = {};

    $scope.enviar = function () {


        $http({
            method: "POST", url: "./auth/login",
            data: $scope.form

        }).then(function (reponse) {
            console.log(reponse);
            if (reponse.data.status === true) {
                swal({
                    title: "Authenticacion exitosa",
                    icon: "success",
                    button: "Cerrar",
                  });

                  window.location.href = "./informacion";
             }

        });


        console.log($scope.form);
    }




});

