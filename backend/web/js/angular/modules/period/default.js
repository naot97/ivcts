myAngular.controller('periodController',['$scope', '$http', 'DTOptionsBuilder', function($scope,$http,DTOptionsBuilder) {
	$scope.rootUrl = '';
	$scope.baseUrl = '';
	$scope.indexSelected = '#';
	$scope.periodID = '';
	$('#month').val();
	//$scope.month = '';
	$scope.year = '';
	$scope.hours = '';
	$scope.periodList = [];
	$scope.init = function(url){
		$scope.rootUrl = url;
		$scope.baseUrl = url + '/period';
		$scope.getPeriodListBy();
	}
	//
	$scope.dtOptions = {
	        pageLength: 10,
            lengthMenu: [5, 10, 15, 20, 25],
            ordering: true,
            paginationType: 'full_numbers',
    	}
    // message
	$scope.msg = '';
    $scope.typeMsg = function (isSuccess = true, timeOut = 10000) {
        showMsg($scope.msg, isSuccess, timeOut);
    };

    $scope.clearMsg = function() {
        $scope.msg = '';
 	};
 	// function 
	$scope.getDataByUrl = function(x,url){
		var rightUrl = $scope.baseUrl + url;
		$http.get(rightUrl).then(
        function(response) {
            var result = response.data;
            if(result.error === 0) {
            	switch(x){
            		default:
            			break;
            	}
            }
        }, function(response) {
            console.log(response.data.message);
        });
	}
	$scope.postMethod = function(kind,dataPost,subUrl,message){
        $http.post($scope.baseUrl + subUrl, JSON.stringify(dataPost)).then(function(response){
            var result = response.data;
            if (result.error == 0){
                switch (kind){
                    case 1 :
                        $scope.periodList = result.result;
                        break;
                    default :
                        break;
                }
                if (message.length != 0){
                    $scope.msg = message;
                    $scope.typeMsg(true);
                }
            }
            else{
                $scope.msg = result.message;
                $scope.typeMsg(false);
            }
        },function(response){
            console.log(response.data.message);
        });
    };
    $scope.prepareData = function(){
    	return{
    		periodID : $scope.periodID,
    		month : $('#month').val(),
    		year : $scope.year,
    		workingHour : $scope.hours
    	}
    };
	$scope.getPeriodListBy = function(){
		var dataPost = $scope.prepareData();
		var url = '/default/get-period-list-by';
		$scope.postMethod(1,dataPost,url,'');
	}
	$scope.selectedData = function(row){
		$scope.periodID = row.periodID;
		//$scope.month = row.month;
		$('#month').val(row.month.toString());
		$scope.year = row.year;
		$scope.hours = row.workingHour;
	}
	$scope.rowSelected = function(index){
		$scope.indexSelected = '#' + (index + 1).toString();
		$('#index').css("background-color", "yellow");
		$('#month').prop('disabled',true);
		$('#year').prop('readOnly',true);
		$scope.selectedData($scope.periodList[index]);
	}
	$scope.resetData = function(){
		$scope.indexSelected = '';
		$scope.periodID = '';
		$('#month').val('');
		$scope.year = '';
		$scope.hours = '';
		$('#index').css("background-color", "#e9ecef");
		$('#month').prop('disabled',false);
		$('#year').prop('readOnly',false);
	}
	$scope.checkSave = function(){
		$scope.clearMsg();
		if ($('#month').val().length == 0 ){
			$scope.msg += 'Month have not been selected <br>'; 
		}
		if (isNaN($scope.year)){
			$scope.msg += 'Year is not number <br>';
		}
		if (isNaN($scope.hours)){
			$scope.msg += 'Working Hour is not number <br>';
		}
		if ($scope.msg.length > 0) {
			$scope.typeMsg(false);
			return false;
		}
		else return true;
	}
	$scope.savePeriod = function(){
		if (!$scope.checkSave()) return;
		var dataPost = $scope.prepareData();
		console.log(dataPost);
		$scope.postMethod(2,dataPost,'/default/save-period','Save Period Successfully');
	}

}]);
