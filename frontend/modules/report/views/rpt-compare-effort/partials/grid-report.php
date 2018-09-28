<style type="text/css">
    #tblReport tr th {
        text-align: center;
        font-weight: bold;
        background-color: rgba(0,0,0,.05);;
    }
    #tblReport tbody tr td {
        text-align: left;
        color: black;
    }
    #tblReport tbody tr td a {
        color: #007ee5;
    }
    .display-none {
        display: none;
    }
    .tblHead {
        line-height: 30px;
        font-size: 21px;
    }
    .tblGR {
      line-height: 22px;
      font-size: 18px;
    }
    .tblPR {
      line-height: 18px;
      font-size: 16px;
      font-weight: 400;
    }
    .tblRT {
      line-height: 16px;
      font-size: 14px;
      font-weight: 400;
    }
</style>

<div class="table-responsive p-t-10">
    <h4 class="card-header text-white">Report Compare Effort</h4>
    <br>
    <table id="tblReport" class="display nowrap table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr class="tblHead">
                <th>#</th>
                <th></th>
                <th>Product Manager</th>
                <th>Project Manager</th>     
                <th>Employee</th>                        
            </tr>
            <tr class="tblGR">
                <th></th>
                <th colspan="4" style="text-align: left">Group Project</th>                    
            </tr>
        </thead>
        <tbody>     
            <tr ng-repeat-start="rptGR in rptGroupProject()" ng-if="1" class="GR tblGR" style="background-color: #99ffcc;">
                <td>{{$index+1}}</td>
                <td>
                    <a class="showmore" href="#" onclick="onClickShowMore(this, 'GR', 'PR')">
                        {{GetNameElement(rptGR.groupID, 'gr')}}
                    </a>
                </td>
                <td>{{rptSumEffort(rptGR.groupID, 'SDC')}}</td>
                <td>{{rptSumEffort(rptGR.groupID, 'PM')}}</td>
                <td>{{rptSumEffort(rptGR.groupID, 'EMP')}}</td>
            </tr>
            
            <tr class="PR tblPR display-none">
                <th></th>
                <th colspan="4" style="text-align: left">Project Name</th>                    
            </tr>
            <tr ng-repeat-start="rptPr in rptProject(rptGR.groupID)" ng-if="2" class="PR tblPR display-none" style="background-color: #7cdfe4;">   
                <td>{{$parent.$parent.$index+1}}.{{$index+1}}</td>
                <td>
                    <a class="showmore" href="#" onclick="onClickShowMore(this, 'PR', 'RT')">
                        {{GetNameElement(rptPr.projectID, 'pr')}}
                    </a>
                </td>
                <td>{{rptSumEffort(rptGR.groupID, 'SDC', rptPr.projectID)}}</td>
                <td>{{rptSumEffort(rptGR.groupID, 'PM', rptPr.projectID)}}</td>
                <td>{{rptSumEffort(rptGR.groupID, 'EMP', rptPr.projectID)}}</td>
            </tr>
            
            <tr class="RT tblRT display-none">
                <th></th>
                <th colspan="4" style="text-align: left">{{getNameRankOrType()}}</th>
            </tr>
            <tr ng-repeat="t in lstType" ng-if="getNameRankOrType() === 'Type'" class="RT tblRT display-none">
                <td>{{$parent.$parent.$parent.$index+1}}.{{$parent.$parent.$index+1}}.{{$index+1}}</td>
                <td>{{t.typeName}}</td>
                <td>{{rptSumEffort(rptGR.groupID, 'SDC', rptPr.projectID, t.typeID)}}</td>
                <td>{{rptSumEffort(rptGR.groupID, 'PM', rptPr.projectID, t.typeID)}}</td>
                <td>{{rptSumEffort(rptGR.groupID, 'EMP', rptPr.projectID, t.typeID)}}</td>
            </tr>
            <tr ng-repeat="r in lstRank" ng-if="getNameRankOrType() === 'Rank'" class="RT tblRT display-none">
                <td>{{$parent.$parent.$parent.$index+1}}.{{$parent.$parent.$index+1}}.{{$index+1}}</td>
                <td>{{r.rankName}}</td>
                <td>{{rptSumEffort(rptGR.groupID, 'SDC', rptPr.projectID, r.rankID)}}</td>
                <td>{{rptSumEffort(rptGR.groupID, 'PM', rptPr.projectID, r.rankID)}}</td>
                <td>{{rptSumEffort(rptGR.groupID, 'EMP', rptPr.projectID, r.rankID)}}</td>
            </tr>            
            
            <tr ng-repeat-end="" ng-if="2" style="display: none;"></tr>
            <tr ng-repeat-end="" ng-if="1" style="display: none;"></tr>
        </tbody>
    </table>
</div>