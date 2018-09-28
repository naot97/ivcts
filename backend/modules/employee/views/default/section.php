<h4 class="m-b-20"><b>SECTION</b></h4>
<div>
	<div class="form-group">
        <label>Section</label>
        <select id="editSection" class="form-control" ng-change="editSectionChange()" ng-model="editSectionId" >
            <option value="">---[Add more]---</option>
            <option ng-repeat="section in sectionList" value="{{section.sectionID}}">{{section.sectionName}}</option>
        </select>
    </div>
	<div class="form-group p-t-20">
        <label>Section Name</label>
		<input type="text" name="" ng-model='editSectionName' class="form-control" >
	</div>
    <div class="p-t-20">
    	<button ng-click="saveSection()" class="btn btn-success"> <i class="fa fa-check"></i>Save</button>
        <button ng-click="removeSection()" class="btn btn-warning"> <i class="fa fa-recycle"></i> Remove</button>
    </div>
</div>
