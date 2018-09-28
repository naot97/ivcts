myAngular.controller('grandController',
	['$scope', '$http', 'DTOptionsBuilder',
	function($scope,$http,DTOptionsBuilder) {
	$scope.accountList = [];
	$scope.rootUrl = '';
	$scope.baseUrl = '';
	$scope.privilegeList = [];
    $scope.oldEmployeeHistory = null;
	$scope.powerList = []
	$scope.dtOptions = {
	        pageLength: 10,
	        lengthMenu: [5, 10, 15, 20, 25],
	        ordering: true,
	        paginationType: 'full_numbers'
    	}
	$scope.init = function(url){
		$scope.rootUrl = url;
    	$scope.baseUrl = url + '/admin';
        $scope.getPrivilegeList();
		$scope.getAccountList();
		$scope.getPowerList();
	};
	$scope.getDataByUrl = function(x,url){
    		var rightUrl = $scope.baseUrl + url;
    		$http.get(rightUrl).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                	switch(x){
                		case(1) :
                			$scope.accountList = result.result;
                            console.log($scope.accountList);    
                			break;
                		case(2):
                			$scope.privilegeList = result.result;
                			break;
                		case(3):
                			$scope.powerList = result.result;
                			console.log($scope.powerList);
                			break;
                		default:
                			break;
                	}
                }
            }, function(response) {
                console.log(response.data.message);
            });
    	}
	$scope.getAccountList = function(){
		$scope.getDataByUrl(1,'/default/get-account-list');
	}
	$scope.getPrivilegeList = function(){
		$scope.getDataByUrl(2,'/default/get-privilege-list');
	}
	$scope.getPowerList = function(){
		$scope.getDataByUrl(3,'/default/get-power-list');
	}
	$scope.checkAccount = function(index){
		val = $('#checkbox' + $scope.accountList[index].employeeID).is(":checked");
		$('#checkbox' + $scope.accountList[index].employeeID).prop('checked',!val);	
	};
	$scope.getPower = function(accId,priId){
		obj =  $scope.powerList.find(function(ele) {
                        return ele.accountId.toString() === accId.toString() 
                        && ele.privilegeId.toString() === priId.toString();
                    	});
		
		return obj ? (obj.accountPower == 'wr' ? 'Read-Write' : 'Read') : 'None';
	}

	$scope.getFont = function(text){
		switch(text){
			case 'Read-Write' :
				return 'Tomato';
			case 'Read' :
				return 'MediumSeaGreen';
			default :
				return '';
		}
	}

	$scope.msg = '';
    $scope.typeMsg = function (isSuccess = true, timeOut = 10000) {
        showMsg($scope.msg, isSuccess, timeOut);
    };

    $scope.clearMsg = function() {
        $scope.msg = '';
    };

    $scope.updatePower = function(){
    	var listAccountId = [];
    	for (var i = $scope.accountList.length - 1; i >= 0; i--) {
			if ($('#checkbox' + $scope.accountList[i].employeeID).is(":checked"))
				listAccountId.push($scope.accountList[i].employeeID);	
    	}

    	var dataPost = {
    		listAccountId : listAccountId,
    		privilegeId : parseInt($('#privilege').val()),
    		powerCode : $('#power').val()
    	}

		$http.post($scope.baseUrl + '/default/update-power', JSON.stringify(dataPost)).then(
        function(response) {
            var result = response.data;
            if (result.error === 0) {
            	$scope.msg = "Update Powers Success";
            	$scope.typeMsg(true);
            	$scope.getPowerList();
            }
        }, function(response) {
            console.log(response.data.message);
        });
    };
    $scope.logList = [];
    $scope.historyTitle = '';
    $scope.getNameElement = function(val,kind){
        console.log($scope.privilegeList);
        if(val != null){
            name = '';
            switch(kind){
                case 'p' :
                    privilege = $scope.privilegeList.find(function(ele) {
                            return ele.privilegeId.toString() === val.toString();
                        });
                    console.log(privilege);
                    name = privilege ? privilege.name : '';
                     break;
                default :
                    break;
            }
            return name;
        }
        else return '';
    }
    $scope.getLog = function(index){
        $scope.logList = [];
        var employee  = $scope.accountList[index];
        $scope.historyTitle = employee.employeeName + '-' + employee.employeeCode;
        var dataPost = {
            employeeID : employee.employeeID
        };
        $http.post($scope.baseUrl + '/default/get-log', JSON.stringify(dataPost)).then(
        function(response) {
            var result = response.data;
            if (result.error === 0) {
                $scope.logList = result.result;
                console.log(result.result);
            }
        }, function(response) {
            console.log(response.data.message);
        });
    };
	
}]);

