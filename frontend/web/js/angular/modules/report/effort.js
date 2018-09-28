myAngular.controller('effortController', ['$scope', '$http', 'DTOptionsBuilder', 'httpGetPeriod', 'httpGetRank', 'httpGetType', 'httpGetProject','httpGetLevel', 
function($scope, $http, DTOptionsBuilder, httpGetPeriod, httpGetRank, httpGetType, httpGetProject, httpGetLevel){
	$scope.rootUrl = '';
	$scope.baseUrl = '';
	$scope.periodList = [];
	$scope.levelList = [];
	$scope.rankList = [];
    $scope.tableList = [];
    $scope.projectList = [];
    $scope.detailList = [];
    $scope.rankListSelected = [];
    $scope.employeeJson = {};
    $scope.levelID = '';
    $scope.from = '' ;
    $scope.to = '';
    $scope.titleOfTable = '';
    $scope.month = '';
    $scope.year = '';
    $scope.sumEmployee = '';
    $scope.workingHour = 0;
    $scope.dtOptionsDetail = {
        pageLength: 10,
        lengthMenu: [5, 10, 15, 20, 25, 30 ],
        ordering: true,
        paginationType: 'full_numbers'
    };
    $scope.dtOptions = {
        paging: false,
        ordering: true,
        bInfo : false,
    };

    $scope.msg = '';
    $scope.typeMsg = function (isSuccess = true, timeOut = 10000) {
        showMsg($scope.msg, isSuccess, timeOut);
    };
    $scope.clearMsg = function() {
        $scope.msg = '';
    };
	$scope.init = function(url) {
        $scope.rootUrl = url;
        $scope.baseUrl = $scope.rootUrl + '/report/effort'; 
        $scope.getLevelList();
        $scope.getPeriodList();
        $scope.getRankList();
        $scope.getProjectList();
       // $scope.GetType();
    };
    $scope.getProjectList = function(){
         $scope.getMethod(4,httpGetProject);
    }
    $scope.getPeriodList = function(){
    	$scope.getMethod(1,httpGetPeriod);
    };
    $scope.getRankList = function(){
    	$scope.getMethod(2,httpGetRank);
    }
    $scope.getLevelList = function(){
    	$scope.getMethod(3,httpGetLevel);
    }
    $scope.getMethod = function(kind,http){
    	http.getData($scope.rootUrl).then(function(data){
    		var result = data;
            if(result.error === 1) {
                console.log(result.message);
            } else {
                switch(kind){
                	case 1 :
                		$scope.periodList = result.period;
                		break;
                	case 2:
                		$scope.rankList = result.rank;
                		break;
                	case 3:
                		$scope.levelList = result.level;
                       $scope.createEmployeeJson();
                		break;
                    case 4:
                        $scope.projectList = result.project;
                        break;
                	default :
                		break;
                }
            }
    	});
    }
    $scope.createEmployeeJson = function(){
        for (var i = $scope.levelList.length - 1; i >= 0; i--) {
            $scope.employeeJson[$scope.levelList[i].levelID] = [];
        }
    }
    $scope.addEmployeeJson = function(list){
        for (var i = list.length - 1; i >= 0; i--) {
            $scope.employeeJson[list[i].levelID].push(list[i])
        }
    }
    $scope.initEventShow = function(){
        for (var i = $scope.tableList.length - 1; i >= 0; i--) {
            $scope.tableList[i].levelStatus = false;
        }
    }
    $scope.postMethod = function(kind,dataPost,subUrl,message){
    	$http.post($scope.baseUrl + subUrl, JSON.stringify(dataPost)).then(function(response){
                var result = response.data;
                if (result.error == 0){
                    switch (kind){
                        case 1 :
                            $scope.tableList = $scope.levelList;
                            $scope.initEventShow();
                            $scope.sumEmployee = result.list.length;
                            $scope.createEmployeeJson();
                            $scope.addEmployeeJson(result.list);
                            break;
                        case 2:
                           // console.log(result.list);
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
    }
    $scope.getRankSelected = function(){
        $scope.rankListSelected = [];
        for (var i = $scope.rankList.length - 1; i >= 0; i--) {
            if ($('#r' + $scope.rankList[i].rankID).is(":checked"))
                $scope.rankListSelected.push($scope.rankList[i].rankID);
        }
        
    }    
    $scope.checkSubmit = function(){
        $scope.clearMsg();
        if ($('#period').val().length === 0)
            $scope.msg += 'Period must been selected<br>';
        $scope.getRankSelected();
        console.log($scope.rankListSelected);
        if ($scope.rankListSelected.length === 0)
            $scope.msg += 'Rank must been selected<br>';
        if ($scope.from === null || $scope.from.length === 0 ||
        isNaN($scope.from) || $scope.to === null || $scope.to.length === 0 || isNaN($scope.to))
            $scope.msg += 'From and To must be number<br>';

    }
    $scope.prepareData = function(){
        return {
            periodID : $('#period').val(),
            rankListSelected : $scope.rankListSelected,
            //levelID : $scope.levelID,
            groupBy : $('#groupBy').val(),
            from : ($('#assign').is(':checked')?$scope.from:(1 - $scope.to))*$scope.workingHour,
            to : ($('#assign').is(':checked')?$scope.to:(1-$scope.from))*$scope.workingHour
           // employeeIDList : $scope.employeeIDJson[$scope.levelID]
        };
    }
    $scope.getElement = function(val,kind){
        if (val == null) return null;
        result = null;
        switch(kind){
            case 'p' :
                result = $scope.periodList.find(function(ele){
                    return val.toString() === ele.periodID.toString();
                });
                break;
            default :
                break;
        }
        return result;
    }

    $scope.submit = function(){
        $scope.checkSubmit();
        if ($scope.msg.length > 0)
        {
            $scope.typeMsg(false);
            return;
        }
        //$scope.getLevelList();
        $scope.tableList = [];
        $scope.titleOfTable = 'Statics availble effort from ' + $scope.from + ' to '
        + $scope.to + ' in ';
        if ($('#period').val() == 0)
          $scope.titleOfTable += 'All time' ; 
        else{
            var p = $scope.getElement($('#period').val(),'p');
            $scope.titleOfTable += p.month + '/' + p.year + '--' + p.workingHour + ' hours';
            $scope.workingHour = p.workingHour;
            $scope.month = p.month;
            $scope.year = p.year;
        } 
        var dataPost = $scope.prepareData();
        var url = '/get-effort-list-by';
        $scope.postMethod(1,dataPost,url,'');
    }

    $scope.detail = function(levelID){
        $scope.detailList = $scope.employeeJson[levelID];
        console.log($scope.detailList);
      // var dataPost = $scope.prepareData();
       // var url = '/get-detail-by';
       // $scope.postMethod(2,dataPost,url,'');

    }
    
}]);
