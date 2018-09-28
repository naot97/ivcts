<h4 class="m-b-20"><b>COPY DATA FOR NEW PERIOD</b></h4>
<div>
    <div class="form-group">
        <select id="ddlCpProject" class="form-control" ng-model="CpProject">
            <option value="">---[Copy from Project]---</option>
            <optgroup ng-repeat="gp in lstGroupProject" label="{{gp.groupNAme}}">                        
                <option ng-repeat="pr in lstProject" ng-if="gp.groupID === pr.groupID" value="{{pr.projectID}}">{{pr.projectName}}</option>
            </optgroup>
        </select>
    </div>
    <div class="form-group">
        <select id="ddlCpOldPeriod" class="form-control" ng-model="CpOldPeriod">
            <option value="">---[Old Period]---</option>
            <option ng-repeat="p in lstPeriod" value="{{p.periodID}}">{{GetNameElement(p.periodID, 'p')}}</option>
        </select>
    </div>
    <div class="form-group">
        <select id="ddlCpNewPeriod" class="form-control" ng-model="CpNewPeriod">
            <option value="">---[New Period]---</option>
            <option ng-repeat="p in lstPeriod" value="{{p.periodID}}">{{GetNameElement(p.periodID, 'p')}}</option>
        </select>
    </div>
    <button ng-click="CopyNewPeriod()" class="btn btn-success"> <i class="fa fa-check"></i>Copy New Period</button>
</div>