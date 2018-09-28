<div class="form-body" ng-form="frmProjectSaleplan">
    <h4 class="card-header text-white">Searching Info</h4>
    
    <div class="row p-t-20">
        <div class="col-md-3">
            <div class="form-group">              
                <label class="control-label">Group Project</label>   
                <select id="group" class="form-control " name="group" ng-model="groupID">
                    <option value="-1">---[ALL]---</option>
                    <option ng-repeat="gr in lstGroupProject" value="{{gr.groupID}}">{{gr.groupNAme}}</option>
                </select>                            
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Period</label>   
                <select id="ddlPeriod" class="form-control " name="period" ng-model="periodID"
                        ng-options="p.periodID as GetNameElement(p.periodID, 'p') for p in lstPeriod">
                </select> 
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Group By</label>   
                <select id="ddlGroupBy" class="form-control " name="groupBy" ng-model="GroupBy">
                    <option value="1">Type</option>
                    <option value="2">Rank</option>
                </select> 
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group offset-3 p-t-20 p-l-0">
                <button ng-click="ExportReport()" class="btn btn-primary"><i class="fa fa-arrow-right"></i>Export Report</button>
            </div>
        </div>
    </div>
</div>