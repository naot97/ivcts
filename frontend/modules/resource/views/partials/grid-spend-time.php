<style type="text/css">
    #tblSpendTime thead tr th {
        text-align: center;
        font-weight: bold;
    }
    #tblSpendTime tbody tr {
        cursor: pointer;
    }
    #tblSpendTime tbody tr td {
        text-align: left;
    }
    #tblSpendTime tbody tr td a{
        color: #4680ff;
    }
    #tblSpendTime tbody .sumCol {
        background-color: green;
        cursor: auto;
    }
    #tblSpendTime tbody .sumCol:hover {
        background-color: green;
        cursor: auto;
    }
    #tblSpendTime tbody .sumCol td {
        color: white;
    }
    #tblSpendTime tbody tr .tdblock {
        cursor: auto;
        vertical-align: middle;
    }
    #tblSpendTime tbody tr:hover {
        background-color: #DDDDDD;
    }
    #tblSpendTime tbody tr:hover > .tdblock {
        background-color: #fff;
    }
</style>

<div class="table-responsive" >
    <h4 class="card-header text-white">Spend Time List</h4>
    <br>
    <table id="tblSpendTime" class="display nowrap table table-bordered" cellspacing="0" width="100%" height="200%">
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
            </tr>
        </thead>
        <tbody >         
            <tr ng-repeat-start="st in lstSpendTime" 
                ng-dblclick="rowSelected(st.spendTimeID)">              
                <td class="index" style=" vertical-align: middle; text-align: center" onclick="$('#tagHistory').show();$('#tagHistory').dropdown('toggle')" ng-click="GetLogs($index)">
                    <a href="#">{{$index + 1}}<a/>
                </td>             
                <td>
                    {{GetNameElement(st.sectionID, 's')}}
                </td>  
                                
                <td ng-if="(count = CountSpendTime(st.employeeID)) > 1" rowspan="{{count}}" class="tdblock"
                    ng-dblclick="">
                    {{GetNameElement(st.employeeID, 'e')}}
                </td>           
                <td ng-if="count === 1">
                    {{GetNameElement(st.employeeID, 'e')}}
                </td>        
                <td ng-if="count === 0" hidden="hidden">
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
            </tr>
            <tr ng-repeat-end ng-if="GetCurrent(st.spendTimeID, st.employeeID)" class="sumCol">
                <td colspan="7"></td>
                <td><b>{{GetSum('e')}}</b></td>
                <td><b>{{GetSum('o')}}</b></td>
            </tr>
        </tbody>
    </table>
</div>