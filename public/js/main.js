var myApp = angular.module('myApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

function toDoCtrl($scope) {

    $scope.todoFld = ""

    $scope.todos = [
        {
            text: "comprar Cucronic",
            done:"false"
        },{
            text: "comer Don tomate",
            done:"false"
        }
    ];

    $scope.addTodo = function () {

        if ($scope.todoFld != "") {
            $scope.todos.push({text: $scope.todoFld , val: $scope.valFld});
            $scope.todoFld = "";
        }
    };

    $scope.doneTodo = function($index) {
        $scope.todos[$index].done ="done";
    };
debugger;
}