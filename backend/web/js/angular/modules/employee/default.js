myAngular.controller('employeeController',['$scope', '$http', 'DTOptionsBuilder', 'httpGetEnum', 'httpGetProjectGroup',
	function($scope, $http, DTOptionsBuilder, httpGetEnum, httpGetProjectGroup){
		$scope.rootUrl = '';
    	$scope.baseUrl = '';
    	$scope.employeeId = '';
		$scope.employeeName = '';
		$scope.employeeCode ='';
		$scope.seclectedIndex = '';
		$scope.employeeStatus = '';
		$scope.supervisorId = '';
		$('#birthDate').val('');
		$('#startDate').val('');
		$('#endDate').val('');
		$scope.telephone = '';
		$scope.mobile = '';
		$scope.email = '';
		$scope.maritalStatus = '';
		$scope.registedAddress = '';
		$scope.currentAddress = '';
		//
		$scope.username = '';
        $scope.status = 1;
		//
		$scope.employeeList = [];
		$scope.sectionList = [];
		$scope.levelList = [];
		$scope.rankList = [];
		//$scope.accountList = [];
		$scope.dtOptions = {
	        pageLength: 10,
            lengthMenu: [5, 10, 15, 20, 25],
            ordering: true,
            paginationType: 'full_numbers',
    	}
    	$scope.msg = '';
	    $scope.typeMsg = function (isSuccess = true, timeOut = 10000) {
	        showMsg($scope.msg, isSuccess, timeOut);
	    };

	    $scope.clearMsg = function() {
	        $scope.msg = '';
	    };

	    $scope.fixUndefined = function(x){
	    	if (x === undefined)
	    		return '';
	    	else return x;
	    }

    	$scope.prepareData = function(){
    		x = {
                status : $scope.status ,// 0 is remove 1 is create
    			employeeId : $scope.employeeId,
    			employeeName : $scope.employeeName,
    			employeeCode : $scope.employeeCode,
    			sectionId : $('#section').val(),
    			levelId : $('#level').val(),
    			rankId : $('#rank').val(),
    			supervisorId : $scope.supervisorId,
    			telephone : $scope.telephone,
    			mobile : $scope.mobile,
    			email : $scope.email,
    			maritalStatus : $('input[name="marital"]:checked').length === 0 ? null : $('input[name="marital"]:checked').val(),
    			registedAddress : $scope.registedAddress,
    			currentAddress : $scope.currentAddress,
    			birthDate : $('#birthDate').val(),
    			startDate : $('#startDate').val(),
    			endDate : $('#endDate').val(),
                username : $scope.username,
                password : $('#password').val(),
                isAdmin : $('#admin').is(":checked"),

    		};
    		for (var i in x) {
  				 x[i] = $scope.fixUndefined(x[i]);
			} 
    		return x;
    	}
    	$scope.getDataByUrl = function(x,url){
    		var rightUrl = $scope.baseUrl + url;
    		$http.get(rightUrl).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                	switch(x){
                		case(1) :
                			$scope.sectionList = result.result;
                			break;
                		case(2):
                			$scope.levelList = result.result;
                			break;
                		case(3):
                			$scope.rankList = result.result;
                			break;
                        case(5):
                            $scope.logList = result.result;
                            //console.log(result.result);
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
    	 $scope.getDataByUrl(4,'/default/get-account-list');
    	}

    	$scope.getSectionList = function(){
    		$scope.getDataByUrl(1,'/default/get-section-list');
    	}
    	$scope.getLevelList = function(){
    		$scope.levelList = $scope.getDataByUrl(2,'/default/get-level-list');
    	}
    	$scope.getRankList = function(){
    		$scope.rankList = $scope.getDataByUrl(3,'/default/get-rank-list');
    	}

    	$scope.getEmployeeListBy = function(){
    		var dataPost = $scope.prepareData();
            $scope.postMethod(1,dataPost,'/default/get-employee-list-by','');
    	}
    	$scope.init  = function(url){
    		$scope.rootUrl = url;
    		$scope.baseUrl = url + '/employee';
    		$scope.getSectionList();
    		$scope.getLevelList();
    		$scope.getRankList();
    		$scope.getAccountList();
    		$scope.getEmployeeListBy();
           // $scope.getLogList();
    	}

    	$scope.getNameElement = function(val,kind){
    		var name = val;
    		if (val !== null){
    			switch(kind){
    				case 's' : 
    					section = $scope.sectionList.find(function(ele) {
                        	return ele.sectionID.toString() === val.toString();
                    	});
    					name = section ? section.sectionName : '';
                    	break;
                    case 'l' :
                    	level = $scope.levelList.find(function(ele) {
                        return ele.levelID.toString() === val.toString();
                    	});
                    	name = level ? level.levelName : '';
                    	break;
                    case 'r':
                    	rank = $scope.rankList.find(function(ele) {
                        return ele.rankID.toString() === val.toString();
                    	});
                    	name = rank ? rank.rankName : '';
                    	break;
                    case 'd':
	                    if(val === null || val === '') {
	                        return '';
	                    }
	                    var dt = new Date(val);
	                    name = dt.getFullYear() + '/' + ('0' + (dt.getMonth() + 1)).slice(-2) + '/' + ('0' + dt.getDate()).slice(-2);
	                    break;
                    default:
                    	name = '';
                    	break;
    			}
    			return name;
    		}
    		else return '';
    	}
    	$scope.selectedData = function(row){
    		$scope.employeeId = row.employeeID;
			$scope.employeeName = row.employeeName;
			$scope.employeeCode = row.employeeCode;
			$('#section').val(row.sectionID);
			$('#level').val(row.levelID);
			$('#rank').val(row.rank);
		//	$scope.employeeStatus = row.employeeStatus === 1 ? true: false ;
		//	console.log(row.maritalStatus);
			$('input[name="marital"][value="' + row.maritalStatus + '"]').prop('checked', true);
			$scope.supervisorId = row.supervisorID;
			$('#birthDate').val($scope.getNameElement(row.DoB, 'd'));
			$('#startDate').val($scope.getNameElement(row.startDate, 'd'));
			$('#endDate').val($scope.getNameElement(row.endDate, 'd'));
			$scope.telephone = row.telephone;
			$scope.mobile = row.mobile;
			$scope.email = row.email;
			$scope.registedAddress = row.registeredAddress;
			$scope.currentAddress = row.currentAddress;
			$scope.username = row.username;
			$('#password').val('');
			$('#confirm').val('');
			$('#admin').prop('checked', false);
			if (row.isAdmin === 1) $('#admin').prop('checked', true);
    	}

    	$scope.resetEmployee = function(){
    		$scope.employeeId = '';
			$scope.employeeName = '';
			$scope.employeeCode ='';
			$scope.seclectedIndex = '';
			$scope.employeeStatus = '';
			$scope.supervisorId = '';
			$('#section').val('');
			$('#level').val('');
			$('#rank').val('');
			$('#birthDate').val('');
			$('#startDate').val('');
			$('#endDate').val('');
			$scope.telephone = '';
			$scope.mobile = '';
			$scope.email = '';
			$scope.maritalStatus = '';
			$scope.registedAddress = '';
			$scope.currentAddress = '';
			$scope.username = '';
            $('#index').css("background-color","#e9ecef");
			$('#password').val('');
			$('#confirm').val('');
			$('#admin').prop('checked', false);
			$('input[name="marital"]:checked').prop('checked', false);
    	}

    	$scope.removeEmployee = function(){
    		if ($scope.employeeId.length == 0){
    			$scope.msg = '<b>Must</b> select one of employee in list';   
            	$scope.typeMsg(false);
            	return;
    		}
    		var process = {
    			remove : function(){
                    $scope.status = 0 ;
    				var dataPost = $scope.prepareData();
                    $scope.postMethod(4,dataPost,'/default/update-employee','Remove Employee Success <br>')
           			//$scope.resetEmployee();
                    //$scope.getEmployeeListBy();
                    $scope.status = 1;
    			}
    		};

    		confirmRemove('REMOVE EMPLOYEE',process);
    	};
        $scope.postMethod = function(kind,dataPost,subUrl,message){
            $http.post($scope.baseUrl + subUrl, JSON.stringify(dataPost)).then(function(response){
                var result = response.data;
                if (result.error == 0){
                    switch (kind){
                        case 1 :
                            $scope.employeeList = result.result;
                            console.log($scope.employeeList);
                            break;
                                       
                        case 3 : 
                            $scope.logList = result.result;
                            console.log(result.result);
                            break;
                        case 4 :
                            $scope.resetEmployee();
                            $scope.getEmployeeListBy();
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
        }
    	$scope.saveEmployee = function(){
    		$scope.checkForm();
    		if ($scope.msg.length > 0){
    			$scope.clearMsg();
    			$scope.typeMsg(false);
    			return;
    		}
    		var dataPost = $scope.prepareData();
            console.log(dataPost);
    		var url = ($scope.seclectedIndex.length === 0 ?
    		 '/default/create-employee': '/default/update-employee');
            $scope.postMethod(4,dataPost,url,"Save Employee success");
            //$scope.resetEmployee();
            //$scope.getEmployeeListBy();
    	}

    	$scope.checkForm = function(){
    		var form = $scope.employeeForm;
    		if (form.name.$error.required){
    			$scope.msg +=  '<b>Employee Name</b> must have <br>';
    		}
    		if (form.code.$error.required){
    			$scope.msg += '<b>Employee Code</b> must have <br>';
    		}
    		if ($('#level').val().length === 0){
    			$scope.msg +=  '<b>Level</b> must have <br>';
    		}
    	}

    	$scope.saveAccount = function(){
    		$scope.clearMsg();
    		if ($scope.seclectedIndex.length === 0){
    			$scope.msg += '<b>Emloyee </b> must be selected <br>';
    		}
    		if ($scope.username.length === 0){
    			$scope.msg +=  '<b>Username</b> must have <br>';
    		}
    		if ($('#password').val().toString() === ''){
    			$scope.msg +=  '<b>Password</b> must have <br>';	
    		}
    		if ($('#password').val().toString() != $('#confirm').val().toString()){
    			$scope.msg +=  '<b>Confirm</b> must have equal <b>Password </b> <br>';
    		}
    		if ($scope.msg.length > 0){
    			$scope.typeMsg(false);
    			return;
    		}
    		var dataPost = $scope.prepareData();
    		var url = $scope.baseUrl + '/default/update-employee';
            $scope.postMethod(4,dataPost,'/default/update-employee',"Save Account success")
    	    //$scope.resetEmployee();
            //$scope.getEmployeeListBy();
        }

    	$scope.removeAccount = function(){
    		$scope.clearMsg();
    		if ($scope.employeeId.length == 0){
    			$scope.msg += '<b>Must</b> select one of employee in list <br>';   
    		}
            var index = parseInt($scope.seclectedIndex.replace("#", "")) - 1;
            console.log(index);
    		if ($scope.employeeList[index].username === null){
    			$scope.msg +=  '<b>Username</b>  have not been exist  <br>';
    		}
    		if ($scope.msg.length > 0){
    			$scope.typeMsg(false);
    			return;
    		}
            $scope.username = '';
    		var process = {
    			remove : function(){
    				var dataPost = $scope.prepareData();
                    $scope.postMethod(4,dataPost,'/default/update-employee','Remove Account success');
    			}
    		};
    		confirmRemove('REMOVE ACCOUNT',process);
    	};
    	$scope.rowSelected = function(index) {
	        $scope.seclectedIndex = '#' + (index + 1);
            $('#index').css("background-color","yellow");
	        $scope.selectedData($scope.employeeList[index]);
    	}
        $scope.editSectionId = '';
        $scope.editSectionName = '';
        $scope.editSectionChange = function(){
            $scope.editSectionName = $scope.getNameElement($scope.editSectionId,'s');
        }

        $scope.logList = [];
        $scope.historyTitle = '';
        $scope.getLogList = function(index){
            $scope.historyTitle = $scope.employeeList[index].employeeName + '-' + $scope.employeeList[index].employeeCode
            var dataPost = {
                employeeCode : $scope.employeeList[index].employeeCode
            };
            console.log(dataPost);
            var url = '/default/get-log-list';
            $scope.postMethod(3,dataPost,url,'');
        }
        $scope.changeColor = function(index,kind){
            if (index == 0 ) return '';
            if ($scope.logList[index][kind].toString() === 
                $scope.logList[index-1][kind].toString())
                return '';
            else {
                return 'Tomato';
            }
        }

	}]);
