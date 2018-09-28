<h4 class="m-b-20"><b>History of {{historyTitle}}</b></h4>
<div>
    <table id="tblProject" datatable="ng" dt-options="dtOptionsLogs" class="display nowrap table table-hover table-bordered" cellspacing="0" width="100%">
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
                <th>Update By</th>        
                <th>Update Time</th>        
                <th>Action</th>        
                <th>Note</th>        
            </tr>
        </thead>
        <tbody >         
            <tr ng-repeat="prj in lstLogs">              
                <td class="index" style=" vertical-align: middle; text-align: center">
                    {{$index + 1}}
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
                    {{prj.redmineID}} - {{prj.redmineURL}}
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
                <td>
                    {{prj.updateBy}}
                </td>                    
                <td>
                    {{GetNameElement(prj.updateTime, 'dt')}}
                </td>                    
                <td>
                    {{prj.action}}
                </td>                    
                <td>
                    {{prj.note}}
                </td>                   
            </tr>
        </tbody>
    </table>
    <button onclick="$('#tagHistory').hide()" class="btn btn-warning"> <i class="fa fa-close"></i> Close</button>
</div>