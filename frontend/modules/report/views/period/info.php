<div class="form-body" ng-form="frmSpendTime">
    <h4 class="card-header text-white">Report Info</h4>
    <div class="row p-t-10">
        <div class="col-md-3">
            <div class="form-group">
                <select id="ddlPeriod" class="form-control " name="period" ng-model="periodID" required="true">
                    <option value="">---[Period]---</option>
                    <option ng-repeat="p in lstPeriod" value="{{p.periodID}}">{{GetNameElement(p.periodID, 'p')}}</option>
                </select> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select id="dllSection" class="form-control " name="section" ng-model="sectionID" required="true" >
                    <option value="">---[Section]---</option>
                    <option ng-repeat="s in lstSectionInfo" value="{{s.sectionID}}">{{s.sectionName}}</option>
                </select> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select id="dllProject" class="form-control " name="project" ng-model="projectID" required="true" >
                    <option value="">---[Project]---</option>
                    <option ng-repeat="p in lstProjectInfo" value="{{p.projectID}}">{{p.projectName}}</option>
                </select> 
            </div>
        </div>
         <div class="col-md-3">
            <div class="form-group">
                <select id="ddlRank" class="form-control " name="rank" required="true">
                    <option value="">---[Rank]---</option>
                    <option value="-1">O/A</option>
                    <option value="0">B/C/R</option>
                    <option ng-repeat="r in lstRank" value="{{r.rankID}}">{{r.rankName}}</option>

                </select> 
            </div>
        </div>
    </div>
    
    <div class="row p-t-5">
        
       
        <div class="col-md-3">
            <div class="form-group">
                <select id="ddlType" class="form-control " name="type" ng-model="typeID" required="true">
                    <option value="">---[Type]---</option>
                    <option ng-repeat="t in lstType" value="{{t.typeID}}">{{t.typeName}}</option>
                </select> 
            </div>
        </div>
        <div class="col-md-9 ">
            <input type="hidden" ng-model="spendTimeID" />
            <div class="form-group offset-3 pull-right" style="align-content: center">
                <button  ng-click="GetListSpendTimeBy()" class="btn btn-info"><i class="fa fa-search"></i>Search</button>
                <button onclick="$('#table').hide()" ng-click="resetData()" class="btn btn-inverse">Reset</button>
            </div>
        </div>
    </div>
   
</div>