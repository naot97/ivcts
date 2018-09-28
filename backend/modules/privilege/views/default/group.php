<h4 class="m-b-20"><b>GROUP PRIVILEGE</b></h4>
<div>
    <div class="form-group">
        <label>Group</label>
        <select id="GPForm" class="form-control" ng-change="GRChange()" ng-model="GPId" >
            <option value="">---[Add more]---</option>
            <option ng-repeat="gr in listGroup" value="{{gr.groupId}}">{{gr.name}}</option>
        </select>
    </div>
    <div class="form-group p-t-20">
        <label>Group Name</label>
        <input type="text" class="form-control"  ng-model="GPName"> 
    </div>
    <div class="p-t-20">
    <button ng-click="SaveGroup()" class="btn btn-success"> <i class="fa fa-check"></i>Save</button>
    <button ng-click="RemoveGroup()" class="btn btn-warning"> <i class="fa fa-recycle"></i> Remove</button>
    </div>
</div>
