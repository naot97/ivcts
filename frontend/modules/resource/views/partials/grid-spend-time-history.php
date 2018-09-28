<h4 class="m-b-20"><b>History of {{historyTitle}}</b></h4>
<div>
    <table id="tblProject" datatable="ng" dt-options="dtOptions" class="display nowrap table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th> 
                <th>Section</th>
                <th>Employee</th>
                <th>Project</th>   
                <th>Period</th>
                <th>Rank</th>
                <th>Type</th>   
                <th>Effort</th>    
                <th>OT</th>         
                <th>Update By</th>        
                <th>Update Time</th>        
                <th>Action</th>        
                <th>Note</th>        
            </tr>
        </thead>
        <tbody >         
            <tr ng-repeat="st in lstLogs">              
                <td class="index" style=" vertical-align: middle; text-align: center">
                    {{$index + 1}}
                </td>               
                <td>
                    {{GetNameElement(st.sectionID, 's')}}
                </td>  
                <td>
                    {{GetNameElement(st.employeeID, 'e')}}
                </td>  
                <td>
                    {{GetNameElement(st.projectID, 'pr')}}
                </td>
                <td>
                    {{GetNameElement(st.periodID, 'p')}}
                </td>
                <td>
                    {{GetNameElement(st.rankID, 'r')}}
                </td>
                <td>
                    {{GetNameElement(st.typeID, 't')}}
                </td>                
                <td>
                    {{st.effort}}
                </td>                     
                <td>
                    {{st.ot}}
                </td>               
                <td>
                    {{st.updateBy}}
                </td>                    
                <td>
                    {{GetNameElement(st.updateTime, 'dt')}}
                </td>                    
                <td>
                    {{st.action}}
                </td>                    
                <td>
                    {{st.note}}
                </td>                   
            </tr>
        </tbody>
    </table>
    <button onclick="$('#tagHistory').hide()" class="btn btn-warning"> <i class="fa fa-close"></i> Close</button>
</div>