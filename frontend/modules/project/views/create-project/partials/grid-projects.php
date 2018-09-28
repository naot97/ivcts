<style type="text/css">
    #tblProject thead tr th {
        text-align: center;
        font-weight: bold;
    }
    #tblProject tbody tr {
        cursor: pointer;
    }
    #tblProject tbody tr td {
        text-align: left;
    }
    #tblProject tbody tr td a{
        color: #4680ff;
    }
</style>

<div class="table-responsive">
    <h4 class="card-header text-white">Project List</h4>
    
    <table id="tblProject" datatable="ng" dt-options="dtOptions" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Group</th>      
                <th>Project</th>
                <th>Status</th>
                <th>OT</th>
                <th>Redmine</th>
                <th>IVIS</th>
                <th>SDC</th>
                <th>End Date</th>                   
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="prj in lstProject" ng-dblclick="rowSelected($index)">
                <td class="index" style="vertical-align: middle; text-align: center" onclick="$('#tagHistory').show();$('#tagHistory').dropdown('toggle')" ng-click="GetLogs($index)">
                    <a href="#">{{$index + 1}}<a/>
                </td>
                <td>
                    {{GetNameElement(prj.groupId, 'gp')}}
                </td>
                <td>
                    {{prj.projectCode}} - {{prj.projectName}}
                </td>
                <td>
                    {{GetNameElement(prj.projectStatus, 'ps')}}
                </td>
                <td>
                    {{GetNameElement(prj.OTStatus, 'ot')}}
                </td>
                <td>
                    {{prj.redmineID}} - <a target="_blank" href="{{prj.redmineURL}}">{{prj.redmineURL}}</a>
                </td>
                <td>
                    {{prj.ivisID}}
                </td>
                
                <td>
                    {{prj.sdcCode}}
                </td>
                <td>
                    {{GetNameElement(prj.endDate, 'd')}}
                </td>
            </tr>
        </tbody>
    </table>
</div>