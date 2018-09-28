<div class="form-body" ng-form="frmProjectSaleplan">
    <h4 class="card-header text-white">Project Sale Plan Info</h4>
    
    <div class="row p-t-20">
        <div class="col-md-3">
            <div class="form-group">                    
                <select id="ddlProject" class="form-control " name="project" ng-model="projectID" required="true">   
                    <option value="">---[Project]---</option>
                    <optgroup ng-repeat="gp in lstGroupProject" label="{{gp.groupNAme}}">                        
                        <option ng-repeat="pr in lstProject" ng-if="gp.groupID === pr.groupID" value="{{pr.projectID}}">{{pr.projectName}}</option>
                    </optgroup>
                </select>                             
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="text" class="form-control" ng-model="effort" name="effort" placeholder="Effort" maxlength="9"
                    pattern="^([0-9]{1,6})(\.[0-9]{1,2})?$"
                    required="true"
                    /> 
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <input type="text" class="form-control" ng-model="indexSelected" disabled="true" />
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <input id="cbCopy" type="checkbox" class="css-control-input" name="Copy" ng-model="Copy" disabled="disabled" />
                <span class="css-control-indicator">Copy New ?</span>  
                <div class="mega-dropdown">
                    <a class="text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-camera-retro" style="color: green"></i>
                    </a>
                    <div class="dropdown-menu animated zoomIn" style="width: 400px">
                        <ul class="mega-dropdown-menu">
                            <li>
                                <?php echo $this->render("./copy-data-period"); ?>     
                            </li>
                        </ul>
                    </div>     
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <input type="hidden" ng-model="saleplanID" />
            <div class="form-group offset-3" style="align-content: center">
                <button ng-click="GetListProjectSaleplanBy()" class="btn btn-info"><i class="fa fa-search"></i>Search</button>
                <?php                  
                if ($powerWrite) echo '<button ng-click="SaveProjectSaleplan()" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>                  
                <button ng-click="RemoveProjectSaleplan()" class="btn btn-warning"> <i class="fa fa-recycle"></i> Remove</button>';
                ?>
                <button ng-click="resetData()" class="btn btn-inverse">Reset</button>
            </div>
        </div>
    </div>
    <div class="row p-t-0">
        <div class="col-md-3">
            <div class="form-group">
                <select id="dllSection" class="form-control " name="section" ng-model="sectionID" required="true">
                    <option value="">---[Section]---</option>
                    <option ng-repeat="s in lstSection" value="{{s.sectionID}}">{{s.sectionName}}</option>
                </select> 
            </div>
        </div>
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
                <select id="ddlRank" class="form-control " name="rank" ng-model="rankID" required="true">
                    <option value="">---[Rank]---</option>
                    <option ng-repeat="r in lstRank" value="{{r.rankID}}">{{r.rankName}}</option>
                </select> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select id="ddlType" class="form-control " name="type" ng-model="typeID" required="true">
                    <option value="">---[Type]---</option>
                    <option ng-repeat="t in lstType" value="{{t.typeID}}">{{t.typeName}}</option>
                </select> 
            </div>
        </div>
    </div>
</div>