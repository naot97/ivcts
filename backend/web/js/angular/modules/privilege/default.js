myAngular.controller('privilegeController',['$scope', '$http', 'DTOptionsBuilder', 'httpGetEnum', 'httpGetProjectGroup',
	function($scope, $http, DTOptionsBuilder, httpGetEnum, httpGetProjectGroup){
    	$scope.rootUrl = '';
    	$scope.baseUrl = '';
    	$scope.mess = "Viet Toan";
    	$scope.privilegeId = '';
    	$scope.privilegeName ='';
    	$scope.indexSelected = '#';
    	$scope.groupId = '';
    	$scope.groupName = '';
    	$scope.deValue = '';
    	$scope.listPri = [];
    	$scope.functionId = '';
    	$scope.listGroup = [];
    	$scope.privilegeLink = ''
    	$scope.dtOptions = {
	        pageLength: 10,
	        lengthMenu: [5, 10, 15, 20, 25],
	        ordering: true,
	        paginationType: 'full_numbers'
    	};
    
	    $scope.dtOptionsLogs = {
	        pageLength: 10,
	        paginationType: 'full_numbers',
	        lengthChange: false
	    };

    	$scope.msg = '';
	    $scope.typeMsg = function (isSuccess = true, timeOut = 10000) {
	        showMsg($scope.msg, isSuccess, timeOut);
	    };

	    $scope.clearMsg = function() {
	        $scope.msg = '';
	    };

    	$scope.init = function(url){
    		$scope.rootUrl = url;
        	$scope.baseUrl = $scope.rootUrl + '/privilege';
        	$scope.getListGroup();
        	$scope.getListPriBy();
    	};

    	$scope.prepareData = function(){
			return {
				privilegeId : $scope.privilegeId,
				privilegeName : $scope.privilegeName,
				functionId : $scope.functionId,
				privilegeLink : $scope.privilegeLink,
				groupId : $scope.groupId,
				value : $scope.deValue
			};
    	};
    
    	$scope.getListGroup = function(){
    		$http.get($scope.baseUrl + '/default/get-list-group').then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                    $scope.listGroup = result.lstGroup;
                }
            }, function(response) {
                console.log(response.data.message);
            });
    	};
    	$scope.getListPriBy = function(){
    		var dataPost = $scope.prepareData();
    		$http.post($scope.baseUrl + '/default/get-list-pri-by', JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                    $scope.listPri = result.lstPri;
                }
            }, function(response) {
                console.log(response.data.message);
            });
    	};
    	$scope.GetNameElement = function(val, kind){
    		var name = val;
        	if(val !== null) {
	            switch(kind) {
	                case 'gp':
	                    name = $scope.listGroup.find(function(ele) {
	                        return ele.groupId.toString() === val.toString();
	                    }).name;
	                    break;
	                default:
	                    break;
	            }
    		}
    		return name;
    	}
    	$scope.selectedData = function(row) {
	        $scope.privilegeId = row.privilegeId;
	        $scope.privilegeName = row.name;
	        $scope.functionId = row.functionId;
	        $scope.privilegeLink = row.link;
	        $('#group').val(row.groupId);
	        $scope.groupId = $('#group').val();
    	};
    	$scope.rowSelected = function(index) {
        	$scope.indexSelected = '#' + (index + 1);
            $('#index').css("background-color","yellow");
        	$scope.selectedData($scope.listPri[index]);
    	};
    	$scope.resetInfo = function(){
   			$scope.privilegeId = '';
    		$scope.privilegeName ='';
    		$scope.functionId = '';
    		$scope.privilegeLink = '';
    		$scope.indexSelected = '#';
            $('#index').css("background-color","#e9ecef");
    		$scope.groupId = '';
    		$scope.groupName = ''; 		
    	};
    	$scope.GPId = '';
   		$scope.GPName = '';
   		$scope.GRChange = function() {
        	$scope.GPName = $scope.GPId.length === 0 ? '' : $("#GPForm :selected").text();
    	};
    	$scope.SaveGroup = function() {
	        if($scope.GPName.length === 0) {
	            $scope.msg = '<b>Group Name</b> must have <br>';   
	            $scope.typeMsg(false, 30000);
	            return;
	        } 
	        var urlUsing = $scope.baseUrl + '/default/create-group';
	        if($scope.GPId.length > 0) {
	            urlUsing = $scope.baseUrl + '/default/update-group';
	        } 
	        var dataPost = {
	        	groupId : $scope.GPId,
	            groupName: $scope.GPName
	        };
	        $http.post(urlUsing, JSON.stringify(dataPost)).then(
	            function(response) {
	                var result = response.data;
	                if(result.error === 0) {
	                    $('#GPForm').prop('selectedIndex', 0);
	                    $scope.GPId = '';
	                    $scope.GPName = '';
	                    $scope.getListGroup();
	                }
	                $scope.msg = result.message;
	                $scope.typeMsg(result.error === 0);
	            }, function(response) {
	                var result = response.data;
	                $scope.msg = result.message;
	                $scope.typeMsg(false);
	            });
    	};
    
    $scope.RemoveGroup = function() {
        if($scope.GPId.length === 0) {  
            $scope.msg = '<b>Must</b> select one of groups in list';   
            $scope.typeMsg(false);
            return;
        } 
        var process = {
            remove: function () {
                var dataPost = {
                    groupId: $scope.GPId,
                    groupName: $scope.GPName
                };
                $http.post($scope.baseUrl + '/default/delete-group', JSON.stringify(dataPost)).then(
                    function(response) {
                        var result = response.data;
                        if(result.error === 0) {
                            $('#GPForm').prop('selectedIndex', 0);
                            $scope.GPId = '';
                            $scope.GPName = '';
                            $scope.getListGroup();
                        }
                        $scope.msg = result.message;
                        $scope.typeMsg(result.error === 0);
                    }, function(response) {
                        var result = response.data;
                        $scope.msg = result.message;
                        $scope.typeMsg(false);
                    });                
            }
        };
        confirmRemove('GROUP PRIVILEGE', process);
    };

    $scope.SavePrivilege = function() {
    	var isCreate = true;
    	if ($scope.indexSelected.length > 1)
    		isCreate = false;
        $scope.msg = $scope.validationFrm($scope.formPrivilege, isCreate); 
        if ($scope.msg !== '')
        {  
            $scope.typeMsg(false, 30000);
            return;
        } 
        console.log(isCreate);
        var urlUsing = '';
        if(!isCreate) {
            urlUsing = $scope.baseUrl + '/default/update-privilege';
        } else {
            urlUsing = $scope.baseUrl + '/default/create-privilege';
          //  $scope.projectID = '';
          //  $scope.enabled = '';
        }
        var dataPost = $scope.prepareData();   
        $http.post(urlUsing, JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                    $scope.resetInfo();           
                    $scope.getListPriBy();
                }
                $scope.msg = result.message;
                $scope.typeMsg(result.error === 0);
            }, function(response) {
                var result = response.data;
                $scope.msg = result.message;
                $scope.typeMsg(false);
            });
    };
    
    $scope.RemovePrivilege = function() {
        if($scope.privilegeId.length === 0) {  
            $scope.msg = '<b>Must</b> select one of privilege in list';   
            $scope.typeMsg(false);
            return;
        } 
        var process = {
            remove: function () {
                var dataPost = $scope.prepareData();   
                $http.post($scope.baseUrl + '/default/delete-privilege', JSON.stringify(dataPost)).then(
                    function(response) {
                        var result = response.data;
                        if(result.error === 0) {
                            $scope.resetInfo();         
                            $scope.getListPriBy();
                        }
                        $scope.msg = result.message;
                        $scope.typeMsg(result.error === 0);
                    }, function(response) {
                        var result = response.data;
                        $scope.msg = result.message;
                        $scope.typeMsg(false);
                    });           
            }
        };
        confirmRemove('PRIVILEGE', process);
    };
     $scope.validationFrm = function(frm, isCreate ) {
	    var msg = '';
	    if ($scope.groupId.length === 0){
	    	msg += '<b>Group</b> must have <br>'
	    }
	    if(frm.name.$error.required) {
	        msg += '<b>Privilege Name</b> must have <br>';
	    }
	    if(frm.id.$error.required) {
	        msg += '<b>Function Id</b> must have <br>';
	    }
	    if(frm.link.$error.required) {
	        msg += '<b>Link</b> must have <br>';
	    }
	    if(frm.id.$error.type) {
	        msg += '<b>Function Id</b> must be number <br>';
	    }
	    if(frm.id.$error.maxlength) {
	        msg += '<b>Function Id</b> must consist less than 11 numbers <br>';
	    }	
	    if ($scope.deValue.length === 0 ){
	    	msg += 'Please choose <b> Default value </b> <br>';
	    }
	    if ($scope.deValue === 'k' &&  isCreate){
	    	msg += '<b> Default value </b> of new Privilege must not Keep stable <br>';
	    }
	    return msg;
	}
}]);

