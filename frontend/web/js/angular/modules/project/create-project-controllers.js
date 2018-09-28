myAngular.controller('createProjectController', ['$scope', '$http', 'DTOptionsBuilder', 'httpGetEnum', 'httpGetProjectGroup',
                                    function($scope, $http, DTOptionsBuilder, httpGetEnum, httpGetProjectGroup){
    $scope.rootUrl = '';
    $scope.baseUrl = '';
    
    $scope.dtOptions = {
        pageLength: 10,
        lengthMenu: [5, 10, 15, 20, 25],
        ordering: false,
        paginationType: 'full_numbers'
    };
    
    $scope.dtOptionsLogs = {
        pageLength: 10,
        paginationType: 'full_numbers',
        lengthChange: false
    };
    
    $scope.indexSelected = '#';
    $scope.projectID = '';
    $scope.projectName = '';
    $scope.projectCode = '';
    $scope.projectStatus = '';
    $scope.OTStatus = false;
    $scope.RedmineURL = '';
    $scope.RedmineID = '';
    $scope.IvisID = '';
    $scope.SDCCode = '';
    $('#EndDate').val('');
    $scope.groupID = '';
    $scope.enabled = '';
    $scope.Copy = false;
    $scope.historyTitle = '';
    
    $scope.resetData = function() {
        $scope.indexSelected = '#';
        $scope.projectID = '';
        $scope.projectName = '';
        $scope.projectCode = '';
        $('#projectStatus').prop('selectedIndex', 0);
        $scope.projectStatus = '';
        $scope.OTStatus = false;
        $scope.RedmineURL = '';
        $scope.RedmineID = '';
        $scope.IvisID = '';
        $scope.SDCCode = '';
        $('#EndDate').val('');
        $('#group').prop('selectedIndex', 0);
        $scope.groupID = '';
        $scope.enabled = '';
        $('#cbCopy').attr('disabled','disabled');
        $scope.Copy = false;
        $scope.historyTitle = '';
    };
    
    $scope.selectedData = function(row) {
        $scope.projectID = row.projectID;
        $scope.projectName = row.projectName;
        $scope.projectCode = row.projectCode;
        $('#projectStatus').val(row.projectStatus);
        $scope.projectStatus =  $('#projectStatus').val();
        $scope.OTStatus = row.OTStatus === 1 ? true : false;
        $scope.RedmineURL = row.redmineURL;
        $scope.RedmineID = row.redmineID;
        $scope.IvisID = row.ivisID;
        $scope.SDCCode = row.sdcCode;
        $('#EndDate').val($scope.GetNameElement(row.endDate, 'd'));
        $('#group').val(row.groupId);
        $scope.groupID =  $('#group').val();
        $scope.enabled = row.enabled;
    };
    
    $scope.prepareData = function() {
        $scope.projectStatus =  $('#projectStatus').val();
        var newdata = {
            projectID: $scope.projectID,
            projectName: $scope.projectName,
            projectCode: $scope.projectCode,
            projectStatus: $scope.projectStatus,
            OTStatus: $scope.OTStatus ? 1 : 0,
            redmineURL: $scope.RedmineURL,
            redmineID: $scope.RedmineID,
            ivisID: $scope.IvisID,
            sdcCode: $scope.SDCCode,
            endDate: $('#EndDate').val(),
            groupId: $scope.groupID,
            enabled: $scope.enabled
        };
        return newdata;
    };
    
    $scope.projectGroup = [];
    $scope.lstProject = [];
    $scope.lstProjectStatus = [];
    $scope.lstOTStatus = [];
    $scope.lstLogs = [];
    
    $scope.msg = '';
    $scope.typeMsg = function (isSuccess = true, timeOut = 10000) {
        showMsg($scope.msg, isSuccess, timeOut);
    };
    $scope.clearMsg = function() {
        $scope.msg = '';
    };
    
    $scope.init = function(url) {
        $scope.rootUrl = url;
        $scope.baseUrl = $scope.rootUrl + '/project/create-project';  
        $scope.GetStatus();
        $scope.GetProjectGroup();
        $scope.GetListProjectBy();
    };
    
    $scope.GetStatus = function() {
        httpGetEnum.getProjectStatus($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                $scope.lstProjectStatus = result.EnumData;      
            }
        });
        httpGetEnum.getOTStatus($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                $scope.lstOTStatus = result.EnumData;
            }
        });  
    };
    
    $scope.GetProjectGroup = function() {
        httpGetProjectGroup.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                $scope.projectGroup = result.projectGroup;
            }
        });       
    };
    
    $scope.GetListProjectBy = function() {
        var dataPost = $scope.prepareData();
        $http.post($scope.baseUrl + '/get-list-project-by', JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                    $scope.lstProject = result.lstProject;
                }
            }, function(response) {
                console.log(response.data.message);
            });
    };
    
    $scope.GetLogs = function(index) {
        var dataPost = {
            projectID: $scope.lstProject[index].projectID
        };
        $http.post($scope.baseUrl + '/get-logs', JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {       
                    $scope.lstLogs = result.lstLogs;
                    $scope.historyTitle = ' #' + (index+1) + '';
                }
            }, function(response) {
                console.log(response.data.message);
            });
    };
    
    $scope.GetNameElement = function(val, kind) {
        var name = val;
        if(val !== null) {
            switch(kind) {
                case 'gp':
                    name = $scope.projectGroup.find(function(ele) {
                        return ele.groupID.toString() === val.toString();
                    }).groupNAme;
                    break;
                case 'ps':
                    name = $scope.lstProjectStatus.find(function(ele) {
                        return ele.value.toString() === val.toString();
                    }).description;
                    break;
                case 'ot':
                    name = $scope.lstOTStatus.find(function(ele) {
                        return ele.value.toString() === val.toString();
                    }).description === 'True' ? 'Yes' : 'No';
                    break;
                case 'd':
                    if(val === null || val === '') {
                        return '';
                    }
                    var dt = new Date(val);
                    name = dt.getFullYear() + '/' + ('0' + (dt.getMonth() + 1)).slice(-2) + '/' + ('0' + dt.getDate()).slice(-2);
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
    
    $scope.rowSelected = function(index) {
        $('#cbCopy').removeAttr('disabled');
        $scope.indexSelected = '#' + (index + 1);
        $scope.selectedData($scope.lstProject[index]);
    };
    
    $scope.SaveProject = function() {
        if($scope.frmProject.$invalid) {
            $scope.msg = validationFrm($scope.frmProject);   
            $scope.typeMsg(false, 30000);
            return;
        } 
        var urlUsing = '';
        if($scope.projectID !== '' && !$scope.Copy) {
            urlUsing = $scope.baseUrl + '/update-project';
        } else {
            urlUsing = $scope.baseUrl + '/create-project';
            $scope.projectID = '';
            $scope.enabled = '';
        }
        var dataPost = $scope.prepareData();   
        $http.post(urlUsing, JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                    $scope.resetData();           
                    $scope.GetListProjectBy();
                }
                $scope.msg = result.message;
                $scope.typeMsg(result.error === 0);
            }, function(response) {
                var result = response.data;
                $scope.msg = result.message;
                $scope.typeMsg(false);
            });
    };
    
    $scope.RemoveProject = function() {
        if($scope.projectID.length === 0) {  
            $scope.msg = '<b>Must</b> select one of projects in list';   
            $scope.typeMsg(false);
            return;
        } 
        var process = {
            remove: function () {
                $scope.enabled = 0;
                var dataPost = $scope.prepareData();   
                $http.post($scope.baseUrl + '/delete-project', JSON.stringify(dataPost)).then(
                    function(response) {
                        var result = response.data;
                        if(result.error === 0) {
                            $scope.resetData();         
                            $scope.GetListProjectBy();
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
        confirmRemove('PROJECT', process);
    };
    
    $scope.GPId = '';
    $scope.GPName = '';
    $scope.GRChange = function() {
        $scope.GPName = $scope.GPId.length === 0 ? '' : $("#GPForm :selected").text();
    };
    $scope.SaveGroupProject = function() {
        if($scope.GPName.length === 0) {
            $scope.msg = '<b>Group Name</b> must have <br>';   
            $scope.typeMsg(false, 30000);
            return;
        } 
        var urlUsing = $scope.baseUrl + '/create-group-project';
        if($scope.GPId.length > 0) {
            urlUsing = $scope.baseUrl + '/update-group-project';
        } 
        var dataPost = {
            groupID: $scope.GPId,
            groupNAme: $scope.GPName
        };
        $http.post(urlUsing, JSON.stringify(dataPost)).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                    $('#GPForm').prop('selectedIndex', 0);
                    $scope.GPId = '';
                    $scope.GPName = '';
                    $scope.GetProjectGroup();
                }
                $scope.msg = result.message;
                $scope.typeMsg(result.error === 0);
            }, function(response) {
                var result = response.data;
                $scope.msg = result.message;
                $scope.typeMsg(false);
            });
    };
    
    $scope.RemoveGroupProject = function() {
        if($scope.GPId.length === 0) {  
            $scope.msg = '<b>Must</b> select one of groups in list';   
            $scope.typeMsg(false);
            return;
        } 
        var process = {
            remove: function () {
                var dataPost = {
                    groupID: $scope.GPId,
                    groupNAme: $scope.GPName
                };
                $http.post($scope.baseUrl + '/delete-group-project', JSON.stringify(dataPost)).then(
                    function(response) {
                        var result = response.data;
                        if(result.error === 0) {
                            $('#GPForm').prop('selectedIndex', 0);
                            $scope.GPId = '';
                            $scope.GPName = '';
                            $scope.GetProjectGroup();
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
        confirmRemove('GROUP PROJECT', process);
    };
}]);

function validationFrm(frm) {
    var msg = '';
    if(frm.projectName.$error.required) {
        msg += '<b>Project Name</b> must have <br>';
    }
    if(frm.projectCode.$error.required) {
        msg += '<b>Project Code</b> must have <br>';
    }
    if(frm.projectStatus.$error.required) {
        msg += '<b>Project Status</b> must have <br>';
    }
    
    return msg;
};