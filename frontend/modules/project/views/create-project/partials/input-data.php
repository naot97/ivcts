
<div class="form-body " ng-form="frmProject">
    <h4 class="card-header text-white">Project Info</h4>
    
    <div class="row p-t-20">
        <div class="col-md-3">
            <div class="form-group">
                <div class="row">
                    <div class="input-group">
                        <select id="group" class="form-control" name="group" ng-model="groupID">
                            <option value="">---[Group Project]---</option>
                            <option ng-repeat="gr in projectGroup" value="{{gr.groupID}}">{{gr.groupNAme}}</option>
                        </select>            
                        <?php
                        if ($powerWrite) echo '<div class=""> 
                            <div class="mega-dropdown">
                                <a class="nav-link text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-edit" style="color: green"></i>
                                </a>
                                <div class="dropdown-menu animated zoomIn">
                                    <ul class="mega-dropdown-menu">
                                        <li>
                                            <?php echo $this->render("group-project"); ?>
                                        </li>
                                    </ul>
                                </div>     
                            </div>
                        </div>';
                        ?>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select id="projectStatus" class="form-control" name="projectStatus" ng-model="projectStatus" required="true">
                    <option value="">---[Project Status]---</option>
                    <option ng-repeat="item in lstProjectStatus" value="{{item.value}}">{{item.description}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <input type="text" class="form-control" ng-model="indexSelected" disabled="true" />
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <input id="cbCopy" type="checkbox" class="css-control-input" name="Copy" ng-model="Copy" disabled="disabled">
                    <span class="css-control-indicator"></span> Copy New ?
            </div>
        </div>
        <div class="col-md-4">
            <input type="hidden" ng-model="projectID" />
            <div class="form-group offset-3" style="align-content: center">
                <button ng-click="GetListProjectBy()" class="btn btn-info"><i class="fa fa-search"></i>Search</button>
                <?php
                    if ($powerWrite) echo '<button ng-click="SaveProject()" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                <button ng-click="RemoveProject()" class="btn btn-warning"> <i class="fa fa-recycle"></i> Remove</button>'
                ?>
                

                <button ng-click="resetData()" class="btn btn-inverse">Reset</button>
            </div>
        </div>
    </div>
    <div class="row p-t-0">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Project Name</label>
                <input type="text" class="form-control" ng-model="projectName" name="projectName" 
                    maxlength="255"
                    required="true"
                    /> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Project Code</label>
                <input type="text" class="form-control" ng-model="projectCode" name="projectCode" 
                    maxlength="10"
                    required="true"
                    />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">SDC Code</label>
                <input type="text" class="form-control" ng-model="SDCCode" name="SDCCode"
                    maxlength="45"
                    />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">End Date</label>
                <input id="EndDate" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="datepicker form-control" name="EndDate"
                    readonly="true" style="cursor: pointer; background-color: #fff"
                    />
            </div>
        </div>
    </div>
    
    <div class="row p-t-0">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Redmine URL</label>
                <input type="url" class="form-control" ng-model="RedmineURL" name="RedmineURL"
                    maxlength="512"
                    />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Redmine ID</label>
                <input type="text" class="form-control" ng-model="RedmineID" name="RedmineID"
                    maxlength="50"
                    />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">IVIS ID</label>
                <input type="text" class="form-control" ng-model="IvisID" name="IvisID"
                    maxlength="50"
                    />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">OT Status</label><br>
                <input type="checkbox" class="css-control-input" name="OTStatus" ng-model="OTStatus" value="1">
                    <span class="css-control-indicator"></span> YES / NO ?
            </div>
        </div>
    </div>
</div>
