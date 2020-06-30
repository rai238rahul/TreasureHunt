var app = angular.module('th', []);

app.controller('login', function($scope, $http) {
   
    $scope.checkLogin = () => {
        $http.post("php/login.php", $scope.check).then(function(response) {
            res = response.data;
            if(res._is_logged == 1)
                window.location.replace("main.html");

        });
    }
});
app.controller('main', function($scope, $http) {
    $http.get("php/login_check.php").then(function(response) {
        if(response.data.is_logged != 1)
            window.location.replace("index.html");
        else{
            $scope.data = response.data;
        }
        if($scope.data.user.curhint > 5)
        $scope.hint_1 = true;
    if ($scope.data.user.curhint > 10)
        $scope.hint_2 = true;
    if ($scope.data.user.curhint > 15)
        $scope.hint_3 = true;
    });
    
    $scope.checkSolution = () => {
        if($scope.data.solution.answer === $scope.ans){
            $http.post("php/checkSolutionR.php", $scope.data.user.piid).then(function(res){
                $scope.data = res.data;
                $scope.ans = "";
                location.reload();
            });
        }else{
            $http.get("php/checkSolutionW.php").then(function(res){
                $scope.data.user = res.data;
                alert("Answer Wrong");
                $scope.ans = "";
                if($scope.data.user.curhint > 5)
                    $scope.hint_1 = true;
                if ($scope.data.user.curhint > 10)
                    $scope.hint_2 = true;
                if ($scope.data.user.curhint > 15)
                    $scope.hint_3 = true;
                location.reload();
            });
        }
    }

    $scope.logout = () => {
        $http.get("php/logout.php").then(function(res){
            $scope.data = null;
        });
        window.location.replace("index.html");

    }

});