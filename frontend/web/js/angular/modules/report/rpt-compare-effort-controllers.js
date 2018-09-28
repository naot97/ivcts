myAngular.controller('rptCompareEffortController', ['$scope', '$http', 'DTOptionsBuilder', 'httpGetPeriod', 'httpGetRank', 'httpGetType', 'httpGetProject', 
                                    function($scope, $http, DTOptionsBuilder, httpGetPeriod, httpGetRank, httpGetType, httpGetProject){
    $scope.rootUrl = '';
    $scope.baseUrl = '';
    $scope.mess = 'Viet Toan';
//    $scope.dtOptions = {
//        searching: false,
//        paging: false,
//        lengthChange: false,
//        ordering: false
//    };
    
    $scope.groupID = '-1';
    $scope.periodID = '';
    $scope.GroupBy = '1';
    $scope.saveGroupBy = '';
    
    $scope.prepareData = function() {
        $scope.saveGroupBy = $scope.GroupBy;
        var newdata = {
            groupID: $scope.groupID,
            periodID: $scope.periodID,
            GroupBy: $scope.GroupBy
        };
        return newdata;
    };
    
    $scope.lstReport = [];
    $scope.lstSalePlanM = [];
    $scope.lstSalePlanP = [];
    $scope.lstEmployee = [];
    
    $scope.lstGroupProject = [];
    $scope.lstProject = [];    
    $scope.lstPeriod = [];
    $scope.lstRank = [];
    $scope.lstType = [];
    
    $scope.init = function(url) {
        $scope.rootUrl = url;
        $scope.baseUrl = $scope.rootUrl + '/report/rpt-compare-effort'; 
        $scope.GetProject();
        $scope.GetPeriod();
        $scope.GetRank();
        $scope.GetType();
    };
    
    $scope.GetProject = function() {
        httpGetProject.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                console.log(result.message);
            } else {
                var temp = '';
                for(var i = 0; i < result.project.length; i++) {
                    if(temp !== result.project[i].groupID || result.project[i].groupID === null || result.project[i].groupID === '') {
                        temp = result.project[i].groupID;
                        var ele = {
                            groupID: result.project[i].groupID,
                            groupNAme: result.project[i].groupNAme
                        };
                        $scope.lstGroupProject.push(ele);
                    }
                }
                $scope.lstProject = result.project;
            }
        });   
    };
    
    $scope.GetPeriod = function() {
        httpGetPeriod.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                console.log(result.message);
            } else {
                $scope.lstPeriod = result.period;
                $scope.periodID = $scope.lstPeriod[0].periodID;
            }
        });   
    };
    
    $scope.GetRank = function() {
        httpGetRank.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                console.log(result.message);
            } else {
                $scope.lstRank = result.rank;
            }
        });       
    };
    
    $scope.GetType = function() {
        httpGetType.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                console.log(result.message);
            } else {
                $scope.lstType = result.type;
            }
        });       
    };
    
    $scope.GetNameElement = function(val, kind) {
        var name = val;
        if(val !== null) {
            switch(kind) {
                case 'gr':
                    if(val === '') {
                        name = '--------NO GROUP--------';
                    } else {
                        name = $scope.lstGroupProject.find(function(ele) {
                            return ele.groupID.toString() === val.toString();
                        }).groupNAme;
                    }
                    break;
                case 'pr':
                    name = $scope.lstProject.find(function(ele) {
                        return ele.projectID.toString() === val.toString();
                    }).projectName;
                    break;
                case 'p':
                    var data = $scope.lstPeriod.find(function(ele) {
                        return ele.periodID.toString() === val.toString();
                    });
                    name = data.year + '/' + data.month + ': ' + data.workingHour + 'h';
                    break;
                case 'r':
                    name = $scope.lstRank.find(function(ele) {
                        return ele.rankID.toString() === val.toString();
                    }).rankName;
                    break;
                case 't':
                    name = $scope.lstType.find(function(ele) {
                        return ele.typeID.toString() === val.toString();
                    }).typeName;
                    break;
                default:
                    break;
            }
        }
        return name;
    };
    
    $scope.ExportReport = function() {
        var dataPost = $scope.prepareData();
        $http.post($scope.baseUrl + '/export-report', JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {       
                    $scope.lstReport = result.lstReport;
                }
            }, function(response) {
                console.log(response.data.message);
            });
    };
    
    $scope.rptGroupProject = function() {
        var arrGroup = [];
        var tempGroupID = 'NULL';
        $scope.lstReport.find(function(ele) {
            if(ele.groupID !== tempGroupID) {
                tempGroupID = ele.groupID;
                arrGroup.push(ele);
            }
        });
        return arrGroup;
    };
    
    $scope.rptProject = function(groupID) {
        var arrProject = [];
        var tempProjectID = 'NULL';
        $scope.lstReport.find(function(ele) {
            if(ele.groupID === groupID && ele.projectID !== tempProjectID) {
                tempProjectID = ele.projectID;
                arrProject.push(ele);
            }
        });
        return arrProject;
    };
    
    $scope.rptSumEffort = function(groupID, position, projectID = null, tr = null) {
        var sum = 0;
        $scope.lstReport.find(function(ele) {
            if(ele.groupID === groupID && ele.position === position) {
                if(projectID !== null) {
                    if(projectID === ele.projectID) {
                        if(tr !== null) {
                            if($scope.saveGroupBy === '1') {
                                if(tr.toString() === ele.typeID.toString()) {
                                    sum += parseFloat(ele.effort.toString());
                                }
                            } else {
                                if(tr.toString() === ele.rankID.toString()) {
                                    sum += parseFloat(ele.effort.toString());
                                }
                            }
                        } else {
                            sum += parseFloat(ele.effort.toString());
                        }
                    }
                } else {
                    sum += parseFloat(ele.effort.toString());
                }
            }
        });
        return sum.toFixed(2);
    };
    
    $scope.getNameRankOrType = function(kind) {        
        return $scope.saveGroupBy === '1' ? 'Type' : 'Rank';
    };
}]);