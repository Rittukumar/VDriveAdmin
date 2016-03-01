/**
 * Created by Viswanathan on 6/4/2015.
 */
evezownApp
    .controller('OpenStoreController', function($scope,$interval){
        $scope.title = "Unique Opportunity EvezPlace";
        $scope.article = "1";

        $interval(function(){

            if($scope.article == '1')
            {
                $scope.article = '2';
            }
            else if($scope.article == '2')
            {
                $scope.article = '3';
            }
            else if($scope.article == '3')
            {
                $scope.article = '1';
            }
        },5000);
    });