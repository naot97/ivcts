<h4 class="m-b-20"><b>History of {{historyTitle}}</b></h4>
<div>
    <table id="tblProject" datatable="ng" dt-options="dtOptions" class="display nowrap table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th> 
                <th>Section</th>
                <th>Period</th>
                <th>Rank</th>
                <th>Type</th>
                <th>Effort</th>        
                <th>Update By</th>        
                <th>Update Time</th>        
                <th>Action</th>        
                <th>Note</th>        
            </tr>
        </thead>
        <tbody >         
            <tr ng-repeat="prj in lstLogs">              
                <td class="index" style="vertical-align: middle; text-align: center">
                    {{$index + 1}}
                </td>               
                <td>
                    {{GetNameElement(prj.sectionID, 's')}}
                </td>
                <td>
                    {{GetNameElement(prj.periodID, 'p')}}
                </td>
                <td>
                    {{GetNameElement(prj.rankID, 'r')}}
                </td>
                <td>
                    {{GetNameElement(prj.typeID, 't')}}
                </td>                
                <td>
                    {{prj.effort}}
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