
myAngular.controller('projectController', ['$scope', '$http', 'DTOptionsBuilder', 'httpGetSection', 'httpGetPeriod', 'httpGetRank', 'httpGetProject', 
function($scope, $http, DTOptionsBuilder, httpGetSection, httpGetPeriod, httpGetRank, httpGetProject){
	$scope.rootUrl = '';
    $scope.baseUrl = '';
    $scope.msg = '';

    $scope.typeMsg = function (isSuccess = true, timeOut = 10000) {
        showMsg($scope.msg, isSuccess, timeOut);
    };
    $scope.clearMsg = function() {
        $scope.msg = '';
    };
    $scope.init = function(url){
    	$scope.rootUrl = url ;
    	$scope.baseUrl = url + '/report/project';
        $('#tbReport').hide();
    	$scope.getPeriod();
    	$scope.getSectionInfo();
    	$scope.getProjectInfo();
    	$scope.getRank();
    }
    $scope.sectionID = '';
    $scope.lstSectionInfo = [];
    $scope.lstPeriod = [];
    $scope.lstProjectInfo = [];
    $scope.lstRank = [];
    $scope.dtOptions = {};
    $scope.reset = function(){
        $scope.sectionID = '';
        $('#period').val('');
        $('#rank').val('');
        $('#pro').val('');
        $('#section').val('');
        $('#diff').val('0');
    }
    $scope.getMethod = function(http,kind){
        http.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                switch(kind){
                	case 1 :
                		$scope.lstSectionInfo = result.section;
                		console.log($scope.lstSectionInfo);
                		break;
                	case 2 :
                		$scope.lstProjectInfo = result.project;
                		break;
                	case 3 :
                		$scope.lstPeriod = result.period;
                		console.log($scope.lstPeriod);
                		break;
                	case 4 :
                		$scope.lstRank = result.rank;
                		break;
                	default :
                		break;
                }
            }
    	});
    };

    $scope.getSectionInfo = function(){
    	$scope.getMethod(httpGetSection,1);
    };

    $scope.getProjectInfo = function(){
    	$scope.getMethod(httpGetProject,2);
    }
    $scope.getPeriod = function(){
    	$scope.getMethod(httpGetPeriod,3);
    }
    $scope.getRank = function(){
    	$scope.getMethod(httpGetRank,4);
    }
    $scope.GetNameElement = function(val, kind) {
        var name = val;
        if(val !== null) {
            switch(kind) {
                case 's':
                    var section  = $scope.lstSectionInfo.find(function(ele) {
                        return ele.sectionID.toString() === val.toString();
                    });
                    name = section != null ? section.sectionName : '';
                    break;
                case 'pr':
                    name = $scope.lstProjectInfo.find(function(ele) {
                        return ele.projectID.toString() === val.toString();
                    }).projectName;
                    break;
                case 'p':
                    var data = $scope.lstPeriod.find(function(ele) {
                        return ele.periodID.toString() === val.toString();
                    });

                    name = data ? data.year + '/' + data.month + ': ' + data.workingHour + 'h' : '';
                    break;
                case 'r':
                    name = $scope.lstRank.find(function(ele) {
                        return ele.rankID.toString() === val.toString();
                    }).rankName;
                    break;
                case 'dt':
                    if(val === null || val === '') {
                        return '';
                    }
                    var dt = new Date(val);
                    name = dt.getFullYear() + '/' + ('0' + (dt.getMonth() + 1)).slice(-2) + '/' + ('0' + dt.getDate()).slice(-2) 
                         + ' ' + ('0' + dt.getHours()).slice(-2) + ':' + ('0' + dt.getMinutes()).slice(-2) + ':' + ('0' + dt.getSeconds()).slice(-2) ;
                    break;
                default:
                    break;
            }
        }
        return name;
    };
    $scope.chooseRank = function(){
    	switch($('#rank').val().toString()){
    		case '0' :
    			return [1,3];
    		case '-1' :
    			return [2,4,5];
    		case '' :
    			return null;
    		default :
    			return [$('#rank').val()];
    	}
    }
    $scope.prepareData = function(){
    	return {
    		periodID : $('#period').val(),
    		rankID : $scope.chooseRank(),
    		projectID : $('#pro').val(),
    		sectionID : $('#section').val()
    	};
    }
    $scope.report = {};
    $scope.indexProject = {};
    $scope.lstSection = [];
    $scope.indexProjectAll = {};
    $scope.reportAll = [];
    $scope.createReport = function(kind,list){
        for (var i = 0; i < list.length; i++) {
            var ele = list[i];
            var sectionID = ele.sectionID;
            var projectID = ele.projectID;
            if ($scope.report[sectionID] == undefined){
                $scope.report[sectionID] = [];
                $scope.indexProject[sectionID] = {};
            }
            var index = $scope.indexProject[sectionID][projectID];
            if (index == undefined){
                $scope.report[sectionID].push({});
                index = $scope.report[sectionID].length - 1;
                $scope.report[sectionID][index].diff = 0.0;
                $scope.report[sectionID][index].sumSaleSDC = 0.0;
                $scope.report[sectionID][index].sumSalePM = 0.0;
                $scope.report[sectionID][index].sumPlan = 0.0;
                $scope.report[sectionID][index].sumActual = 0.0;
                $scope.indexProject[sectionID][projectID] = index;
            }
            $scope.report[sectionID][index][kind] = ele.sumEffort;   
            $scope.report[sectionID][index].projectID = projectID;                          
        }
    }
    $scope.createReportAll = function(kind,list){
        for (var i = 0 ; i < list.length;i++) {
               var ele = list[i];
               var projectID = ele.projectID;
               var index = $scope.indexProjectAll[projectID];
               if (index == undefined){
                    $scope.reportAll.push({});
                    index = $scope.reportAll.length - 1;
                    $scope.reportAll[index].diff = 0.0;
                    $scope.reportAll[index].sumSaleSDC = 0.0;
                    $scope.reportAll[index].sumSalePM = 0.0;
                    $scope.reportAll[index].sumPlan = 0.0;
                    $scope.reportAll[index].sumActual = 0.0;
                    $scope.indexProjectAll[projectID] = index;
               }
               $scope.reportAll[index][kind] = ele.sumEffort;
               $scope.reportAll[index].projectID = projectID;
           }   
    }
    $scope.initReport = function(result){
        if ($scope.sectionID === 0){
            console.log('bbb');
            $scope.indexProjectAll = {};
            $scope.reportAll = [];
            $scope.createReportAll('sumSaleSDC',result.saleSDC);
            $scope.createReportAll('sumSalePM',result.salePM);
            $scope.createReportAll('sumPlan',result.plan);
            $scope.createReportAll('sumActual',result.assignment);
            console.log($scope.reportAll);
            console.log($scope.indexProjectAll);
        }
        else{
            console.log('aaa');
            $scope.report = {};
            $scope.indexProject = {};
            $scope.lstSection = [];
            $scope.createReport('sumSaleSDC',result.saleSDC);
            $scope.createReport('sumSalePM',result.salePM);
            $scope.createReport('sumPlan',result.plan);
            $scope.createReport('sumActual',result.assignment);
            for (i in $scope.report)
                $scope.lstSection.push(i);
        }
    }

    $scope.postMethod = function(kind,dataPost,subUrl,message){
    	$http.post($scope.baseUrl + subUrl, JSON.stringify(dataPost)).then(function(response){
                var result = response.data;
                if (result.error == 0){
                    switch (kind){
                        case 1 :
                             $scope.sectionID = dataPost.sectionID;
                             $scope.initReport(result);
                            break;
                        case 2:
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
    $scope.getProjectReportBy = function(){
    	if ($('#period').val().length === 0){
    		$scope.msg = '<b>Period</b> have not been selected<br>';
    		$scope.typeMsg(false);
    	}
    	var dataPost = $scope.prepareData();
    	$scope.postMethod(1,dataPost,'/get-project-report-by','');
        $('#tbReport').show();
    	console.log(dataPost);
    }
    $scope.diffValue = '0';
    $scope.getDiff = function(p){
        switch($scope.diffValue){
            case '0' :
                return p.sumActual - p.sumPlan;
            case '1' :
                return p.sumActual - p.sumSalePM;
            case '2' :
                return p.sumActual - p.sumSaleSDC;
            case '3' :
                return p.sumPlan - p.sumSalePM;
            case '4' :
                return p.sumPlan - p.sumSaleSDC;
            case '5' :
                return p.sumSalePM - p.sumSaleSDC;   
            default :
                return null; 
        }
    }
}]);
