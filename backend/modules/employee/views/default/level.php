<h4 class="m-b-20"><b>LEVEL</b></h4>
<div>
	<div class="form-group">
        <label>Level</label>
        <select id="GPForm" class="form-control" ng-change="GRChange()" ng-model="GPId" >
            <option value="">---[Add more]---</option>
            <option ng-repeat="level in levelList" value="{{level.levelID}}">{{level.levelName}}</option>
        </select>
    </div>
	<div class="form-group p-t-20">
        <label>Level Name</label>
		<input type="text" name="" class="form-control">
	</div>
    <div class="p-t-20">
    	<button ng-click="SaveGroup()" class="btn btn-success"> <i class="fa fa-check"></i>Save</button>
        <button ng-click="RemoveGroup()" class="btn btn-warning"> <i class="fa fa-recycle"></i> Remove</button>
    </div>
</div>

