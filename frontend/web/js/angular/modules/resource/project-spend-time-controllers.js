myAngular.controller('spendTimeController', ['$scope', '$http', 'DTOptionsBuilder', 'httpGetSection', 'httpGetEmployee', 'httpGetPeriod', 'httpGetRank', 'httpGetType', 'httpGetProject', 
                                    function($scope, $http, DTOptionsBuilder, httpGetSection, httpGetEmployee, httpGetPeriod, httpGetRank, httpGetType, httpGetProject){
    $scope.rootUrl = '';
    $scope.baseUrl = '';
    $scope.titleSpendTime = '';
    
    $scope.dtOptions = {
        pageLength: 10,
        paginationType: 'full_numbers',
        lengthChange: false
    };
    $
    $scope.indexSelected = '#';
    $scope.spendTimeID = '';
    $scope.sectionID = '';
    $scope.employeeID = '';
    $scope.projectID = '';
    $scope.periodID = '';
    $scope.rankID = '';
    $scope.typeID = '';
    $scope.effort = '';
    $scope.ot = '';
    $scope.enabled = '';
    
    $scope.Copy = false;
    $scope.historyTitle = '';
    
    $scope.resetData = function() {    
        $scope.indexSelected = '#';
        $scope.spendTimeID = '';
        $('#dllSection').prop('selectedIndex', 0);
        $scope.sectionID = '';
        $('#dllEmployee').prop('selectedIndex', 0);
        $scope.employeeID = '';
        $('#ddlProject').prop('selectedIndex', 0);
        $scope.projectID = '';
        $('#ddlPeriod').prop('selectedIndex', 0);
        $scope.periodID = '';
        $('#ddlRank').prop('selectedIndex', 0);
        $scope.rankID = '';
        $('#ddlType').prop('selectedIndex', 0);
        $scope.typeID = '';
        $scope.effort = '';
        $scope.ot = '';
        $scope.enabled = '';
        $('#cbCopy').attr('disabled','disabled');
        $scope.Copy = false;
        $scope.historyTitle = '';
    };
    
    $scope.selectedData = function(row) {        
        $scope.spendTimeID = row.spendTimeID;
        $('#dllSection').val(row.sectionID);
        $scope.sectionID = $('#dllSection').val();  
        $('#dllEmployee').val(row.employeeID);
        $scope.employeeID = $('#dllEmployee').val();  
        $('#ddlProject').val(row.projectID);
        $scope.projectID = $('#ddlProject').val();  
        $('#ddlPeriod').val(row.periodID);
        $scope.periodID = $('#ddlPeriod').val();
        $('#ddlRank').val(row.rankID);
        $scope.rankID = $('#ddlRank').val();
        $('#ddlType').val(row.typeID);
        $scope.typeID = $('#ddlType').val();
        $scope.effort = row.effort;
        $scope.ot = row.ot;
        $scope.enabled = row.enabled;
    };
    
    $scope.prepareData = function() {
        $scope.sectionID =  $('#dllSection').val();
        $scope.employeeID =  $('#dllEmployee').val();
        $scope.projectID =  $('#ddlProject').val();
        $scope.periodID =  $('#ddlPeriod').val();
        $scope.rankID =  $('#ddlRank').val();
        $scope.typeID =  $('#ddlType').val();
        var newdata = {
            spendTimeID: $scope.spendTimeID,
            sectionID: $scope.sectionID,
            employeeID: $scope.employeeID,
            projectID: $scope.projectID,
            periodID: $scope.periodID,
            rankID: $scope.rankID,
            typeID: $scope.typeID,
            effort: $scope.effort,
            ot: $scope.ot,
            enabled: $scope.enabled
        };
        return newdata;
    };
    
    $scope.lstSpendTime = [];
    $scope.lstLogs = [];
    
    $scope.lstSection = [];
    $scope.lstEmployee = [];
    
    $scope.lstGroupProject = [];
    $scope.lstProject = [];
    
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
    
    $scope.init = function(url, from) {
        $scope.rootUrl = url;
        $scope.baseUrl = $scope.rootUrl + '/resource/' + from;  
        $scope.titleSpendTime = from === 'input-plan' ? 'spend time plan' : 'spend time actual';
        $scope.GetSection();
        $scope.GetEmployee();
        $scope.GetProject();
        $scope.GetPeriod();
        $scope.GetRank();
        $scope.GetType();
        $scope.GetListSpendTimeBy();
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
    
    $scope.GetEmployee = function(section = '') {
        httpGetEmployee.getData($scope.rootUrl, section).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                $scope.lstEmployee = result.employee;
            }
        });   
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
                case 's':
                    name = $scope.lstSection.find(function(ele) {
                        return ele.sectionID.toString() === val.toString();
                    }).sectionName;
                    break;
                case 'e':
                    name = $scope.lstEmployee.find(function(ele) {
                        return ele.employeeID.toString() === val.toString();
                    }).employeeName;
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
        var dataSelected = $scope.lstSpendTime.find(function(ele) {
            return ele.spendTimeID === id;
        });        
        $scope.indexSelected = '#' + ($scope.lstSpendTime.indexOf(dataSelected) + 1);
        $scope.selectedData(dataSelected);
    };
    
    $scope.GetListSpendTimeBy = function() {
        var dataPost = $scope.prepareData();
        $http.post($scope.baseUrl + '/get-spend-time-by', JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {       
                    idCount = ''; sumEffort = 0; sumOT = 0; working = 0;
                    $scope.lstSpendTime = result.lstSpendTime;
                }
            }, function(response) {
                console.log(response.data.message);
            });
    };
    
    $scope.GetLogs = function(index) {
        var dataPost = {
            spendTimeID: $scope.lstSpendTime[index].spendTimeID
        };
        $http.post($scope.baseUrl + '/get-logs', JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {       
                    $scope.lstLogs = result.lstLogs;
                    $scope.historyTitle = $scope.GetNameElement($scope.lstSpendTime[index].employeeID, 'e') + ' (#' + (index+1) + ')';
                }
            }, function(response) {
                console.log(response.data.message);
            });
    };
    
    $scope.SaveSpendTime = function() {
        if($scope.frmSpendTime.$invalid) {
            $scope.msg = validationFrm($scope.frmSpendTime);   
            $scope.typeMsg(false, 30000);
            return;
        } 
        var urlUsing = '';
        if($scope.spendTimeID !== '' && !$scope.Copy) {
            urlUsing = $scope.baseUrl + '/update-spend-time';
        } else {
            urlUsing = $scope.baseUrl + '/create-spend-time';
            $scope.spendTimeID = '';
            $scope.enabled = '';
        }
        var dataPost = $scope.prepareData();   
        $http.post(urlUsing, JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                    $scope.resetData();       
                    $scope.GetListSpendTimeBy();
                }
                $scope.msg = result.message;
                $scope.typeMsg(result.error === 0);
            }, function(response) {
                var result = response.data;
                $scope.msg = result.message;
                $scope.typeMsg(false);
            });
    };
    
    $scope.RemoveSpendTime = function() {
        if($scope.spendTimeID.length === 0) {  
            $scope.msg = '<b>Must</b> select one of ' + $scope.titleSpendTime + ' in list';   
            $scope.typeMsg(false);
            return;
        } 
        var process = {
            remove: function () {
                $scope.enabled = 0;
                var dataPost = $scope.prepareData();   
                $http.post($scope.baseUrl + '/delete-spend-time', JSON.stringify(dataPost)).then(
                    function(response) {
                        var result = response.data;
                        if(result.error === 0) {
                            $scope.resetData();         
                            $scope.GetListSpendTimeBy();
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
        confirmRemove($scope.titleSpendTime.toUpperCase(), process);
    };
    
    var idCount = '';
    var sumEffort = 0;
    var sumOT = 0;
    var working = 0;
    $scope.CountSpendTime = function(id) {
        working++;
        if(id !== idCount || working === $scope.lstSpendTime.length) {
            var count = 0;
            sumEffort = 0;
            sumOT = 0;
            idCount = id;
            working = 0;
            $scope.lstSpendTime.find(function(ele) {
                if(ele.employeeID === id) {
                    count++;
                    sumEffort += parseFloat(ele.effort);
                    sumOT += parseFloat(ele.ot);
                }
            });
            return count;
        }
        return 0;
    };
    
    $scope.GetCurrent = function(spendTimeID, employeeID) {
        var count = 0;
        var lastItem = 0;
        $scope.lstSpendTime.find(function(ele) {
            if(ele.employeeID === employeeID) {
                count++;
                lastItem = ele.spendTimeID;
            }
        });
        return count > 1 && lastItem === spendTimeID;
    };
    
    $scope.GetSum = function(k) {
        switch(k) {
            case 'e':
                return sumEffort.toFixed(2);
            case 'o':
                return sumOT.toFixed(2);
            default:
                return 0.0;
        }
    };
    
    $scope.changeSectionEmployee = function() {
        $scope.GetEmployee($scope.sectionID);
    };
}]);

function validationFrm(frm) {
    var msg = '';
    if(frm.section.$error.required) {
        msg += '<b>Section</b> must have <br>';
    }
    if(frm.employee.$error.required) {
        msg += '<b>Employee</b> must have <br>';
    }
    if(frm.project.$error.required) {
        msg += '<b>Project</b> must have <br>';
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
    if(frm.ot.$error.pattern) {
        msg += '<b>OT</b> must be number (######.##) <br>';
    }
    
    return msg;
};