<style type="text/css">
    .radio, .radio + a:hover{
        cursor: pointer;
    }
</style>
<div class="form-body" ng-form="employeeForm">
	<h4 class="card-header text-white">Employee Info</h4>
	<div class="row ">
        <div class="col-md-3">
            <div class="form-group">
                <label>Index</label>
                <input id='index' type="text" ng-model="seclectedIndex" class="form-control" disabled="true" />
            </div>
        </div>
        <div class="col-md-3" >
                <div class="form-group">
                    <label class="control-label">Employee Name</label>
                    <input type="text" class="form-control" name="name" 
                        maxlength="255"
                        required="true"
                        ng-model="employeeName" 
                        /> 
                </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Employee Code</label>
                <input type="text" class="form-control" name="code" 
                    maxlength="255"
                    required="true"
                    ng-model="employeeCode" 
                    /> 
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label>Level</label>
                <div class="input-group">
                    <select name='level' class='form-control' id ='level'>
                        <option value="">---[Level]---</option>
                        <option value="{{level.levelID}}" ng-repeat="level in levelList">{{level.levelName}}</option>
                     </select>  
                     <div >
                         <div class="mega-dropdown">
                            <a class="nav-link text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-edit" style="color: green"></i>
                            </a>
                            <div class="dropdown-menu animated zoomIn">
                                <?= $this->render('level') ?>
                            </div>
                        </div>  
                     </div> 
                </div>
            </div>
        </div>
    </div>
		<div class="row">
        <div class="col-md-3" >
            <div class="form-group">
                <label>Section</label>
                <div class="input-group">
                    <select name='section'  class='form-control' id ='section'>
                        <option value="">---[Section]---</option>
                        <option value="{{section.sectionID}}" ng-repeat="section in sectionList">{{section.sectionName}}</option>
                    </select>
                    <div >
                        <div class="mega-dropdown">
                            <a class="nav-link text-muted" href="#" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-edit right" style="color: green"></i>
                            </a>
                            <div class="dropdown-menu animated zoomIn"  >
                                <?= $this->render("section") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label>Rank</label>
                <select name='rank' class='form-control' id ='rank'>
                    <option value="">---[Rank]---</option>
                    <option value="{{rank.rankID}}" ng-repeat="rank in rankList">{{rank.rankName}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Supervisor Id</label>
                <input type="text" class="form-control" name="supervisorId" 
                    maxlength="255"
                    required="false"
                    ng-model="supervisorId" 
                    /> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Marital Status</label>
                <div>
                 <input type="radio" name="marital" class="radio" value="1" > <a onclick="$('input[name=\'marital\'][value=\'1\']').prop('checked', !$('input[name=\'marital\'][value=\'1\']').is(':checked'))">Yes </a>
                 <input type="radio" class="radio" name="marital" value="0" ><a onclick="$('input[name=\'marital\'][value=\'0\']').prop('checked', !$('input[name=\'marital\'][value=\'0\']').is(':checked'))">No </a>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
		
		<div class="col-md-3">
            <div class="form-group">
                <label class="control-label">BirthDate</label>
                <input id="birthDate" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="datepicker form-control" name="birthDate"
                    readonly="true" style="cursor: pointer; background-color: #fff"
                    />
            </div>
        </div>
		<div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Start Date</label>
                <input id="startDate" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="datepicker form-control" name="startDate"
                    readonly="true" style="cursor: pointer; background-color: #fff"
                    />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">End Date</label>
                <input id="endDate" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="datepicker form-control" name="endDate	"
                    readonly="true" style="cursor: pointer; background-color: #fff"
                    />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Telephone</label>
                <input type="text" class="form-control" name="telephone" 
                    maxlength="20"
                    required="false"
                    ng-model="telephone"    
                    /> 
            </div>
        </div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Mobile</label>
                <input type="text" class="form-control" name="mobile" 
                    maxlength="20"
                    required="false"
                    ng-model="mobile"	
                    /> 
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Email</label>
                <input type="text" class="form-control" name="email"
                	id ='email' 
                    maxlength="255"
                    required="false"
                    ng-model="email"	
                    /> 
			</div>
		</div>
		<div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Registed Address</label>
                <input type="text" class="form-control" name="registedAddress" 
                    maxlength="255"
                    required="false"
                    ng-model="registedAddress"  
                    /> 
            </div>
        </div>

	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Current Address</label>
                <input type="text" class="form-control" name="currentAddress" 
                    maxlength="255"
                    required="false"
                    ng-model="currentAddress"	
                    /> 
			</div>
		</div>
        <div class="col-md-6  p-t-20" >
        <div class="form-group pull-right" >
                <div class="d-inline-block">
                    <div class="mega-dropdown ">
                         <button ng-click="account()" class="btn btn-danger
" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>Account</button>
                        <div class="dropdown-menu animated zoomIn">
                            <ul class="mega-dropdown-menu">
                                <li>
                                     <?php echo $this->render('account'); ?>
                                </li>
                            </ul>
                        </div>     
                    </div>
                </div>
                <button ng-click="getEmployeeListBy()" class="btn btn-info"><i class="fa fa-search"></i>Search</button>
                <button ng-click="saveEmployee()" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                <button ng-click="removeEmployee()" class="btn btn-warning"> <i class="fa fa-recycle"></i> Remove</button>
                <button ng-click="resetEmployee()" class="btn btn-primary"> <i class ="fa fa-refresh"> </i>Reset </button>
                
                
            </div>
    </div>
	</div>  
</div>
