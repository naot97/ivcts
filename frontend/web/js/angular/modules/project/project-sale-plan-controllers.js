myAngular.controller('ProjectSaleplanController', ['$scope', '$http', 'DTOptionsBuilder', 'httpGetSection', 'httpGetPeriod', 'httpGetRank', 'httpGetType', 'httpGetProject', 
                                    function($scope, $http, DTOptionsBuilder, httpGetSection, httpGetPeriod, httpGetRank, httpGetType, httpGetProject){
    $scope.rootUrl = '';
    $scope.baseUrl = '';
    
    $scope.dtOptions = {
        pageLength: 10,
        paginationType: 'full_numbers',
        lengthChange: false
    };
    
    $scope.indexSelected = '#';
    $scope.saleplanID = '';
    $scope.projectID = '';
    $scope.sectionID = '';
    $scope.periodID = '';
    $scope.rankID = '';
    $scope.typeID = '';
    $scope.effort = '';
    $scope.enabled = '';
    
    $scope.Copy = false;
    $scope.historyTitle = '';
    
    $scope.CpProject = '';
    $scope.CpOldPeriod = '';
    $scope.CpNewPeriod = '';
    
    $scope.resetData = function() {    
        $scope.indexSelected = '#';
        $scope.saleplanID = '';
        $('#ddlProject').prop('selectedIndex', 0);
        $scope.projectID = '';
        $('#dllSection').prop('selectedIndex', 0);
        $scope.sectionID = '';
        $('#ddlPeriod').prop('selectedIndex', 0);
        $scope.periodID = '';
        $('#ddlRank').prop('selectedIndex', 0);
        $scope.rankID = '';
        $('#ddlType').prop('selectedIndex', 0);
        $scope.typeID = '';
        $scope.effort = '';
        $scope.enabled = '';
        $('#cbCopy').attr('disabled','disabled');
        $scope.Copy = false;
        $scope.historyTitle = '';
        
        $('#ddlCpProject').prop('selectedIndex', 0);
        $scope.CpProject = '';
        $('#ddlCpOldPeriod').prop('selectedIndex', 0);
        $scope.CpOldPeriod = '';
        $('#ddlCpNewPeriod').prop('selectedIndex', 0);
        $scope.CpNewPeriod = '';
    };
    
    $scope.selectedData = function(row) {        
        $scope.saleplanID = row.saleplanID;
        $('#ddlProject').val(row.projectID);
        $scope.projectID = $('#ddlProject').val();  
        $('#dllSection').val(row.sectionID);
        $scope.sectionID = $('#dllSection').val();  
        $('#ddlPeriod').val(row.periodID);
        $scope.periodID = $('#ddlPeriod').val();
        $('#ddlRank').val(row.rankID);
        $scope.rankID = $('#ddlRank').val();
        $('#ddlType').val(row.typeID);
        $scope.typeID = $('#ddlType').val();
        $scope.effort = row.effort;
        $scope.enabled = row.enabled;
    };
    
    $scope.prepareData = function() {
        $scope.projectID =  $('#ddlProject').val();
        $scope.sectionID =  $('#dllSection').val();
        $scope.periodID =  $('#ddlPeriod').val();
        $scope.rankID =  $('#ddlRank').val();
        $scope.typeID =  $('#ddlType').val();
        var newdata = {
            saleplanID: $scope.saleplanID,
            projectID: $scope.projectID,
            sectionID: $scope.sectionID,
            periodID: $scope.periodID,
            rankID: $scope.rankID,
            typeID: $scope.typeID,
            effort: $scope.effort,
            enabled: $scope.enabled
        };
        return newdata;
    };
    
    $scope.lstProjectSaleplan = [];
    $scope.lstLogs = [];
    
    $scope.lstGroupProject = [];
    $scope.lstProject = [];
    
    $scope.lstSection = [];
    $scope.lstPeriod = [];
    $scope.lstRank = [];
    $scope.lstType = [];
    
    $scope.msg = '';
    $scope.typeMsg = function (isSuccess = true, timeOut = 10000) {
        showMsg($scope.msg, isSuccess, timeOut);
    };
    $scope.clearMsg = function() {
        $scope.msg = '';
    };
    
    $scope.init = function(url) {
        $scope.rootUrl = url;
        $scope.baseUrl = $scope.rootUrl + '/project/project-sale-plan';  
        $scope.GetProject();
        $scope.GetSection();
        $scope.GetPeriod();
        $scope.GetRank();
        $scope.GetType();
        $scope.GetListProjectSaleplanBy();
    };
    
    $scope.GetProject = function() {
        httpGetProject.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
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
    
    $scope.GetSection = function() {
        httpGetSection.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                $scope.lstSection = result.section;
            }
        });   
    };
    
    $scope.GetPeriod = function() {
        httpGetPeriod.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                $scope.lstPeriod = result.period;
            }
        });   
    };
    
    $scope.GetRank = function() {
        httpGetRank.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                $scope.lstRank = result.rank;
            }
        });       
    };
    
    $scope.GetType = function() {
        httpGetType.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                $scope.lstType = result.type;
            }
        });       
    };
    
    $scope.GetNameElement = function(val, kind) {
        var name = val;
        if(val !== null) {
            switch(kind) {
                case 'pr':
                    name = $scope.lstProject.find(function(ele) {
                        return ele.projectID.toString() === val.toString();
                    }).projectName;
                    break;
                case 's':
                    name = $scope.lstSection.find(function(ele) {
                        return ele.sectionID.toString() === val.toString();
                    }).sectionName;
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
    
    $scope.rowSelected = function(id) {
        $('#cbCopy').removeAttr('disabled');
        var dataSelected = $scope.lstProjectSaleplan.find(function(ele) {
            return ele.saleplanID === id;
        });        
        $scope.indexSelected = '#' + ($scope.lstProjectSaleplan.indexOf(dataSelected) + 1);
        $scope.selectedData(dataSelected);
    };
    
    $scope.GetListProjectSaleplanBy = function() {
        var dataPost = $scope.prepareData();
        $http.post($scope.baseUrl + '/get-project-saleplan-by', JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {       
                    idCount = ''; sumEffort = 0; working = 0;
                    $scope.lstProjectSaleplan = result.lstProjectSaleplan;
                }
            }, function(response) {
                console.log(response.data.message);
            });
    };
    
    $scope.GetLogs = function(index) {
        var dataPost = {
            saleplanID: $scope.lstProjectSaleplan[index].saleplanID
        };
        $http.post($scope.baseUrl + '/get-logs', JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {       
                    $scope.lstLogs = result.lstLogs;
                    $scope.historyTitle = $scope.GetNameElement($scope.lstProjectSaleplan[index].projectID, 'pr') + ' (#' + (index+1) + ')';
                }
            }, function(response) {
                console.log(response.data.message);
            });
    };
    
    $scope.SaveProjectSaleplan = function() {
        if($scope.frmProjectSaleplan.$invalid) {
            $scope.msg = validationFrm($scope.frmProjectSaleplan);   
            $scope.typeMsg(false, 30000);
            return;
        } 
        var urlUsing = '';
        if($scope.saleplanID !== '' && !$scope.Copy) {
            urlUsing = $scope.baseUrl + '/update-project-saleplan';
        } else {
            urlUsing = $scope.baseUrl + '/create-project-saleplan';
            $scope.saleplanID = '';
            $scope.enabled = '';
        }
        var dataPost = $scope.prepareData();   
        $http.post(urlUsing, JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                    $scope.resetData();       
                    $scope.GetListProjectSaleplanBy();
                }
                $scope.msg = result.message;
                console.log(result.position);
                $scope.typeMsg(result.error === 0);
            }, function(response) {
                var result = response.data;
                $scope.msg = result.message;
                $scope.typeMsg(false);
            });
    };
    
    $scope.RemoveProjectSaleplan = function() {
        if($scope.saleplanID.length === 0) {  
            $scope.msg = '<b>Must</b> select one of project sale plan in list';   
            $scope.typeMsg(false);
            return;
        } 
        var process = {
            remove: function () {
                $scope.enabled = 0;
                var dataPost = $scope.prepareData();   
                $http.post($scope.baseUrl + '/delete-project-saleplan', JSON.stringify(dataPost)).then(
                    function(response) {
                        var result = response.data;
                        if(result.error === 0) {
                            $scope.resetData();         
                            $scope.GetListProjectSaleplanBy();
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
        confirmRemove('PROJECT SALE PLAN', process);
    };
    
    $scope.CopyNewPeriod = function() {
        var msg = '';
        if($scope.CpProject.length === 0) {
            msg += '<b>Copy from Project</b> must have <br>';
        }
        if($scope.CpOldPeriod.length === 0) {
            msg += '<b>Old Period</b> must have <br>';
        }
        if($scope.CpNewPeriod.length === 0) {
            msg += '<b>New Period</b> must have <br>';
        }
        if(msg.length === 0) {
            if($scope.CpOldPeriod === $scope.CpNewPeriod) {
                msg += '<b>Old Period</b> and <b>New Period</b> must be different <br>';
            }
        }
        if(msg.length > 0) {
            $scope.msg = msg;   
            $scope.typeMsg(false);
            return;
        }
        var dataPost = {
            project: $scope.CpProject,
            oldPeriod: $scope.CpOldPeriod,
            newPeriod: $scope.CpNewPeriod
        };
        $http.post($scope.baseUrl + '/copy-data-new-period', JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                    $scope.resetData();       
                    $scope.GetListProjectSaleplanBy();
                }
                $scope.msg = result.message;
                $scope.typeMsg(result.error === 0);
            }, function(response) {
                var result = response.data;
                $scope.msg = result.message;
                $scope.typeMsg(false);
            });
    };
    
    var idCount = '';
    var sumEffort = 0;
    var working = 0;
    $scope.CountProjectSaleplan = function(id) {
        working++;
        if(id !== idCount || working === $scope.lstSpendTime.length) {
            var count = 0;
            sumEffort = 0;
            idCount = id;
            $scope.lstProjectSaleplan.find(function(ele) {
                if(ele.projectID === id) {
                    count++;
                    sumEffort += parseFloat(ele.effort);
                }
            });
            return count;
        }
        return 0;
    };
    
    $scope.GetCurrent = function(saleplanID, projectID) {
        var count = 0;
        var lastItem = 0;
        $scope.lstProjectSaleplan.find(function(ele) {
            if(ele.projectID === projectID) {
                count++;
                lastItem = ele.saleplanID;
            }
        });
        return count > 1 && lastItem === saleplanID;
    };
    
    $scope.GetSumEffort = function() {
        return sumEffort.toFixed(2);
    };
    
}]);

function validationFrm(frm) {
    var msg = '';
    if(frm.project.$error.required) {
        msg += '<b>Project</b> must have <br>';
    }
    if(frm.section.$error.required) {
        msg += '<b>Section</b> must have <br>';
    }
    if(frm.period.$error.required) {
        msg += '<b>Period</b> must have <br>';
    }
    if(frm.rank.$error.required) {
        msg += '<b>Rank</b> must have <br>';
    }
    if(frm.type.$error.required) {
        msg += '<b>Type</b> must have <br>';
    }
    if(frm.effort.$error.required) {
        msg += '<b>Effort</b> must have <br>';
    } else if(frm.effort.$error.pattern) {
        msg += '<b>Effort</b> must be number (######.##) <br>';
    }
    
    return msg;
};