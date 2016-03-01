evezownApp

// inject the invite service into our controller
    .controller('inviteController', function ($scope, $http, $location, InviteService) {

        $scope.days = 31;
        $scope.getNumber = function (days) {
            return new Array(days);
        };

        $scope.inviteData = {};

        $scope.isInviteSuccess = false;

        $scope.months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        var year = new Date().getFullYear();
        var range = [];
        range.push(year);
        for (var i = 1; i < 100; i++) {
            range.push(year - i);
        }
        $scope.years = range;

        $scope.model = {
            title: "Create Signup Invite (exclusively for women)"
        };
        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // function to handle submitting the form
        // Request an invite
        $scope.requestInvite = function () {
            $scope.loading = true;
            // save the comment. pass in comment data from the form
            // use the function we created in our service
            InviteService.save($scope.inviteData)
                .then(function (data) {
                    $scope.isInviteSuccess = true;
                    console.log(data)
                    $scope.inviteResponse = data;
                    toastr.success(data.message, 'Request Invite');
                }, function (data) {
                    $scope.isInviteSuccess = false;
                    toastr.error(data.error.message, 'Request Invite');
                    console.log(data);
                });

        };

    });

