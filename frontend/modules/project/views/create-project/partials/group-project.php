<h4 class="m-b-20"><b>GROUP PROJECT</b></h4>
<div>
    <div class="form-group">
        <select id="GPForm" class="form-control" ng-change="GRChange()" ng-model="GPId" >
            <option value="">---[Add more]---</option>
            <option ng-repeat="gr in projectGroup" value="{{gr.groupID}}">{{gr.groupNAme}}</option>
        </select>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Group Name" ng-model="GPName"> 
    </div>
    <button ng-click="SaveGroupProject()" class="btn btn-success"> <i class="fa fa-check"></i>Save</button>
    <button ng-click="RemoveGroupProject()" class="btn btn-warning"> <i class="fa fa-recycle"></i> Remove</button>
</div>