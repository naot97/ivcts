
myAngular.controller('periodController', ['$scope', '$http', 'DTOptionsBuilder', 'httpGetSection', 'httpGetEmployee', 'httpGetPeriod', 'httpGetRank', 'httpGetType', 'httpGetProject', 
                                    function($scope, $http, DTOptionsBuilder, httpGetSection, httpGetEmployee, httpGetPeriod, httpGetRank, httpGetType, httpGetProject){

    $scope.rootUrl = '';
    $scope.baseUrl = '';
    $scope.titleSpendTime = '';
    $scope.indexSelected = '#';
    $scope.spendTimeID = '';
    $scope.sectionID = '';
    $scope.employeeID = '';
    $scope.workingHour = 0;
    $scope.projectID = '';
    $scope.periodID = '';
    $scope.rankID = [];
    $scope.typeID = '';
    $scope.effort = '';
    $scope.ot = '';
    $scope.enabled = '';
    $scope.sumEffort = {};
    $scope.Copy = false;
    $scope.historyTitle = '';
    //
    $scope.dtOptions = {
        fixedHeader: true
    }
    
    $scope.borderLeft = 'border-left:2px solid black;';
    $scope.resetData = function() {    
        $scope.indexSelected = '#';
        $scope.spendTimeID = '';
        $('#dllSection').prop('selectedIndex', 0);
        $scope.sectionID = '';
        $('#dllEmployee').prop('selectedIndex', 0);
        $scope.employeeID = '';
        $('#ddlPeriod').prop('selectedIndex', 0);
        $scope.periodID = '';
        $('#dllProject').prop('selectedIndex', 0);
        $scope.projectID = '';
        $('#ddlRank').prop('selectedIndex', 0);
        $scope.rankID = [];
        $('#ddlType').prop('selectedIndex', 0);
        $scope.typeID = '';
        $scope.getData();
    };
    $scope.chooseRank = function(){
        var rank =  $('#ddlRank').val();
        switch(rank){
            case '-1':
                $scope.rankID = [1,3];
                break;
            case '0' :
                $scope.rankID = [2,4,5];
                break;
            case '':
                $scope.rankID = rank;
                break;
            default :
                $scope.rankID = [rank];
                break;
        }
    }
    $scope.prepareData = function() {
        $scope.projectID =  $('#dllProject').val();
        //$scope.employeeID =  $('#dllEmployee').val();
        $scope.sectionID =  $('#dllSection').val();
        $scope.periodID =  $('#ddlPeriod').val();
        var p = $scope.lstPeriod.find(function(ele) {
                        return ele.periodID.toString() === $scope.periodID.toString();
        });
        $scope.workingHour = p ? p.workingHour : 0;
        $scope.chooseRank();
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
    
    $scope.lstSectionInfo = [];
    $scope.lstSection = [];
    $scope.lstEmployee = [];
    $scope.lstProjectInfo = [];
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
    $scope.GetProjectInfo = function(){
        httpGetProject.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                $scope.lstProjectInfo = result.project;
            }
        });    
    }
    $scope.GetSectionInfo = function(){
        httpGetSection.getData($scope.rootUrl).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                $scope.lstSectionInfo = result.section;
            }
        });
    }
    $scope.getData = function(){
        $scope.GetEmployee();
        $scope.GetSectionInfo();// trong nay co ca GetEmployee
        $scope.GetProjectInfo();
        $scope.GetPeriod();
        $scope.GetRank();
        $scope.GetType();
    }
    $scope.init = function(url) {
        $scope.rootUrl = url;
        $scope.baseUrl = $scope.rootUrl + '/report/period';  
       $('#table').hide();
        $scope.getData();
    };
    
    $scope.GetSection = function() {
       var dataPost = $scope.prepareData();
       var url = '/get-section';
       $scope.postMethod(3,dataPost,url,'');
    };
    $scope.sectionJson = {};
    $scope.createSectionJson = function(){
        for (var i = $scope.lstSectionInfo.length - 1; i >= 0; i--) {
            var sectionID = $scope.lstSectionInfo[i].sectionID;
            $scope.sectionJson[sectionID] = {};
            $scope.sectionJson[sectionID].list = [];
        }
        for (var  i = 0; i <= $scope.lstEmployee.length - 1; i++) {
            var employee = $scope.lstEmployee[i];
            //if ($scope.sectionJson[employee.sectionID] != undefined)
                $scope.sectionJson[employee.sectionID].list.push(employee);
        }

        console.log($scope.sectionJson);
    }
    $scope.GetEmployee = function(section = '') {
        httpGetEmployee.getData($scope.rootUrl, section).then(function(data) {
            var result = data;
            if(result.error === 1) {
                $scope.msg = result.message;
                $scope.typeMsg(false);
            } else {
                $scope.lstEmployee = result.employee;
                console.log(result.employee);
            }
        });   
    };
    $scope.getMethod = function(x,url){
            var rightUrl = $scope.baseUrl + url;
            $http.get(rightUrl).then(
            function(response) {
                var result = response.data;
                if(result.error === 0) {
                    switch(x){
                        case(1) :
                            $scope.lstProject = result.lstProject;
                            break;
                        default:
                            break;
                    }
                }
            }, function(response) {
                console.log(response.data.message);
            });
        }
    $(document).ready(function() {
  $('tbody').scroll(function(e) { //detect a scroll event on the tbody
    $('thead').css("left", -$("tbody").scrollLeft()); //fix the thead relative to the body scrolling
    $('thead th:nth-child(1)').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
    $('tbody td:nth-child(1)').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
  });
});
    $scope.postMethod = function(kind,dataPost,subUrl,message){
            $http.post($scope.baseUrl + subUrl, JSON.stringify(dataPost)).then(function(response){
                var result = response.data;
                if (result.error == 0){
                    switch (kind){
                        case 1 :
                            $scope.lstProject = result.lstProject;
                            break;
                        case 2 : 
                            $scope.lstSpendTime = result.lstSpendTime;
                            console.log(result.lstSpendTime);
                            $('#table').show();
                            $scope.createSpendTimeJson();
                            break;
                        case 3 :
                            $scope.lstSection = result.section;
                            console.log(result.section);
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
    $scope.GetProject = function() {
        var dataPost = $scope.prepareData();
        $scope.postMethod(1,dataPost,'/get-project','');
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
    $scope.separateProject = function(index){
        return index % 4 == 0 ? $scope.borderLeft : ' ';
    }
    $scope.getStyle = function(employeeID,colIndex,jsonIndex){
        var strBorder = (colIndex % 4 == 0) ? $scope.borderLeft : '';
        try{
            if ($scope.sumEffort[employeeID] == 0)
                return strBorder + 'background-color:#32CD32;';
            var projectID = $scope.lstProject[parseInt(colIndex / 4)].projectID;
            var i = $scope.spendTimeJson[employeeID][projectID][jsonIndex];
            var spendTime = $scope.lstSpendTime[i];
            var strBgType ='';
            var strBgRank ='';
            if (spendTime.typeID == 2)
                strBgType = 'background-color:#FF8C00;';
            switch(spendTime.rankID){
                case 2 :
                    strBgRank = 'background-color:DarkTurquoise;';
                    break;
                case 4 :
                    strBgRank = 'background-color:#7FFFD4;';
                    break;
                case 5 :
                    strBgRank ='background-color:#9ACD32;';
                    break;
                default : 
                    break;
            }                
            return strBorder + ((colIndex % 4 == 2) ? strBgRank + strBgType : strBgType + strBgRank);
        }
        catch(ex){
            return strBorder;
        }  
    }
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
                    var section  = $scope.lstSection.find(function(ele) {
                        return ele.sectionID.toString() === val.toString();
                    });
                    name = section != null ? section.sectionName : '';
                    break;
                case 'e':
                    var employee = $scope.lstEmployee.find(function(ele) {
                        return ele.employeeID.toString() === val.toString();
                    });
                    name = employee != null ? employee.employeeName : '';
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

                    name = data ? data.year + '/' + data.month + ': ' + data.workingHour + 'h' : '';
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
    $scope.spendTimeJson = {};
    $scope.sumEmployee = 0;
    $scope.sumNumAvail = 0;
    $scope.sumNumFairlyAvail = 0;
    $scope.sumEffortOfAll = 0;
    $scope.createSpendTimeJson = function(){
        //employee vs project
       for (var i = $scope.lstEmployee.length - 1; i >= 0; i--) {
            $scope.spendTimeJson[$scope.lstEmployee[i].employeeID]= {};
            $scope.spendTimeJson[$scope.lstEmployee[i].employeeID].maxL = 1;
            $scope.sumEffort[$scope.lstEmployee[i].employeeID]= 0;
        }
        for (var i = $scope.lstSpendTime.length - 1; i >= 0; i--) {
            var employeeID = $scope.lstSpendTime[i].employeeID;
            var projectID = $scope.lstSpendTime[i].projectID;
            console.log($scope.spendTimeJson[employeeID][projectID]);
            if ($scope.spendTimeJson[employeeID][projectID] == undefined)
                $scope.spendTimeJson[employeeID][projectID] = [i];
            else 
                $scope.spendTimeJson[employeeID][projectID].push(i);
            $scope.spendTimeJson[employeeID].maxL 
                = Math.max($scope.spendTimeJson[employeeID].maxL,
                    $scope.spendTimeJson[employeeID][projectID].length);
            
            $scope.sumEffort[employeeID] += 
            parseFloat($scope.lstSpendTime[i].effort);
            
        }
        // section vs employee
        $scope.createSectionJson();
        for (var i = $scope.lstSection.length - 1; i >= 0; i--) {
            var sectionID = $scope.lstSection[i].sectionID;
            $scope.sectionJson[sectionID].numAvail = 0;
            $scope.sectionJson[sectionID].numFairlyAvail = 0;
        }

        for (var i = $scope.lstEmployee.length - 1; i >= 0; i--) {
            var e = $scope.lstEmployee[i];
            if ($scope.sumEffort[e.employeeID] == 0)
                $scope.sectionJson[e.sectionID].numAvail ++;
            else {
                var avail = ($scope.workingHour -$scope.sumEffort[e.employeeID] ) / $scope.workingHour; 
                if ( avail < 1 && avail >= 0.5 )
                  $scope.sectionJson[e.sectionID].numFairlyAvail ++;  
            }         
        }
        //tong ket
        $scope.sumEmployee = 0;
        $scope.sumNumAvail = 0;
        $scope.sumNumFairlyAvail = 0;
        $scope.sumEffortOfAll = 0;
        for (var i = $scope.lstSection.length - 1; i >= 0; i--) {
            var sectionID = $scope.lstSection[i].sectionID;
            $scope.sumEmployee += $scope.sectionJson[sectionID].list.length;
            $scope.sumNumAvail += $scope.sectionJson[sectionID].numAvail;
            $scope.sumNumFairlyAvail += $scope.sectionJson[sectionID].numFairlyAvail;
        }
        for (var i = $scope.lstEmployee.length - 1; i >= 0; i--) {
            $scope.sumEffortOfAll += $scope.sumEffort[$scope.lstEmployee[i].employeeID];
        }
    };  
    $scope.GetListSpendTimeBy = function() {

        var dataPost = $scope.prepareData();
        console.log($scope.periodID);
        if ($scope.periodID.length === 0 ){
            $scope.msg = '<b>Period</b> must have <br>';
            $scope.typeMsg(false);
            return;
        }
        $scope.GetSection();
        $scope.GetProject();
        $scope.postMethod(2,dataPost,'/get-spend-time-by','');
        
    };
     $scope.getValueToColumn = function(employeeID,colIndex,jsonIndex){
        try{
            var projectID = $scope.lstProject[parseInt(colIndex / 4)].projectID;
            var i = $scope.spendTimeJson[employeeID][projectID][jsonIndex];
           // console.log($scope.spendTimeJson);
            if (i === undefined) return '';
            switch(colIndex % 4){
                case 0 :
                   return $scope.lstSpendTime[i].effort;
                case 1 :
                    return $scope.GetNameElement($scope.lstSpendTime[i].rankID,'r');
                case 2 :
                    return $scope.GetNameElement($scope.lstSpendTime[i].typeID,'t');
                case 3 : 
                    return $scope.lstSpendTime[i].ot; 
                default : 
                    return '';
            }}
        catch(err){
            return '';
        }
    };
    
}]);

